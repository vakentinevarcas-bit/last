<div id="auth-overlay">
  <div class="auth-card">
    <div class="crest-logo" aria-hidden="true" style="margin-bottom:12px;">
      <svg viewBox="0 0 120 60" xmlns="http://www.w3.org/2000/svg" style="width:80px;height:40px;">
        <path d="M60,10 L60,50" stroke="var(--brass)" stroke-width="1.4" />
        <text x="60" y="34" text-anchor="middle" font-family="Cinzel, serif" font-size="16"
          fill="var(--brass-bright)">HR</text>
      </svg>
    </div>
    <span class="eyebrow" style="display:block; margin-bottom:12px;">Reception Desk Sign-In</span>

    <div class="auth-tabs">
      <button type="button" class="auth-tab-btn active" id="tab-login-btn">Log In</button>
      <button type="button" class="auth-tab-btn" id="tab-register-btn">Create Account</button>
    </div>

    <form id="login-form" class="auth-form">
      <div class="auth-form-group">
        <label for="login-username">Username or Gmail</label>
        <input type="text" id="login-username" name="username" class="auth-input" placeholder="Enter username or Gmail" required />
      </div>
      <div class="auth-form-group">
        <label for="login-password">Password</label>
        <input type="password" id="login-password" name="password" class="auth-input" placeholder="Enter password" required />
      </div>
      <button type="submit" class="auth-submit-btn">Log In &amp; Play</button>
    </form>

    <form id="register-form" class="auth-form" style="display:none;">
      <div class="auth-form-group">
        <label for="reg-username">Username</label>
        <input type="text" id="reg-username" name="username" class="auth-input" placeholder="Choose username" required />
      </div>
      <div class="auth-form-group">
        <label for="reg-email">Gmail / Email Address</label>
        <input type="email" id="reg-email" name="email" class="auth-input" placeholder="e.g. yourname@gmail.com" required />
      </div>
      <div class="auth-form-group">
        <label for="reg-password">Password</label>
        <input type="password" id="reg-password" name="password" class="auth-input" placeholder="Create password (min. 4 chars)" required />
      </div>
      <button type="submit" class="auth-submit-btn">Create Account</button>
    </form>

    <div id="auth-msg" class="auth-msg"></div>
  </div>
</div>
