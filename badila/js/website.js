document.getElementById('year').textContent = new Date().getFullYear();
const navToggle = document.getElementById('navToggle');
const navLinks = document.getElementById('navLinks');
navToggle.addEventListener('click', () => {
    const open = navLinks.style.display === 'flex';
    navLinks.style.display = open ? 'none' : 'flex';
    navLinks.style.cssText += open ? '' : 'position:absolute; top:74px; left:0; right:0; flex-direction:column; gap:18px; background:rgba(6,16,12,0.97); padding:24px 40px; border-bottom:1px solid rgba(233,189,92,0.15);';
});
document.querySelectorAll('[data-nav]').forEach(link => {
    link.addEventListener('click', () => {
        document.querySelectorAll('[data-nav]').forEach(l => l.classList.remove('active'));
        link.classList.add('active');
        if (window.innerWidth <= 980) navLinks.style.display = 'none';
    });
});
const stages = [
    { title: 'Front Office Services NC II', desc: 'Trace reception, reservation, and guest-service terms drawn from the Front Office reviewer. Multiple-choice Term Checks confirm you know each definition.', bullets: ['10 terms drawn from a 30-term pool each run', 'Multiple-choice Term Check on every find', 'Reach 1,000 pts to clear the stage'], icon: `<path d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6"/>` },
    { title: 'Food & Beverage Services NC II', desc: 'Search for service, dining, and kitchen-brigade terms. Just like Front Office, every correct trace opens a multiple-choice Term Check before points are awarded.', bullets: ['Fresh 10-term set from the F&B pool each run', 'Multiple-choice Term Check on every find', 'Streak multiplier rewards fast, accurate play'], icon: `<path d="M7 3v7a2 2 0 002 2h0a2 2 0 002-2V3M9 12v9M16 3c-1.5 1-2 3-2 5s1 3 2 3 2-1 2-3-.5-4-2-5zM16 11v10"/>` },
    { title: 'Housekeeping NC II', desc: 'The final stage drops multiple choice entirely — write a short explanation of each term in your own words, then compare it against a model answer.', bullets: ['No multiple choice — free-response Term Check', 'Blank or off-topic answers cost a life', 'Same 1,000-pt quota to complete the game'], icon: `<path d="M4 20l6-6M14 6l4 4M6 18l3-3M11 6a3 3 0 013 3l-8 8-3-3 8-8z"/>` }
];

function wireStageTabs() {
    const tabs = document.querySelectorAll('#stageTabs .tab-btn');
    const dots = document.querySelectorAll('#dots .dot');
    const modeTitle = document.getElementById('modeTitle');
    const modeDesc = document.getElementById('modeDesc');
    const modeList = document.getElementById('modeList');
    const modeIconSvg = document.querySelector('.mode-icon svg');
    const modePanel = document.getElementById('modePanel');
    function render(idx) {
        const m = stages[idx];
        if (!m || !modePanel) return;
        modePanel.style.opacity = 0;
        setTimeout(() => {
            if (modeTitle) modeTitle.textContent = m.title;
            if (modeDesc) modeDesc.textContent = m.desc;
            if (modeList) modeList.innerHTML = m.bullets.map(b => `<li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>${b}</li>`).join('');
            if (modeIconSvg) modeIconSvg.innerHTML = m.icon;
            modePanel.style.opacity = 1;
        }, 150);
        tabs.forEach((t, i) => t.classList.toggle('active', i === idx));
        dots.forEach((d, i) => d.classList.toggle('active', i === idx));
    }
    let current = 0;
    let timer;
    function startAuto() { timer = setInterval(() => { current = (current + 1) % stages.length; render(current); }, 7000); }
    tabs.forEach((tab, i) => tab.addEventListener('click', () => { current = i; render(i); clearInterval(timer); startAuto(); }));
    const stagesSec = document.getElementById('stages');
    if (stagesSec) {
        stagesSec.addEventListener('mouseenter', () => clearInterval(timer));
        stagesSec.addEventListener('mouseleave', startAuto);
    }
    startAuto();
}
wireStageTabs();

