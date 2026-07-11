<?php
/** Admin sidebar navigation — included in all admin pages */
$adminPage = basename($_SERVER['PHP_SELF'], '.php');
?>
<aside class="admin-sidebar">
    <h3>Admin Menu</h3>
    <ul>
        <li><a href="<?= baseUrl('admin/index.php') ?>" class="<?= $adminPage === 'index' ? 'active' : '' ?>">Dashboard</a></li>
        <li><a href="<?= baseUrl('admin/modules.php') ?>" class="<?= $adminPage === 'modules' ? 'active' : '' ?>">Modules</a></li>
        <li><a href="<?= baseUrl('admin/tips.php') ?>" class="<?= $adminPage === 'tips' ? 'active' : '' ?>">Tips</a></li>
        <li><a href="<?= baseUrl('admin/questions.php') ?>" class="<?= $adminPage === 'questions' ? 'active' : '' ?>">Quiz Questions</a></li>
        <li><a href="<?= baseUrl('index.php') ?>">← Back to Site</a></li>
    </ul>
</aside>
