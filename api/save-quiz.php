<?php
/**
 * API endpoint — save quiz results for logged-in users.
 * Accepts JSON POST data; uses prepared statements for security.
 */
require_once __DIR__ . '/../includes/auth.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

$quizType = $input['quiz_type'] ?? '';
$score = filter_var($input['score'] ?? 0, FILTER_VALIDATE_INT);
$total = filter_var($input['total'] ?? 0, FILTER_VALIDATE_INT);
$level = $input['awareness_level'] ?? null;
$moduleId = isset($input['module_id']) ? filter_var($input['module_id'], FILTER_VALIDATE_INT) : null;

// Validate inputs
$allowedTypes = ['phishing', 'awareness', 'module'];
if (!in_array($quizType, $allowedTypes) || $score === false || $total === false || $total < 1) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid quiz data']);
    exit;
}

if ($quizType === 'module' && !$moduleId) {
    http_response_code(400);
    echo json_encode(['error' => 'Module ID required for module quizzes']);
    exit;
}

saveQuizResult($_SESSION['user_id'], $quizType, $score, $total, $level, $moduleId ?: null);

echo json_encode(['success' => true]);