let dbWeeks = [
    { title: 'Week 1: Planning', date_range: 'Aug 3 – 9', items: ['Defined project scope and selected the word-search puzzle concept', 'Assigned team roles: project manager, front-end, and back-end developers', 'Drafted the three-stage structure around the NC II qualifications', 'Sketched early wireframes for the puzzle grid and layout'] },
    { title: 'Week 2: Research & Requirements', date_range: 'Aug 10 – 16', items: ['Gathered NC II reviewer terms for all three stages', 'Built the 30-term pool per stage that puzzles draw 10 terms from', 'Outlined the scoring rules: per-term minimum and stage quota'] },
    { title: 'Week 3: UI/UX Design', date_range: 'Aug 17 – 23', items: ['Designed the dark forest-green and gold visual direction', 'Mocked up the hero section and the word-tile branding', 'Planned the Term Check panel for multiple-choice and free-response modes'] },
    { title: 'Week 4: Front-end Development', date_range: 'Aug 24 – 30', items: ['Built the click-and-drag puzzle grid with tracing across, down, and diagonal', 'Implemented the countdown timer and difficulty settings', 'Connected the hint system to the point-cost logic'] },
    { title: 'Week 5: Back-end & Logic', date_range: 'Aug 31 – Sep 6', items: ['Built word-list validation against traced letters', 'Implemented the scoring quota, streak multiplier, and life-loss conditions', 'Wired up the win/lose states for each stage'] },
    { title: 'Week 6: Testing', date_range: 'Sep 7 – 13', items: ['Ran playtesting sessions across all three stages', 'Tuned difficulty settings based on tester feedback', 'Fixed grid-tracing edge cases and Term Check bugs'] },
    { title: 'Week 7: Finalization', date_range: 'Sep 14 – 20', items: ['Polished visuals, animations, and responsive layout', 'Prepared the final presentation and documentation', 'Packaged the build for submission'] }
];

function initWeekTabs() {
    const weekTabsContainer = document.getElementById('weekTabs');
    const weekTitle = document.getElementById('weekTitle');
    const weekList = document.getElementById('weekList');
    const weekCount = document.getElementById('weekCount');
    const prevBtn = document.getElementById('weekPrev');
    const nextBtn = document.getElementById('weekNext');

    if (!weekTabsContainer || !weekTitle || !weekList) return;

    function fetchAndRenderWeeks() {
        fetch('php/api.php?action=get_weeks')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && Array.isArray(data.weeks) && data.weeks.length > 0) {
                    dbWeeks = data.weeks.map(w => {
                        const items = w.description ? w.description.split('\n').filter(l => l.trim().length > 0) : [];
                        return {
                            title: w.title,
                            date_range: w.date_range,
                            items: items
                        };
                    });
                }
                renderTabsAndContent();
            })
            .catch(() => {
                renderTabsAndContent();
            });
    }

    function renderTabsAndContent() {
        weekTabsContainer.innerHTML = dbWeeks.map((w, i) => `
            <button class="tab-btn ${i === 0 ? 'active' : ''}" data-idx="${i}">Week ${i + 1}</button>
        `).join('');

        let current = 0;

        function render(idx) {
            if (idx < 0 || idx >= dbWeeks.length) return;
            const w = dbWeeks[idx];
            weekTitle.textContent = w.title + (w.date_range ? ` (${w.date_range})` : '');
            weekTitle.style.animation = 'none';
            void weekTitle.offsetWidth;
            weekTitle.style.animation = 'typingCursor 0.8s step-end infinite';

            weekList.innerHTML = w.items.map(b => `<li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>${escapeHtml(b)}</li>`).join('');
            weekList.classList.remove('blog-list-animate');
            void weekList.offsetWidth;
            weekList.classList.add('blog-list-animate');

            const tabBtns = weekTabsContainer.querySelectorAll('.tab-btn');
            tabBtns.forEach((t, i) => t.classList.toggle('active', i === idx));

            if (weekCount) weekCount.textContent = (idx + 1) + ' / ' + dbWeeks.length;
            if (prevBtn) prevBtn.disabled = idx === 0;
            if (nextBtn) nextBtn.disabled = idx === dbWeeks.length - 1;
            current = idx;
        }

        weekTabsContainer.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const idx = parseInt(btn.getAttribute('data-idx'));
                render(idx);
            });
        });

        if (prevBtn) prevBtn.onclick = () => { render(Math.max(0, current - 1)); };
        if (nextBtn) nextBtn.onclick = () => { render(Math.min(dbWeeks.length - 1, current + 1)); };

        render(0);
    }

    renderTabsAndContent();
    fetchAndRenderWeeks();
}
initWeekTabs();

