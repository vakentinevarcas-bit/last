<?php
session_start();
require_once __DIR__ . '/../php/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

$adminName = $_SESSION['admin_fullname'] ?? $_SESSION['admin_username'] ?? 'Admin';
$adminEmail = $_SESSION['admin_email'] ?? 'admin@gmail.com';
$adminAvatar = strtoupper(substr($adminName, 0, 1));
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin-theme.css">
</head>
<body class="admin-theme">
    <div class="admin-background" aria-hidden="true">
        <div class="admin-tile-noise"></div>
        <svg class="admin-leaf admin-leaf-top" viewBox="0 0 300 300">
            <path d="M10 10 C120 20 180 90 160 200 C140 280 60 260 30 190 C0 120 -20 30 10 10Z" />
            <path d="M40 40 C110 60 140 120 120 190 C105 240 60 220 45 170 C28 110 20 55 40 40Z" />
        </svg>
        <svg class="admin-leaf admin-leaf-bottom" viewBox="0 0 300 300">
            <path d="M10 10 C120 20 180 90 160 200 C140 280 60 260 30 190 C0 120 -20 30 10 10Z" />
            <path d="M40 40 C110 60 140 120 120 190 C105 240 60 220 45 170 C28 110 20 55 40 40Z" />
        </svg>
        <div class="admin-vignette"></div>
    </div>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-cubes"></i>
            <span>Admin<span>Hub</span></span>
        </div>
        <button class="nav-item active" data-tab="dashboard">
            <i class="fas fa-th-large"></i><span>Dashboard</span>
        </button>
        <button class="nav-item" data-tab="demo">
            <i class="fas fa-play-circle"></i><span>System Demo</span>
        </button>
        <button class="nav-item" data-tab="questions">
            <i class="fas fa-circle-question"></i><span>Quiz Questions</span>
        </button>
        <button class="nav-item" data-tab="weekly">
            <i class="fas fa-calendar-week"></i><span>Weekly Update</span>
        </button>
        <button class="nav-item" data-tab="user-dashboard">
            <i class="fas fa-user-circle"></i><span>User Dashboard</span>
        </button>
        <button class="nav-item logout" data-tab="logout">
            <i class="fas fa-sign-out-alt"></i><span>Logout</span>
        </button>
    </aside>

    <div class="main-content">

        <div class="top-bar">
            <h1><i class="fas fa-gauge-high"></i> Dashboard</h1>
            <div class="top-bar-right">
                <button type="button" class="refresh-btn" id="refreshDashboardBtn" title="Refresh dashboard">
                    <i class="fas fa-sync-alt"></i><span>Refresh</span>
                </button>
                <span class="date"><i class="far fa-calendar-alt"></i> <?php echo date('F j, Y'); ?></span>

                <div class="current-user">
                    <div class="avatar" id="userAvatar"><?php echo htmlspecialchars($adminAvatar); ?></div>
                    <div class="current-user-info">
                        <div class="current-user-name" id="currentUserName"><?php echo htmlspecialchars($adminName); ?></div>
                        <div class="current-user-email" id="currentUserEmail"><?php echo htmlspecialchars($adminEmail); ?></div>
                        <div class="current-user-status">
                            <span class="status-dot online" id="userStatusDot"></span>
                            <span id="currentUserStatus">Online</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tab-dashboard" class="tab-content active">
            <div class="stats-grid">
                <div class="stat-card"><div class="stat-icon"><i class="fas fa-users"></i></div><div class="stat-number" id="dashTotalUsers">0</div><div class="stat-label">Total Users</div></div>
                <div class="stat-card"><div class="stat-icon"><i class="fas fa-trophy"></i></div><div class="stat-number" id="dashTopScore">0</div><div class="stat-label">Top High Score</div></div>
                <div class="stat-card"><div class="stat-icon"><i class="fas fa-gamepad"></i></div><div class="stat-number" id="dashTotalGames">0</div><div class="stat-label">Total Games Played</div></div>
                <div class="stat-card"><div class="stat-icon"><i class="fas fa-play-circle"></i></div><div class="stat-number" id="dashDemosCount">0</div><div class="stat-label">System Demos</div></div>
            </div>
            <div class="panel">
                <div class="panel-header">
                    <h2><i class="fas fa-bolt"></i> Real-time System Dashboard</h2>
                    <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:#2e7d32; font-weight:600;">
                        <span class="status-dot online" style="animation: pulse 1.5s infinite;"></span> Live Updates Active
                    </div>
                </div>
                <p style="color:#666; font-size:15px; line-height:1.7;">
                    Welcome to your admin dashboard. This dashboard syncs live with the database automatically.
                    User registrations, gameplay scores, demo uploads, and blog updates stream in real-time.
                </p>
            </div>
        </div>

        <div id="tab-user-dashboard" class="tab-content">
            <div class="panel">
                <div class="panel-header">
                    <h2><i class="fas fa-users-cog"></i> User Interface — Registered Accounts &amp; Scores</h2>
                    <div style="display:flex; align-items:center; gap:12px;">
                        <span style="font-size:13px; color:#666;"><i class="fas fa-sync fa-spin" id="liveSyncSpinner" style="display:none;"></i> Syncing...</span>
                        <button type="button" class="btn btn-outline" id="userDashboardRefresh">
                            <i class="fas fa-sync-alt"></i> Refresh Now
                        </button>
                    </div>
                </div>

                <div class="user-dashboard-grid" style="grid-template-columns: 1fr 2fr; gap:20px; margin-bottom:24px;">
                    <div class="user-profile-card">
                        <div class="profile-main">
                            <div class="profile-avatar" id="dashboardUserAvatar"><?php echo htmlspecialchars($adminAvatar); ?></div>
                            <div>
                                <h3 id="dashboardUserName"><?php echo htmlspecialchars($adminName); ?></h3>
                                <p id="dashboardUserEmail"><?php echo htmlspecialchars($adminEmail); ?></p>
                                <div class="profile-status">
                                    <span class="status-dot online" id="dashboardStatusDot"></span>
                                    <span id="dashboardUserStatus">Administrator</span>
                                </div>
                            </div>
                        </div>

                        <div class="user-detail">
                            <span>Admin Full Name</span>
                            <span id="dashboardFullName"><?php echo htmlspecialchars($adminName); ?></span>
                        </div>
                        <div class="user-detail">
                            <span>Email</span>
                            <span id="dashboardEmail"><?php echo htmlspecialchars($adminEmail); ?></span>
                        </div>
                        <div class="user-detail">
                            <span>System Status</span>
                            <span id="dashboardAccountStatus">Online &amp; Active</span>
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:16px;">
                        <div class="dashboard-stat">
                            <h4>Total Registered Users</h4>
                            <div class="value" id="userDashTotalUsers">0</div>
                        </div>
                        <div class="dashboard-stat">
                            <h4>Highest Score Achieved</h4>
                            <div class="value" id="userDashTopScore">0</div>
                        </div>
                        <div class="dashboard-stat">
                            <h4>Total Games Played</h4>
                            <div class="value" id="userDashTotalGames">0</div>
                        </div>
                        <div class="dashboard-stat">
                            <h4>Live Auto-Refresh</h4>
                            <div class="value" style="font-size:16px; color:#2e7d32;" id="lastRefreshTime">Every 4s</div>
                        </div>
                    </div>
                </div>

                <div class="panel" style="margin-top:20px; padding:20px; background:#fff; border-radius:12px;">
                    <div class="panel-header" style="margin-bottom:16px;">
                        <h3 style="font-size:18px; color:#1a1a2e;"><i class="fas fa-list-ol"></i> Registered Players &amp; High Scores</h3>
                    </div>
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse; text-align:left;" id="usersTable">
                            <thead>
                                <tr style="border-bottom:2px solid #eee; background:#f8f9fa; color:#555; font-size:14px;">
                                    <th style="padding:12px;">Player</th>
                                    <th style="padding:12px;">Email</th>
                                    <th style="padding:12px;">High Score</th>
                                    <th style="padding:12px;">Total Points</th>
                                    <th style="padding:12px;">Games</th>
                                    <th style="padding:12px;">Last Active</th>
                                    <th style="padding:12px; text-align:right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="usersTableBody">
                                <tr>
                                    <td colspan="7" style="text-align:center; padding:20px; color:#888;">Loading user accounts...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="tab-demo" class="tab-content">
            <div class="panel">
                <div class="panel-header">
                    <h2><i class="fas fa-play-circle"></i> System Demo — Upload &amp; Describe</h2>
                </div>
                <div class="demo-area">
                    <div>
                        <div class="upload-box" id="uploadBox">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click or drag to upload an image</p>
                            <div class="file-name" id="fileName"></div>
                            <div class="upload-preview" id="uploadPreview">
                                <img id="previewImage" src="#" alt="Preview">
                            </div>
                            <input type="file" id="fileInput" accept="image/*" style="display:none;">
                        </div>
                        <div class="image-preview-container" id="imageGallery"></div>
                    </div>
                    <div class="description-area">
                        <input type="text" id="demoTitleInput" placeholder="System Demo Title (e.g. Front Office Reception)" style="width:100%; padding:12px; margin-bottom:12px; border:1px solid #ddd; border-radius:8px; font-size:15px; outline:none;">
                        <textarea id="descInput" placeholder="Write a description for your image..."></textarea>
                        <div class="char-count"><span id="charCount">0</span> / 500</div>
                        <div class="demo-actions">
                            <button class="btn btn-primary" id="submitDemoBtn"><i class="fas fa-check"></i> Submit Upload</button>
                            <button class="btn btn-outline" id="clearDemoBtn"><i class="fas fa-undo"></i> Clear</button>
                        </div>
                        <div style="margin-top:12px; font-size:14px; color:#888;">
                            <i class="fas fa-info-circle"></i> Uploaded images will be saved to database and displayed in real-time.
                        </div>
                    </div>
                </div>
                <div style="margin-top:24px; padding-top:20px; border-top:1px solid #eee;">
                    <h4 style="margin-bottom:12px; color:#1a1a2e;"><i class="fas fa-history"></i> Upload History</h4>
                    <div id="uploadHistory">
                        <div class="empty-state">No uploads yet. Upload an image to see it here.</div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tab-questions" class="tab-content">
            <div class="panel">
                <div class="panel-header">
                    <h2><i class="fas fa-circle-question"></i> Manage Quiz Questions</h2>
                    <div style="display:flex; gap:8px;">
                        <button type="button" class="btn btn-primary" id="addQuestionBtn">
                            <i class="fas fa-plus"></i> Add Question
                        </button>
                        <button type="button" class="btn btn-outline" id="refreshQuestionsBtn">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                <p style="color:#666; margin-bottom:16px;">Only administrators can edit or delete questions. Changes will appear in the quiz.</p>
                <div id="questionsList">
                    <div class="empty-state">Loading quiz questions...</div>
                </div>
            </div>
        </div>

        <div id="tab-weekly" class="tab-content">
            <div class="panel">
                <div class="panel-header">
                    <h2><i class="fas fa-calendar-week"></i> Weekly Progress Blog</h2>
                </div>
                <div class="panel">
                    <div class="panel-header">
                        <h2><i class="fas fa-plus-circle"></i> Add New Week</h2>
                    </div>
                    <div class="add-week-form">
                        <div class="form-row">
                            <input type="text" id="weekTitleInput" placeholder="Week title (e.g. Week 5 — Deployment)">
                            <input type="text" id="weekDateInput" placeholder="Date range (e.g. Sep 7 – 13)">
                        </div>
                        <textarea id="weekDescInput" placeholder="Write a description for this week's progress..."></textarea>
                        <div style="display:flex; gap:12px; flex-wrap:wrap;">
                            <button class="btn btn-success" id="addWeekBtn"><i class="fas fa-plus"></i> Add Week</button>
                            <button class="btn btn-outline" id="clearWeekBtn"><i class="fas fa-undo"></i> Clear</button>
                        </div>
                    </div>
                </div>
                <div class="weekly-grid" id="weeklyGrid"></div>
            </div>
        </div>

    </div>

    <div class="modal-overlay" id="editWeekModal">
        <div class="modal-box">
            <h3 id="editWeekModalTitle">Edit Week</h3>
            <input type="text" id="editWeekTitle" placeholder="Title">
            <input type="text" id="editWeekDate" placeholder="Date range">
            <textarea id="editWeekDesc" placeholder="Description"></textarea>
            <div class="modal-actions">
                <button class="btn btn-outline" id="editWeekModalCancel">Cancel</button>
                <button class="btn btn-primary" id="editWeekModalSave">Save</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="editUploadModal">
        <div class="modal-box">
            <h3 id="editUploadModalTitle">Edit Uploaded System Demo</h3>
            <img id="editUploadPreview" class="preview-thumb" src="#" alt="Image preview" style="max-height:120px; object-fit:contain; margin-bottom:12px; border-radius:6px;">
            <input type="text" id="editUploadTitle" placeholder="Demo title..." style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #ddd; border-radius:6px; font-size:14px;">
            <textarea id="editUploadDesc" placeholder="Enter new description..."></textarea>
            <div class="modal-actions">
                <button class="btn btn-outline" id="editUploadModalCancel">Cancel</button>
                <button class="btn btn-primary" id="editUploadModalSave">Save Changes</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="editQuestionModal">
        <div class="modal-box">
            <h3 id="editQuestionModalTitle">Edit Quiz Question</h3>
            <input type="hidden" id="editQuestionId">
            <label for="editQuestionStage">Stage</label>
            <select id="editQuestionStage">
                <option value="1">Front Office</option>
                <option value="2">Food &amp; Beverage</option>
                <option value="3">Housekeeping</option>
            </select>
            <label for="editQuestionTerm">Term</label>
            <input type="text" id="editQuestionTerm" maxlength="24" placeholder="TERM (letters and numbers)">
            <label for="editQuestionDefinition">Definition</label>
            <textarea id="editQuestionDefinition" maxlength="2000" placeholder="Question definition..."></textarea>
            <div class="modal-actions">
                <button type="button" class="btn btn-outline" id="editQuestionCancel">Cancel</button>
                <button type="button" class="btn btn-primary" id="editQuestionSave">Save Changes</button>
            </div>
        </div>
    </div>

    <div class="toast" id="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Success!</span>
    </div>

    <script>window.ADMIN_CSRF_TOKEN = <?php echo json_encode($_SESSION['csrf_token']); ?>;</script>
    <script src="../js/admin.js"></script>
</body>
</html>