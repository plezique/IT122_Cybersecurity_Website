<?php
/**
 * User Login Page
 */
$pageTitle = 'Login';
require_once __DIR__ . '/../includes/auth.php';

// Redirect if already logged in
if (isLoggedIn()) {
    redirect('dashboard.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $errors[] = 'Please enter both username and password.';
    } else {
        $result = loginUser($username, $password);
        if ($result['success']) {
            $redirect = $_SESSION['redirect_after_login'] ?? baseUrl('dashboard.php');
            unset($_SESSION['redirect_after_login']);
            header('Location: ' . $redirect);
            exit;
        } else {
            $errors = $result['errors'];
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="data-tag">Login</span>
        <h1 class="mt-2">Login</h1>
        <p>Sign in to track your quiz progress and access your dashboard.</p>
    </div>
</div>

<section class="section">
    <div class="form-card">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <?php foreach ($errors as $error): ?>
                    <p><?= e($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username or Email</label>
                <input type="text" id="username" name="username" required
                       value="<?= e($_POST['username'] ?? '') ?>" autocomplete="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-field">
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                    <button type="button" class="toggle-password" aria-label="Show password" data-target="password"></button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;">Login</button>
        </form>

        <p class="text-center text-muted mt-2">
            Don't have an account? <a href="<?= baseUrl('auth/register.php') ?>">Register here</a>
        </p>

        <div class="alert alert-info mt-3" style="font-size:0.85rem;">
            <strong>Demo accounts:</strong><br>
            Admin: admin / admin123<br>
            User: demo_user / user123
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
