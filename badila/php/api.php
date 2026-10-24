<?php
session_start();
require_once __DIR__ . '/db.php';

header('Content-Type: application/json');

if (!$pdo) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . ($dbError ?? 'MySQL server unreachable')]);
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';
$uploadsDir = __DIR__ . '/../uploads/';

if (!file_exists($uploadsDir)) {
    @mkdir($uploadsDir, 0777, true);
}

try {
    switch ($action) {

        case 'get_demos':
            $stmt = $pdo->query("SELECT * FROM system_demos ORDER BY id DESC");
            $demos = $stmt->fetchAll();
            echo json_encode(['status' => 'success', 'demos' => $demos]);
            break;

        case 'add_demo':
            $description = trim($_POST['description'] ?? '');
            $title = trim($_POST['title'] ?? '');

            if (!isset($_FILES['image'])) {
                echo json_encode(['status' => 'error', 'message' => 'Please select an image file to upload.']);
                exit;
            }

            $file = $_FILES['image'];
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $uploadErrors = [
                    UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the max upload limit configured on the server.',
                    UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds MAX_FILE_SIZE.',
                    UPLOAD_ERR_PARTIAL    => 'The file was only partially uploaded. Please try again.',
                    UPLOAD_ERR_NO_FILE    => 'No image file was selected.',
                    UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary upload directory on server.',
                    UPLOAD_ERR_CANT_WRITE => 'Failed to write image file to disk.',
                    UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload.'
                ];
                $errMsg = $uploadErrors[$file['error']] ?? ('File upload error code: ' . $file['error']);
                echo json_encode(['status' => 'error', 'message' => $errMsg]);
                exit;
            }

            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];

            if (!in_array($ext, $allowedExts)) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid file format. Allowed formats: JPG, PNG, GIF, WEBP, SVG.']);
                exit;
            }

            $newFileName = 'demo_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
            $targetPath = $uploadsDir . $newFileName;
            $relativePath = 'uploads/' . $newFileName;

            if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to save uploaded file on server. Check folder permissions.']);
                exit;
            }

            $displayTitle = $title ?: pathinfo($file['name'], PATHINFO_FILENAME);
            $stmt = $pdo->prepare("INSERT INTO system_demos (title, image_path, description) VALUES (:t, :img, :d)");
            $stmt->execute([
                't' => $displayTitle,
                'img' => $relativePath,
                'd' => $description
            ]);
            $insertedId = $pdo->lastInsertId();

            try {
                if ($pdoGame) {
                    $stmtGame = $pdoGame->prepare("INSERT INTO system_demos (id, title, image_path, description) VALUES (:id, :t, :img, :d)");
                    $stmtGame->execute([
                        'id' => $insertedId,
                        't' => $displayTitle,
                        'img' => $relativePath,
                        'd' => $description
                    ]);
                }
            } catch (Exception $e) {}

            echo json_encode([
                'status' => 'success',
                'message' => 'System demo uploaded and saved to database successfully!',
                'demo' => [
                    'id' => $insertedId,
                    'title' => $displayTitle,
                    'image_path' => $relativePath,
                    'description' => $description,
                    'created_at' => date('Y-m-d H:i:s')
                ]
            ]);
            break;

        case 'update_demo':
            $id = intval($_POST['id'] ?? 0);
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (!$id) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid Demo ID.']);
                exit;
            }

            $stmt = $pdo->prepare("UPDATE system_demos SET title = IF(:t != '', :t, title), description = :d WHERE id = :id");
            $stmt->execute(['t' => $title, 'd' => $description, 'id' => $id]);

            try {
                if ($pdoGame) {
                    $stmtGame = $pdoGame->prepare("UPDATE system_demos SET title = IF(:t != '', :t, title), description = :d WHERE id = :id");
                    $stmtGame->execute(['t' => $title, 'd' => $description, 'id' => $id]);
                }
            } catch (Exception $e) {}

            echo json_encode(['status' => 'success', 'message' => 'System demo updated successfully in database!']);
            break;

        case 'delete_demo':
            $id = intval($_POST['id'] ?? $_GET['id'] ?? 0);

            if (!$id) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid Demo ID.']);
                exit;
            }

            $fetchStmt = $pdo->prepare("SELECT image_path FROM system_demos WHERE id = :id LIMIT 1");
            $fetchStmt->execute(['id' => $id]);
            $demo = $fetchStmt->fetch();

            if ($demo && !empty($demo['image_path'])) {
                $filePath = __DIR__ . '/../' . $demo['image_path'];
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }

            $delStmt = $pdo->prepare("DELETE FROM system_demos WHERE id = :id");
            $delStmt->execute(['id' => $id]);

            try {
                $delGameStmt = $pdoGame->prepare("DELETE FROM system_demos WHERE id = :id");
                $delGameStmt->execute(['id' => $id]);
            } catch (Exception $e) {}

            echo json_encode(['status' => 'success', 'message' => 'Demo deleted successfully from database!']);
            break;


        case 'get_weeks':
            $stmt = $pdo->query("SELECT * FROM weekly_updates ORDER BY id ASC");
            $weeks = $stmt->fetchAll();
            echo json_encode(['status' => 'success', 'weeks' => $weeks]);
            break;

        case 'add_week':
            $title = trim($_POST['title'] ?? '');
            $date_range = trim($_POST['date_range'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (empty($title) || empty($description)) {
                echo json_encode(['status' => 'error', 'message' => 'Week title and description are required.']);
                exit;
            }

            $maxWeekNum = $pdo->query("SELECT MAX(week_number) FROM weekly_updates")->fetchColumn();
            $nextWeekNum = ($maxWeekNum ? intval($maxWeekNum) + 1 : 1);

            $stmt = $pdo->prepare("INSERT INTO weekly_updates (week_number, title, date_range, description) VALUES (:wn, :t, :d, :desc)");
            $stmt->execute([
                'wn' => $nextWeekNum,
                't' => $title,
                'd' => $date_range,
                'desc' => $description
            ]);
            $insertedId = $pdo->lastInsertId();

            try {
                $stmtGame = $pdoGame->prepare("INSERT INTO weekly_updates (id, week_number, title, date_range, description) VALUES (:id, :wn, :t, :d, :desc)");
                $stmtGame->execute([
                    'id' => $insertedId,
                    'wn' => $nextWeekNum,
                    't' => $title,
                    'd' => $date_range,
                    'desc' => $description
                ]);
            } catch (Exception $e) {}

            echo json_encode([
                'status' => 'success',
                'message' => 'Weekly progress log added to database successfully!',
                'week' => [
                    'id' => $insertedId,
                    'week_number' => $nextWeekNum,
                    'title' => $title,
                    'date_range' => $date_range,
                    'description' => $description
                ]
            ]);
            break;

        case 'update_week':
            $id = intval($_POST['id'] ?? 0);
            $title = trim($_POST['title'] ?? '');
            $date_range = trim($_POST['date_range'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (!$id || empty($title) || empty($description)) {
                echo json_encode(['status' => 'error', 'message' => 'Week ID, title, and description are required.']);
                exit;
            }

            $stmt = $pdo->prepare("UPDATE weekly_updates SET title = :t, date_range = :d, description = :desc WHERE id = :id");
            $stmt->execute(['t' => $title, 'd' => $date_range, 'desc' => $description, 'id' => $id]);

            try {
                $stmtGame = $pdoGame->prepare("UPDATE weekly_updates SET title = :t, date_range = :d, description = :desc WHERE id = :id");
                $stmtGame->execute(['t' => $title, 'd' => $date_range, 'desc' => $description, 'id' => $id]);
            } catch (Exception $e) {}

            echo json_encode(['status' => 'success', 'message' => 'Weekly update saved to database successfully!']);
            break;

        case 'delete_week':
            $id = intval($_POST['id'] ?? $_GET['id'] ?? 0);

            if (!$id) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid Week ID.']);
                exit;
            }

            $delStmt = $pdo->prepare("DELETE FROM weekly_updates WHERE id = :id");
            $delStmt->execute(['id' => $id]);

            try {
                $delGameStmt = $pdoGame->prepare("DELETE FROM weekly_updates WHERE id = :id");
                $delGameStmt->execute(['id' => $id]);
            } catch (Exception $e) {}

            echo json_encode(['status' => 'success', 'message' => 'Weekly update deleted from database successfully!']);
            break;

        case 'save_score':
            $userId = intval($_SESSION['user_id'] ?? $_POST['user_id'] ?? 0);
            $username = trim($_SESSION['username'] ?? $_POST['username'] ?? 'Guest');
            $score = intval($_POST['score'] ?? 0);
            $accuracy = intval($_POST['accuracy'] ?? 0);
            $hintsUsed = intval($_POST['hints_used'] ?? 0);
            $mistakes = intval($_POST['mistakes'] ?? 0);
            $bestStreak = intval($_POST['best_streak'] ?? 0);

            if (!$userId && $username === 'Guest') {
                echo json_encode(['status' => 'warning', 'message' => 'Guest score recorded locally. Sign in to save to leaderboard!']);
                exit;
            }

            $stmtScore = $pdo->prepare("INSERT INTO user_scores (user_id, username, score, accuracy, hints_used, mistakes, best_streak) VALUES (:uid, :uname, :score, :acc, :hints, :mist, :streak)");
            $stmtScore->execute([
                'uid' => $userId,
                'uname' => $username,
                'score' => $score,
                'acc' => $accuracy,
                'hints' => $hintsUsed,
                'mist' => $mistakes,
                'streak' => $bestStreak
            ]);

            $stmtUser = $pdo->prepare("
                UPDATE users SET 
                    high_score = GREATEST(high_score, :score1),
                    total_score = total_score + :score2,
                    games_played = games_played + 1,
                    last_active = CURRENT_TIMESTAMP
                WHERE id = :uid OR username = :uname
            ");
            $stmtUser->execute([
                'score1' => $score,
                'score2' => $score,
                'uid' => $userId,
                'uname' => $username
            ]);

            try {
                if ($pdoGame) {
                    $stmtGScore = $pdoGame->prepare("INSERT INTO user_scores (user_id, username, score, accuracy, hints_used, mistakes, best_streak) VALUES (:uid, :uname, :score, :acc, :hints, :mist, :streak)");
                    $stmtGScore->execute([
                        'uid' => $userId,
                        'uname' => $username,
                        'score' => $score,
                        'acc' => $accuracy,
                        'hints' => $hintsUsed,
                        'mist' => $mistakes,
                        'streak' => $bestStreak
                    ]);

                    $stmtGUser = $pdoGame->prepare("
                        UPDATE users SET 
                            high_score = GREATEST(high_score, :score1),
                            total_score = total_score + :score2,
                            games_played = games_played + 1,
                            last_active = CURRENT_TIMESTAMP
                        WHERE id = :uid OR username = :uname
                    ");
                    $stmtGUser->execute([
                        'score1' => $score,
                        'score2' => $score,
                        'uid' => $userId,
                        'uname' => $username
                    ]);
                }
            } catch (Exception $ex) {}

            $fetchStats = $pdo->prepare("SELECT high_score, total_score, games_played FROM users WHERE id = :uid OR username = :uname LIMIT 1");
            $fetchStats->execute(['uid' => $userId, 'uname' => $username]);
            $updated = $fetchStats->fetch();

            echo json_encode([
                'status' => 'success',
                'message' => 'Score updated successfully!',
                'stats' => [
                    'high_score' => intval($updated['high_score'] ?? $score),
                    'total_score' => intval($updated['total_score'] ?? $score),
                    'games_played' => intval($updated['games_played'] ?? 1)
                ]
            ]);
            break;

        case 'get_leaderboard':
            $stmt = $pdo->query("SELECT id, username, high_score, total_score, games_played, last_active FROM users WHERE high_score > 0 ORDER BY high_score DESC, total_score DESC LIMIT 10");
            $leaderboard = $stmt->fetchAll();
            echo json_encode(['status' => 'success', 'leaderboard' => $leaderboard]);
            break;

        case 'get_users':
            $stmt = $pdo->query("SELECT id, username, email, high_score, total_score, games_played, last_active, created_at FROM users ORDER BY high_score DESC, id DESC");
            $users = $stmt->fetchAll();
            echo json_encode(['status' => 'success', 'users' => $users]);
            break;

        case 'get_live_stats':
            $totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
            $topScore = $pdo->query("SELECT MAX(high_score) FROM users")->fetchColumn();
            $totalGames = $pdo->query("SELECT SUM(games_played) FROM users")->fetchColumn();
            $demosCount = $pdo->query("SELECT COUNT(*) FROM system_demos")->fetchColumn();
            $weeksCount = $pdo->query("SELECT COUNT(*) FROM weekly_updates")->fetchColumn();

            echo json_encode([
                'status' => 'success',
                'stats' => [
                    'total_users' => intval($totalUsers ?: 0),
                    'top_score' => intval($topScore ?: 0),
                    'total_games' => intval($totalGames ?: 0),
                    'demos_count' => intval($demosCount ?: 0),
                    'weeks_count' => intval($weeksCount ?: 0),
                    'server_time' => date('Y-m-d H:i:s')
                ]
            ]);
            break;

        case 'reset_user_score':
            $userId = intval($_POST['id'] ?? 0);
            if (!$userId) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid User ID.']);
                exit;
            }

            $stmt = $pdo->prepare("UPDATE users SET high_score = 0, total_score = 0, games_played = 0 WHERE id = :id");
            $stmt->execute(['id' => $userId]);

            try {
                if ($pdoGame) {
                    $stmtG = $pdoGame->prepare("UPDATE users SET high_score = 0, total_score = 0, games_played = 0 WHERE id = :id");
                    $stmtG->execute(['id' => $userId]);
                }
            } catch (Exception $e) {}

            echo json_encode(['status' => 'success', 'message' => 'User score reset to zero successfully!']);
            break;

        case 'delete_user':
            $userId = intval($_POST['id'] ?? 0);
            if (!$userId) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid User ID.']);
                exit;
            }

            $del = $pdo->prepare("DELETE FROM users WHERE id = :id");
            $del->execute(['id' => $userId]);

            $delScores = $pdo->prepare("DELETE FROM user_scores WHERE user_id = :id");
            $delScores->execute(['id' => $userId]);

            try {
                if ($pdoGame) {
                    $delG = $pdoGame->prepare("DELETE FROM users WHERE id = :id");
                    $delG->execute(['id' => $userId]);
                    $delGScores = $pdoGame->prepare("DELETE FROM user_scores WHERE user_id = :id");
                    $delGScores->execute(['id' => $userId]);
                }
            } catch (Exception $e) {}

            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully!']);
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Unknown API action requested.']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'API Error: ' . $e->getMessage()]);
}
