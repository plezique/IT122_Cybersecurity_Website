<?php
/**
 * Authentication helpers — session management, login, registration.
 * Passwords are hashed with password_hash() and verified with password_verify().
 */

require_once __DIR__ . '/db.php';

// Start session if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if a user is logged in.
 */
function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

/**
 * Check if the current user is an admin.
 */
function isAdmin(): bool {
    return isLoggedIn() && ($_SESSION['role'] ?? '') === 'admin';
}

/**
 * Require login — redirect to login page if not authenticated.
 */
function requireLogin(): void {
    if (!isLoggedIn()) {
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        redirect('auth/login.php');
    }
}

/**
 * Require admin role — redirect non-admins to home.
 */
function requireAdmin(): void {
    requireLogin();
    if (!isAdmin()) {
        redirect('index.php');
    }
}

/**
 * Get the current logged-in user's data from session.
 */
function currentUser(): ?array {
    if (!isLoggedIn()) {
        return null;
    }
    return [
        'user_id'  => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'email'    => $_SESSION['email'],
        'role'     => $_SESSION['role'],
    ];
}

/**
 * Register a new user with hashed password.
 */
function registerUser(string $username, string $email, string $password): array {
    $db = getDB();

    // Validate input
    $errors = [];
    if (strlen($username) < 3 || strlen($username) > 50) {
        $errors[] = 'Username must be between 3 and 50 characters.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }

    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }

    // Check for duplicate username or email
    $stmt = $db->prepare('SELECT user_id FROM users WHERE username = ? OR email = ?');
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) {
        return ['success' => false, 'errors' => ['Username or email already exists.']];
    }

    // Hash password and insert user (prepared statement prevents SQL injection)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare(
        'INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)'
    );
    $stmt->execute([$username, $email, $hashedPassword, 'user']);

    return ['success' => true, 'user_id' => (int) $db->lastInsertId()];
}

/**
 * Authenticate user login.
 */
function loginUser(string $username, string $password): array {
    $db = getDB();

    $stmt = $db->prepare('SELECT user_id, username, email, password, role FROM users WHERE username = ? OR email = ?');
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        return ['success' => false, 'errors' => ['Invalid username or password.']];
    }

    // Set session variables
    $_SESSION['user_id']  = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email']    = $user['email'];
    $_SESSION['role']     = $user['role'];

    return ['success' => true];
}

/**
 * Log out the current user.
 */
function logoutUser(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
    }
    session_destroy();
}

/**
 * Save quiz result for a logged-in user.
 */
function saveQuizResult(int $userId, string $quizType, int $score, int $total, ?string $level = null, ?int $moduleId = null): void {
    $db = getDB();
    $stmt = $db->prepare(
        'INSERT INTO quiz_results (user_id, quiz_type, score, total_questions, awareness_level, module_id) VALUES (?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([$userId, $quizType, $score, $total, $level, $moduleId]);
}

/**
 * Get quiz history for a user.
 */
function getQuizHistory(int $userId, int $limit = 10): array {
    $db = getDB();
    $stmt = $db->prepare(
        'SELECT qr.*, m.title AS module_title
         FROM quiz_results qr
         LEFT JOIN modules m ON qr.module_id = m.module_id
         WHERE qr.user_id = ?
         ORDER BY qr.date_taken DESC
         LIMIT ?'
    );
    $stmt->bindValue(1, $userId, PDO::PARAM_INT);
    $stmt->bindValue(2, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}
