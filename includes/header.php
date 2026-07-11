<?php
/**
 * Shared site header with navigation.
 */
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/icons.php';

$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CyberSafe Learn — Practical cybersecurity awareness for students and everyday internet users.">
    <title><?= isset($pageTitle) ? e($pageTitle) . ' | ' : '' ?><?= e(SITE_NAME) ?></title>
    <script>
        (function () {
            var key = 'cybersafe-theme';
            var saved = localStorage.getItem(key);
            var theme = saved || (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');
            if (theme === 'light') {
                document.documentElement.setAttribute('data-theme', 'light');
            }
        })();
    </script>
    <link rel="stylesheet" href="<?= baseUrl('assets/css/style.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=Inter:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <header class="site-header">
        <div class="container header-inner">
            <a href="<?= baseUrl('index.php') ?>" class="logo">
                <span class="logo-icon" aria-hidden="true"><?= icon('shield', 'logo-icon-svg') ?></span>
                <span class="logo-text"><?= e(SITE_NAME) ?></span>
            </a>

            <nav class="main-nav" aria-label="Main navigation">
                <ul>
                    <li><a href="<?= baseUrl('index.php') ?>" class="<?= $currentPage === 'index' ? 'active' : '' ?>">Home</a></li>
                    <li><a href="<?= baseUrl('learn.php') ?>" class="<?= in_array($currentPage, ['learn', 'module']) ? 'active' : '' ?>">Learn</a></li>
                    <li><a href="<?= baseUrl('quiz.php') ?>" class="<?= $currentPage === 'quiz' ? 'active' : '' ?>">Quiz & Tools</a></li>
                    <li><a href="<?= baseUrl('resources.php') ?>" class="<?= $currentPage === 'resources' ? 'active' : '' ?>">Resources</a></li>
                    <li><a href="<?= baseUrl('about.php') ?>" class="<?= $currentPage === 'about' ? 'active' : '' ?>">About</a></li>
                    <?php if (isLoggedIn()): ?>
                        <li><a href="<?= baseUrl('dashboard.php') ?>" class="<?= $currentPage === 'dashboard' ? 'active' : '' ?>">Dashboard</a></li>
                        <?php if (isAdmin()): ?>
                            <li><a href="<?= baseUrl('admin/index.php') ?>" class="<?= strpos($_SERVER['PHP_SELF'], '/admin/') !== false ? 'active' : '' ?>">Admin</a></li>
                        <?php endif; ?>
                        <li><a href="<?= baseUrl('auth/logout.php') ?>" class="nav-logout">Logout</a></li>
                    <?php else: ?>
                        <li><a href="<?= baseUrl('auth/login.php') ?>" class="nav-cta">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="header-actions">
                <button type="button" class="theme-toggle" aria-label="Switch to light mode" aria-pressed="false" title="Toggle dark/light mode">
                    <span class="theme-toggle-track" aria-hidden="true">
                        <span class="theme-toggle-icon theme-toggle-icon--sun"><?= icon('sun', 'theme-toggle-svg') ?></span>
                        <span class="theme-toggle-icon theme-toggle-icon--moon"><?= icon('moon', 'theme-toggle-svg') ?></span>
                        <span class="theme-toggle-thumb">
                            <span class="theme-toggle-thumb-icon theme-toggle-thumb-icon--sun"><?= icon('sun', 'theme-toggle-svg') ?></span>
                            <span class="theme-toggle-thumb-icon theme-toggle-thumb-icon--moon"><?= icon('moon', 'theme-toggle-svg') ?></span>
                        </span>
                    </span>
                </button>

                <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    <main id="main-content">
