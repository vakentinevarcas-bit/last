<?php
session_start();
require_once __DIR__ . '/../php/db.php';

header('Content-Type: application/json');

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'register') {
        $fullname = trim($_POST['fullname'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $email = strtolower(trim($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';

        if (empty($fullname) || empty($username) || empty($email) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            exit;
        }

        if (strlen($password) < 6) {
            echo json_encode(['status' => 'error', 'message' => 'Password must be at least 6 characters.']);
            exit;
        }

        try {
            $checkStmt = $pdo->prepare("SELECT id FROM admins WHERE username = :u OR email = :e LIMIT 1");
            $checkStmt->execute(['u' => $username, 'e' => $email]);
            if ($checkStmt->fetch()) {
                echo json_encode(['status' => 'error', 'message' => 'Admin Username or Email is already registered in the database.']);
                exit;
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $insertStmt = $pdo->prepare("INSERT INTO admins (fullname, username, email, password) VALUES (:f, :u, :e, :p)");
            $insertStmt->execute([
                'f' => $fullname,
                'u' => $username,
                'e' => $email,
                'p' => $hashedPassword
            ]);
            $adminId = $pdo->lastInsertId();

            try {
                $insertGameStmt = $pdoGame->prepare("INSERT INTO admins (fullname, username, email, password) VALUES (:f, :u, :e, :p)");
                $insertGameStmt->execute([
                    'f' => $fullname,
                    'u' => $username,
                    'e' => $email,
                    'p' => $hashedPassword
                ]);
            } catch (PDOException $ex) {
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'Admin account saved to database successfully! You can now log in.',
                'admin' => [
                    'id' => $adminId,
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email
                ]
            ]);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
        exit;
    }

    if ($action === 'login') {
        $emailOrUsername = trim($_POST['email'] ?? $_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($emailOrUsername) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'Please enter both Email/Username and Password.']);
            exit;
        }

        try {
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = :input OR username = :input LIMIT 1");
            $stmt->execute(['input' => $emailOrUsername]);
            $admin = $stmt->fetch();

            if (!$admin) {
                $stmtGame = $pdoGame->prepare("SELECT * FROM admins WHERE email = :input OR username = :input LIMIT 1");
                $stmtGame->execute(['input' => $emailOrUsername]);
                $admin = $stmtGame->fetch();
            }

            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_fullname'] = $admin['fullname'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_email'] = $admin['email'];

                echo json_encode([
                    'status' => 'success',
                    'message' => 'Login successful! Opening Admin Hub...',
                    'admin' => [
                        'id' => $admin['id'],
                        'fullname' => $admin['fullname'],
                        'username' => $admin['username'],
                        'email' => $admin['email']
                    ]
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Incorrect Admin Email/Username or Password.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
        exit;
    }

    if ($action === 'logout') {
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_fullname']);
        unset($_SESSION['admin_username']);
        unset($_SESSION['admin_email']);
        session_destroy();

        echo json_encode(['status' => 'success', 'message' => 'Logged out successfully.']);
        exit;
    }
}

if ($action === 'check') {
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        echo json_encode([
            'status' => 'success',
            'logged_in' => true,
            'admin' => [
                'id' => $_SESSION['admin_id'] ?? null,
                'fullname' => $_SESSION['admin_fullname'] ?? 'Admin',
                'username' => $_SESSION['admin_username'] ?? 'admin',
                'email' => $_SESSION['admin_email'] ?? 'admin@gmail.com'
            ]
        ]);
    } else {
        echo json_encode(['status' => 'error', 'logged_in' => false]);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
