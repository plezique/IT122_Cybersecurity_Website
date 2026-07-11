<?php
/**
 * User Dashboard — quiz history and progress tracking.
 */
$pageTitle = 'Dashboard';
require_once __DIR__ . '/includes/auth.php';
requireLogin();

$user = currentUser();
$history = getQuizHistory($user['user_id'], 20);

// Calculate stats
$totalQuizzes = count($history);
$avgScore = 0;
if ($totalQuizzes > 0) {
    $totalPct = 0;
    foreach ($history as $result) {
        $totalPct += ($result['score'] / $result['total_questions']) * 100;
    }
    $avgScore = round($totalPct / $totalQuizzes);
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="data-tag">Dashboard</span>
        <h1 class="mt-2">Welcome, <?= e($user['username']) ?>!</h1>
        <p>Track your quiz progress and security awareness journey.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value"><?= $totalQuizzes ?></div>
                <div class="stat-label">Quizzes Taken</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= $avgScore ?>%</div>
                <div class="stat-label">Average Score</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">
                    <?php
                    $latestLevel = '—';
                    foreach ($history as $r) {
                        if ($r['awareness_level']) {
                            $latestLevel = $r['awareness_level'];
                            break;
                        }
                    }
                    echo e($latestLevel);
                    ?>
                </div>
                <div class="stat-label">Latest Awareness Level</div>
            </div>
        </div>

        <h2 class="section-title">Quiz History</h2>

        <?php if (empty($history)): ?>
            <div class="alert alert-info">
                You haven't taken any quizzes yet. <a href="<?= baseUrl('quiz.php') ?>">Take your first quiz</a> to start tracking progress!
            </div>
        <?php else: ?>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Quiz Type</th>
                        <th>Score</th>
                        <th>Percentage</th>
                        <th>Awareness Level</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $result): ?>
                    <?php
                    $quizLabel = ucfirst($result['quiz_type']);
                    if ($result['quiz_type'] === 'module' && !empty($result['module_title'])) {
                        $quizLabel = 'Module: ' . $result['module_title'];
                    }
                    ?>
                    <tr>
                        <td><?= e(date('M j, Y g:ia', strtotime($result['date_taken']))) ?></td>
                        <td><?= e($quizLabel) ?></td>
                        <td><?= e($result['score']) ?>/<?= e($result['total_questions']) ?></td>
                        <td><?= round(($result['score'] / $result['total_questions']) * 100) ?>%</td>
                        <td><?= e($result['awareness_level'] ?? '—') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="text-center mt-3">
            <a href="<?= baseUrl('quiz.php') ?>" class="btn btn-primary">Take Another Quiz</a>
            <a href="<?= baseUrl('learn.php') ?>" class="btn btn-outline">Review Modules</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
