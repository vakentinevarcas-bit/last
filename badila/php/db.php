<?php
$host = 'localhost';
$user = 'root';
$pass = '';

$dbname = 'localhost_badilla';
$secondaryDb = 'game_db';

$dbError = null;

try {
    $pdoWithoutDb = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $pdoWithoutDb->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdoWithoutDb->exec("CREATE DATABASE IF NOT EXISTS `$secondaryDb` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $pdoGame = new PDO("mysql:host=$host;dbname=$secondaryDb;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS `users` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(50) NOT NULL UNIQUE,
            `email` VARCHAR(100) NOT NULL UNIQUE,
            `password` VARCHAR(255) NOT NULL,
            `high_score` INT DEFAULT 0,
            `total_score` INT DEFAULT 0,
            `games_played` INT DEFAULT 0,
            `last_active` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($createTableQuery);
    $pdoGame->exec($createTableQuery);

    $userCols = ['email VARCHAR(100) DEFAULT NULL', 'high_score INT DEFAULT 0', 'total_score INT DEFAULT 0', 'games_played INT DEFAULT 0', 'last_active TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'];
    foreach ([$pdo, $pdoGame] as $dbConn) {
        if (!$dbConn) continue;
        foreach ($userCols as $colDef) {
            $colName = explode(' ', trim($colDef))[0];
            $checkCol = $dbConn->query("SHOW COLUMNS FROM `users` LIKE '$colName'");
            if ($checkCol->rowCount() == 0) {
                $dbConn->exec("ALTER TABLE `users` ADD COLUMN $colDef");
            }
        }
    }

    $createScoresTableQuery = "
        CREATE TABLE IF NOT EXISTS `user_scores` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL,
            `username` VARCHAR(50) NOT NULL,
            `score` INT NOT NULL DEFAULT 0,
            `accuracy` INT NOT NULL DEFAULT 0,
            `hints_used` INT NOT NULL DEFAULT 0,
            `mistakes` INT NOT NULL DEFAULT 0,
            `best_streak` INT NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($createScoresTableQuery);
    $pdoGame->exec($createScoresTableQuery);

    $createAdminTableQuery = "
        CREATE TABLE IF NOT EXISTS `admins` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `fullname` VARCHAR(100) NOT NULL,
            `username` VARCHAR(50) NOT NULL UNIQUE,
            `email` VARCHAR(100) NOT NULL UNIQUE,
            `password` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($createAdminTableQuery);
    $pdoGame->exec($createAdminTableQuery);

    $createDemosTableQuery = "
        CREATE TABLE IF NOT EXISTS `system_demos` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL DEFAULT '',
            `image_path` VARCHAR(255) NOT NULL,
            `description` TEXT NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($createDemosTableQuery);
    $pdoGame->exec($createDemosTableQuery);

    $createWeeklyTableQuery = "
        CREATE TABLE IF NOT EXISTS `weekly_updates` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `week_number` INT NOT NULL DEFAULT 1,
            `title` VARCHAR(255) NOT NULL,
            `date_range` VARCHAR(100) NOT NULL DEFAULT '',
            `description` TEXT NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($createWeeklyTableQuery);
    $pdoGame->exec($createWeeklyTableQuery);

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `quiz_questions` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `stage` TINYINT NOT NULL,
            `term` VARCHAR(24) NOT NULL,
            `definition` TEXT NOT NULL,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            UNIQUE KEY `quiz_question_stage_term` (`stage`, `term`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `quiz_question_seed_state` (
            `id` TINYINT PRIMARY KEY
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    $count1 = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    if ($count1 == 0) {
        $samplePass = password_hash("password123", PASSWORD_BCRYPT);
        $seedStmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:u, :e, :p)");
        $seedStmt->execute(['u' => 'badilla_user', 'e' => 'badilla@example.com', 'p' => $samplePass]);
    }

    $count2 = $pdoGame->query("SELECT COUNT(*) FROM users")->fetchColumn();
    if ($count2 == 0) {
        $samplePass = password_hash("password123", PASSWORD_BCRYPT);
        $seedStmt2 = $pdoGame->prepare("INSERT INTO users (username, email, password) VALUES (:u, :e, :p)");
        $seedStmt2->execute(['u' => 'badilla_user', 'e' => 'badilla@example.com', 'p' => $samplePass]);
    }

    $adminCount1 = $pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
    if ($adminCount1 == 0) {
        $sampleAdminPass = password_hash("admin123", PASSWORD_BCRYPT);
        $seedAdminStmt = $pdo->prepare("INSERT INTO admins (fullname, username, email, password) VALUES (:f, :u, :e, :p)");
        $seedAdminStmt->execute(['f' => 'System Administrator', 'u' => 'admin', 'e' => 'admin@gmail.com', 'p' => $sampleAdminPass]);
    }

    $adminCount2 = $pdoGame->query("SELECT COUNT(*) FROM admins")->fetchColumn();
    if ($adminCount2 == 0) {
        $sampleAdminPass = password_hash("admin123", PASSWORD_BCRYPT);
        $seedAdminStmt2 = $pdoGame->prepare("INSERT INTO admins (fullname, username, email, password) VALUES (:f, :u, :e, :p)");
        $seedAdminStmt2->execute(['f' => 'System Administrator', 'u' => 'admin', 'e' => 'admin@gmail.com', 'p' => $sampleAdminPass]);
    }

    $defaultWeeks = [
        [1, 'Week 1: Planning', 'Aug 3 – 9', "Defined project scope and selected the word-search puzzle concept\nAssigned team roles: project manager, front-end, and back-end developers\nDrafted the three-stage structure around the NC II qualifications\nSketched early wireframes for the puzzle grid and layout"],
        [2, 'Week 2: Research & Requirements', 'Aug 10 – 16', "Gathered NC II reviewer terms for all three stages\nBuilt the 30-term pool per stage that puzzles draw 10 terms from\nOutlined the scoring rules: per-term minimum and stage quota"],
        [3, 'Week 3: UI/UX Design', 'Aug 17 – 23', "Designed the dark forest-green and gold visual direction\nMocked up the hero section and the word-tile branding\nPlanned the Term Check panel for multiple-choice and free-response modes"],
        [4, 'Week 4: Front-end Development', 'Aug 24 – 30', "Built the click-and-drag puzzle grid with tracing across, down, and diagonal\nImplemented the countdown timer and difficulty settings\nConnected the hint system to the point-cost logic"],
        [5, 'Week 5: Back-end & Logic', 'Aug 31 – Sep 6', "Built word-list validation against traced letters\nImplemented the scoring quota, streak multiplier, and life-loss conditions\nWired up the win/lose states for each stage"],
        [6, 'Week 6: Testing', 'Sep 7 – 13', "Ran playtesting sessions across all three stages\nTuned difficulty settings based on tester feedback\nFixed grid-tracing edge cases and Term Check bugs"],
        [7, 'Week 7: Finalization', 'Sep 14 – 20', "Polished visuals, animations, and responsive layout\nPrepared the final presentation and documentation\nPackaged the build for submission"]
    ];

    $weekCount1 = $pdo->query("SELECT COUNT(*) FROM weekly_updates")->fetchColumn();
    if ($weekCount1 == 0) {
        $seedWeekStmt = $pdo->prepare("INSERT INTO weekly_updates (week_number, title, date_range, description) VALUES (:wn, :t, :d, :desc)");
        foreach ($defaultWeeks as $w) {
            $seedWeekStmt->execute(['wn' => $w[0], 't' => $w[1], 'd' => $w[2], 'desc' => $w[3]]);
        }
    }

    $weekCount2 = $pdoGame->query("SELECT COUNT(*) FROM weekly_updates")->fetchColumn();
    if ($weekCount2 == 0) {
        $seedWeekStmt2 = $pdoGame->prepare("INSERT INTO weekly_updates (week_number, title, date_range, description) VALUES (:wn, :t, :d, :desc)");
        foreach ($defaultWeeks as $w) {
            $seedWeekStmt2->execute(['wn' => $w[0], 't' => $w[1], 'd' => $w[2], 'desc' => $w[3]]);
        }
    }

} catch (PDOException $e) {
    $dbError = $e->getMessage();
    $pdo = null;
    $pdoGame = null;
}
