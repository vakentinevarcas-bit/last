document.addEventListener('DOMContentLoaded', () => {
  const authOverlay = document.getElementById('auth-overlay');
  const tabLoginBtn = document.getElementById('tab-login-btn');
  const tabRegBtn = document.getElementById('tab-register-btn');
  const loginForm = document.getElementById('login-form');
  const regForm = document.getElementById('register-form');
  const authMsg = document.getElementById('auth-msg');
  const userBadge = document.getElementById('user-badge');
  const userDisplayName = document.getElementById('user-display-name');
  const userHighScore = document.getElementById('user-high-score');
  const userGamesCount = document.getElementById('user-games-count');
  const btnLogout = document.getElementById('btn-logout');

  let currentUser = null;

  function showAuthMsg(msg, isError = true) {
    if (!authMsg) return;
    authMsg.textContent = msg;
    authMsg.className = 'auth-msg ' + (isError ? 'error' : 'success');
  }

  function updateUserBadgeUI() {
    if (!userBadge) return;

    if (currentUser) {
      if (userDisplayName) userDisplayName.textContent = currentUser.username;
      if (userHighScore) userHighScore.textContent = currentUser.high_score || 0;
      const userTotalScore = document.getElementById('user-total-score');
      if (userTotalScore) userTotalScore.textContent = currentUser.total_score || 0;
      if (userGamesCount) userGamesCount.textContent = currentUser.games_played || 0;
      userBadge.style.display = 'flex';
    } else {
      userBadge.style.display = 'none';
    }
  }

  function setActiveTab(mode) {
    if (!tabLoginBtn || !tabRegBtn || !loginForm || !regForm) return;

    if (mode === 'register') {
      tabRegBtn.classList.add('active');
      tabLoginBtn.classList.remove('active');
      regForm.style.display = 'flex';
      loginForm.style.display = 'none';
    } else {
      tabLoginBtn.classList.add('active');
      tabRegBtn.classList.remove('active');
      loginForm.style.display = 'flex';
      regForm.style.display = 'none';
    }

    if (authMsg) authMsg.textContent = '';
  }

  function checkAuthStatus() {
    if (!authOverlay) return;

    fetch('check_auth.php')
      .then((res) => res.json())
      .then((data) => {
        if (data.status === 'success' && data.logged_in) {
          currentUser = data.user;
          updateUserBadgeUI();
          authOverlay.classList.add('hidden');
        } else {
          currentUser = null;
          updateUserBadgeUI();
          authOverlay.classList.remove('hidden');
        }
      })
      .catch((err) => {
        console.error('Auth check error:', err);
        authOverlay.classList.remove('hidden');
      });
  }

  if (tabLoginBtn) {
    tabLoginBtn.addEventListener('click', () => setActiveTab('login'));
  }

  if (tabRegBtn) {
    tabRegBtn.addEventListener('click', () => setActiveTab('register'));
  }

  if (loginForm) {
    loginForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const formData = new FormData(loginForm);

      fetch('login.php', {
        method: 'POST',
        body: formData
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.status === 'success') {
            showAuthMsg(data.message, false);
            currentUser = data.user;
            updateUserBadgeUI();
            setTimeout(() => {
              if (authOverlay) authOverlay.classList.add('hidden');
              loginForm.reset();
              if (authMsg) authMsg.textContent = '';
            }, 800);
          } else {
            showAuthMsg(data.message, true);
          }
        })
        .catch(() => {
          showAuthMsg('Indi maka-connect sa database server (Connection error).', true);
        });
    });
  }

  if (regForm) {
    regForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const formData = new FormData(regForm);

      fetch('register.php', {
        method: 'POST',
        body: formData
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.status === 'success') {
            showAuthMsg(data.message, false);
            currentUser = data.user;
            updateUserBadgeUI();
            setTimeout(() => {
              if (authOverlay) authOverlay.classList.add('hidden');
              regForm.reset();
              if (authMsg) authMsg.textContent = '';
            }, 800);
          } else {
            showAuthMsg(data.message, true);
          }
        })
        .catch(() => {
          showAuthMsg('Indi maka-connect sa database server (Connection error).', true);
        });
    });
  }

  if (btnLogout) {
    btnLogout.addEventListener('click', () => {
      fetch('logout.php')
        .then((res) => res.json())
        .then(() => {
          currentUser = null;
          updateUserBadgeUI();
          if (authOverlay) authOverlay.classList.remove('hidden');
          if (tabLoginBtn) tabLoginBtn.click();
        });
    });
  }

  checkAuthStatus();
});
