<?php
/**
 * Admin Panel — dashboard with analytics overview.
 */
$pageTitle = 'Admin Panel';
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();

$db = getDB();

// Basic analytics queries
$userCount = $db->query('SELECT COUNT(*) FROM users WHERE role = "user"')->fetchColumn();
$moduleCount = $db->query('SELECT COUNT(*) FROM modules')->fetchColumn();
$tipCount = $db->query('SELECT COUNT(*) FROM tips')->fetchColumn();
$questionCount = $db->query('SELECT COUNT(*) FROM quiz_questions')->fetchColumn();
$quizTakenCount = $db->query('SELECT COUNT(*) FROM quiz_results')->fetchColumn();
$avgScore = $db->query('SELECT ROUND(AVG(score * 100.0 / total_questions), 1) FROM quiz_results')->fetchColumn();

// Most-taken quiz types
$quizBreakdown = $db->query(
    'SELECT quiz_type, COUNT(*) as count, ROUND(AVG(score * 100.0 / total_questions), 1) as avg_pct
     FROM quiz_results GROUP BY quiz_type ORDER BY count DESC'
)->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <h1>Admin Panel</h1>
        <p>Manage content and view site analytics.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="admin-layout">
            <?php include __DIR__ . '/sidebar.php'; ?>

            <div class="admin-content">
                <h2 class="section-title">Overview</h2>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value"><?= (int) $userCount ?></div>
                        <div class="stat-label">Registered Users</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value"><?= (int) $quizTakenCount ?></div>
                        <div class="stat-label">Quizzes Taken</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value"><?= $avgScore ?? 0 ?>%</div>
                        <div class="stat-label">Average Quiz Score</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value"><?= (int) $moduleCount ?></div>
                        <div class="stat-label">Modules</div>
                    </div>
                </div>

                <h3 class="mt-3 mb-2">Content Summary</h3>
                <p class="text-muted"><?= (int) $tipCount ?> tips · <?= (int) $questionCount ?> quiz questions</p>

                <?php if (!empty($quizBreakdown)): ?>
                <h3 class="mt-3 mb-2">Quiz Analytics</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Quiz Type</th>
                            <th>Times Taken</th>
                            <th>Avg Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($quizBreakdown as $row): ?>
                        <tr>
                            <td><?= e(ucfirst($row['quiz_type'])) ?></td>
                            <td><?= (int) $row['count'] ?></td>
                            <td><?= e($row['avg_pct']) ?>%</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
