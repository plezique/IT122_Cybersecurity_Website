<?php
/**
 * Admin — Manage Quiz Questions (CRUD).
 */
$pageTitle = 'Manage Quiz Questions';
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();

$db = getDB();
$message = '';
$error = '';

if (isset($_GET['delete'])) {
    $id = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
    if ($id) {
        $stmt = $db->prepare('DELETE FROM quiz_questions WHERE question_id = ?');
        $stmt->execute([$id]);
        $message = 'Question deleted successfully.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'question_id', FILTER_VALIDATE_INT);
    $questionText = trim($_POST['question_text'] ?? '');
    $optionA = trim($_POST['option_a'] ?? '');
    $optionB = trim($_POST['option_b'] ?? '');
    $optionC = trim($_POST['option_c'] ?? '');
    $optionD = trim($_POST['option_d'] ?? '');
    $correctAnswer = strtoupper(trim($_POST['correct_answer'] ?? ''));
    $explanation = trim($_POST['explanation'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $quizType = $_POST['quiz_type'] ?? 'awareness';

    if (empty($questionText) || empty($optionA) || empty($correctAnswer) || empty($explanation)) {
        $error = 'Question text, at least option A, correct answer, and explanation are required.';
    } elseif (!in_array($correctAnswer, ['A', 'B', 'C', 'D'])) {
        $error = 'Correct answer must be A, B, C, or D.';
    } else {
        if ($id) {
            $stmt = $db->prepare(
                'UPDATE quiz_questions SET question_text=?, option_a=?, option_b=?, option_c=?, option_d=?,
                 correct_answer=?, explanation=?, category=?, quiz_type=? WHERE question_id=?'
            );
            $stmt->execute([$questionText, $optionA, $optionB, $optionC, $optionD, $correctAnswer, $explanation, $category, $quizType, $id]);
            $message = 'Question updated successfully.';
        } else {
            $stmt = $db->prepare(
                'INSERT INTO quiz_questions (question_text, option_a, option_b, option_c, option_d,
                 correct_answer, explanation, category, quiz_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([$questionText, $optionA, $optionB, $optionC, $optionD, $correctAnswer, $explanation, $category, $quizType]);
            $message = 'Question created successfully.';
        }
    }
}

$editQuestion = null;
if (isset($_GET['edit'])) {
    $editId = filter_input(INPUT_GET, 'edit', FILTER_VALIDATE_INT);
    if ($editId) {
        $stmt = $db->prepare('SELECT * FROM quiz_questions WHERE question_id = ?');
        $stmt->execute([$editId]);
        $editQuestion = $stmt->fetch();
    }
}

$questions = $db->query('SELECT question_id, question_text, category, quiz_type FROM quiz_questions ORDER BY quiz_type, question_id')->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container"><h1>Manage Quiz Questions</h1></div>
</div>

<section class="section">
    <div class="container">
        <div class="admin-layout">
            <?php include __DIR__ . '/sidebar.php'; ?>
            <div class="admin-content">
                <?php if ($message): ?><div class="alert alert-success"><?= e($message) ?></div><?php endif; ?>
                <?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>

                <div class="card mb-3">
                    <h3><?= $editQuestion ? 'Edit Question' : 'Add New Question' ?></h3>
                    <form method="POST">
                        <?php if ($editQuestion): ?>
                            <input type="hidden" name="question_id" value="<?= $editQuestion['question_id'] ?>">
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="quiz_type">Quiz Type</label>
                            <select id="quiz_type" name="quiz_type">
                                <option value="phishing" <?= ($editQuestion['quiz_type'] ?? '') === 'phishing' ? 'selected' : '' ?>>Phishing</option>
                                <option value="awareness" <?= ($editQuestion['quiz_type'] ?? 'awareness') === 'awareness' ? 'selected' : '' ?>>Awareness</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="question_text">Question</label>
                            <textarea id="question_text" name="question_text" required rows="3"><?= e($editQuestion['question_text'] ?? '') ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="option_a">Option A</label>
                            <input type="text" id="option_a" name="option_a" required value="<?= e($editQuestion['option_a'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="option_b">Option B</label>
                            <input type="text" id="option_b" name="option_b" value="<?= e($editQuestion['option_b'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="option_c">Option C</label>
                            <input type="text" id="option_c" name="option_c" value="<?= e($editQuestion['option_c'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="option_d">Option D</label>
                            <input type="text" id="option_d" name="option_d" value="<?= e($editQuestion['option_d'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="correct_answer">Correct Answer (A/B/C/D)</label>
                            <input type="text" id="correct_answer" name="correct_answer" required maxlength="1"
                                   value="<?= e($editQuestion['correct_answer'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="explanation">Explanation</label>
                            <textarea id="explanation" name="explanation" required rows="2"><?= e($editQuestion['explanation'] ?? '') ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" id="category" name="category" value="<?= e($editQuestion['category'] ?? '') ?>">
                        </div>
                        <button type="submit" class="btn btn-primary"><?= $editQuestion ? 'Update' : 'Create' ?> Question</button>
                        <?php if ($editQuestion): ?>
                            <a href="<?= baseUrl('admin/questions.php') ?>" class="btn btn-outline">Cancel</a>
                        <?php endif; ?>
                    </form>
                </div>

                <table class="admin-table">
                    <thead><tr><th>ID</th><th>Question</th><th>Type</th><th>Category</th><th>Actions</th></tr></thead>
                    <tbody>
                        <?php foreach ($questions as $q): ?>
                        <tr>
                            <td><?= $q['question_id'] ?></td>
                            <td><?= e(mb_strimwidth($q['question_text'], 0, 60, '...')) ?></td>
                            <td><?= e($q['quiz_type']) ?></td>
                            <td><?= e($q['category']) ?></td>
                            <td class="admin-actions">
                                <a href="?edit=<?= $q['question_id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                                <a href="?delete=<?= $q['question_id'] ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Delete this question?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
