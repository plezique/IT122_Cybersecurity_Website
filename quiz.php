<?php
/**
 * Quiz & Tools Page — phishing quiz, awareness quiz, and password checker.
 */
$pageTitle = 'Quiz & Tools';
require_once __DIR__ . '/includes/header.php';

$db = getDB();

// Fetch quiz questions by type from database
$phishingStmt = $db->prepare('SELECT * FROM quiz_questions WHERE quiz_type = ? ORDER BY question_id');
$phishingStmt->execute(['phishing']);
$phishingQuestions = $phishingStmt->fetchAll();

$awarenessStmt = $db->prepare('SELECT * FROM quiz_questions WHERE quiz_type = ? ORDER BY question_id');
$awarenessStmt->execute(['awareness']);
$awarenessQuestions = $awarenessStmt->fetchAll();

$extraScripts = ['assets/js/quiz.js', 'assets/js/password-checker.js'];
?>

<div class="page-header">
    <div class="container">
        <span class="data-tag">Quiz & Tools</span>
        <h1 class="mt-2">Quiz & Tools</h1>
        <p>Test your security awareness and check password strength — interactive and educational.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="quiz-tabs" role="tablist">
            <button class="quiz-tab active" data-tab="phishing-quiz" role="tab">Phishing Quiz</button>
            <button class="quiz-tab" data-tab="awareness-quiz" role="tab">Awareness Quiz</button>
            <button class="quiz-tab" data-tab="password-tool" role="tab">Password Checker</button>
        </div>

        <!-- Phishing Identification Quiz -->
        <div id="phishing-quiz" class="quiz-panel active" role="tabpanel">
            <div class="quiz-container">
                <p class="text-muted mb-3">Can you spot a phishing attempt? Answer each question and see the explanation immediately.</p>
                <div class="quiz-engine"
                     data-quiz-type="phishing"
                     data-questions="<?= htmlspecialchars(json_encode($phishingQuestions), ENT_QUOTES, 'UTF-8') ?>"
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
                        <h3>Quiz Complete!</h3>
                        <p class="result-message"></p>
                        <button type="button" class="btn btn-outline mt-2 quiz-retake-btn">Try Again</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Awareness Quiz -->
        <div id="awareness-quiz" class="quiz-panel" role="tabpanel">
            <div class="quiz-container">
                <p class="text-muted mb-3">A broader security awareness quiz covering passwords, malware, networks, and more.</p>
                <?php if (!isLoggedIn()): ?>
                    <div class="alert alert-info mb-3">Log in to save your quiz results and track progress over time.</div>
                <?php endif; ?>
                <div class="quiz-engine"
                     data-quiz-type="awareness"
                     data-questions="<?= htmlspecialchars(json_encode($awarenessQuestions), ENT_QUOTES, 'UTF-8') ?>"
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
                        <h3>Quiz Complete!</h3>
                        <p class="result-message"></p>
                        <button type="button" class="btn btn-outline mt-2 quiz-retake-btn">Try Again</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Strength Checker -->
        <div id="password-tool" class="quiz-panel" role="tabpanel">
            <div class="password-checker">
                <h2 class="section-title text-center">Password Strength Checker</h2>
                <p class="text-muted text-center mb-3">Type a password below to see how strong it is. Nothing is sent to any server.</p>

                <div class="question-card">
                    <div class="password-input-group">
                        <label for="password-input">Test a password</label>
                        <div class="password-field">
                            <input type="password" id="password-input" placeholder="Enter a password to check..." autocomplete="off">
                            <button type="button" class="toggle-password" aria-label="Show password" data-target="password-input"></button>
                        </div>
                    </div>

                    <div class="strength-meter">
                        <div class="strength-meter-fill" id="strength-meter-fill"></div>
                    </div>
                    <p class="strength-label" id="strength-label">Enter a password to check</p>

                    <ul class="strength-tips" id="strength-criteria">
                        <li data-criterion="length" class="unmet">At least 12 characters</li>
                        <li data-criterion="upper" class="unmet">Contains uppercase letter</li>
                        <li data-criterion="lower" class="unmet">Contains lowercase letter</li>
                        <li data-criterion="number" class="unmet">Contains a number</li>
                        <li data-criterion="special" class="unmet">Contains special character</li>
                        <li data-criterion="unique" class="unmet">No repeated character sequences</li>
                    </ul>

                    <p class="privacy-note"><?= icon('lock') ?> This tool runs entirely in your browser. Your password is never transmitted or stored.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
