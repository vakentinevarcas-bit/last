<?php
require_once __DIR__ . '/php/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Word Puzzle Game — Hospitality NC II Vocabulary Trainer</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600;700;800&family=Marck+Script&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/website.css">
</head>
<body>
  <div class="background-letters" id="bgLetters"></div>
  <div class="bg-layer">
    <div class="tile-noise"></div>
    <svg class="leaf-corner tl" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M10 10 C120 20 180 90 160 200 C140 280 60 260 30 190 C0 120 -20 30 10 10Z" fill="#0f3a29" opacity="0.55" />
      <path d="M40 40 C110 60 140 120 120 190 C105 240 60 220 45 170 C28 110 20 55 40 40Z" fill="#0a2b1d" opacity="0.6" />
    </svg>
    <svg class="leaf-corner br" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M10 10 C120 20 180 90 160 200 C140 280 60 260 30 190 C0 120 -20 30 10 10Z" fill="#0f3a29" opacity="0.5" />
      <path d="M40 40 C110 60 140 120 120 190 C105 240 60 220 45 170 C28 110 20 55 40 40Z" fill="#0a2b1d" opacity="0.55" />
    </svg>
    <div class="vignette"></div>
  </div>
  
  <header>
    <div class="wrap nav">
      <div class="logo">
      <img class="side-logo" src="image/log.png" alt="Word Puzzle Game Logo">
    <div class="log">
    </div>
    <div class="logo-text">
        <div class="l1">QUIZ PUZZLE</div>
        <div class="l2">GAME</div>
    </div>
