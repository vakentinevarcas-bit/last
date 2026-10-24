<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

if (!$pdo) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . ($dbError ?? 'MySQL server unreachable')]);
    exit;
}

$loginInput = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($loginInput) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Enter both Username/Gmail and Password.']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :input OR email = :input LIMIT 1");
    $stmt->execute(['input' => $loginInput]);
    $user = $stmt->fetch();

    if (!$user && $pdoGame) {
        $stmtGame = $pdoGame->prepare("SELECT * FROM users WHERE username = :input OR email = :input LIMIT 1");
        $stmtGame->execute(['input' => $loginInput]);
        $user = $stmtGame->fetch();
    }

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        try {
            $upd = $pdo->prepare("UPDATE users SET last_active = CURRENT_TIMESTAMP WHERE id = :id");
            $upd->execute(['id' => $user['id']]);
            if ($pdoGame) {
                $updG = $pdoGame->prepare("UPDATE users SET last_active = CURRENT_TIMESTAMP WHERE id = :id");
                $updG->execute(['id' => $user['id']]);
            }
        } catch (Exception $e) {}

        echo json_encode([
            'status' => 'success',
            'message' => 'Naka-login ka na! (Login successful!)',
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'high_score' => intval($user['high_score'] ?? 0),
                'total_score' => intval($user['total_score'] ?? 0),
                'games_played' => intval($user['games_played'] ?? 0)
            ]
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Username/Gmail and Password.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Server error: ' . $e->getMessage()]);
}
