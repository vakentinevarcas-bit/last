<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover" />
  <title>The Reception Ledger — Hospitality NC II Puzzle</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;0,900;1,600&family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,600&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&family=Cinzel:wght@500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="../css/puzzle.css">
  <link rel="stylesheet" href="../css/auth.css">
  <link rel="stylesheet" href="../css/buttons.css">
</head>

<body>
  <div id="bg-letters" aria-hidden="true"></div>
  <svg id="crest-watermark" viewBox="0 0 200 200" aria-hidden="true">
    <g fill="none" stroke="#f3dfa1" stroke-width="1.1">
      <circle cx="100" cy="100" r="86" />
      <circle cx="100" cy="100" r="78" />
      <path d="M40,150 C48,110 48,90 40,54 C58,66 66,66 80,54" />
      <path d="M160,150 C152,110 152,90 160,54 C142,66 134,66 120,54" />
      <path d="M40,150 C48,120 30,108 22,110" />
      <path d="M160,150 C152,120 170,108 178,110" />
    </g>
    <text x="100" y="96" text-anchor="middle" font-family="Cinzel, serif" font-size="34" fill="#f3dfa1"
      letter-spacing="2">HR</text>
    <text x="100" y="122" text-anchor="middle" font-family="Cinzel, serif" font-size="9" fill="#f3dfa1"
      letter-spacing="5">NC II</text>
  </svg>

  <div id="rotate-overlay">
    <div class="rotate-icon" aria-hidden="true"></div>
    <h3>Turn your device</h3>
    <p>This puzzle plays best in landscape — rotate your phone sideways to see the full board and word list together.
    </p>
  </div>

  <?php include __DIR__ . '/auth_form.php'; ?>

  <div class="stage-wrap">


    <section id="menu-screen">
      <div class="sidebar">
        <div class="sidebar-header">
          <div class="user-badge" id="user-badge" style="display:none;">
            <div class="badge-name">👤 <strong>Receptionist: <span id="user-display-name">Guest</span></strong></div>
            <div class="badge-stats">
              <span>🏆 <strong>High Score:</strong> <span id="user-high-score">0</span></span>
              <span><strong>Total:</strong> <span id="user-total-score">0</span></span>
              <span><strong>Games:</strong> <span id="user-games-count">0</span></span>
            </div>
            <button type="button" class="logout-btn" id="btn-logout">Log Out</button>
          </div>
        </div>

        <div class="sidebar-buttons">
          <?php include __DIR__ . '/button.php'; ?>
          <?php echo render_button('▸ Play', 'side-btn primary', 'btn-play'); ?>
          <?php echo render_button('🏆 Leaderboard', 'side-btn', 'btn-leaderboard'); ?>
          <?php echo render_button('Review', 'side-btn', 'btn-review'); ?>
          <?php echo render_button('Options', 'side-btn', 'btn-options'); ?>
          <?php echo render_button('Exit', 'side-btn', 'btn-exit'); ?>
        </div>

        <div class="sidebar-footer">
          <div class="stage-preview" id="stage-preview"></div>
        </div>
      </div>

      <div class="main-content">
        <div class="floating-container">
          <img class="logo" src="../image/log.png" alt="">
          <div class="subtitle">Hospitality NC II Review</div>
          <h1 class="title">Quiz Puzzle Game</h1>
          <p class="description">A Hospitality NC II word-search review covering three TESDA competency areas —
            Front Office Services NC II, Food and Beverage Services NC II, and Housekeeping NC II — before your lives run out. Each
            stage draws 10 terms from a pool of 30. Trace a word, then answer the Term Check to lock it in — Housekeeping
            is answered in your own words.</p>
          <div class="divider"><span>◆</span></div>
        </div>
      </div>
    </section>

    <section id="story-screen">
      <div class="plaque story-panel">
        <span class="eyebrow" id="story-eyebrow">Front Desk Briefing</span>
        <h2 id="story-title">Welcome to the Hospitality Challenge</h2>
        <p class="story-text" id="story-text">The front desk is alive with new arrivals, guest requests, and a fresh set of service challenges. Choose your section carefully, keep your focus sharp, and prove your hospitality skills one word at a time.</p>
        <div class="story-actions">
          <button type="button" class="story-btn story-btn-secondary" id="btn-skip-story">Skip Story</button>
          <button type="button" class="story-btn story-btn-secondary is-hidden" id="btn-story-prev">Prev</button>
          <button type="button" class="story-btn story-btn-primary" id="btn-story-next">Next</button>
        </div>
      </div>
    </section>

    <section id="stage-select-screen">
      <div class="plaque stage-select-panel">
        <span class="eyebrow">Choose Your Section</span>
        <h2>Select a stage to play</h2>
        <div class="stage-choice-grid">
          <button type="button" class="stage-choice" data-stage="0">
            <span class="stage-choice-number">01</span>
            <span class="stage-choice-name">FRONT OFFICE</span>
            <span class="stage-choice-detail">Guest arrival and front desk operations</span>
          </button>
          <button type="button" class="stage-choice" data-stage="1">
            <span class="stage-choice-number">02</span>
            <span class="stage-choice-name">FOOD &amp; BEVERAGE</span>
            <span class="stage-choice-detail">Dining service and table setup</span>
          </button>
          <button type="button" class="stage-choice" data-stage="2">
            <span class="stage-choice-number">03</span>
            <span class="stage-choice-name">HOUSEKEEPING</span>
            <span class="stage-choice-detail">Room care and sanitation</span>
          </button>
        </div>
      </div>
      <button class="back-btn" id="btn-stage-select-back">← Back to Menu</button>
    </section>

    <section id="review-screen">
      <div class="plaque review-panel">
        <span class="eyebrow">Guest Handbook</span>
        <h2>How to Play</h2>
        <p class="howto">
          Click or tap a letter and drag in a straight line — across, down, or diagonal — to trace a hidden term, then
          release. In <b>Front Office Services NC II</b> and <b>Food and Beverage Services NC II</b>, a <b>Term
            Check</b> panel slides in with a multiple-choice question — every option is a real NC II definition, but
          only one matches the traced term. In <b>Housekeeping NC II</b>, there is no multiple choice: you write your
          own short explanation of the term in the box provided, then a model answer appears so you can compare. A
          <b>correct or substantive answer</b> earns points (the more time left on the clock, the bigger the bonus); a
          <b>wrong or blank answer</b> costs a life and earns no points. An <b>incorrect trace</b> also costs a life,
          and so does letting the stage <b>timer</b> or the <b>10-second Term Check timer</b> reach zero. You begin with <b>3
            lives</b> and <b>3 hints</b> per stage — each hint costs <b>50 pts</b>. A correct answer earns <b>120
            pts</b>. Each
          stage carries a <b>score quota</b>: every term must earn at least <b>100 pts</b>, and the stage total must reach
          <b>1,000 pts</b>.
          Falling short repeats the stage with a freshly shuffled puzzle. Clear all three stages to earn your
          hospitality rank.
        </p>
      </div>
      <div class="plaque review-panel">
        <span class="eyebrow">NC II Qualifications</span>
        <h2>Stage Glossary</h2>
        <p class="howto" style="margin-top:6px;">Choose a stage to study its terms — Front Office and F&amp;B pull their
          multiple-choice options from here, and Housekeeping's model answers come from here too.</p>
        <div class="stage-tabs" id="stage-tabs"></div>
        <div class="review-grid" id="glossary-grid"></div>
      </div>
      <button class="back-btn" id="btn-review-back">← Back to Menu</button>
    </section>

    <section id="options-screen">
      <div class="plaque opt-panel">
        <span class="eyebrow">Front Desk Settings</span>
        <h2>Options</h2>

        <div class="opt-group">
          <h3>Difficulty</h3>
          <div class="diff-row" id="diff-row">
            <div class="diff-card" data-diff="easy">
              <div class="dc-name">Easy</div>
              <div class="dc-desc">More time, more hints</div>
            </div>
            <div class="diff-card" data-diff="normal">
              <div class="dc-name">Normal</div>
              <div class="dc-desc">Standard pace</div>
            </div>
            <div class="diff-card" data-diff="hard">
              <div class="dc-name">Hard</div>
              <div class="dc-desc">Less time, fewer hints</div>
            </div>
            <div class="diff-card" data-diff="difficult">
              <div class="dc-name">Difficult</div>
              <div class="dc-desc">Tight timer, no hints</div>
            </div>
          </div>
        </div>

        <div class="opt-group">
          <h3>Audio</h3>
          <div class="toggle-row">
            <span>Background Music</span>
            <label class="switch">
              <input type="checkbox" id="music-toggle" checked>
              <span class="track"></span>
            </label>
          </div>
        </div>
      </div>
      <button class="back-btn" id="btn-options-back">← Back to Menu</button>
    </section>

    <section id="game-screen">
      <div class="hud plaque">
        <div class="stage-progress" id="stage-progress"></div>
        <div class="hud-block">
          <span class="hud-label">Stage</span>
          <span class="stage-badge" id="hud-stage">Front Office Services NC II</span>
        </div>
        <div class="hud-block">
          <span class="hud-label">Score</span>
          <span class="hud-value" id="hud-score">0</span>
        </div>
        <div class="hud-block" id="streak-block" style="display:none;">
          <span class="hud-label">Streak</span>
          <span class="hud-value streak-value" id="hud-streak">🔥 x0</span>
        </div>
        <div class="hud-block">
          <span class="hud-label">Quota</span>
          <span class="hud-value" id="hud-quota" style="font-size:15px;">0 / 1000</span>
        </div>
        <div class="hud-block">
          <span class="hud-label">Lives</span>
          <div class="lives-row" id="hud-lives"></div>
        </div>
        <div class="hud-block" style="min-width:130px;">
          <span class="hud-label">Time</span>
          <span class="hud-value" id="hud-timer">90</span>
          <div class="timer-bar-outer">
            <div class="timer-bar-inner" id="timer-bar"></div>
          </div>
        </div>
        <div class="hud-block" style="flex-direction:row; gap:8px;">
          <button class="icon-btn" id="btn-back-pause">↻ Restart</button>
          <button class="icon-btn" id="btn-quit-pause">✕ Quit</button>
        </div>
      </div>

      <div class="board-area">
        <div class="grid-panel plaque">
          <div id="grid"></div>
          <div id="inline-quiz">
            <div class="iq-top-bar">
              <span class="iq-eyebrow">Term Check</span>
              <div class="iq-timer-pill" id="iq-timer-wrap" title="Time remaining for Term Check">
                <span class="iq-timer-icon" aria-hidden="true">⏱️</span>
                <span class="iq-timer-val" id="iq-timer-val">10s</span>
              </div>
            </div>
            <div class="iq-timer-progress-wrap">
              <div class="iq-timer-progress-bar" id="iq-timer-bar"></div>
            </div>
            <div class="iq-word" id="iq-word">TERM</div>
            <p class="iq-question" id="iq-question">Question appears here.</p>

            <div id="iq-mc-wrap">
              <div class="quiz-choices" id="iq-choices"></div>
            </div>

            <div id="iq-essay-wrap" style="display:none; flex-direction:column; gap:9px;">
              <textarea id="iq-essay-input" class="iq-essay-textarea"
                placeholder="Write your own explanation of this term, in your own words..."></textarea>
              <p class="iq-essay-hint">Write a real explanation in your own words — you have 10 seconds to submit. A blank, too-short, or off-topic answer earns no points and costs a life.</p>
              <button class="iq-essay-btn" id="iq-essay-submit">Submit Answer</button>
            </div>

            <div class="quiz-correct-def" id="iq-correct-def"></div>
          </div>
        </div>
        <div class="side-panel plaque">
          <div class="mascot-wrap" id="mascot-wrap">
            <svg viewBox="0 0 110 130" xmlns="http://www.w3.org/2000/svg">
              <path d="M30,46 Q22,10 40,4 Q45,-2 55,4 Q65,-2 70,4 Q88,10 80,46 Z" fill="#ffffff" stroke="#dcdce0"
                stroke-width="1.2" />
              <rect x="28" y="40" width="54" height="12" rx="5" fill="#ffffff" stroke="#dcdce0" stroke-width="1.2" />
              <path d="M27,52 Q26,44 34,42 L76,42 Q84,44 83,52 Z" fill="#2b2018" />
              <ellipse cx="55" cy="66" rx="21" ry="23" fill="#e8b48c" />
              <path d="M34,54 Q31,68 36,80 Q33,64 38,54 Z" fill="#2b2018" />
              <path d="M76,54 Q79,68 74,80 Q77,64 72,54 Z" fill="#2b2018" />
              <path id="mascot-brow-l" d="M42,58 Q47,55 52,58" stroke="#2b2018" stroke-width="2.4" fill="none"
                stroke-linecap="round" />
              <path id="mascot-brow-r" d="M58,58 Q63,55 68,58" stroke="#2b2018" stroke-width="2.4" fill="none"
                stroke-linecap="round" />
              <ellipse cx="47" cy="66" rx="3.4" ry="4.2" fill="#2b2018" id="mascot-eye-l" />
              <ellipse cx="63" cy="66" rx="3.4" ry="4.2" fill="#2b2018" id="mascot-eye-r" />
              <path d="M55,68 Q57,74 55,76" stroke="#c98f68" stroke-width="1.6" fill="none" stroke-linecap="round" />
              <path id="mascot-mouth" d="M46,82 Q55,88 64,82" stroke="#8a4a3a" stroke-width="2.6" fill="none"
                stroke-linecap="round" />
              <path d="M31,124 Q29,98 38,90 L44,86 Q55,92 66,86 L72,90 Q81,98 79,124 Z" fill="#ffffff" stroke="#dcdce0"
                stroke-width="1.2" />
              <path d="M44,86 L40,124" stroke="#dcdce0" stroke-width="1" />
              <path d="M66,86 L70,124" stroke="#dcdce0" stroke-width="1" />
              <circle cx="47" cy="96" r="1.8" fill="#c7c7cc" />
              <circle cx="47" cy="106" r="1.8" fill="#c7c7cc" />
              <circle cx="63" cy="96" r="1.8" fill="#c7c7cc" />
              <circle cx="63" cy="106" r="1.8" fill="#c7c7cc" />
              <path d="M44,86 L55,94 L66,86 L60,88 L55,92 L50,88 Z" fill="#f2f2f4" />
            </svg>
            <div class="mascot-bubble" id="mascot-bubble">Good luck out there — I'll cheer you on!</div>
          </div>
          <h3>Find these terms</h3>
          <ul class="word-list" id="word-list"></ul>
          <button class="hint-btn" id="btn-hint">
            <span>💡 Use Hint</span>
            <span id="hint-count">3</span>
          </button>
          <div class="msg-line" id="msg-line">Trace a word to begin.</div>
        </div>
      </div>
    </section>

    <section id="gameover-screen">
      <div class="plaque ribbon">
        <div class="medal-seal" aria-hidden="true">
          <svg viewBox="0 0 60 70" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <radialGradient id="medalGold" cx="35%" cy="30%" r="75%">
                <stop offset="0" stop-color="#fbeec1" />
                <stop offset=".5" stop-color="#e5c471" />
                <stop offset="1" stop-color="#a3801f" />
              </radialGradient>
            </defs>
            <path d="M14,38 L8,64 L30,54 L52,64 L46,38" fill="#7a2340" />
            <circle cx="30" cy="28" r="24" fill="url(#medalGold)" stroke="#8a6a1c" stroke-width="1.5" />
            <circle cx="30" cy="28" r="18" fill="none" stroke="#fff8e6" stroke-opacity=".5" stroke-width="1" />
            <text x="30" y="35" text-anchor="middle" font-family="Cinzel, serif" font-weight="700" font-size="19"
              fill="#4a3608">★</text>
          </svg>
        </div>
        <span class="eyebrow" id="go-eyebrow">Guest Departure</span>
        <h2 class="rank-title" id="go-rank">Beginner</h2>
        <p class="rank-sub" id="go-sub">Your service record for this session</p>
        <div class="stat-grid">
          <div class="stat-box">
            <div class="num" id="go-score">0</div>
            <div class="lbl">Final Score</div>
          </div>
          <div class="stat-box">
            <div class="num" id="go-accuracy">0%</div>
            <div class="lbl">Accuracy</div>
          </div>
          <div class="stat-box">
            <div class="num" id="go-hints">0</div>
            <div class="lbl">Hints Used</div>
          </div>
          <div class="stat-box">
            <div class="num" id="go-mistakes">0</div>
            <div class="lbl">Mistakes</div>
          </div>
          <div class="stat-box">
            <div class="num" id="go-streak">0</div>
            <div class="lbl">Best Streak</div>
          </div>
        </div>
        <div class="end-btns">
          <?php echo render_button('Play Again', 'menu-btn primary', 'btn-play-again'); ?>
          <?php echo render_button('Review', 'menu-btn', 'btn-go-review'); ?>
          <?php echo render_button('Home', 'menu-btn', 'btn-quit-to-menu'); ?>
        </div>
      </div>
    </section>

    <section id="exit-screen">
      <div class="plaque ribbon">
        <span class="eyebrow">Checking Out</span>
        <h2 class="rank-title">Thank you for visiting</h2>
        <p class="rank-sub">You may close this tab, or return to the front desk.</p>
        <div class="end-btns"><?php echo render_button('Return to Menu', 'menu-btn primary', 'btn-exit-back'); ?></div>
      </div>
    </section>

  </div>

  <div class="pause-overlay" id="pause-overlay">
    <div class="plaque pause-card">
      <h3 id="pause-title">Paused</h3>
      <p id="pause-sub">The clock is on hold. What would you like to do?</p>
      <div class="pause-btns" id="pause-btns">
        <?php echo render_button('Resume', 'menu-btn primary', 'btn-resume'); ?>
        <?php echo render_button('Quit to Menu', 'menu-btn', 'btn-pause-quit'); ?>
      </div>
    </div>
  </div>

  <div class="pause-overlay" id="leaderboard-overlay" style="z-index:999;">
    <div class="plaque pause-card" style="max-width:560px; width:92%;">
      <span class="eyebrow">Top Performers</span>
      <h3 style="margin-bottom:8px; font-family:'Playfair Display',serif; color:#fbeec1;">🏆 High Score Leaderboard</h3>
      <p style="font-size:13px; color:rgba(251,238,193,0.7); margin-bottom:16px;">Top players in Hospitality NC II Word Search Review</p>
      
      <div id="leaderboard-list" style="max-height:280px; overflow-y:auto; display:flex; flex-direction:column; gap:8px; margin-bottom:20px;">
        <div style="text-align:center; padding:15px; color:#888;">Loading leaderboard...</div>
      </div>

      <div class="pause-btns">
        <?php echo render_button('Close Leaderboard', 'menu-btn primary', 'btn-close-leaderboard'); ?>
      </div>
    </div>
  </div>

  <div class="timesup-overlay" id="timesup-overlay">
    <div class="plaque timesup-content">
      <div class="timesup-icon" aria-hidden="true">⏱️</div>
      <h2 class="timesup-title">TIME'S UP!</h2>
      <p class="timesup-desc">The clock ran out for this stage.</p>
    </div>
  </div>

  <div class="meaning-toast" id="meaning-toast" aria-live="polite">
    <div class="mt-word" id="mt-word"></div>
    <div class="mt-def" id="mt-def"></div>
  </div>

  <script src="../js/auth.js"></script>
  <script>window.ADMIN_CSRF_TOKEN = <?php echo json_encode($_SESSION['csrf_token']); ?>;</script>
  <script src="../js/puzzle.js"></script>
</body>

</html>