const sections = ['home', 'about-wrap', 'stages', 'blog', 'demo', 'contact'].map(id => document.getElementById(id)).filter(Boolean);
const navMap = { home: 'HOME', 'about-wrap': 'ABOUT', stages: 'GAME STAGES', blog: 'BLOG', demo: 'DEMO', contact: 'CONTACT' };
window.addEventListener('scroll', () => {
    let current = sections[0]?.id;
    sections.forEach(sec => { if (sec.getBoundingClientRect().top <= 120) current = sec.id; });
    document.querySelectorAll('[data-nav]').forEach(link => {
        link.classList.toggle('active', link.textContent.trim() === navMap[current]);
    });
});

const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.style.opacity = 1; e.target.style.transform = 'translateY(0)'; }
    });
}, { threshold: 0.12 });
document.querySelectorAll('.panel, .dev-card, .demo-slider-wrap').forEach(p => {
    p.style.opacity = 0;
    p.style.transform = 'translateY(30px)';
    p.style.transition = 'opacity .7s ease, transform .7s ease';
    io.observe(p);
});

function goToGame() { window.location.href = 'php/index.php'; }
document.querySelectorAll('.btn-gold').forEach(btn => {
    if (btn.textContent.trim().toUpperCase().includes('PLAY NOW')) {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            btn.animate([{ transform: 'scale(1)' }, { transform: 'scale(0.94)' }, { transform: 'scale(1)' }], { duration: 260, easing: 'ease-out' });
            setTimeout(goToGame, 200);
        });
    }
});

