<?php
/**
 * User Registration Page
 */
$pageTitle = 'Register';
require_once __DIR__ . '/../includes/auth.php';

if (isLoggedIn()) {
    redirect('dashboard.php');
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    } else {
        $result = registerUser($username, $email, $password);
        if ($result['success']) {
            loginUser($username, $password);
            redirect('dashboard.php');
        } else {
            $errors = $result['errors'];
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="data-tag">Register</span>
        <h1 class="mt-2">Create Account</h1>
        <p>Register to save quiz results and track your security awareness progress.</p>
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
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required minlength="3" maxlength="50"
                       value="<?= e($_POST['username'] ?? '') ?>" autocomplete="username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required
                       value="<?= e($_POST['email'] ?? '') ?>" autocomplete="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-field">
                    <input type="password" id="password" name="password" required minlength="6" autocomplete="new-password" data-strength-check>
                    <button type="button" class="toggle-password" aria-label="Show password" data-target="password"></button>
                </div>
                <div class="register-strength" id="register-strength" aria-live="polite">
                    <div class="strength-meter"><div class="strength-meter-fill" id="register-strength-fill"></div></div>
                    <p class="strength-label" id="register-strength-label">At least 6 characters required</p>
                </div>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <div class="password-field">
                    <input type="password" id="confirm_password" name="confirm_password" required minlength="6" autocomplete="new-password">
                    <button type="button" class="toggle-password" aria-label="Show password" data-target="confirm_password"></button>
                </div>
                <p class="field-hint field-hint-error" id="password-match-hint" hidden>Passwords do not match.</p>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;">Create Account</button>
        </form>

        <p class="text-center text-muted mt-2">
            Already have an account? <a href="<?= baseUrl('auth/login.php') ?>">Login here</a>
        </p>
    </div>
</section>

<?php
$extraScripts = ['assets/js/password-checker.js'];
require_once __DIR__ . '/../includes/footer.php';
?>
