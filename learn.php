<?php
/**
 * Learning Modules — lists all educational modules from the database.
 */
$pageTitle = 'Learning Modules';
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$stmt = $db->query('SELECT module_id, title, category, icon FROM modules ORDER BY module_id ASC');
$modules = $stmt->fetchAll();
?>

<div class="page-header">
    <div class="container">
        <span class="data-tag">Modules</span>
        <h1 class="mt-2">Learning Modules</h1>
        <p>Practical cybersecurity lessons with real-world examples and key takeaways.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="card-grid">
            <?php foreach ($modules as $i => $module): ?>
            <a href="<?= baseUrl('module.php?id=' . $module['module_id']) ?>" class="card card-link reveal<?= $i % 4 ? ' reveal-delay-' . ($i % 4) : '' ?>">
                <div class="card-icon" aria-hidden="true"><?= moduleIcon($module['icon']) ?></div>
                <h3><?= e($module['title']) ?></h3>
                <p><?= e($module['category']) ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