function initDemoSlider() {
    const sliderContainer = document.getElementById('sliderContainer');
    const dotsContainer = document.getElementById('sliderDots');
    const prevBtn = document.getElementById('sliderPrev');
    const nextBtn = document.getElementById('sliderNext');
    const counter = document.getElementById('sliderCounter');

    if (!sliderContainer) return;

    setupSliderLogic();

    fetch('php/api.php?action=get_demos')
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success' && Array.isArray(data.demos) && data.demos.length > 0) {
                sliderContainer.querySelectorAll('.demo-slide-db').forEach(el => el.remove());

                data.demos.forEach(demo => {
                    const slideDiv = document.createElement('div');
                    slideDiv.className = 'demo-slide demo-slide-db';
                    slideDiv.innerHTML = `
                        <div class="slide-visual" style="display:flex; justify-content:center; align-items:center; background:#071510; border-radius:12px; overflow:hidden; min-height:220px; border:1px solid rgba(233,189,92,0.2);">
                            <span class="mock-badge" style="background:#e9bd5c; color:#071510; font-weight:bold;">Database Demo</span>
                            <img src="${escapeHtml(demo.image_path)}" alt="${escapeHtml(demo.title || 'System Demo')}" style="max-width:100%; max-height:210px; object-fit:contain; border-radius:8px;">
                        </div>
                        <div class="slide-content">
                            <h3>${escapeHtml(demo.title || 'System Demo Upload')}</h3>
                            <p>${escapeHtml(demo.description)}</p>
                            <span class="slide-tag">Uploaded Demo</span>
                        </div>
                    `;
                    sliderContainer.prepend(slideDiv);
                });
                setupSliderLogic();
            }
        })
        .catch(() => {});

    function setupSliderLogic() {
        const slides = sliderContainer.querySelectorAll('.demo-slide');
        const total = slides.length;
        if (total === 0) return;

        if (dotsContainer) {
            dotsContainer.innerHTML = Array.from({ length: total }).map((_, i) => `
                <button class="sdot ${i === 0 ? 'active' : ''}" data-index="${i}" aria-label="Slide ${i + 1}"></button>
            `).join('');
        }

        const dots = dotsContainer ? dotsContainer.querySelectorAll('.sdot') : [];
        let current = 0;
        let autoTimer = null;
        let isTransitioning = false;

        function goTo(index) {
            if (isTransitioning) return;
            if (index < 0) index = total - 1;
            if (index >= total) index = 0;
            isTransitioning = true;

            slides.forEach((s, i) => s.classList.toggle('active', i === index));
            dots.forEach((d, i) => d.classList.toggle('active', i === index));
            if (counter) counter.textContent = (index + 1) + ' / ' + total;
            current = index;

            if (prevBtn) prevBtn.disabled = current === 0;
            if (nextBtn) nextBtn.disabled = current === total - 1;

            setTimeout(() => { isTransitioning = false; }, 400);
        }

        function next() { goTo(current + 1); }
        function prev() { goTo(current - 1); }
        function startAuto() { stopAuto(); autoTimer = setInterval(next, 6000); }
        function stopAuto() { if (autoTimer) { clearInterval(autoTimer); autoTimer = null; } }

        if (prevBtn) prevBtn.onclick = () => { prev(); stopAuto(); startAuto(); };
        if (nextBtn) nextBtn.onclick = () => { next(); stopAuto(); startAuto(); };

        dots.forEach((dot, i) => {
            dot.onclick = () => { goTo(i); stopAuto(); startAuto(); };
        });

        const wrap = document.querySelector('.demo-slider-wrap');
        if (wrap) {
            wrap.addEventListener('mouseenter', stopAuto);
            wrap.addEventListener('mouseleave', startAuto);
        }

        goTo(0);
        startAuto();
    }
}
initDemoSlider();

function fetchAndRenderWebsiteLeaderboard() {
    const container = document.getElementById('websiteLeaderboard');
    if (!container) return;

    fetch('php/api.php?action=get_leaderboard')
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success' && Array.isArray(data.leaderboard) && data.leaderboard.length > 0) {
                container.innerHTML = data.leaderboard.slice(0, 4).map((user, idx) => `
                    <div style="background:rgba(10,34,24,0.6); padding:16px; border-radius:12px; border:1px solid rgba(233,189,92,0.25); display:flex; flex-direction:column; gap:6px;">
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-weight:bold; color:${idx === 0 ? '#ffd700' : idx === 1 ? '#c0c0c0' : idx === 2 ? '#cd7f32' : '#888'};">Rank #${idx + 1}</span>
                            <span style="font-size:12px; color:rgba(255,255,255,0.6);">🎮 ${user.games_played} games</span>
                        </div>
                        <h4 style="color:#fbeec1; font-size:18px; margin:4px 0;">${escapeHtml(user.username)}</h4>
                        <div style="font-weight:bold; color:#e9bd5c; font-size:20px;">🏆 ${user.high_score} pts</div>
                    </div>
                `).join('');
            } else {
                container.innerHTML = '<div style="text-align:center; color:rgba(255,255,255,0.6); padding:20px; grid-column:1 / -1;">No player high scores recorded yet. Be the first to play!</div>';
            }
        })
        .catch(() => {});
}
fetchAndRenderWebsiteLeaderboard();

setInterval(() => {
    fetchAndRenderWebsiteLeaderboard();
}, 5000);

function escapeHtml(str) {
    if (!str) return '';
    return str
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}