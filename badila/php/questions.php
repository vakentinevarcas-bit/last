<?php
session_start();
require_once __DIR__ . '/db.php';

header('Content-Type: application/json; charset=utf-8');

function isAdmin(): bool
{
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function respond(array $data, int $statusCode = 200): void
{
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

function hasValidCsrfToken(): bool
{
    $expected = $_SESSION['csrf_token'] ?? '';
    $provided = $_POST['csrf_token'] ?? '';
    return is_string($expected) && $expected !== '' && is_string($provided) && hash_equals($expected, $provided);
}

if (!$pdo) {
    respond(['status' => 'error', 'message' => 'Database connection failed: ' . ($dbError ?? 'MySQL server unreachable')], 500);
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

try {
    if ($action === 'get') {
        $stmt = $pdo->query('SELECT id, stage, term, definition FROM quiz_questions WHERE is_active = 1 ORDER BY stage, term');
        respond(['status' => 'success', 'questions' => $stmt->fetchAll()]);
    }

    if (!isAdmin()) {
        respond(['status' => 'error', 'message' => 'Administrator access is required.'], 403);
    }

    if ($action === 'seed') {
        if (!hasValidCsrfToken()) {
            respond(['status' => 'error', 'message' => 'The security token is invalid. Refresh the page and try again.'], 403);
        }
        $defaults = json_decode($_POST['questions'] ?? '', true);
        if (!is_array($defaults) || count($defaults) < 4 || count($defaults) > 100) {
            respond(['status' => 'error', 'message' => 'The default quiz question list is invalid.'], 400);
        }

        $pdo->beginTransaction();
        $seedState = $pdo->query('SELECT id FROM quiz_question_seed_state WHERE id = 1')->fetchColumn();
        if (!$seedState) {
            $insert = $pdo->prepare('INSERT IGNORE INTO quiz_questions (stage, term, definition) VALUES (:stage, :term, :definition)');
            foreach ($defaults as $question) {
                if (!is_array($question)) {
                    $pdo->rollBack();
                    respond(['status' => 'error', 'message' => 'A default quiz question is invalid.'], 400);
                }
                $stage = filter_var($question['stage'] ?? null, FILTER_VALIDATE_INT);
                $term = strtoupper(trim($question['term'] ?? ''));
                $definition = trim($question['definition'] ?? '');
                if ($stage === false || $stage < 1 || $stage > 3 || !preg_match('/^[A-Z][A-Z0-9]{1,23}$/', $term) || $definition === '') {
                    $pdo->rollBack();
                    respond(['status' => 'error', 'message' => 'A default quiz question is invalid.'], 400);
                }
                $insert->execute(['stage' => $stage, 'term' => $term, 'definition' => $definition]);
            }
            $pdo->exec('INSERT IGNORE INTO quiz_question_seed_state (id) VALUES (1)');
        }
        $pdo->commit();
        respond(['status' => 'success', 'message' => 'Quiz questions initialized.']);
    }

    if ($action === 'admin_list') {
        $stmt = $pdo->query('SELECT id, stage, term, definition FROM quiz_questions WHERE is_active = 1 ORDER BY stage, term');
        respond(['status' => 'success', 'questions' => $stmt->fetchAll()]);
    }

    if ($action === 'create') {
        if (!hasValidCsrfToken()) {
            respond(['status' => 'error', 'message' => 'The security token is invalid. Refresh the page and try again.'], 403);
        }

        $stage = filter_var($_POST['stage'] ?? null, FILTER_VALIDATE_INT);
        $term = strtoupper(trim($_POST['term'] ?? ''));
        $definition = trim($_POST['definition'] ?? '');
        $definitionLength = function_exists('mb_strlen') ? mb_strlen($definition, 'UTF-8') : strlen($definition);

        if ($stage === false || !in_array($stage, [1, 2, 3], true) || !preg_match('/^[A-Z][A-Z0-9]{1,23}$/', $term) || $definition === '' || $definitionLength > 2000) {
            respond(['status' => 'error', 'message' => 'Enter a valid stage, term, and definition of up to 2,000 characters.'], 400);
        }

        $stageSizes = [1 => 14, 2 => 15, 3 => 16];
        if (strlen($term) > ($stageSizes[(int)$stage] ?? 0)) {
            respond(['status' => 'error', 'message' => 'The term is too long for its stage word-search grid.'], 400);
        }

        $insert = $pdo->prepare('INSERT INTO quiz_questions (stage, term, definition) VALUES (:stage, :term, :definition)');
        try {
            $insert->execute(['stage' => $stage, 'term' => $term, 'definition' => $definition]);
            respond(['status' => 'success', 'message' => 'Quiz question created.']);
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                respond(['status' => 'error', 'message' => 'That term already exists in this stage.'], 409);
            }
            throw $e;
        }
    }

    if ($action === 'update') {
        if (!hasValidCsrfToken()) {
            respond(['status' => 'error', 'message' => 'The security token is invalid. Refresh the page and try again.'], 403);
        }
        $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
        $stageInput = $_POST['stage'] ?? null;
        $stage = $stageInput === null ? null : filter_var($stageInput, FILTER_VALIDATE_INT);
        $term = strtoupper(trim($_POST['term'] ?? ''));
        $definition = trim($_POST['definition'] ?? '');
        $definitionLength = function_exists('mb_strlen') ? mb_strlen($definition, 'UTF-8') : strlen($definition);
        if (!$id || ($stageInput !== null && ($stage === false || !in_array($stage, [1, 2, 3], true))) || !preg_match('/^[A-Z][A-Z0-9]{1,23}$/', $term) || $definition === '' || $definitionLength > 2000) {
            respond(['status' => 'error', 'message' => 'Enter a valid term and a definition of up to 2,000 characters.'], 400);
        }

        $stageStmt = $pdo->prepare('SELECT stage FROM quiz_questions WHERE id = :id AND is_active = 1');
        $stageStmt->execute(['id' => $id]);
        $existingStage = $stageStmt->fetchColumn();
        $targetStage = $stage !== null ? $stage : (int)$existingStage;
        $stageSizes = [1 => 14, 2 => 15, 3 => 16];
        if (!$existingStage || strlen($term) > ($stageSizes[(int)$targetStage] ?? 0)) {
            respond(['status' => 'error', 'message' => 'The term is too long for its stage word-search grid.'], 400);
        }

        $stmt = $pdo->prepare('UPDATE quiz_questions SET stage = :stage, term = :term, definition = :definition WHERE id = :id AND is_active = 1');
        $stmt->execute(['stage' => $targetStage, 'term' => $term, 'definition' => $definition, 'id' => $id]);
        if ($stmt->rowCount() === 0) {
            $check = $pdo->prepare('SELECT id FROM quiz_questions WHERE id = :id AND is_active = 1');
            $check->execute(['id' => $id]);
            if (!$check->fetchColumn()) {
                respond(['status' => 'error', 'message' => 'Question not found.'], 404);
            }
        }
        respond(['status' => 'success', 'message' => 'Quiz question updated.']);
    }

    if ($action === 'delete') {
        if (!hasValidCsrfToken()) {
            respond(['status' => 'error', 'message' => 'The security token is invalid. Refresh the page and try again.'], 403);
        }
        $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
        if (!$id) {
            respond(['status' => 'error', 'message' => 'Invalid question ID.'], 400);
        }

        $pdo->beginTransaction();
        $stmt = $pdo->prepare('SELECT stage, is_active FROM quiz_questions WHERE id = :id FOR UPDATE');
        $stmt->execute(['id' => $id]);
        $question = $stmt->fetch();
        if (!$question || !$question['is_active']) {
            $pdo->rollBack();
            respond(['status' => 'error', 'message' => 'Question not found.'], 404);
        }

        $count = $pdo->prepare('SELECT COUNT(*) FROM quiz_questions WHERE stage = :stage AND is_active = 1');
        $count->execute(['stage' => $question['stage']]);
        if ((int)$count->fetchColumn() <= 4) {
            $pdo->rollBack();
            respond(['status' => 'error', 'message' => 'Each stage must keep at least four questions for the quiz choices.'], 400);
        }

        $delete = $pdo->prepare('DELETE FROM quiz_questions WHERE id = :id');
        $delete->execute(['id' => $id]);
        $pdo->commit();
        respond(['status' => 'success', 'message' => 'Quiz question deleted.']);
    }

    respond(['status' => 'error', 'message' => 'Invalid action.'], 400);
} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    if ($action === 'update' && $e->getCode() === '23000') {
        respond(['status' => 'error', 'message' => 'That term already exists in this stage.'], 409);
    }
    error_log('Quiz question API error: ' . $e->getMessage());
    respond(['status' => 'error', 'message' => 'The quiz question request could not be completed.'], 500);
}
