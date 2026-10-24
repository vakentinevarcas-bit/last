document.addEventListener('DOMContentLoaded', () => {

    let selectedFile = null;
    let editingDemoId = null;
    let editingWeekId = null;
    let editingQuestionId = null;

    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');

    function showToast(msg, isSuccess = true) {
        if (!toast || !toastMessage) return;
        toastMessage.textContent = msg;
        toast.className = 'toast show ' + (isSuccess ? 'success' : 'error');
        if (toast.querySelector('i')) {
            toast.querySelector('i').className = isSuccess ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
        }
        setTimeout(() => {
            toast.className = 'toast';
        }, 3500);
    }

    function checkAdminAuth() {
        fetch('auth.php?action=check')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && data.logged_in && data.admin) {
                    const admin = data.admin;
                    const initial = (admin.fullname || admin.username || 'A').charAt(0).toUpperCase();

                    const elems = {
                        userAvatar: initial,
                        dashboardUserAvatar: initial,
                        currentUserName: admin.fullname || admin.username,
                        dashboardUserName: admin.fullname || admin.username,
                        dashboardFullName: admin.fullname || admin.username,
                        currentUserEmail: admin.email,
                        dashboardUserEmail: admin.email,
                        dashboardEmail: admin.email
                    };

                    Object.keys(elems).forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.textContent = elems[id];
                    });
                } else if (data.logged_in === false) {
                    window.location.href = 'index.php';
                }
            })
            .catch(err => console.error('Auth check error:', err));
    }
    checkAdminAuth();

    const navItems = document.querySelectorAll('.sidebar .nav-item');
    const tabContents = document.querySelectorAll('.tab-content');
    const pageTitle = document.querySelector('.top-bar h1');

    const titleMap = {
        'dashboard': '<i class="fas fa-gauge-high"></i> Dashboard',
        'demo': '<i class="fas fa-play-circle"></i> System Demo',
        'questions': '<i class="fas fa-circle-question"></i> Quiz Questions',
        'weekly': '<i class="fas fa-calendar-week"></i> Weekly Update',
        'user-dashboard': '<i class="fas fa-user-circle"></i> User Dashboard'
    };

    function activateTab(tabName) {
        const item = Array.from(navItems).find(navItem => navItem.dataset.tab === tabName);
        const targetTab = document.getElementById('tab-' + tabName);
        if (!item || !targetTab || !titleMap[tabName]) return;

        navItems.forEach(navItem => navItem.classList.remove('active'));
        item.classList.add('active');
        tabContents.forEach(tab => tab.classList.remove('active'));
        targetTab.classList.add('active');

        if (pageTitle) pageTitle.innerHTML = titleMap[tabName];
        sessionStorage.setItem('adminActiveTab', tabName);

        if (tabName === 'demo') loadSystemDemos();
        if (tabName === 'questions') loadQuestions();
        if (tabName === 'weekly') loadWeeklyUpdates();
    }

    const savedTab = sessionStorage.getItem('adminActiveTab');
    if (savedTab) activateTab(savedTab);

    navItems.forEach(item => {
        item.addEventListener('click', () => {
            const tabName = item.getAttribute('data-tab');

            if (tabName === 'logout') {
                if (confirm('Are you sure you want to log out?')) {
                    fetch('auth.php?action=logout', { method: 'POST' })
                        .then(res => res.json())
                        .then(data => {
                            showToast('Logged out successfully');
                            setTimeout(() => { window.location.href = 'index.php'; }, 800);
                        })
                        .catch(() => { window.location.href = 'index.php'; });
                }
                return;
            }

            activateTab(tabName);
        });
    });

    function loadQuestions() {
        const list = document.getElementById('questionsList');
        if (!list) return;
        list.innerHTML = '<div class="empty-state">Loading quiz questions...</div>';

        fetch('../php/questions.php?action=admin_list')
            .then(res => res.json().then(data => ({ ok: res.ok, data })))
            .then(({ ok, data }) => {
                if (!ok || data.status !== 'success' || !Array.isArray(data.questions)) {
                    throw new Error(data.message || 'Could not load quiz questions.');
                }
                if (data.questions.length === 0) {
                    list.innerHTML = '<div class="empty-state">No questions found. Open the quiz once to initialize its question bank, then refresh this list.</div>';
                    return;
                }

                const stages = ['Front Office', 'Food & Beverage', 'Housekeeping'];
                list.innerHTML = data.questions.map(question => `
                    <article class="quiz-question-row">
                        <div class="quiz-question-content">
                            <div class="quiz-question-meta">${escapeHtml(stages[Number(question.stage) - 1] || 'Stage')}</div>
                            <strong>${escapeHtml(question.term)}</strong>
                            <p>${escapeHtml(question.definition)}</p>
                        </div>
                        <div class="quiz-question-actions">
                            <button type="button" class="btn btn-outline edit-question-btn" data-id="${escapeHtml(String(question.id))}" data-stage="${escapeHtml(String(question.stage))}" data-term="${escapeHtml(question.term)}" data-definition="${escapeHtml(question.definition)}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn btn-danger delete-question-btn" data-id="${escapeHtml(String(question.id))}">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </article>
                `).join('');

                list.querySelectorAll('.edit-question-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        editingQuestionId = button.dataset.id;
                        document.getElementById('editQuestionModalTitle').textContent = 'Edit Quiz Question';
                        document.getElementById('editQuestionId').value = editingQuestionId;
                        document.getElementById('editQuestionStage').value = button.dataset.stage || '1';
                        document.getElementById('editQuestionTerm').value = button.dataset.term;
                        document.getElementById('editQuestionDefinition').value = button.dataset.definition;
                        document.getElementById('editQuestionSave').textContent = 'Save Changes';
                        document.getElementById('editQuestionModal').classList.add('show');
                    });
                });

                list.querySelectorAll('.delete-question-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        if (!confirm('Delete this quiz question?')) return;
                        const formData = new FormData();
                        formData.append('action', 'delete');
                        formData.append('id', button.dataset.id);
                        formData.append('csrf_token', window.ADMIN_CSRF_TOKEN || '');
                        saveQuestion(formData);
                    });
                });
            })
            .catch(error => {
                list.innerHTML = `<div class="empty-state">${escapeHtml(error.message)}</div>`;
                showToast(error.message, false);
            });
    }

    function saveQuestion(formData) {
        fetch('../php/questions.php', { method: 'POST', body: formData })
            .then(res => res.json().then(data => ({ ok: res.ok, data })))
            .then(({ ok, data }) => {
                if (!ok || data.status !== 'success') throw new Error(data.message || 'Could not save quiz question.');
                document.getElementById('editQuestionModal').classList.remove('show');
                showToast(data.message);
                loadQuestions();
            })
            .catch(error => showToast(error.message, false));
    }

    const refreshQuestionsBtn = document.getElementById('refreshQuestionsBtn');
    if (refreshQuestionsBtn) refreshQuestionsBtn.addEventListener('click', loadQuestions);

    const addQuestionBtn = document.getElementById('addQuestionBtn');
    if (addQuestionBtn) {
        addQuestionBtn.addEventListener('click', () => {
            editingQuestionId = null;
            document.getElementById('editQuestionModalTitle').textContent = 'Add Quiz Question';
            document.getElementById('editQuestionId').value = '';
            document.getElementById('editQuestionStage').value = '1';
            document.getElementById('editQuestionTerm').value = '';
            document.getElementById('editQuestionDefinition').value = '';
            document.getElementById('editQuestionSave').textContent = 'Add Question';
            document.getElementById('editQuestionModal').classList.add('show');
        });
    }

    const editQuestionSave = document.getElementById('editQuestionSave');
    if (editQuestionSave) {
        editQuestionSave.addEventListener('click', () => {
            const formData = new FormData();
            const action = editingQuestionId ? 'update' : 'create';
            formData.append('action', action);
            formData.append('id', editingQuestionId || '');
            formData.append('stage', document.getElementById('editQuestionStage').value);
            formData.append('term', document.getElementById('editQuestionTerm').value);
            formData.append('definition', document.getElementById('editQuestionDefinition').value);
            formData.append('csrf_token', window.ADMIN_CSRF_TOKEN || '');
            saveQuestion(formData);
        });
    }

    const editQuestionCancel = document.getElementById('editQuestionCancel');
    if (editQuestionCancel) {
        editQuestionCancel.addEventListener('click', () => {
            document.getElementById('editQuestionModal').classList.remove('show');
        });
    }

    function loadLiveStats() {
        fetch('../php/api.php?action=get_live_stats')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && data.stats) {
                    const s = data.stats;
                    const dashTotalUsers = document.getElementById('dashTotalUsers');
                    const dashTopScore = document.getElementById('dashTopScore');
                    const dashTotalGames = document.getElementById('dashTotalGames');
                    const dashDemosCount = document.getElementById('dashDemosCount');

                    const userDashTotalUsers = document.getElementById('userDashTotalUsers');
                    const userDashTopScore = document.getElementById('userDashTopScore');
                    const userDashTotalGames = document.getElementById('userDashTotalGames');

                    if (dashTotalUsers) dashTotalUsers.textContent = s.total_users;
                    if (dashTopScore) dashTopScore.textContent = s.top_score + ' pts';
                    if (dashTotalGames) dashTotalGames.textContent = s.total_games;
                    if (dashDemosCount) dashDemosCount.textContent = s.demos_count;

                    if (userDashTotalUsers) userDashTotalUsers.textContent = s.total_users;
                    if (userDashTopScore) userDashTopScore.textContent = s.top_score + ' pts';
                    if (userDashTotalGames) userDashTotalGames.textContent = s.total_games;

                    const lastRefreshTime = document.getElementById('lastRefreshTime');
                    if (lastRefreshTime) lastRefreshTime.textContent = 'Synced at ' + new Date().toLocaleTimeString();
                }
            })
            .catch(() => {});
    }

    function loadUsersList() {
        const spinner = document.getElementById('liveSyncSpinner');
        if (spinner) spinner.style.display = 'inline-block';

        fetch('../php/api.php?action=get_users')
            .then(res => res.json())
            .then(data => {
                if (spinner) spinner.style.display = 'none';
                const tbody = document.getElementById('usersTableBody');
                if (!tbody) return;

                if (data.status === 'success' && Array.isArray(data.users) && data.users.length > 0) {
                    tbody.innerHTML = data.users.map(u => `
                        <tr style="border-bottom:1px solid #f0f0f0; font-size:14px;">
                            <td style="padding:12px; font-weight:600; color:#1a1a2e;">
                                <i class="fas fa-user-circle" style="color:#4fc3f7; margin-right:6px;"></i> ${escapeHtml(u.username)}
                            </td>
                            <td style="padding:12px; color:#666;">${escapeHtml(u.email || 'N/A')}</td>
                            <td style="padding:12px; font-weight:bold; color:#2e7d32;">🏆 ${u.high_score || 0}</td>
                            <td style="padding:12px; color:#555;">${u.total_score || 0} pts</td>
                            <td style="padding:12px; color:#555;">🎮 ${u.games_played || 0}</td>
                            <td style="padding:12px; font-size:12px; color:#888;">${u.last_active ? escapeHtml(u.last_active) : 'Recently'}</td>
                            <td style="padding:12px; text-align:right;">
                                <button type="button" class="btn btn-outline reset-user-score-btn" data-id="${u.id}" data-name="${escapeHtml(u.username)}" style="padding:4px 8px; font-size:12px; margin-right:4px;" title="Reset score to 0">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                                <button type="button" class="btn btn-danger delete-user-btn" data-id="${u.id}" data-name="${escapeHtml(u.username)}" style="padding:4px 8px; font-size:12px; background:#ef5350; color:#fff; border:none; border-radius:6px; cursor:pointer;" title="Delete user">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    `).join('');

                    tbody.querySelectorAll('.reset-user-score-btn').forEach(btn => {
                        btn.addEventListener('click', () => {
                            const uid = btn.getAttribute('data-id');
                            const uname = btn.getAttribute('data-name');
                            if (confirm(`Are you sure you want to reset high score and total score for "${uname}"?`)) {
                                const fd = new FormData();
                                fd.append('action', 'reset_user_score');
                                fd.append('id', uid);
                                fetch('../php/api.php', { method: 'POST', body: fd })
                                    .then(res => res.json())
                                    .then(d => {
                                        if (d.status === 'success') {
                                            showToast(d.message);
                                            loadUsersList();
                                            loadLiveStats();
                                        } else {
                                            showToast(d.message || 'Error resetting score.', false);
                                        }
                                    });
                            }
                        });
                    });

                    tbody.querySelectorAll('.delete-user-btn').forEach(btn => {
                        btn.addEventListener('click', () => {
                            const uid = btn.getAttribute('data-id');
                            const uname = btn.getAttribute('data-name');
                            if (confirm(`Are you sure you want to PERMANENTLY DELETE user account "${uname}"?`)) {
                                const fd = new FormData();
                                fd.append('action', 'delete_user');
                                fd.append('id', uid);
                                fetch('../php/api.php', { method: 'POST', body: fd })
                                    .then(res => res.json())
                                    .then(d => {
                                        if (d.status === 'success') {
                                            showToast(d.message);
                                            loadUsersList();
                                            loadLiveStats();
                                        } else {
                                            showToast(d.message || 'Error deleting user.', false);
                                        }
                                    });
                            }
                        });
                    });
                } else {
                    tbody.innerHTML = '<tr><td colspan="7" style="text-align:center; padding:20px; color:#888;">No registered users found in database.</td></tr>';
                }
            })
            .catch(() => {
                if (spinner) spinner.style.display = 'none';
            });
    }

    const refreshBtns = ['refreshDashboardBtn', 'userDashboardRefresh', 'refreshUserInfoBtn'];
    refreshBtns.forEach(id => {
        const btn = document.getElementById(id);
        if (btn) {
            btn.addEventListener('click', () => {
                checkAdminAuth();
                loadSystemDemos();
                loadWeeklyUpdates();
                loadLiveStats();
                loadUsersList();
                showToast('Dashboard reloaded with latest database records!');
            });
        }
    });

    function escapeHtml(str) {
        if (!str) return '';
        return str
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    loadSystemDemos();
    loadWeeklyUpdates();
    loadLiveStats();
    loadUsersList();

    setInterval(() => {
        loadLiveStats();
        loadUsersList();
    }, 4000);

    const uploadBox = document.getElementById('uploadBox');
    const fileInput = document.getElementById('fileInput');
    const fileName = document.getElementById('fileName');
    const uploadPreview = document.getElementById('uploadPreview');
    const previewImage = document.getElementById('previewImage');
    const descInput = document.getElementById('descInput');
    const charCount = document.getElementById('charCount');
    const submitDemoBtn = document.getElementById('submitDemoBtn');
    const clearDemoBtn = document.getElementById('clearDemoBtn');
    const uploadHistory = document.getElementById('uploadHistory');

    if (uploadBox && fileInput) {
        uploadBox.addEventListener('click', (e) => {
            if (e.target !== fileInput) {
                fileInput.value = '';
                fileInput.click();
            }
        });

        fileInput.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        uploadBox.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadBox.style.borderColor = '#4fc3f7';
            uploadBox.style.background = '#f0f8ff';
        });

        uploadBox.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadBox.style.borderColor = '';
            uploadBox.style.background = '';
        });

        uploadBox.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadBox.style.borderColor = '';
            uploadBox.style.background = '';
            if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                handleFileSelect(e.dataTransfer.files[0]);
            }
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files && fileInput.files[0]) {
                handleFileSelect(fileInput.files[0]);
            }
        });
    }

    function handleFileSelect(file) {
        if (!file || !file.type.startsWith('image/')) {
            showToast('Please select a valid image file (JPG, PNG, GIF, WEBP, SVG)', false);
            return;
        }
        selectedFile = file;
        const formattedSize = Math.round(file.size / 1024);
        if (fileName) fileName.textContent = file.name + ' (' + formattedSize + ' KB)';

        const reader = new FileReader();
        reader.onload = (e) => {
            if (previewImage) previewImage.src = e.target.result;
            if (uploadPreview) {
                uploadPreview.style.display = 'block';
                uploadPreview.classList.add('show');
            }
        };
        reader.readAsDataURL(file);
    }

    if (descInput && charCount) {
        descInput.addEventListener('input', () => {
            const len = descInput.value.length;
            charCount.textContent = len;
            if (len > 500) {
                descInput.value = descInput.value.substring(0, 500);
                charCount.textContent = 500;
            }
        });
    }

    if (clearDemoBtn) {
        clearDemoBtn.addEventListener('click', clearDemoForm);
    }

    function clearDemoForm() {
        selectedFile = null;
        if (fileInput) fileInput.value = '';
        if (fileName) fileName.textContent = '';
        if (uploadPreview) {
            uploadPreview.style.display = 'none';
            uploadPreview.classList.remove('show');
        }
        if (previewImage) previewImage.src = '#';
        const demoTitleInput = document.getElementById('demoTitleInput');
        if (demoTitleInput) demoTitleInput.value = '';
        if (descInput) descInput.value = '';
        if (charCount) charCount.textContent = '0';
    }

    if (submitDemoBtn) {
        submitDemoBtn.addEventListener('click', () => {
            const titleInput = document.getElementById('demoTitleInput');
            const title = titleInput ? titleInput.value.trim() : '';
            const desc = descInput ? descInput.value.trim() : '';

            if (!selectedFile) {
                showToast('Please select or drag an image file to upload.', false);
                return;
            }

            submitDemoBtn.disabled = true;
            submitDemoBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';

            const formData = new FormData();
            formData.append('action', 'add_demo');
            formData.append('image', selectedFile);
            formData.append('title', title);
            formData.append('description', desc);

            fetch('../php/api.php', {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    submitDemoBtn.disabled = false;
                    submitDemoBtn.innerHTML = '<i class="fas fa-check"></i> Submit Upload';

                    if (data.status === 'success') {
                        showToast(data.message || 'System Demo uploaded and saved to database successfully!');
                        clearDemoForm();
                        loadSystemDemos();
                        loadLiveStats();
                    } else {
                        showToast(data.message || 'Failed to save system demo.', false);
                    }
                })
                .catch(err => {
                    submitDemoBtn.disabled = false;
                    submitDemoBtn.innerHTML = '<i class="fas fa-check"></i> Submit Upload';
                    showToast('Server error while uploading demo. Check connection or file size.', false);
                });
        });
    }

    function loadSystemDemos() {
        const historyContainer = document.getElementById('uploadHistory');

        fetch('../php/api.php?action=get_demos')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    renderSystemDemos(data.demos || []);
                } else if (historyContainer) {
                    historyContainer.innerHTML = `<div class="empty-state">Failed to load demos: ${data.message}</div>`;
                }
            })
            .catch(err => {
                if (historyContainer) {
                    historyContainer.innerHTML = `<div class="empty-state">Error connecting to database.</div>`;
                }
            });
    }

    function renderSystemDemos(demos) {
        const historyContainer = document.getElementById('uploadHistory');
        if (!historyContainer) return;

        if (demos.length === 0) {
            historyContainer.innerHTML = `<div class="empty-state">No uploads yet. Upload an image above to record it in the database.</div>`;
            return;
        }

        historyContainer.innerHTML = demos.map(demo => {
            const formattedDate = demo.created_at ? new Date(demo.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric', hour: '2-digit', minute: '2-digit' }) : '';
            return `
                <div class="upload-item" data-id="${demo.id}" style="display:flex; gap:16px; align-items:flex-start; padding:16px; background:#fff; border:1px solid #e2e8f0; border-radius:10px; margin-bottom:12px; transition:all 0.2s;">
                    <img src="../${demo.image_path}" alt="Demo Image" style="width:110px; height:80px; object-fit:cover; border-radius:8px; border:1px solid #cbd5e1;">
                    <div style="flex:1;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                            <strong style="color:#1e293b; font-size:15px;">${escapeHtml(demo.title || 'Demo Image')}</strong>
                            <span style="font-size:12px; color:#64748b;"><i class="far fa-clock"></i> ${formattedDate}</span>
                        </div>
                        <p style="color:#475569; font-size:14px; margin-bottom:10px; line-height:1.5;">${escapeHtml(demo.description)}</p>
                        <div style="display:flex; gap:8px;">
                            <button type="button" class="btn edit-demo-btn" data-id="${demo.id}" data-title="${escapeHtml(demo.title || '')}" data-desc="${escapeHtml(demo.description)}" data-img="../${demo.image_path}" style="padding:4px 10px; font-size:12px;">
                                <i class="fas fa-edit"></i> Edit Demo
                            </button>
                            <button type="button" class="btn delete-demo-btn" data-id="${demo.id}" style="padding:4px 10px; font-size:12px;">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }).join('');

        document.querySelectorAll('.edit-demo-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                editingDemoId = btn.getAttribute('data-id');
                const title = btn.getAttribute('data-title');
                const desc = btn.getAttribute('data-desc');
                const imgSrc = btn.getAttribute('data-img');

                const editUploadModal = document.getElementById('editUploadModal');
                const editUploadPreview = document.getElementById('editUploadPreview');
                const editUploadTitle = document.getElementById('editUploadTitle');
                const editUploadDesc = document.getElementById('editUploadDesc');

                if (editUploadPreview) editUploadPreview.src = imgSrc;
                if (editUploadTitle) editUploadTitle.value = title;
                if (editUploadDesc) editUploadDesc.value = desc;
                if (editUploadModal) editUploadModal.classList.add('show');
            });
        });

        document.querySelectorAll('.delete-demo-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this System Demo from the database?')) {
                    const formData = new FormData();
                    formData.append('action', 'delete_demo');
                    formData.append('id', id);

                    fetch('../php/api.php', { method: 'POST', body: formData })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                showToast(data.message || 'Demo deleted from database!');
                                loadSystemDemos();
                                loadLiveStats();
                            } else {
                                showToast(data.message || 'Failed to delete demo.', false);
                            }
                        })
                        .catch(() => showToast('Error deleting demo from database.', false));
                }
            });
        });
    }

    const editUploadModal = document.getElementById('editUploadModal');
    const editUploadModalCancel = document.getElementById('editUploadModalCancel');
    const editUploadModalSave = document.getElementById('editUploadModalSave');

    if (editUploadModalCancel) {
        editUploadModalCancel.addEventListener('click', () => {
            if (editUploadModal) editUploadModal.classList.remove('show');
            editingDemoId = null;
        });
    }

    if (editUploadModalSave) {
        editUploadModalSave.addEventListener('click', () => {
            const newTitle = document.getElementById('editUploadTitle')?.value.trim();
            const newDesc = document.getElementById('editUploadDesc')?.value.trim();
            if (!editingDemoId || !newDesc) {
                showToast('Please enter a description.', false);
                return;
            }

            const formData = new FormData();
            formData.append('action', 'update_demo');
            formData.append('id', editingDemoId);
            formData.append('title', newTitle);
            formData.append('description', newDesc);

            fetch('../php/api.php', { method: 'POST', body: formData })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        showToast(data.message || 'System demo updated in database!');
                        if (editUploadModal) editUploadModal.classList.remove('show');
                        editingDemoId = null;
                        loadSystemDemos();
                    } else {
                        showToast(data.message || 'Failed to update demo.', false);
                    }
                })
                .catch(() => showToast('Error updating demo in database.', false));
        });
    }

    const weeklyGrid = document.getElementById('weeklyGrid');
    const weekTitleInput = document.getElementById('weekTitleInput');
    const weekDateInput = document.getElementById('weekDateInput');
    const weekDescInput = document.getElementById('weekDescInput');
    const addWeekBtn = document.getElementById('addWeekBtn');
    const clearWeekBtn = document.getElementById('clearWeekBtn');

    if (clearWeekBtn) {
        clearWeekBtn.addEventListener('click', () => {
            if (weekTitleInput) weekTitleInput.value = '';
            if (weekDateInput) weekDateInput.value = '';
            if (weekDescInput) weekDescInput.value = '';
        });
    }

    if (addWeekBtn) {
        addWeekBtn.addEventListener('click', () => {
            const title = weekTitleInput ? weekTitleInput.value.trim() : '';
            const dateRange = weekDateInput ? weekDateInput.value.trim() : '';
            const desc = weekDescInput ? weekDescInput.value.trim() : '';

            if (!title || !desc) {
                showToast('Please provide both a Week Title and Description.', false);
                return;
            }

            addWeekBtn.disabled = true;
            addWeekBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

            const formData = new FormData();
            formData.append('action', 'add_week');
            formData.append('title', title);
            formData.append('date_range', dateRange);
            formData.append('description', desc);

            fetch('../php/api.php', { method: 'POST', body: formData })
                .then(res => res.json())
                .then(data => {
                    addWeekBtn.disabled = false;
                    addWeekBtn.innerHTML = '<i class="fas fa-plus"></i> Add Week';

                    if (data.status === 'success') {
                        showToast(data.message || 'Weekly update saved to database successfully!');
                        if (weekTitleInput) weekTitleInput.value = '';
                        if (weekDateInput) weekDateInput.value = '';
                        if (weekDescInput) weekDescInput.value = '';
                        loadWeeklyUpdates();
                    } else {
                        showToast(data.message || 'Failed to add weekly update.', false);
                    }
                })
                .catch(() => {
                    addWeekBtn.disabled = false;
                    addWeekBtn.innerHTML = '<i class="fas fa-plus"></i> Add Week';
                    showToast('Server error while saving week update.', false);
                });
        });
    }

    function loadWeeklyUpdates() {
        const gridContainer = document.getElementById('weeklyGrid');

        fetch('../php/api.php?action=get_weeks')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    renderWeeklyGrid(data.weeks || []);
                } else if (gridContainer) {
                    gridContainer.innerHTML = `<div class="empty-state">Failed to load weeks: ${data.message}</div>`;
                }
            })
            .catch(() => {
                if (gridContainer) {
                    gridContainer.innerHTML = `<div class="empty-state">Error loading weekly updates from database.</div>`;
                }
            });
    }

    function renderWeeklyGrid(weeks) {
        const gridContainer = document.getElementById('weeklyGrid');
        if (!gridContainer) return;

        if (weeks.length === 0) {
            gridContainer.innerHTML = `<div class="empty-state">No weekly progress logs recorded in database yet. Add one below!</div>`;
            return;
        }

        gridContainer.innerHTML = weeks.map(w => {
            const bullets = (w.description || '').split('\n').filter(line => line.trim().length > 0);
            const bulletsHtml = bullets.map(b => `<li><i class="fas fa-check-circle"></i> ${escapeHtml(b)}</li>`).join('');

            return `
                <article class="week-card" data-id="${w.id}">
                    <div class="week-card-header">
                        <h3><i class="fas fa-calendar-alt"></i> ${escapeHtml(w.title)}</h3>
                        ${w.date_range ? `<span class="week-chip">${escapeHtml(w.date_range)}</span>` : ''}
                    </div>
                    <ul class="week-card-list">
                        ${bulletsHtml}
                    </ul>
                    <div class="week-card-actions">
                        <button type="button" class="btn edit-week-btn" data-id="${w.id}" data-title="${escapeAttribute(w.title || '')}" data-date="${escapeAttribute(w.date_range || '')}" data-desc="${escapeAttribute(w.description || '')}">
                            <i class="fas fa-edit"></i> Edit Week
                        </button>
                        <button type="button" class="btn delete-week-btn" data-id="${w.id}">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </div>
                </article>
            `;
        }).join('');

        document.querySelectorAll('.edit-week-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                openWeekEditModal(
                    btn.getAttribute('data-id'),
                    btn.getAttribute('data-title') || '',
                    btn.getAttribute('data-date') || '',
                    btn.getAttribute('data-desc') || ''
                );
            });
        });

        document.querySelectorAll('.delete-week-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this weekly update from the database?')) {
                    const formData = new FormData();
                    formData.append('action', 'delete_week');
                    formData.append('id', id);

                    fetch('../php/api.php', { method: 'POST', body: formData })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                showToast(data.message || 'Weekly update deleted!');
                                loadWeeklyUpdates();
                            } else {
                                showToast(data.message || 'Failed to delete week.', false);
                            }
                        })
                        .catch(() => showToast('Error deleting week update.', false));
                }
            });
        });
    }

    function openWeekEditModal(id, title, date, desc) {
        editingWeekId = id;
        const editWeekModal = document.getElementById('editWeekModal');
        const editWeekTitle = document.getElementById('editWeekTitle');
        const editWeekDate = document.getElementById('editWeekDate');
        const editWeekDesc = document.getElementById('editWeekDesc');

        if (editWeekTitle) editWeekTitle.value = title || '';
        if (editWeekDate) editWeekDate.value = date || '';
        if (editWeekDesc) editWeekDesc.value = desc || '';
        if (editWeekModal) editWeekModal.classList.add('show');
    }

    function closeWeekEditModal() {
        const editWeekModal = document.getElementById('editWeekModal');
        if (editWeekModal) editWeekModal.classList.remove('show');
        editingWeekId = null;
    }

    const editWeekModal = document.getElementById('editWeekModal');
    const editWeekModalCancel = document.getElementById('editWeekModalCancel');
    const editWeekModalSave = document.getElementById('editWeekModalSave');

    if (editWeekModal) {
        editWeekModal.addEventListener('click', (event) => {
            if (event.target === editWeekModal) closeWeekEditModal();
        });
    }

    if (editWeekModalCancel) {
        editWeekModalCancel.addEventListener('click', () => closeWeekEditModal());
    }

    if (editWeekModalSave) {
        editWeekModalSave.addEventListener('click', () => {
            const title = document.getElementById('editWeekTitle')?.value.trim();
            const dateRange = document.getElementById('editWeekDate')?.value.trim();
            const desc = document.getElementById('editWeekDesc')?.value.trim();

            if (!editingWeekId || !title || !desc) {
                showToast('Please enter title and description.', false);
                return;
            }

            const formData = new FormData();
            formData.append('action', 'update_week');
            formData.append('id', editingWeekId);
            formData.append('title', title);
            formData.append('date_range', dateRange);
            formData.append('description', desc);

            fetch('../php/api.php', { method: 'POST', body: formData })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        showToast(data.message || 'Weekly update saved to database!');
                        closeWeekEditModal();
                        loadWeeklyUpdates();
                    } else {
                        showToast(data.message || 'Failed to save week.', false);
                    }
                })
                .catch(() => showToast('Error updating week in database.', false));
        });
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function escapeAttribute(str) {
        return escapeHtml(String(str ?? ''))
            .replace(/`/g, '&#96;');
    }

    loadSystemDemos();
    loadWeeklyUpdates();
});
