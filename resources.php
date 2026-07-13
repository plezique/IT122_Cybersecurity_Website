<?php
/**
 * Resources Page — curated tools and cybersecurity glossary.
 */
$pageTitle = 'Resources';
require_once __DIR__ . '/includes/header.php';

$db = getDB();

$toolsStmt = $db->prepare('SELECT * FROM resources WHERE resource_type = ? ORDER BY category, name');
$toolsStmt->execute(['tool']);
$tools = $toolsStmt->fetchAll();

$glossaryStmt = $db->prepare('SELECT * FROM resources WHERE resource_type = ? ORDER BY name');
$glossaryStmt->execute(['glossary']);
$glossary = $glossaryStmt->fetchAll();

$categoryOrder = [
    'Password Managers',
    'VPN Services',
    'Antivirus Tools',
    'Browser Privacy & Security Extensions',
    'Two-Factor Authentication (2FA) Apps',
    'Data Breach & Security Check Tools',
    'Learning & News Sources',
    'Mobile Security Tools',
];

$pricingLabels = [
    'free' => 'Free',
    'paid' => 'Paid',
    'freemium' => 'Freemium',
    'built-in' => 'Built-in',
];

// Group tools by category
$toolsByCategory = [];
foreach ($tools as $tool) {
    $toolsByCategory[$tool['category']][] = $tool;
}

uksort($toolsByCategory, function ($a, $b) use ($categoryOrder) {
    $posA = array_search($a, $categoryOrder, true);
    $posB = array_search($b, $categoryOrder, true);
    $posA = $posA === false ? PHP_INT_MAX : $posA;
    $posB = $posB === false ? PHP_INT_MAX : $posB;
    return $posA <=> $posB;
});
?>

<div class="page-header">
    <div class="container">
        <span class="data-tag">Resources</span>
        <h1 class="mt-2">Resources</h1>
        <p>Trusted tools and references to help you put these lessons into practice.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="tip-widget mb-3">
            <div class="tip-label">
                <?= icon('zap') ?>
                Quick Tips Cheat Sheet
            </div>
            <p>Scannable security tips organized by category — perfect for a quick refresher before exams or at work.</p>
            <a href="<?= baseUrl('tips.php') ?>" class="btn btn-outline btn-sm mt-2">Browse Tips &rarr;</a>
        </div>

        <h2 class="section-title">Recommended Tools</h2>
        <p class="section-subtitle">Legitimate, widely-used security tools to help protect your digital life.</p>

        <?php foreach ($toolsByCategory as $category => $categoryTools): ?>
        <h3 class="mt-3 mb-2" style="color: var(--color-text); font-family: var(--font-heading);"><?= e($category) ?></h3>
        <div class="card-grid mb-3">
            <?php foreach ($categoryTools as $tool): ?>
            <div class="card">
                <div class="resource-card">
                    <span class="resource-icon" aria-hidden="true"><?= icon('tool') ?></span>
                    <div>
                        <div class="resource-card-header">
                            <h3><?= e($tool['name']) ?></h3>
                            <?php if (!empty($tool['pricing']) && isset($pricingLabels[$tool['pricing']])): ?>
                                <span class="resource-pricing-tag"><?= e($pricingLabels[$tool['pricing']]) ?></span>
                            <?php endif; ?>
                        </div>
                        <p><?= e($tool['description']) ?></p>
                        <?php if ($tool['url']): ?>
                            <a href="<?= e($tool['url']) ?>" target="_blank" rel="noopener noreferrer">Visit website &rarr;</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <h2 class="section-title">Glossary</h2>
        <p class="section-subtitle">Key cybersecurity terms explained in plain language.</p>

        <dl class="glossary-grid">
            <?php foreach ($glossary as $term): ?>
            <div class="glossary-item">
                <dt><?= e($term['name']) ?></dt>
                <dd><?= e($term['description']) ?></dd>
            </div>
            <?php endforeach; ?>
        </dl>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
