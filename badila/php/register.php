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

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($email) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Kinahanglan nga sabtan ang Username, Gmail/Email kag Password (Username, Gmail/Email and Password are required).']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Palihog butangi sang insakto nga Gmail/Email address (Please enter a valid Gmail/Email address, e.g. name@gmail.com).']);
    exit;
}

if (strlen($username) < 3) {
    echo json_encode(['status' => 'error', 'message' => 'Ang username kinahanglan indi nubo sa 3 ka characters (Username must be at least 3 chars).']);
    exit;
}

if (strlen($password) < 4) {
    echo json_encode(['status' => 'error', 'message' => 'Ang password kinahanglan indi nubo sa 4 ka characters (Password must be at least 4 chars).']);
    exit;
}

try {
    // Check if username already exists in database
    $checkStmt = $pdo->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
    $checkStmt->execute(['username' => $username]);
    if ($checkStmt->fetch()) {
        echo json_encode(['status' => 'error', 'message' => 'Ang Username na-gamit na (Username already exists).']);
        exit;
    }

    // Check if email already exists in database
    $checkEmailStmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
    $checkEmailStmt->execute(['email' => $email]);
    if ($checkEmailStmt->fetch()) {
        echo json_encode(['status' => 'error', 'message' => 'Ang Gmail/Email na-gamit na (Gmail/Email already registered).']);
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $insertStmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $insertStmt->execute([
        'username' => $username,
        'email' => $email,
        'password' => $hashedPassword
    ]);
    $userId = $pdo->lastInsertId();

    try {
        if ($pdoGame) {
            $insertGameStmt = $pdoGame->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $insertGameStmt->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword
            ]);
        }
    } catch (PDOException $ex) {
    }

    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    echo json_encode([
        'status' => 'success',
        'message' => 'Naka-himo ka na sang Account! Na-save sa database! (Account created successfully!)',
        'user' => [
            'id' => $userId,
            'username' => $username,
            'email' => $email,
            'high_score' => 0,
            'total_score' => 0,
            'games_played' => 0
        ]
    ]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
