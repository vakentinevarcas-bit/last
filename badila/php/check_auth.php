<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/db.php';

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $userId = $_SESSION['user_id'];
    $userStats = null;
    if ($pdo) {
        $stmt = $pdo->prepare("SELECT id, username, email, high_score, total_score, games_played FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $userId]);
        $userStats = $stmt->fetch();
    }
    
    echo json_encode([
        'status' => 'success',
        'logged_in' => true,
        'user' => [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'email' => $_SESSION['email'] ?? '',
            'high_score' => intval($userStats['high_score'] ?? 0),
            'total_score' => intval($userStats['total_score'] ?? 0),
            'games_played' => intval($userStats['games_played'] ?? 0)
        ]
    ]);
} else {
    echo json_encode([
        'status' => 'success',
        'logged_in' => false
    ]);
}
