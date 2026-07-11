<?php
/**
 * Quick Tips / Cheat Sheet — bite-sized tips grouped by category.
 */
$pageTitle = 'Quick Tips';
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$stmt = $db->query('SELECT tip_text, category FROM tips ORDER BY category, tip_id');
$allTips = $stmt->fetchAll();

// Group tips by category
$tipsByCategory = [];
foreach ($allTips as $tip) {
    $tipsByCategory[$tip['category']][] = $tip['tip_text'];
}
?>

<div class="page-header">
    <div class="container">
        <span class="data-tag">Quick Reference</span>
        <h1 class="mt-2">Quick Tips & Cheat Sheet</h1>
        <p>Bite-sized security advice you can scan in seconds. Bookmark this page for a quick refresher.</p>
    </div>
</div>

<section class="section">
    <div class="container" style="max-width: 800px;">
        <p class="text-muted mb-3">
            <button onclick="window.print()" class="btn btn-outline btn-sm"><?= icon('print') ?> Print / Save as PDF</button>
        </p>

        <?php foreach ($tipsByCategory as $category => $tips): ?>
        <div class="tips-category">
            <h2><?= e($category) ?></h2>
            <ul class="tip-list">
                <?php foreach ($tips as $tipText): ?>
                <li><?= e($tipText) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
