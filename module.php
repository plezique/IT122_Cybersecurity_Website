<?php
/**
 * Single Module View — displays full module content with example, takeaway, and module quiz.
 */
require_once __DIR__ . '/includes/db.php';

// Validate and fetch module ID (prevents SQL injection via prepared statement)
$moduleId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$moduleId) {
    header('Location: ' . baseUrl('learn.php'));
    exit;
}

$db = getDB();
$stmt = $db->prepare('SELECT * FROM modules WHERE module_id = ?');
$stmt->execute([$moduleId]);
$module = $stmt->fetch();

if (!$module) {
    header('Location: ' . baseUrl('learn.php'));
    exit;
}

// Fetch quiz questions scoped to this module's category
$quizStmt = $db->prepare('SELECT * FROM quiz_questions WHERE category = ? ORDER BY question_id');
$quizStmt->execute([$module['category']]);
$moduleQuestions = $quizStmt->fetchAll();

$pageTitle = $module['title'];
$extraScripts = ['assets/js/quiz.js'];
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <p class="text-muted mb-2"><a href="<?= baseUrl('learn.php') ?>">&larr; Back to Modules</a></p>
        <span class="data-tag"><?= e($module['category']) ?></span>
        <h1 class="mt-2"><?= e($module['title']) ?></h1>
    </div>
</div>

<section class="section">
    <div class="container" style="max-width: 800px;">
        <article class="module-content">
            <h2>Overview</h2>
            <p><?= e($module['content']) ?></p>

            <?php if ($module['example_text']): ?>
            <div class="example-box">
                <h4>Real-World Example</h4>
                <p><?= e($module['example_text']) ?></p>
            </div>
            <?php endif; ?>

            <?php if ($module['key_takeaway']): ?>
            <div class="takeaway-box">
                <h4>Key Takeaway</h4>
                <p><?= e($module['key_takeaway']) ?></p>
            </div>
            <?php endif; ?>
        </article>

        <div class="module-quiz-section" id="module-quiz">
            <h2 class="section-title">Test Your Knowledge: <?= e($module['title']) ?></h2>
            <p class="text-muted">Answer these questions to reinforce what you learned in this module.</p>

            <?php if (!isLoggedIn()): ?>
                <div class="alert alert-info mt-2">Log in to save your module quiz results to your dashboard.</div>
            <?php endif; ?>

            <?php if (empty($moduleQuestions)): ?>
                <div class="alert alert-info mt-2">
                    Quiz questions for this module are coming soon.
                    <a href="<?= baseUrl('quiz.php') ?>">Try the general awareness quiz</a> in the meantime.
                </div>
            <?php else: ?>
                <div class="quiz-container">
                    <div class="quiz-engine"
                         data-quiz-type="module"
                         data-module-id="<?= (int) $module['module_id'] ?>"
                         data-questions="<?= htmlspecialchars(json_encode($moduleQuestions), ENT_QUOTES, 'UTF-8') ?>"
                         data-save-url="<?= baseUrl('api/save-quiz.php') ?>"
                         data-logged-in="<?= isLoggedIn() ? 'true' : 'false' ?>">
                        <div class="quiz-progress"><div class="quiz-progress-bar"></div></div>
                        <div class="quiz-question-area">
                            <div class="question-card">
                                <h3 class="quiz-question-text"></h3>
                                <ul class="quiz-options"></ul>
                                <div class="explanation-box" style="display:none;"></div>
                            </div>
                            <button class="btn btn-primary quiz-next-btn" style="display:none;">Next Question</button>
                        </div>
                        <div class="quiz-result" style="display:none;">
                            <div class="score-circle"><span class="score-value"></span></div>
                            <div class="awareness-badge"></div>
                            <h3>Module Quiz Complete!</h3>
                            <p class="result-message"></p>
                            <button type="button" class="btn btn-outline mt-2 quiz-retake-btn">Retake Quiz</button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