</div>
      <nav class="nav-links" id="navLinks">
        <a href="#home" class="active" data-nav>HOME</a>
        <a href="#about" data-nav>ABOUT</a>
        <a href="#stages" data-nav>GAME STAGES</a>
        <a href="#blog" data-nav>BLOG</a>
        <a href="#demo" data-nav>DEMO</a>
        <a href="#contact" data-nav>Developers</a>
        <a href="admin/index.php" data-nav>admin</a>
      </nav>
      <button class="btn-gold" id="playBtn">
        PLAY NOW
        <svg viewBox="0 0 24 24" fill="none" stroke="#20140a" stroke-width="2">
          <rect x="2" y="7" width="20" height="10" rx="5" />
          <path d="M7 10v4M5 12h4M15.5 12h.01M18.5 10h.01" />
        </svg>
      </button>
      <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>
  <main>
    <section class="hero" id="home">
      <div class="wrap hero-grid">
        <div>
          <div class="eyebrow">Hospitality NC II Vocabulary Trainer</div>
          <h1>
            <span class="line1">Sharpen Your Mind,</span>
            <span class="line2">One Word At A Time.</span>
          </h1>
          <p class="sub">Challenge yourself with exciting word puzzles. Have fun, learn new words, and become the ultimate word master!</p>
          <p class="sub2">Clear all three stages — <b>Front Office Services NC II</b>, <b>Food &amp; Beverage Services NC II</b>, and <b>Housekeeping NC II</b> — and you'll have reviewed the core terms tested across the Hospitality NC II qualification.</p>
          <div class="hero-cta">
      
          </div>
        </div>
        <div class="hero-visual">
          <div class="visual-glow"></div>
          <div class="visual-tilesbg">
            <span>Z</span><span>Q</span><span>Y</span><span>B</span>
            <span>E</span><span>X</span><span>K</span><span>H</span>
          </div>
          <div class="tile-row">
            <div class="letter-tile">Q</div>
            <div class="letter-tile">U</div>
            <div class="letter-tile">I</div>
            <div class="letter-tile">Z</div>
          </div>
          <div class="puzzle-script script">Puzzle</div>
          <div class="particle" style="width:6px;height:6px;top:10%;left:15%;"></div>
          <div class="particle" style="width:4px;height:4px;top:70%;left:8%; animation-delay:1s;"></div>
          <div class="particle" style="width:5px;height:5px;top:20%;right:5%; animation-delay:2s;"></div>
          <div class="particle" style="width:3px;height:3px;bottom:10%;right:20%; animation-delay:0.5s;"></div>
        </div>
      </div>
      <svg class="divider-curve" viewBox="0 0 1400 80" preserveAspectRatio="none">
        <path d="M0 20 C 400 90, 1000 -30, 1400 40" stroke="url(#g1)" stroke-width="1.5" fill="none" opacity="0.6" />
        <defs>
          <linearGradient id="g1" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0" stop-color="#e9bd5c" stop-opacity="0" />
            <stop offset="0.5" stop-color="#e9bd5c" stop-opacity="0.9" />
            <stop offset="1" stop-color="#e9bd5c" stop-opacity="0" />
          </linearGradient>
        </defs>
      </svg>
    </section>
    <section class="wrap panels" id="about-wrap">
      <div class="panel" id="about">
        <div class="panel-title">
          <div class="icon-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M12 6C10 4.5 7 4 4 4v14c3 0 6 .5 8 2 2-1.5 5-2 8-2V4c-3 0-6 .5-8 2z" />
            </svg>
          </div>
          ABOUT <span class="accent">THE GAME</span>
        </div>
        <p class="desc">Word Puzzle Game challenges players to clear a hospitality-themed word search grid before time and lives run out, combining quick pattern recognition with a graded vocabulary check on every term you find.</p>
        <div class="mech-heading">GAME MECHANICS</div>
        <div class="mech-grid">
          <div class="mech-col">
            <div class="icon-badge">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <rect x="2" y="7" width="20" height="10" rx="5" />
                <path d="M7 10v4M5 12h4M15.5 12h.01M18.5 10h.01" />
              </svg>
            </div>
            <h4>How To Play</h4>
            <ul>
              <li>Three stages — Front Office, Food &amp; Beverage, and Housekeeping — clear one after another</li>
              <li>Each stage draws 10 terms at random from a 30-term pool, so every run is different</li>
              <li>Trace a word by clicking or dragging across, down, or diagonally, then release to submit it</li>
              <li>Difficulty (Easy, Normal, Hard, Difficult) adjusts timer length, starting lives, and hint allowance</li>
            </ul>
          </div>
          <div class="mech-col">
            <div class="icon-badge">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M12 15a5 5 0 100-10 5 5 0 000 10z" />
                <path d="M8.5 13.5L7 21l5-2.5L17 21l-1.5-7.5" />
              </svg>
            </div>
            <h4>Scoring System</h4>
            <ul>
              <li>Every found term must earn at least <b>100 pts</b>, with a time-based bonus for speed</li>
              <li>Consecutive correct answers build a <b>streak multiplier</b></li>
              <li>Each stage total must reach <b>1,000 pts</b> to clear — falling short reshuffles the stage</li>
              <li>Hints cost points, and each one used costs more than the last</li>
            </ul>
          </div>
          <div class="mech-col">
            <div class="icon-badge">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="12" cy="12" r="9" />
                <circle cx="12" cy="12" r="4" />
                <circle cx="12" cy="12" r="0.7" fill="currentColor" />
              </svg>
            </div>
            <h4>Game Outcome</h4>
            <ul>
              <li class="win"><b>Win:</b> Reach the 1,000-point quota to clear the stage</li>
              <li class="lose"><b>Lose:</b> Run out of lives, or the stage timer expires</li>
              <li>Players start each stage with a set number of lives and 3 hints</li>
            </ul>
          </div>
        </div>
        <div class="mech-heading">TERM CHECK &amp; VALIDATION</div>
        <div class="mech-grid cols-2">
          <div class="mech-col">
            <div class="icon-badge">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M9 12l2 2 4-4M12 3l8 4v5c0 5-3.5 8.5-8 9-4.5-.5-8-4-8-9V7l8-4z" />
              </svg>
            </div>
            <h4>Question Display</h4>
            <ul>
              <li>The puzzle grid and a countdown timer show for the active stage</li>
              <li>The list of hospitality terms to find is shown alongside the grid</li>
              <li>Finding a word correctly opens a <b>Term Check</b> panel to confirm real understanding</li>
              <li>Front Office &amp; Food &amp; Beverage use multiple choice — every option is a real NC II definition, only one matches</li>
              <li>Housekeeping has no multiple choice — write a short explanation, then compare it to a model answer</li>
            </ul>
          </div>
          <div class="mech-col">
            <div class="icon-badge">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M20 6L9 17l-5-5" />
              </svg>
            </div>
            <h4>Answer Validation</h4>
            <ul>
              <li class="win">Trace matches the word list <b>and</b> the Term Check is correct → <b>score increases</b> with a time bonus and streak multiplier</li>
              <li class="lose">Trace matches nothing, the Term Check answer is wrong, the Housekeeping answer is blank or off-topic, or the timer hits zero → <b>lose a life</b>, no points earned</li>
              <li>Hints are optional, up to 3 per stage — each reveals the starting tile of an unfound word at a rising point cost</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="panel" id="live-leaderboard-panel" style="margin-top:40px; margin-bottom:40px;">
        <div class="panel-title">
          <div class="icon-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M12 15a5 5 0 100-10 5 5 0 000 10z" />
              <path d="M8.5 13.5L7 21l5-2.5L17 21l-1.5-7.5" />
            </svg>
          </div>
          LIVE <span class="accent">TOP PLAYERS</span>
          <div style="margin-left:auto; font-size:12px; color:#e9bd5c; display:flex; align-items:center; gap:6px;">
            <span style="display:inline-block; width:8px; height:8px; background:#4caf50; border-radius:50%;"></span> Auto-updating
          </div>
        </div>
        <p class="desc">Top scorers across Hospitality NC II Word Search Review games.</p>
        <div id="websiteLeaderboard" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:16px; margin-top:20px;">
          <div style="text-align:center; color:rgba(255,255,255,0.6); padding:20px; grid-column: 1 / -1;">Loading top player high scores...</div>
        </div>
      </div>

      <div class="panel" id="stages">
        <div class="panel-title" style="justify-content:center;">
          <div class="icon-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M20.5 11a3.5 3.5 0 00-3.5-3.5V6a2 2 0 00-2-2h-2.5a3.5 3.5 0 10-1 0H9a2 2 0 00-2 2v1.5A3.5 3.5 0 003 11a3.5 3.5 0 003.5 3.5H8V18a2 2 0 002 2h1.5a3.5 3.5 0 107 0H20a2 2 0 002-2v-3.5a3.5 3.5 0 00-1.5-2z" />
            </svg>
          </div>
          GAME <span class="accent">STAGES</span>
        </div>
        <div class="tabs cols-3" id="stageTabs">
          <button class="tab-btn active" data-mode="0">FRONT OFFICE</button>
          <button class="tab-btn" data-mode="1">FOOD &amp; BEVERAGE</button>
          <button class="tab-btn" data-mode="2">HOUSEKEEPING</button>
        </div>
        <div class="mode-panel" id="modePanel">
          <div class="mode-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#f6d789" stroke-width="1.5">
              <path d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6" />
            </svg>
          </div>
          <div class="mode-info">
            <h3 id="modeTitle">Front Office Services NC II</h3>
            <p id="modeDesc">Trace reception, reservation, and guest-service terms drawn from the Front Office reviewer. Multiple-choice Term Checks confirm you know each definition.</p>
            <ul id="modeList">
              <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M20 6L9 17l-5-5" /></svg>10 terms drawn from a 30-term pool each run</li>
              <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M20 6L9 17l-5-5" /></svg>Multiple-choice Term Check on every find</li>
              <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M20 6L9 17l-5-5" /></svg>Reach 1,000 pts to clear the stage</li>
            </ul>
          </div>
        </div>
        <div class="dots" id="dots">
          <span class="dot active"></span>
          <span class="dot"></span>
          <span class="dot"></span>
        </div>
      </div>
    </section>
    <section class="block" id="blog">
      <div class="wrap">
        <div class="section-head">
          <div class="eyebrow">Development Log</div>
          <h2>Progress <span>Blog</span></h2>
          <p>A week-by-week look at how the project came together.</p>
        </div>
        <div class="panel wide" style="max-width:900px; margin:0 auto;">
          <div class="tabs" id="weekTabs">
            <button class="tab-btn active" data-tab="w1">Week 1</button>
            <button class="tab-btn" data-tab="w2">Week 2</button>
            <button class="tab-btn" data-tab="w3">Week 3</button>
            <button class="tab-btn" data-tab="w4">Week 4</button>
            <button class="tab-btn" data-tab="w5">Week 5</button>
            <button class="tab-btn" data-tab="w6">Week 6</button>
            <button class="tab-btn" data-tab="w7">Week 7</button>
          </div>
          <div class="mode-panel" id="weekPanel" style="display:block;">
            <div class="mode-info" style="width:100%;">
              <h3 id="weekTitle" class="week-title-typing">Week 1: Planning</h3>
              <ul id="weekList" class="blog-list-animate">
                <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M20 6L9 17l-5-5" /></svg>Defined project scope and selected the word-search puzzle concept</li>
                <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M20 6L9 17l-5-5" /></svg>Assigned team roles: project manager, front-end, and back-end developers</li>
                <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M20 6L9 17l-5-5" /></svg>Drafted the three-stage structure around the NC II qualifications</li>
                <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M20 6L9 17l-5-5" /></svg>Sketched early wireframes for the puzzle grid and layout</li>
              </ul>
            </div>
          </div>
          <div class="pager">
            <button id="weekPrev">◀ Prev</button>
            <span id="weekCount">1 / 7</span>
            <button id="weekNext">Next ▶</button>
          </div>
        </div>
      </div>
    </section>
    <section class="block" id="demo">
      <div class="wrap">
        <div class="section-head">
          <div class="eyebrow">Preview</div>
          <h2>System <span>Demo</span></h2>
          <p>An interactive walkthrough of the puzzle grid, timer, and Term Check flow.</p>
        </div>
        <div class="demo-slider-wrap">
          <div class="demo-slider-container" id="sliderContainer">
            <div class="demo-slide active" data-index="0">
              <div class="slide-visual">
                <span class="mock-badge">Puzzle Grid</span>
                <svg viewBox="0 0 600 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="0" y="0" width="600" height="220" rx="12" fill="#0a2018" opacity="0.6" />
                  <g transform="translate(20, 20)">
                    <text x="0" y="12" font-family="monospace" font-size="9" fill="#e9bd5c" opacity="0.6">0</text>
                    <text x="28" y="12" font-family="monospace" font-size="9" fill="#e9bd5c" opacity="0.6">1</text>
                    <text x="56" y="12" font-family="monospace" font-size="9" fill="#e9bd5c" opacity="0.6">2</text>
                    <text x="84" y="12" font-family="monospace" font-size="9" fill="#e9bd5c" opacity="0.6">3</text>
                    <text x="112" y="12" font-family="monospace" font-size="9" fill="#e9bd5c" opacity="0.6">4</text>
                    <text x="140" y="12" font-family="monospace" font-size="9" fill="#e9bd5c" opacity="0.6">5</text>
                    <text x="168" y="12" font-family="monospace" font-size="9" fill="#e9bd5c" opacity="0.6">6</text>
                    <text x="196" y="12" font-family="monospace" font-size="9" fill="#e9bd5c" opacity="0.6">7</text>
                    <g font-family="monospace" font-size="14" font-weight="bold" fill="#f6f1e2">
                      <rect x="0" y="16" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="7" y="33">R</text>
                      <rect x="24" y="16" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="31" y="33">E</text>
                      <rect x="48" y="16" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="55" y="33">S</text>
                      <rect x="72" y="16" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="79" y="33">E</text>
                      <rect x="96" y="16" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="103" y="33">R</text>
                      <rect x="120" y="16" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="127" y="33">V</text>
                      <rect x="144" y="16" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="151" y="33">A</text>
                      <rect x="168" y="16" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="175" y="33">T</text>
                      <rect x="0" y="40" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="7" y="57">I</text>
                      <rect x="24" y="40" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="31" y="57">O</text>
                      <rect x="48" y="40" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="55" y="57">N</text>
                      <rect x="72" y="40" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="79" y="57">G</text>
                      <rect x="96" y="40" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="103" y="57">P</text>
                      <rect x="120" y="40" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="127" y="57">A</text>
                      <rect x="144" y="40" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="151" y="57">T</text>
                      <rect x="168" y="40" width="22" height="22" rx="4" fill="#f6d789" stroke="#e9bd5c" stroke-opacity="0.5" stroke-width="1.5" />
                      <text x="175" y="57" fill="#071510">H</text>
                      <rect x="0" y="64" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="7" y="81">C</text>
                      <rect x="24" y="64" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="31" y="81">K</text>
                      <rect x="48" y="64" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="55" y="81">D</text>
                      <rect x="72" y="64" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="79" y="81">P</text>
                      <rect x="96" y="64" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="103" y="81">A</text>
                      <rect x="120" y="64" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="127" y="81">M</text>
                      <rect x="144" y="64" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="151" y="81">E</text>
                      <rect x="168" y="64" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="175" y="81">N</text>
                      <rect x="0" y="88" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="7" y="105">T</text>
                      <rect x="24" y="88" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="31" y="105">A</text>
                      <rect x="48" y="88" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="55" y="105">B</text>
                      <rect x="72" y="88" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="79" y="105">L</text>
                      <rect x="96" y="88" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="103" y="105">E</text>
                      <rect x="120" y="88" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="127" y="105">S</text>
                      <rect x="144" y="88" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="151" y="105">R</text>
                      <rect x="168" y="88" width="22" height="22" rx="4" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.25" stroke-width="1" />
                      <text x="175" y="105">T</text>
                      <g transform="translate(10, 130)">
                        <text font-family="monospace" font-size="9" fill="#f6d789" opacity="0.7">found:</text>
                        <text font-family="monospace" font-size="9" fill="#8fd39a" x="55">RESERVATION</text>
                        <text font-family="monospace" font-size="9" fill="#8fd39a" x="170">GUEST</text>
                        <text font-family="monospace" font-size="9" fill="#e9bd5c" x="55" y="16">CHECK-IN</text>
                        <text font-family="monospace" font-size="9" fill="#e9bd5c" x="170" y="16">TABLE</text>
                        <text font-family="monospace" font-size="9" fill="#e9bd5c" x="55" y="32">HOUSEKEEPING</text>
                      </g>
                    </g>
                  </g>
                  <rect x="440" y="18" width="140" height="30" rx="14" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.3" stroke-width="1" />
                  <text x="460" y="38" font-family="monospace" font-size="12" fill="#f6d789">⏱ 01:24</text>
                </svg>
              </div>
              <div class="slide-content">
                <h3>Puzzle Grid &amp; Timer</h3>
                <p>The main game board displays a random arrangement of letters. Click and drag horizontally, vertically, or diagonally to trace a word. A live countdown timer keeps the pressure on.</p>
                <span class="slide-tag">Core Interaction</span>
              </div>
            </div>
            <div class="demo-slide" data-index="1">
              <div class="slide-visual">
                <span class="mock-badge">Term Check</span>
                <svg viewBox="0 0 600 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="0" y="0" width="600" height="220" rx="12" fill="#0a2018" opacity="0.6" />
                  <g transform="translate(24, 20)">
                    <text font-family="monospace" font-size="12" fill="#f6d789" font-weight="bold">TERM CHECK</text>
                    <text font-family="monospace" font-size="9" fill="#e9bd5c" y="20" opacity="0.7">You found: <tspan fill="#f6d789" font-weight="bold">RESERVATION</tspan></text>
                    <text font-family="monospace" font-size="9" fill="#c98f3a" y="36">What does this term mean in hospitality?</text>
                    <g transform="translate(0, 52)">
                      <rect x="0" y="0" width="260" height="28" rx="6" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.2" stroke-width="1" />
                      <circle cx="16" cy="14" r="6" fill="none" stroke="#e9bd5c" stroke-opacity="0.3" stroke-width="1.5" />
                      <text font-family="monospace" font-size="10" fill="#f6f1e2" x="30" y="18">A. A room assigned to a VIP guest</text>
                    </g>
                    <g transform="translate(0, 86)">
                      <rect x="0" y="0" width="260" height="28" rx="6" fill="#14493a" stroke="#8fd39a" stroke-opacity="0.5" stroke-width="1.5" />
                      <circle cx="16" cy="14" r="6" fill="#8fd39a" stroke="#8fd39a" stroke-width="1.5" />
                      <text font-family="monospace" font-size="10" fill="#f6f1e2" x="30" y="18">B. A booking or arrangement for a room</text>
                      <text font-family="monospace" font-size="8" fill="#8fd39a" x="230" y="18">✓</text>
                    </g>
                    <g transform="translate(0, 120)">
                      <rect x="0" y="0" width="260" height="28" rx="6" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.2" stroke-width="1" />
                      <circle cx="16" cy="14" r="6" fill="none" stroke="#e9bd5c" stroke-opacity="0.3" stroke-width="1.5" />
                      <text font-family="monospace" font-size="10" fill="#f6f1e2" x="30" y="18">C. A request for extra amenities</text>
                    </g>
                    <g transform="translate(0, 154)">
                      <rect x="0" y="0" width="260" height="28" rx="6" fill="#0e2c21" stroke="#e9bd5c" stroke-opacity="0.2" stroke-width="1" />
                      <circle cx="16" cy="14" r="6" fill="none" stroke="#e9bd5c" stroke-opacity="0.3" stroke-width="1.5" />
                      <text font-family="monospace" font-size="10" fill="#f6f1e2" x="30" y="18">D. The check-out procedure</text>
                    </g>
                    <g transform="translate(300, 52)">
                      <rect x="0" y="0" width="250" height="110" rx="10" fill="#0a2b1d" stroke="#e9bd5c" stroke-opacity="0.15" stroke-width="1" />
                      <text font-family="monospace" font-size="11" fill="#f6d789" x="16" y="24">SCORE</text>
                      <text font-family="monospace" font-size="28" fill="#f6d789" font-weight="bold" x="16" y="58">+120</text>
                      <text font-family="monospace" font-size="9" fill="#e9bd5c" x="16" y="76">base + time bonus</text>
                      <text font-family="monospace" font-size="9" fill="#8fd39a" x="16" y="94">streak ×2</text>
                    </g>
                  </g>
                </svg>
              </div>
              <div class="slide-content">
                <h3>Term Check — Multiple Choice</h3>
                <p>Every traced word triggers a definition check. Front Office and F&amp;B stages use multiple choice with real NC II definitions — only one is correct.</p>
                <span class="slide-tag">Knowledge Validation</span>
              </div>
            </div>
            <div class="demo-slide" data-index="2">
              <div class="slide-visual">
                <span class="mock-badge">Housekeeping</span>
                <svg viewBox="0 0 600 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="0" y="0" width="600" height="220" rx="12" fill="#0a2018" opacity="0.6" />
                  <g transform="translate(24, 20)">
                    <text font-family="monospace" font-size="12" fill="#f6d789" font-weight="bold">TERM CHECK · HOUSEKEEPING</text>
                    <text font-family="monospace" font-size="9" fill="#e9bd5c" y="20" opacity="0.7">You found: <tspan fill="#f6d789" font-weight="bold">TURNDOWN SERVICE</tspan></text>
                    <text font-family="monospace" font-size="9" fill="#c98f3a" y="36">Write a short explanation in your own words:</text>
                    <rect x="0" y="48" width="360" height="60" rx="8" fill="#071510" stroke="#e9bd5c" stroke-opacity="0.2" stroke-width="1" />
                    <text font-family="monospace" font-size="10" fill="#f6f1e2" opacity="0.5" x="12" y="66">Evening service that prepares the room for</text>
                    <text font-family="monospace" font-size="10" fill="#f6f1e2" opacity="0.5" x="12" y="80">sleep — turning down bed, closing curtains,</text>
                    <text font-family="monospace" font-size="10" fill="#f6f1e2" opacity="0.5" x="12" y="94">leaving a mint and a nightly amenity...</text>
                    <g transform="translate(0, 122)">
                      <text font-family="monospace" font-size="9" fill="#e9bd5c">📖 Model answer:</text>
                      <text font-family="monospace" font-size="9" fill="#8fd39a" y="16">A nightly service where staff prepare the room for sleep:</text>
                      <text font-family="monospace" font-size="9" fill="#8fd39a" y="30">turn down bed covers, close drapes, place a chocolate on</text>
                      <text font-family="monospace" font-size="9" fill="#8fd39a" y="44">the pillow, and refresh the bathroom amenities.</text>
                    </g>
                    <g transform="translate(400, 48)">
                      <rect x="0" y="0" width="140" height="36" rx="18" fill="#e9bd5c" />
                      <text font-family="monospace" font-size="11" fill="#071510" font-weight="bold" x="30" y="24">COMPARE</text>
                    </g>
                    <g transform="translate(400, 96)">
                      <text font-family="monospace" font-size="10" fill="#8fd39a">✓ Your answer is close!</text>
                      <text font-family="monospace" font-size="9" fill="#e9bd5c" opacity="0.6" y="16">+100 pts</text>
                    </g>
                  </g>
                </svg>
              </div>
              <div class="slide-content">
                <h3>Housekeeping — Free Response</h3>
                <p>The final stage drops multiple choice. Write a short explanation of the term in your own words, then compare it to a model answer. Blank or off-topic answers cost a life.</p>
                <span class="slide-tag">Final Stage</span>
              </div>
            </div>
            <div class="demo-slide" data-index="3">
              <div class="slide-visual">
                <span class="mock-badge">Scoring &amp; Lives</span>
                <svg viewBox="0 0 600 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="0" y="0" width="600" height="220" rx="12" fill="#0a2018" opacity="0.6" />
                  <g transform="translate(30, 24)">
                    <text font-family="monospace" font-size="10" fill="#e9bd5c">STAGE PROGRESS</text>
                    <rect x="0" y="14" width="540" height="18" rx="9" fill="#071510" stroke="#e9bd5c" stroke-opacity="0.2" stroke-width="1" />
                    <rect x="2" y="16" width="324" height="14" rx="7" fill="#e9bd5c" opacity="0.8" />
                    <text font-family="monospace" font-size="9" fill="#071510" font-weight="bold" x="240" y="28">680 / 1,000</text>
                    <g transform="translate(0, 48)">
                      <text font-family="monospace" font-size="10" fill="#e9bd5c">❤️ Lives:</text>
                      <text font-family="monospace" font-size="14" fill="#e08c6f" x="70">❤️ ❤️ ❤️ ❤️</text>
                      <text font-family="monospace" font-size="10" fill="#e9bd5c" x="230">💡 Hints:</text>
                      <text font-family="monospace" font-size="14" fill="#f6d789" x="290">💡 💡</text>
                      <text font-family="monospace" font-size="9" fill="#c98f3a" x="370">(2 left)</text>
                    </g>
                    <g transform="translate(0, 84)">
                      <text font-family="monospace" font-size="10" fill="#e9bd5c">FOUND WORDS</text>
                      <g transform="translate(0, 16)">
                        <rect x="0" y="0" width="110" height="24" rx="6" fill="#0e2c21" stroke="#8fd39a" stroke-opacity="0.3" stroke-width="1" />
                        <text font-family="monospace" font-size="9" fill="#8fd39a" x="8" y="16">RESERVATION</text>
                        <text font-family="monospace" font-size="8" fill="#8fd39a" x="82" y="16">+120</text>
                      </g>
                      <g transform="translate(120, 16)">
                        <rect x="0" y="0" width="110" height="24" rx="6" fill="#0e2c21" stroke="#8fd39a" stroke-opacity="0.3" stroke-width="1" />
                        <text font-family="monospace" font-size="9" fill="#8fd39a" x="8" y="16">TURNDOWN</text>
                        <text font-family="monospace" font-size="8" fill="#8fd39a" x="82" y="16">+110</text>
                      </g>
                      <g transform="translate(240, 16)">
                        <rect x="0" y="0" width="110" height="24" rx="6" fill="#0e2c21" stroke="#8fd39a" stroke-opacity="0.3" stroke-width="1" />
                        <text font-family="monospace" font-size="9" fill="#8fd39a" x="8" y="16">CHECK-IN</text>
                        <text font-family="monospace" font-size="8" fill="#8fd39a" x="82" y="16">+105</text>
                      </g>
                      <g transform="translate(360, 16)">
                        <rect x="0" y="0" width="110" height="24" rx="6" fill="#0e2c21" stroke="#8fd39a" stroke-opacity="0.3" stroke-width="1" />
                        <text font-family="monospace" font-size="9" fill="#8fd39a" x="8" y="16">GUEST</text>
                        <text font-family="monospace" font-size="8" fill="#8fd39a" x="82" y="16">+100</text>
                      </g>
                      <g transform="translate(0, 46)">
                        <rect x="0" y="0" width="110" height="24" rx="6" fill="#0e2c21" stroke="#e08c6f" stroke-opacity="0.3" stroke-width="1" />
                        <text font-family="monospace" font-size="9" fill="#e08c6f" x="8" y="16">CHECK-OUT</text>
                        <text font-family="monospace" font-size="8" fill="#e08c6f" x="82" y="16">✗</text>
                      </g>
                    </g>
                    <g transform="translate(0, 170)">
                      <text font-family="monospace" font-size="10" fill="#f6d789">🔥 Streak: ×2</text>
                      <text font-family="monospace" font-size="10" fill="#8fd39a" x="140">⏱ 00:47 left</text>
                      <text font-family="monospace" font-size="10" fill="#e9bd5c" x="280">Stage: Front Office</text>
                    </g>
                  </g>
                </svg>
              </div>
              <div class="slide-content">
                <h3>Scoring, Lives &amp; Streak</h3>
                <p>Track your progress with a live score bar, remaining lives, and a streak multiplier. Every correct answer adds points with a time bonus — reach 1,000 to clear the stage.</p>
                <span class="slide-tag">Progress Tracking</span>
              </div>
            </div>
            <div class="demo-slide" data-index="4">
              <div class="slide-visual">
                <span class="mock-badge">Win / Lose</span>
                <svg viewBox="0 0 600 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="0" y="0" width="600" height="220" rx="12" fill="#0a2018" opacity="0.6" />
                  <g transform="translate(30, 30)">
                    <text font-family="monospace" font-size="28" fill="#8fd39a" font-weight="bold">🏆 STAGE CLEAR!</text>
                    <text font-family="monospace" font-size="12" fill="#f6f1e2" y="40">Front Office Services NC II — Complete</text>
                    <text font-family="monospace" font-size="12" fill="#e9bd5c" y="60">Score: 1,240 pts | Streak: ×3 | Time bonus: +180</text>
                    <g transform="translate(0, 84)">
                      <rect x="0" y="0" width="200" height="34" rx="17" fill="#e9bd5c" />
                      <text font-family="monospace" font-size="12" fill="#071510" font-weight="bold" x="44" y="22">NEXT STAGE →</text>
                    </g>
                    <g transform="translate(300, 0)">
                      <text font-family="monospace" font-size="28" fill="#e08c6f" font-weight="bold">💔 STAGE FAILED</text>
                      <text font-family="monospace" font-size="12" fill="#f6f1e2" y="40">You ran out of lives — try again!</text>
                      <text font-family="monospace" font-size="11" fill="#e9bd5c" y="58">Score: 720 / 1,000 · 0 lives left</text>
                      <g transform="translate(0, 84)">
                        <rect x="0" y="0" width="200" height="34" rx="17" fill="#e08c6f" />
                        <text font-family="monospace" font-size="12" fill="#071510" font-weight="bold" x="44" y="22">RETRY STAGE</text>
                      </g>
                    </g>
                  </g>
                </svg>
              </div>
              <div class="slide-content">
                <h3>Win / Lose States</h3>
                <p>Hit 1,000 points before time runs out to clear the stage and advance. Run out of lives or let the timer hit zero — you'll get a chance to retry and improve.</p>
                <span class="slide-tag">Outcome</span>
              </div>
            </div>
          </div>
          <div class="slider-controls">
            <button id="sliderPrev" aria-label="Previous slide">◀</button>
            <div class="slider-dots" id="sliderDots">
              <button class="sdot active" data-index="0" aria-label="Slide 1"></button>
              <button class="sdot" data-index="1" aria-label="Slide 2"></button>
              <button class="sdot" data-index="2" aria-label="Slide 3"></button>
              <button class="sdot" data-index="3" aria-label="Slide 4"></button>
              <button class="sdot" data-index="4" aria-label="Slide 5"></button>
            </div>
            <span class="slider-counter" id="sliderCounter">1 / 5</span>
            <button id="sliderNext" aria-label="Next slide">▶</button>
          </div>
        </div>
      </div>
    </section>
    <section class="block" id="contact">
      <div class="wrap">
        <div class="section-head">
          <div class="eyebrow">Group Members</div>
          <h2>The <span>Developers</span></h2>
          <p>The team behind Word Puzzle Game.</p>
        </div>
        <div class="dev-grid">
          <div class="dev-card">
            <div class="dev-avatar">
              <img src="image/badila.jpg" alt="Dan Krisper A. Badilla">
            </div>
            <h4>Dan Krisper A. Badilla</h4>
            <span class="role">Project Manager</span>
          </div>
          <div class="dev-card">
            <div class="dev-avatar">
              <img src="image/hope.jpg" alt="Hope C. Aloro">
            </div>
            <h4>Hope C. Aloro</h4>
            <span class="role">Front-end Developer</span>
          </div>
          <div class="dev-card">
            <div class="dev-avatar">
              <img src="image/jhasel.jpg" alt="Jhasel Barcebal">
            </div>
            <h4>Jhasel Barcebal</h4>
            <span class="role">Back-end Developer</span>
          </div>
          <div class="dev-card">
            <div class="dev-avatar">
              <img src="image/jeramie.jpg" alt="Jeramie Agustin">
            </div>
            <h4>Jeramie Agustin</h4>
            <span class="role">Back-end Developer</span>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer>
    <p>&copy; <span id="year"></span> <span>Word Puzzle Game</span>. Sharpen your mind, one word at a time.</p>
  </footer>
  <script src="js/website.js"></script>
  <script>
    (function() {
      const container = document.getElementById('bgLetters');
      if (!container) return;
      const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      const count = 35;
      for (let i = 0; i < count; i++) {
        const span = document.createElement('span');
        span.className = 'bg-letter';
        span.textContent = letters[Math.floor(Math.random() * letters.length)];
        span.style.left = Math.random() * 100 + '%';
        span.style.fontSize = (14 + Math.random() * 36) + 'px';
        span.style.animationDuration = (8 + Math.random() * 14) + 's';
        span.style.animationDelay = (Math.random() * 12) + 's';
        span.style.opacity = '0';
        container.appendChild(span);
      }
    })();
  </script>
</body>
</html>