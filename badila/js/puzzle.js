(function () {

    const STAGES = [
        {
            name: "Front Office Services NC II",
            short: "Front Office",
            blurb: "Guest arrival, reservations, registration, and front desk operations.",
            size: 14, time: 100, hints: 3,
            essay: false,
            definitions: {
                FRONTOFFICE: "The department of a hotel that serves as the guest's first and last point of contact, handling reservations, registration, and guest services.",
                RESERVATION: "An advance arrangement made by a guest to secure a room or service for a specific date.",
                CHECKIN: "The process of registering an arriving guest, verifying their reservation, and assigning a room.",
                CHECKOUT: "The process of settling a guest's account and formally ending their stay.",
                GUESTFOLIO: "A running statement of a guest's charges and payments kept by the front office during their stay.",
                WALKIN: "A guest who arrives and requests accommodation without a prior reservation.",
                NOSHOW: "A guest with a confirmed reservation who does not arrive and does not cancel.",
                OVERBOOKING: "The practice of accepting more reservations than the number of rooms actually available.",
                ROOMRACK: "A front office system or board used to display and track the current status of every room.",
                REGISTRATION: "The formal recording of a guest's personal details and stay information upon arrival.",
                CONCIERGE: "A front office staff member who assists guests with bookings, directions, and local recommendations.",
                BELLBOY: "A front office employee who carries luggage and escorts guests to their rooms.",
                DOORMAN: "A staff member stationed at the entrance who greets guests and assists with vehicles and doors.",
                VALET: "A staff member who parks and retrieves guests' vehicles on their behalf.",
                LOBBY: "The main entrance area of a hotel where the front desk and guest seating are located.",
                KEYCARD: "An electronic card used to unlock a guest room in place of a traditional metal key.",
                GUESTHISTORY: "A record kept by the front office of a guest's past stays, preferences, and requests.",
                AMENITIES: "Extra comfort items or services provided to guests, such as toiletries or bathrobes.",
                UPSELLING: "The technique of encouraging a guest to purchase a higher category of room or an added service.",
                ROOMSTATUS: "The current condition of a room, such as vacant, occupied, clean, or dirty, tracked by the front office.",
                VACANT: "A room status indicating that no guest is currently occupying the room.",
                OCCUPIED: "A room status indicating that a guest is currently staying in the room.",
                OUTOFORDER: "A room status indicating the room cannot be sold due to maintenance or repair issues.",
                SKIPPER: "A guest who leaves the hotel without paying their outstanding bill.",
                LATECHECKOUT: "An arrangement allowing a guest to vacate their room later than the standard checkout time.",
                GROUPBOOKING: "A reservation made for a block of rooms for members of the same group or organization.",
                CORPORATE: "A room rate or account arranged for business travelers or companies.",
                RACKRATE: "The full, standard published price of a room before any discount is applied.",
                NIGHTAUDIT: "The end-of-day process of reconciling front office transactions and verifying room status and revenue.",
                DEPOSIT: "A sum of money paid in advance by a guest to guarantee a reservation."
            }
        },
        {
            name: "Food and Beverage Services NC II",
            short: "Food & Beverage",
            blurb: "Dining room service styles, table setup, and beverage service.",
            size: 15, time: 90, hints: 3,
            essay: false,
            definitions: {
                TABLESETTING: "The arrangement of tableware, glassware, and linen on a dining table before service.",
                NAPKINFOLD: "A decorative technique of folding a napkin for table presentation.",
                SILVERWARE: "The knives, forks, and spoons used by guests for dining.",
                GUERIDON: "A small mobile trolley used by waitstaff for tableside preparation or service.",
                SOMMELIER: "A trained wine steward who manages a restaurant's wine list and service.",
                CANAPE: "A small bite-sized appetizer served before a meal, often on a base of bread or pastry.",
                APERITIF: "An alcoholic drink taken before a meal to stimulate the appetite.",
                DIGESTIF: "An alcoholic drink taken after a meal, believed to aid digestion.",
                MISEENPLACE: "The preparation and arrangement of ingredients and equipment before service begins.",
                CHAFINGDISH: "A metal container with a heat source underneath used to keep food warm during buffet service.",
                BUFFETSERVICE: "A style of service where food is displayed for guests to serve themselves.",
                SILVERSERVICE: "A formal style of service where a waiter places food onto a guest's plate from a serving dish.",
                PLATESERVICE: "A style of service where food is portioned and plated in the kitchen before being brought to the guest.",
                FAMILYSERVICE: "A style of service where large platters of food are placed on the table for guests to share.",
                ORDERTAKING: "The process of recording a guest's food and beverage selections.",
                COVERSETUP: "The complete table setting arranged for a single diner.",
                GARNISHING: "Adding a decorative item to a dish or drink to enhance its presentation.",
                STEWARDING: "The department responsible for cleaning and maintaining kitchen equipment and utensils.",
                REQUISITION: "A formal request for the issuance of stock or supplies from the storeroom.",
                BANQUETSETUP: "The arrangement of tables, chairs, and equipment for a large formal event.",
                TABLEDHOTE: "A fixed menu offered at a set price with limited choices per course.",
                ALACARTE: "A menu where each dish is individually priced and ordered separately.",
                DEGUSTATION: "A tasting menu consisting of small courses meant to sample a range of dishes.",
                DECANTING: "The process of pouring wine into a separate vessel to separate sediment and allow it to breathe.",
                CONDIMENTS: "Sauces, spices, or accompaniments added to food to enhance its flavor.",
                CUTLERY: "Another term for the eating utensils, such as forks, knives, and spoons, used at the table.",
                CROCKERY: "The plates, bowls, and cups used for serving food and drink.",
                GLASSWARE: "Drinking glasses and other glass vessels used in beverage service.",
                FLAMBE: "A cooking technique where alcohol is added to a dish and ignited for presentation and flavor.",
                GRATUITY: "A voluntary payment given to a service worker in appreciation of good service."
            }
        },
        {
            name: "Housekeeping NC II",
            short: "Housekeeping",
            blurb: "Room care, linens, public areas, and sanitation — answered in your own words.",
            size: 16, time: 80, hints: 3,
            essay: true,
            definitions: {
                BEDMAKING: "The task of preparing and arranging a guest bed with clean linens in a neat, standard manner.",
                LINENCHANGE: "The replacement of used bed sheets, pillowcases, and towels with fresh ones.",
                DUSTING: "The task of removing dust from surfaces, furniture, and fixtures in a room.",
                VACUUMING: "Cleaning carpets and floors using a vacuum cleaner to remove dirt and debris.",
                MOPPING: "The task of cleaning hard floors using a wet mop and cleaning solution.",
                SWEEPING: "The task of clearing dirt and debris from a floor using a broom.",
                TURNDOWN: "An evening housekeeping service that prepares the room for sleep, such as folding back the bed covers.",
                GUESTSUPPLIES: "Items such as toiletries and amenities placed in a guest room for their use.",
                MINIBAR: "A small refrigerator in a guest room stocked with drinks and snacks for purchase.",
                LAUNDRY: "The process of washing, drying, and cleaning linens, towels, and garments.",
                DRYCLEANING: "A method of cleaning fabrics using chemical solvents instead of water.",
                STAINREMOVAL: "The process of treating and eliminating stains from linen or fabric.",
                FABRICSOFTENER: "A laundry product used to make fabrics feel softer and reduce static.",
                LINENINVENTORY: "The tracked stock count of sheets, towels, and other linen items.",
                TROLLEY: "A wheeled cart used by housekeeping staff to carry supplies between rooms.",
                PANTRY: "A small service area on a guest floor used to store housekeeping supplies.",
                PUBLICAREA: "Shared spaces of a hotel, such as the lobby and hallways, that require regular cleaning.",
                CORRIDOR: "A hallway connecting guest rooms on a hotel floor.",
                UPHOLSTERY: "The fabric or padded covering used on furniture such as chairs and sofas.",
                POLISHING: "The task of cleaning and shining a surface, such as furniture or metal fixtures.",
                SANITIZING: "The process of reducing germs on a surface to a safe level.",
                DISINFECTING: "The process of using a chemical agent to destroy bacteria and germs on a surface.",
                WASTEDISPOSAL: "The proper collection and removal of trash and rubbish from guest rooms and public areas.",
                LOSTANDFOUND: "A department or system that stores and manages items guests have left behind.",
                KEYCONTROL: "The system used to track, issue, and secure room and master keys.",
                ROOMINSPECTION: "A thorough check of a room to ensure it meets cleanliness and quality standards.",
                STATUSREPORT: "A report used by housekeeping to communicate the current cleaning status of each room.",
                FLOORPLAN: "A diagram showing the layout of rooms and areas on a hotel floor.",
                MAKEUPROOM: "A request from a guest for their room to be cleaned during their stay.",
                DONOTDISTURB: "A request or sign used by a guest to ask staff not to enter or interrupt their room."
            }
        }
    ];

    STAGES.forEach(s => { s.pool = Object.keys(s.definitions); });

    const DIRECTIONS = [
        [0, 1], [0, -1], [1, 0], [-1, 0], [1, 1], [-1, -1], [1, -1], [-1, 1]
    ];

    const DIFFICULTIES = {
        easy: { label: "Easy", timeMult: 1.35, hintsBonus: 1, lives: 4 },
        normal: { label: "Normal", timeMult: 1.0, hintsBonus: 0, lives: 3 },
        hard: { label: "Hard", timeMult: 0.75, hintsBonus: 0, lives: 3 },
        difficult: { label: "Difficult", timeMult: 0.55, hintsBonus: -2, lives: 2 }
    };
    let settings = {
        difficulty: 'normal',
        musicOn: true
    };

    const BASE_SCORE = 120;
    const QUOTA_PER_QUESTION = 100;
    const QUOTA_PER_STAGE = 1000;
    const HINT_COSTS = [50, 50, 50];
    const WORDS_PER_STAGE = 10;
    const ESSAY_MIN_LENGTH = 15;

    const ESSAY_STOPWORDS = new Set([
        "the", "a", "an", "and", "or", "of", "to", "in", "on", "for", "with", "that", "this",
        "is", "are", "was", "were", "be", "by", "as", "their", "its", "it", "from", "used",
        "use", "uses", "such", "who", "which", "when", "where", "into", "before", "after",
        "during", "while", "than", "then", "them", "they", "he", "she", "you", "your",
        "guest", "guests", "room", "rooms", "hotel", "staff", "member", "service", "services"
    ]);
    function extractKeywords(text) {
        return (text.toLowerCase().match(/[a-z]+/g) || [])
            .filter(w => w.length >= 4 && !ESSAY_STOPWORDS.has(w));
    }
    function essayIsRelevant(answerText, word, definition) {
        if (answerText.length < ESSAY_MIN_LENGTH) return false;
        const defKeywords = [...new Set(extractKeywords(definition))];
        if (defKeywords.length === 0) return true;
        const answerWords = new Set(extractKeywords(answerText));
        const wordLower = word.toLowerCase();
        let matches = 0;
        defKeywords.forEach(k => {
            if (answerWords.has(k)) matches++;
        });
        const required = Math.max(2, Math.ceil(defKeywords.length * 0.22));
        const meaningfulAnswerWords = [...answerWords].filter(w => !wordLower.includes(w) && w.length >= 4);
        if (meaningfulAnswerWords.length < 3) return false;
        return matches >= required;
    }


    let state = null;
    function freshState() {
        const diff = DIFFICULTIES[settings.difficulty];
        return {
            stageIndex: 0,
            score: 0,
            lives: diff.lives,
            maxLives: diff.lives,
            hintsLeft: 0,
            hintsUsedStage: 0,
            correctWords: 0,
            mistakes: 0,
            hintsUsed: 0,
            grid: [],
            size: 0,
            placements: [],
            foundWords: new Set(),
            timer: 0,
            timerMax: 0,
            timerHandle: null,
            selecting: false,
            startCell: null,
            currentPath: [],
            stageScore: 0,
            stageQuestionScores: [],
            gameOver: false,
            currentWords: [],
            streak: 0,
            bestStreak: 0
        };
    }

    function streakMultiplier(streak) {
        return 1;
    }

    let _displayedScore = 0;
    let _scoreAnimHandle = null;
    function animateScoreDisplay(target) {
        if (_scoreAnimHandle) cancelAnimationFrame(_scoreAnimHandle);
        const el = document.getElementById('hud-score');
        if (!el) { return; }
        const start = _displayedScore;
        const diff = target - start;
        if (diff === 0) { el.textContent = target; return; }
        const duration = Math.min(600, Math.max(200, Math.abs(diff) * 0.4));
        const startTime = performance.now();
        function step(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
            const current = Math.round(start + diff * eased);
            el.textContent = current;
            if (progress < 1) {
                _scoreAnimHandle = requestAnimationFrame(step);
            } else {
                _displayedScore = target;
                _scoreAnimHandle = null;
            }
        }
        requestAnimationFrame(step);
    }

    function showFloatingPoints(points, referenceEl) {
        if (!points || points <= 0) return;
        const popup = document.createElement('div');
        popup.textContent = '+' + points + ' pts';
        popup.style.cssText = [
            'position:fixed', 'font-family:\'IBM Plex Mono\',monospace',
            'font-size:15px', 'font-weight:700',
            'color:#f3dfa1', 'pointer-events:none',
            'z-index:200', 'text-shadow:0 1px 4px rgba(0,0,0,0.8)',
            'animation:floatPoints .9s ease-out forwards'
        ].join(';');
        // Position near score HUD
        const scoreEl = document.getElementById('hud-score');
        if (scoreEl) {
            const r = scoreEl.getBoundingClientRect();
            popup.style.left = r.left + 'px';
            popup.style.top = (r.top - 4) + 'px';
        } else {
            popup.style.left = '50%';
            popup.style.top = '60px';
            popup.style.transform = 'translateX(-50%)';
        }
        document.body.appendChild(popup);
        setTimeout(() => popup.remove(), 950);
    }

    const screens = {
        menu: document.getElementById('menu-screen'),
        story: document.getElementById('story-screen'),
        stageSelect: document.getElementById('stage-select-screen'),
        review: document.getElementById('review-screen'),
        options: document.getElementById('options-screen'),
        game: document.getElementById('game-screen'),
        gameover: document.getElementById('gameover-screen'),
        exit: document.getElementById('exit-screen')
    };
    const SCREEN_STATE_KEY = 'puzzle-last-screen';
    const STORY_STATE_KEY = 'puzzle-story-state';

    function saveScreenState(name) {
        try {
            localStorage.setItem(SCREEN_STATE_KEY, name);
        } catch (err) {
            console.warn('Unable to save screen state:', err);
        }
    }

    function saveStoryState() {
        try {
            localStorage.setItem(STORY_STATE_KEY, JSON.stringify({ mode: storyMode, index: storyIndex }));
        } catch (err) {
            console.warn('Unable to save story state:', err);
        }
    }

    function loadSavedScreenState() {
        try {
            const savedScreen = localStorage.getItem(SCREEN_STATE_KEY);
            if (savedScreen && screens[savedScreen]) {
                return savedScreen;
            }
        } catch (err) {
            console.warn('Unable to load screen state:', err);
        }
        return 'menu';
    }

    function loadSavedStoryState() {
        try {
            const saved = localStorage.getItem(STORY_STATE_KEY);
            if (!saved) return false;
            const parsed = JSON.parse(saved);
            if (parsed && STORY_SCREENS[parsed.mode] && Number.isInteger(parsed.index)) {
                storyMode = parsed.mode;
                storyIndex = Math.max(0, Math.min(parsed.index, STORY_SCREENS[parsed.mode].length - 1));
                return true;
            }
        } catch (err) {
            console.warn('Unable to load story state:', err);
        }
        return false;
    }

    const STORY_SCREENS = {
        intro: [
            {
                eyebrow: 'Front Desk Briefing',
                title: 'Welcome to the Hospitality Challenge',
                text: 'The front desk is alive with new arrivals, guest requests, and a fresh set of service challenges. Choose your section carefully, keep your focus sharp, and prove your hospitality skills one word at a time.'
            },
            {
                eyebrow: 'Your Mission',
                title: 'Trace the Terms. Solve the Terms.',
                text: 'Each stage hides a set of hospitality words in the puzzle board. Find the correct word, then answer the quick check to lock in your score and push through the next challenge.'
            },
            {
                eyebrow: 'Ready to Begin',
                title: 'Choose Your Section',
                text: 'When you are ready, continue to the stage selection screen and begin your review. Stay sharp, manage your time, and keep the guest experience on track.'
            }
        ],
        afterStage: [
            {
                eyebrow: 'Next Assignment',
                title: 'The Lobby Is Ready Again',
                text: 'The previous task is cleared, and the next hospitality challenge steps forward. Take a breath, reset your focus, and prepare for the next section.'
            },
            {
                eyebrow: 'Next Stage',
                title: 'Choose the Next Section',
                text: 'Select the next stage to continue the review. Each section keeps the same polished flow, so the next challenge begins as smoothly as the last one.'
            }
        ]
    };

    let storyMode = 'intro';
    let storyIndex = 0;

    function renderStoryScreen() {
        const slides = STORY_SCREENS[storyMode] || STORY_SCREENS.intro;
        const slide = slides[storyIndex] || slides[0];
        const titleEl = document.getElementById('story-title');
        const textEl = document.getElementById('story-text');
        const eyebrowEl = document.getElementById('story-eyebrow');
        const prevBtn = document.getElementById('btn-story-prev');
        const nextBtn = document.getElementById('btn-story-next');
        if (!titleEl || !textEl || !eyebrowEl || !prevBtn || !nextBtn) return;

        eyebrowEl.textContent = slide.eyebrow;
        titleEl.textContent = slide.title;
        textEl.textContent = slide.text;

        prevBtn.classList.toggle('is-hidden', storyIndex === 0);
        const isLastSlide = storyIndex >= slides.length - 1;
        nextBtn.textContent = isLastSlide ? 'Continue' : 'Next';
    }

    function showStoryScreen(mode = 'intro') {
        storyMode = mode;
        storyIndex = 0;
        renderStoryScreen();
        goTo('story');
        saveStoryState();
    }

    function goToStoryNext() {
        const slides = STORY_SCREENS[storyMode] || STORY_SCREENS.intro;
        const isLastSlide = storyIndex >= slides.length - 1;
        if (isLastSlide) {
            goTo('stageSelect');
            saveStoryState();
            return;
        }
        storyIndex += 1;
        renderStoryScreen();
        saveStoryState();
    }

    function goToStoryPrev() {
        if (storyIndex <= 0) return;
        storyIndex -= 1;
        renderStoryScreen();
        saveStoryState();
    }

    function goTo(name) {
        Object.entries(screens).forEach(([k, el]) => {
            el.style.display = (k === name) ? 'flex' : 'none';
        });
        const shown = screens[name];
        if (!shown) return;
        saveScreenState(name);
        shown.classList.remove('screen-enter');
        void shown.offsetWidth;
        shown.classList.add('screen-enter');
    }

    function spawnBgLetters() {
        const wrap = document.getElementById('bg-letters');
        if (!wrap) return;
        const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const count = window.innerWidth < 640 ? 18 : 34;

        for (let i = 0; i < count; i++) {
            const span = document.createElement('span');
            span.className = 'bg-letter' + (Math.random() < 0.4 ? ' alt' : '');
            span.textContent = letters[Math.floor(Math.random() * letters.length)];

            const size = 14 + Math.random() * 26;
            const left = Math.random() * 100;
            const duration = 14 + Math.random() * 16;
            const delay = Math.random() * -30;
            const drift = (Math.random() * 160 - 80) + 'px';
            const spin = (Math.random() * 70 - 35) + 'deg';

            span.style.left = left + 'vw';
            span.style.fontSize = size + 'px';
            span.style.animationDuration = duration + 's';
            span.style.animationDelay = delay + 's';
            span.style.setProperty('--drift', drift);
            span.style.setProperty('--spin', spin);

            wrap.appendChild(span);
        }
    }

    function buildStagePreview() {
        const wrap = document.getElementById('stage-preview');
        wrap.innerHTML = '';
        STAGES.forEach((s, i) => {
            const chip = document.createElement('span');
            chip.className = 'stage-chip';
            chip.textContent = (s.short || s.name).toUpperCase();
            wrap.appendChild(chip);
        });
    }
    let reviewStageIndex = 0;

    function buildStageTabs() {
        const wrap = document.getElementById('stage-tabs');
        wrap.innerHTML = '';
        STAGES.forEach((s, i) => {
            const tab = document.createElement('button');
            tab.className = 'stage-tab' + (i === reviewStageIndex ? ' active' : '');
            tab.textContent = `Stage ${i + 1} · ${s.short || s.name}`;
            tab.addEventListener('click', () => {
                reviewStageIndex = i;
                document.querySelectorAll('.stage-tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                buildGlossary();
            });
            wrap.appendChild(tab);
        });
    }

    function buildGlossary() {
        const wrap = document.getElementById('glossary-grid');
        wrap.innerHTML = '';
        wrap.classList.add('single-stage');

        const i = reviewStageIndex;
        const s = STAGES[i];
        const card = document.createElement('div');
        card.className = 'review-card';

        const sortedPool = [...s.pool].sort();
        const termItems = sortedPool.map(w => {
            const def = s.definitions[w] || '';
            return `<li><span class="term-name">${w}</span><span class="term-def">${def}</span></li>`;
        }).join('');

        card.innerHTML =
            `<h4>Stage ${i + 1} · ${s.name}</h4>` +
            `<p class="blurb">${s.blurb} — ${s.pool.length} terms in the pool; ${WORDS_PER_STAGE} are drawn at random each run.${s.essay ? ' Answered in your own words.' : ''}</p>` +
            `<ul class="term-list">${termItems}</ul>`;
        wrap.appendChild(card);
    }

    function buildQuestion(stageIndex, word) {
        const defs = STAGES[stageIndex].definitions;
        const correctDef = defs[word];
        const otherWords = Object.keys(defs).filter(w => w !== word);
        for (let i = otherWords.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [otherWords[i], otherWords[j]] = [otherWords[j], otherWords[i]];
        }
        const distractors = otherWords.slice(0, 3).map(w => defs[w]);
        return { question: `What is ${word}?`, choices: [correctDef, ...distractors], correctIndex: 0 };
    }

    function buildEmptyGrid(size) {
        const g = [];
        for (let r = 0; r < size; r++) { g.push(new Array(size).fill(null)); }
        return g;
    }

    function tryPlaceWord(grid, size, word) {
        const attempts = 200;
        for (let a = 0; a < attempts; a++) {
            const dir = DIRECTIONS[Math.floor(Math.random() * DIRECTIONS.length)];
            const len = word.length;
            const startR = Math.floor(Math.random() * size);
            const startC = Math.floor(Math.random() * size);
            const endR = startR + dir[0] * (len - 1);
            const endC = startC + dir[1] * (len - 1);
            if (endR < 0 || endR >= size || endC < 0 || endC >= size) continue;

            const cells = [];
            let ok = true;
            for (let i = 0; i < len; i++) {
                const r = startR + dir[0] * i;
                const c = startC + dir[1] * i;
                const existing = grid[r][c];
                if (existing !== null && existing !== word[i]) { ok = false; break; }
                cells.push([r, c]);
            }
            if (!ok) continue;
            cells.forEach((rc, i) => { grid[rc[0]][rc[1]] = word[i]; });
            return cells;
        }
        return null;
    }

    function pickRandomWords(pool, count) {
        const shuffled = [...pool];
        for (let i = shuffled.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
        }
        return shuffled.slice(0, Math.min(count, shuffled.length));
    }

    function generatePuzzle(stage, words) {
        const size = stage.size;
        let grid, placements, success;
        for (let attempt = 0; attempt < 10; attempt++) {
            grid = buildEmptyGrid(size);
            placements = [];
            success = true;
            const wordsSorted = [...words].sort((a, b) => b.length - a.length);
            for (const w of wordsSorted) {
                const cells = tryPlaceWord(grid, size, w);
                if (!cells) { success = false; break; }
                placements.push({ word: w, cells });
            }
            if (success) break;
        }
        const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for (let r = 0; r < size; r++) {
            for (let c = 0; c < size; c++) {
                if (grid[r][c] === null) {
                    grid[r][c] = letters[Math.floor(Math.random() * letters.length)];
                }
            }
        }
        return { grid, size, placements };
    }

    function renderGrid() {
        const gridEl = document.getElementById('grid');
        gridEl.innerHTML = '';
        gridEl.style.gridTemplateColumns = `repeat(${state.size}, minmax(0,1fr))`;
        gridEl.style.width = 'min(100%, 480px)';
        for (let r = 0; r < state.size; r++) {
            for (let c = 0; c < state.size; c++) {
                const cell = document.createElement('div');
                cell.className = 'cell';
                cell.textContent = state.grid[r][c];
                cell.dataset.r = r;
                cell.dataset.c = c;
                cell.tabIndex = 0;
                gridEl.appendChild(cell);
            }
        }
    }

    function currentStage() { return STAGES[state.stageIndex]; }

    function renderWordList() {
        const listEl = document.getElementById('word-list');
        listEl.innerHTML = '';
        const defs = currentStage().definitions;
        state.currentWords.forEach(w => {
            const li = document.createElement('li');
            const found = state.foundWords.has(w);
            if (found) li.classList.add('found');
            const top = document.createElement('div');
            top.className = 'row-top';
            top.innerHTML = `<span>${w}</span>` + (found ? `<span class="stamp">FOUND</span>` : '');
            li.appendChild(top);
            if (found) {
                const def = document.createElement('div');
                def.className = 'meaning';
                def.textContent = defs[w] || '';
                li.appendChild(def);
            }
            listEl.appendChild(li);
        });
    }

    function renderHud() {
        document.getElementById('hud-stage').textContent = currentStage().name;
        animateScoreDisplay(state.score);
        renderStageProgress();
        updateStreakHud();
        document.getElementById('hint-count').textContent = state.hintsLeft;
        document.getElementById('btn-hint').disabled = state.hintsLeft <= 0;

        const quotaEl = document.getElementById('hud-quota');
        if (quotaEl) {
            quotaEl.textContent = `${state.stageScore || 0} / ${QUOTA_PER_STAGE}`;
            quotaEl.style.color = (state.stageScore || 0) >= QUOTA_PER_STAGE ? 'var(--brass-bright)' : 'var(--ivory)';
        }

        const livesWrap = document.getElementById('hud-lives');
        livesWrap.innerHTML = '';
        for (let i = 0; i < state.maxLives; i++) {
            const dot = document.createElement('div');
            dot.className = 'life-dot' + (i < state.lives ? '' : ' lost');
            livesWrap.appendChild(dot);
        }
        updateTimerDisplay();
    }

    function updateStreakHud() {
        const block = document.getElementById('streak-block');
        const val = document.getElementById('hud-streak');
        if (!block || !val) return;
        if ((state.streak || 0) >= 2) {
            block.style.display = 'flex';
            val.textContent = `🔥 x${state.streak}`;
            val.classList.remove('score-pop');
            void val.offsetWidth;
            val.classList.add('score-pop');
        } else {
            block.style.display = 'none';
        }
    }

    function renderStageProgress() {
        const wrap = document.getElementById('stage-progress');
        if (!wrap) return;
        wrap.innerHTML = '';
        STAGES.forEach((s, i) => {
            const step = document.createElement('div');
            const done = i < state.stageIndex;
            const current = i === state.stageIndex;
            step.className = 'sp-step' + (done ? ' done' : '') + (current ? ' current' : '');
            step.innerHTML = `<span class="sp-dot">${done ? '✓' : (i + 1)}</span><span>${s.short || s.name}</span>`;
            wrap.appendChild(step);
            if (i < STAGES.length - 1) {
                const link = document.createElement('div');
                link.className = 'sp-link' + (i < state.stageIndex ? ' done' : '');
                wrap.appendChild(link);
            }
        });
    }

    function updateTimerDisplay() {
        document.getElementById('hud-timer').textContent = state.timer;
        const pct = Math.max(0, (state.timer / state.timerMax) * 100);
        const bar = document.getElementById('timer-bar');
        bar.style.width = pct + '%';
        bar.classList.toggle('low', state.timer <= state.timerMax * 0.25);
    }

    function setMsg(text) {
        const el = document.getElementById('msg-line');
        el.textContent = text;
        el.classList.remove('msg-pulse');
        void el.offsetWidth;
        el.classList.add('msg-pulse');
    }

    let toastTimeout = null;
    function showMeaningToast(word) {
        const toast = document.getElementById('meaning-toast');
        const wordEl = document.getElementById('mt-word');
        const defEl = document.getElementById('mt-def');
        wordEl.textContent = word;
        defEl.textContent = currentStage().definitions[word] || '';
        toast.classList.add('show');
        clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
            toast.classList.remove('show');
        }, 3200);
    }

    function burstConfetti(count) {
        const colors = ['#7a2424', '#d49a47', '#f3e7d2', '#f3e7d2', '#2b2b2b'];
        for (let i = 0; i < count; i++) {
            const piece = document.createElement('div');
            piece.className = 'confetti-piece';
            piece.style.left = Math.random() * 100 + 'vw';
            piece.style.background = colors[Math.floor(Math.random() * colors.length)];
            piece.style.animationDuration = (1.6 + Math.random() * 1.2) + 's';
            piece.style.transform = `rotate(${Math.random() * 360}deg)`;
            document.body.appendChild(piece);
            setTimeout(() => piece.remove(), 3200);
        }
    }

    const MASCOT_MOUTHS = {
        happy: "M45,80 Q55,94 65,80 Q55,90 45,80",
        neutral: "M46,82 Q55,88 64,82",
        sad: "M46,88 Q55,78 64,88"
    };
    const MASCOT_BROWS = {
        happy: { l: "M42,57 Q47,54 52,57", r: "M58,57 Q63,54 68,57" },
        neutral: { l: "M42,58 Q47,55 52,58", r: "M58,58 Q63,55 68,58" },
        sad: { l: "M42,55 Q47,59 52,57", r: "M58,57 Q63,59 68,55" }
    };
    const MASCOT_LINES = {
        happy: ["Well spotted!", "Splendid trace!", "The guests would be proud.", "Right on the register!", "Outstanding — table for one, Michelin star!"],
        sad: ["Not quite — try another angle.", "Steady now, take another look.", "Close! Scan the rows again.", "Back to the books on that one."],
        neutral: ["Good luck out there — I'll cheer you on!", "Trace carefully across, down, or diagonal."]
    };
    function setMascotMood(mood) {
        const mouth = document.getElementById('mascot-mouth');
        const browL = document.getElementById('mascot-brow-l');
        const browR = document.getElementById('mascot-brow-r');
        const bubble = document.getElementById('mascot-bubble');
        const wrap = document.getElementById('mascot-wrap');
        if (mouth) mouth.setAttribute('d', MASCOT_MOUTHS[mood] || MASCOT_MOUTHS.neutral);
        const brows = MASCOT_BROWS[mood] || MASCOT_BROWS.neutral;
        if (browL) browL.setAttribute('d', brows.l);
        if (browR) browR.setAttribute('d', brows.r);
        if (bubble) {
            const lines = MASCOT_LINES[mood] || MASCOT_LINES.neutral;
            bubble.textContent = lines[Math.floor(Math.random() * lines.length)];
        }
        if (wrap) {
            wrap.classList.remove('mascot-bounce', 'mascot-shake');
            void wrap.offsetWidth;
            wrap.classList.add(mood === 'sad' ? 'mascot-shake' : 'mascot-bounce');
        }
    }

    function triggerMascotGrow(isCorrect) {
        const wrap = document.getElementById('mascot-wrap');
        if (!wrap) return;
        wrap.classList.remove('mascot-grow-correct', 'mascot-grow-wrong');
        void wrap.offsetWidth;
        wrap.classList.add(isCorrect ? 'mascot-grow-correct' : 'mascot-grow-wrong');
        setTimeout(() => {
            wrap.classList.remove('mascot-grow-correct', 'mascot-grow-wrong');
        }, 1400);
    }

    let audioCtx = null, musicState = null;
    function ensureAudioCtx() {
        if (!audioCtx) {
            const Ctx = window.AudioContext || window.webkitAudioContext;
            audioCtx = new Ctx();
        }
        return audioCtx;
    }

    function pluckNote(ctx, dest, freq, startTime, duration, peak, type) {
        const osc = ctx.createOscillator();
        osc.type = type;
        osc.frequency.value = freq;
        const g = ctx.createGain();
        g.gain.setValueAtTime(0.0001, startTime);
        g.gain.linearRampToValueAtTime(peak, startTime + 0.06);
        g.gain.exponentialRampToValueAtTime(0.0001, startTime + duration);
        osc.connect(g).connect(dest);
        osc.start(startTime);
        osc.stop(startTime + duration + 0.05);
    }

    function startMusic() {
        if (!settings.musicOn) return;

        if (musicState) {
            if (musicState.audio.paused) {
                const playPromise = musicState.audio.play();
                if (playPromise) playPromise.catch(() => {});
            }
            return;
        }

        const audio = new Audio('music/music.mp3');
        audio.loop = true;
        audio.volume = 0.35;
        audio.preload = 'auto';

        const playPromise = audio.play();
        if (playPromise) playPromise.catch(() => {});

        musicState = { audio };
    }

    function stopMusic() {
        if (!musicState) return;
        musicState.audio.pause();
        musicState.audio.currentTime = 0;
        musicState = null;
    }

    function playSoundEffect(path, volume = 0.75) {
        if (!settings.musicOn) return;
        try {
            const audio = new Audio(path);
            audio.volume = volume;
            audio.preload = 'auto';
            const playPromise = audio.play();
            if (playPromise) playPromise.catch(() => {});
        } catch (e) {}
    }

    function playCorrectSound() {
        playSoundEffect('music/CORRECT ANSWER SOUND EFFECT _ NO COPYRIGHT.mp3', 0.75);
    }

    function playWrongSound() {
        playSoundEffect('music/', 0.8);
    }

    function playGameOverSound() {
        playSoundEffect('music/GAME OVER Sound Effect (Download).mp3', 0.8);
    }

    function applyMusicSetting() {
        if (settings.musicOn) { startMusic(); }
        else { stopMusic(); }
    }

    function playTimeUpSound() {
        if (!settings.musicOn) return;
        try {
            const ctx = ensureAudioCtx();
            if (ctx.state === 'suspended') ctx.resume();
            const now = ctx.currentTime;
            pluckNote(ctx, ctx.destination, 340, now, 0.22, 0.16, 'sawtooth');
            pluckNote(ctx, ctx.destination, 270, now + 0.22, 0.28, 0.16, 'sawtooth');
            pluckNote(ctx, ctx.destination, 180, now + 0.50, 0.45, 0.22, 'sawtooth');
        } catch (e) {}
    }

    function showTimeUpBanner() {
        const overlay = document.getElementById('timesup-overlay');
        if (overlay) {
            overlay.classList.add('show');
            setTimeout(() => {
                overlay.classList.remove('show');
            }, 1800);
        }
    }

    function startTimer() {
        clearInterval(state.timerHandle);
        state.timerHandle = setInterval(() => {
            state.timer--;
            if (state.timer <= 0) {
                state.timer = 0;
                updateTimerDisplay();
                clearInterval(state.timerHandle);
                onTimeUp();
            } else {
                updateTimerDisplay();
            }
        }, 1000);
    }

    function onTimeUp() {
        if (!state || state.gameOver) return;
        clearInterval(state.timerHandle);
        stopQuizTimer();

        state.streak = 0;
        const unfound = state.currentWords.filter(w => !state.foundWords.has(w)).length;
        state.mistakes += unfound;
        setMsg("⏱️ TIME'S UP! The shift clock has run out.");
        renderHud();
        setMascotMood('sad');

        const hudPanel = document.querySelector('#game-screen .hud');
        if (hudPanel) {
            hudPanel.classList.remove('shake');
            void hudPanel.offsetWidth;
            hudPanel.classList.add('shake');
        }

        playTimeUpSound();
        showTimeUpBanner();

        setTimeout(() => {
            endGame(false, 'timesup');
        }, 1800);
    }

    function loadStage(index) {
        if (!state || state.gameOver) return;
        state.stageIndex = index;
        const stage = STAGES[index];
        const diff = DIFFICULTIES[settings.difficulty];
        const drawnWords = pickRandomWords(stage.pool, WORDS_PER_STAGE);
        state.currentWords = drawnWords;
        const puzzle = generatePuzzle(stage, drawnWords);
        state.grid = puzzle.grid;
        state.size = puzzle.size;
        state.placements = puzzle.placements;
        state.foundWords = new Set();
        state.hintsLeft = Math.max(0, stage.hints + diff.hintsBonus);
        state.hintsUsedStage = 0;
        state.timer = Math.max(20, Math.round(stage.time * diff.timeMult));
        state.timerMax = state.timer;
        state.stageScore = 0;
        state.stageQuestionScores = [];

        renderGrid();
        renderWordList();
        renderHud();
        setMsg(`Stage ${index + 1}: ${stage.name} — find all the terms before time runs out.`);
        startTimer();

        const badge = document.getElementById('hud-stage');
        badge.classList.remove('stage-pop');
        void badge.offsetWidth;
        badge.classList.add('stage-pop');
    }

    function advanceStage() {
        if (!state || state.gameOver) return;
        if (state.stageIndex >= STAGES.length - 1) {
            endGame(true);
            return;
        }
        showStoryScreen('after-stage');
    }

    function checkStageQuota() {
        const scores = state.stageQuestionScores || [];
        if (scores.length === 0) return false;
        const perQuestionOk = scores.every(p => p >= QUOTA_PER_QUESTION);
        const totalOk = (state.stageScore || 0) >= QUOTA_PER_STAGE;
        return perQuestionOk && totalOk;
    }

    function stageComplete() {
        if (!state || state.gameOver) return;
        clearInterval(state.timerHandle);
        const quotaMet = checkStageQuota();
        if (quotaMet) {
            setMsg('Stage cleared! Moving to the next section...');
            setTimeout(advanceStage, 1400);
        } else {
            setMsg(`Quota not met (needed ${QUOTA_PER_QUESTION}+ per term and ${QUOTA_PER_STAGE} total) — this stage repeats with a fresh puzzle.`);
            setTimeout(() => loadStage(state.stageIndex), 1600);
        }
    }

    function cellsInLine(r0, c0, r1, c1) {
        const dr = r1 - r0, dc = c1 - c0;
        const steps = Math.max(Math.abs(dr), Math.abs(dc));
        if (steps === 0) return [[r0, c0]];
        const stepR = dr === 0 ? 0 : dr / Math.abs(dr);
        const stepC = dc === 0 ? 0 : dc / Math.abs(dc);
        if (!(dr === 0 || dc === 0 || Math.abs(dr) === Math.abs(dc))) return null;
        const path = [];
        for (let i = 0; i <= steps; i++) {
            path.push([r0 + stepR * i, c0 + stepC * i]);
        }
        return path;
    }

    function clearSelectingClass() {
        document.querySelectorAll('.cell.selecting').forEach(el => el.classList.remove('selecting'));
    }

    function applyPathHighlight(path) {
        clearSelectingClass();
        path.forEach(([r, c]) => {
            const el = cellAt(r, c);
            if (el) el.classList.add('selecting');
        });
    }

    function cellAt(r, c) {
        const gridEl = document.getElementById('grid');
        const idx = r * state.size + c;
        return gridEl.children[idx] || null;
    }

    function wordFromPath(path) {
        return path.map(([r, c]) => state.grid[r][c]).join('');
    }

    function beginSelection(r, c) {
        state.selecting = true;
        state.startCell = [r, c];
        state.currentPath = [[r, c]];
        applyPathHighlight(state.currentPath);
    }

    function updateSelection(r, c) {
        if (!state.selecting) return;
        const [r0, c0] = state.startCell;
        const path = cellsInLine(r0, c0, r, c);
        if (path) {
            state.currentPath = path;
            applyPathHighlight(path);
        }
    }

    function endSelection() {
        if (!state.selecting) return;
        state.selecting = false;
        const path = state.currentPath;
        clearSelectingClass();
        if (path.length < 2) { return; }

        const forward = wordFromPath(path);
        const backward = forward.split('').reverse().join('');

        let matchedWord = null;
        for (const w of state.currentWords) {
            if (state.foundWords.has(w)) continue;
            if (w === forward || w === backward) { matchedWord = w; break; }
        }

        if (matchedWord) {
            openQuiz(matchedWord, path);
        } else {
            handleWrongSelection(path);
        }
    }

    let quizState = null;
    const QUIZ_TIME_LIMIT = 10;
    let quizTimerHandle = null;
    let quizTimeRemaining = QUIZ_TIME_LIMIT;
    let quizTimerStartTime = null;

    function renderQuizTimerUI(secondsLeft) {
        const timerVal = document.getElementById('iq-timer-val');
        const timerBar = document.getElementById('iq-timer-bar');
        const timerWrap = document.getElementById('iq-timer-wrap');
        const displaySec = Math.max(0, Math.ceil(secondsLeft));
        if (timerVal) {
            timerVal.textContent = `${displaySec}s`;
        }
        if (timerBar) {
            const pct = Math.max(0, Math.min(100, (secondsLeft / QUIZ_TIME_LIMIT) * 100));
            timerBar.style.width = `${pct}%`;
            timerBar.classList.toggle('urgent', secondsLeft <= 3.2);
        }
        if (timerWrap) {
            timerWrap.classList.toggle('urgent', secondsLeft <= 3.2);
        }
    }

    function startQuizTimer(initialSeconds = QUIZ_TIME_LIMIT) {
        stopQuizTimer();
        quizTimeRemaining = initialSeconds;
        quizTimerStartTime = Date.now();
        renderQuizTimerUI(quizTimeRemaining);

        quizTimerHandle = setInterval(() => {
            const elapsed = (Date.now() - quizTimerStartTime) / 1000;
            const currentRemaining = Math.max(0, quizTimeRemaining - elapsed);
            renderQuizTimerUI(currentRemaining);

            if (currentRemaining <= 0) {
                stopQuizTimer();
                handleQuizTimeout();
            }
        }, 80);
    }

    function pauseQuizTimer() {
        if (quizTimerHandle) {
            const elapsed = (Date.now() - quizTimerStartTime) / 1000;
            quizTimeRemaining = Math.max(0, quizTimeRemaining - elapsed);
            clearInterval(quizTimerHandle);
            quizTimerHandle = null;
        }
    }

    function resumeQuizTimer() {
        if (quizState && !quizState.answered && quizTimeRemaining > 0) {
            startQuizTimer(quizTimeRemaining);
        }
    }

    function stopQuizTimer() {
        if (quizTimerHandle) {
            clearInterval(quizTimerHandle);
            quizTimerHandle = null;
        }
    }

    function handleQuizTimeout() {
        if (!quizState || quizState.answered) return;
        quizState.answered = true;
        stopQuizTimer();

        const { word, path, q, essay } = quizState;
        const stage = currentStage();
        const defEl = document.getElementById('iq-correct-def');
        const panelEl = document.getElementById('inline-quiz');

        if (essay) {
            const input = document.getElementById('iq-essay-input');
            input.disabled = true;
            document.getElementById('iq-essay-submit').disabled = true;
            const definition = stage.definitions[word] || '';
            defEl.innerHTML = `<div class="iq-timeout-tag">⏱️ Time's Up! (10s limit exceeded)</div><br><b>${word} — Model Answer:</b> ${escapeHtml(definition)}<br><br><i>Time ran out before an explanation was submitted.</i>`;
            defEl.style.display = 'block';
        } else {
            const allBtns = Array.from(document.querySelectorAll('#iq-choices .quiz-choice-btn'));
            allBtns.forEach(b => { b.disabled = true; });
            const correctText = q.choices[q.correctIndex];
            allBtns.forEach(b => {
                if (b.textContent === correctText) { b.classList.add('correct'); }
            });
            defEl.innerHTML = `<div class="iq-timeout-tag">⏱️ Time's Up! (10s limit exceeded)</div><br><b>${word}:</b> ${escapeHtml(correctText)}`;
            defEl.style.display = 'block';
        }

        panelEl.classList.remove('iq-panel-success', 'iq-panel-basic');
        void panelEl.offsetWidth;
        panelEl.classList.add('iq-panel-basic');

        setMascotMood('sad');
        triggerMascotGrow(false);
        playWrongSound();

        state.lives--;
        state.mistakes++;
        renderHud();
        flashLifeLost();

        setMsg(`Time's up for "${word}"! 10 seconds expired — wrong answer, and a life was lost.`);

        const closeDelay = essay ? 3200 : 2500;
        setTimeout(() => {
            document.getElementById('inline-quiz').classList.remove('show');
            quizState = null;
            finalizeWordFound(word, path, 0);
            if (state.lives > 0 && !state.gameOver) {
                startTimer();
            } else if (state.lives <= 0) {
                endGame();
            }
        }, closeDelay);
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    function shuffleChoices(q) {
        const items = q.choices.map((text, i) => ({ text, correct: i === q.correctIndex }));
        for (let i = items.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [items[i], items[j]] = [items[j], items[i]];
        }
        return items;
    }

    function focusOnQuizPanel(panel, afterFocus) {
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                panel.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'nearest' });
                panel.classList.remove('iq-spotlight');
                void panel.offsetWidth;
                panel.classList.add('iq-spotlight');
                if (typeof afterFocus === 'function') {
                    setTimeout(afterFocus, 320);
                }
            });
        });
    }

    function openQuiz(word, path) {
        clearInterval(state.timerHandle);
        const stage = currentStage();

        if (stage.essay) {
            openEssayQuiz(word, path);
            return;
        }

        const q = buildQuestion(state.stageIndex, word);
        quizState = { word, path, answered: false, q, essay: false };

        document.getElementById('iq-word').textContent = word;
        document.getElementById('iq-question').textContent = q.question;

        document.getElementById('iq-mc-wrap').style.display = 'block';
        document.getElementById('iq-essay-wrap').style.display = 'none';

        const choicesWrap = document.getElementById('iq-choices');
        choicesWrap.innerHTML = '';
        const defEl = document.getElementById('iq-correct-def');
        defEl.style.display = 'none';
        defEl.innerHTML = '';

        const items = shuffleChoices(q);
        items.forEach(item => {
            const btn = document.createElement('button');
            btn.className = 'quiz-choice-btn';
            btn.textContent = item.text;
            btn.addEventListener('click', () => handleChoice(btn, item.correct));
            choicesWrap.appendChild(btn);
        });

        const panel = document.getElementById('inline-quiz');
        panel.classList.remove('iq-panel-success', 'iq-panel-basic');
        panel.classList.add('show');
        focusOnQuizPanel(panel);
        setMsg(`"${word}" traced! Pick the correct meaning within 10 seconds.`);
        startQuizTimer(QUIZ_TIME_LIMIT);
    }

    function handleChoice(clickedBtn, isCorrect) {
        if (!quizState || quizState.answered) return;
        quizState.answered = true;
        stopQuizTimer();
        const { word, path, q } = quizState;

        const allBtns = Array.from(document.querySelectorAll('#iq-choices .quiz-choice-btn'));
        allBtns.forEach(b => { b.disabled = true; });
        clickedBtn.classList.add(isCorrect ? 'correct' : 'wrong');
        if (!isCorrect) {
            const correctText = q.choices[q.correctIndex];
            allBtns.forEach(b => {
                if (b.textContent === correctText) { b.classList.add('correct'); }
            });
        }

        const defEl = document.getElementById('iq-correct-def');
        defEl.innerHTML = `<b>${word}:</b> ${escapeHtml(q.choices[q.correctIndex])}`;
        defEl.style.display = 'block';

        const earnedPoints = isCorrect && quizTimeRemaining > 0 ? BASE_SCORE : 0;

        const panelEl = document.getElementById('inline-quiz');
        panelEl.classList.remove('iq-panel-success', 'iq-panel-basic');
        void panelEl.offsetWidth;
        panelEl.classList.add(isCorrect ? 'iq-panel-success' : 'iq-panel-basic');

        setMascotMood(isCorrect ? 'happy' : 'sad');
        triggerMascotGrow(isCorrect);
        if (isCorrect) {
            playCorrectSound();
        } else {
            playWrongSound();
            state.lives--;
            state.mistakes++;
            renderHud();
            flashLifeLost();
        }

        setTimeout(() => {
            document.getElementById('inline-quiz').classList.remove('show');
            quizState = null;
            finalizeWordFound(word, path, earnedPoints);
            if (state.lives > 0 && !state.gameOver) {
                startTimer();
            } else if (state.lives <= 0) {
                endGame();
            }
        }, 2400);
    }

    function openEssayQuiz(word, path) {
        quizState = { word, path, answered: false, essay: true };

        document.getElementById('iq-word').textContent = word;
        document.getElementById('iq-question').textContent = `In your own words, explain what "${word}" means in Housekeeping.`;

        document.getElementById('iq-mc-wrap').style.display = 'none';
        document.getElementById('iq-essay-wrap').style.display = 'flex';

        const input = document.getElementById('iq-essay-input');
        input.value = '';
        input.disabled = false;
        const submitBtn = document.getElementById('iq-essay-submit');
        submitBtn.disabled = false;

        const defEl = document.getElementById('iq-correct-def');
        defEl.style.display = 'none';
        defEl.innerHTML = '';

        const panel = document.getElementById('inline-quiz');
        panel.classList.remove('iq-panel-success', 'iq-panel-basic');
        panel.classList.add('show');
        focusOnQuizPanel(panel, () => input.focus());
        setMsg(`"${word}" traced! Write your own short explanation within 10 seconds.`);
        startQuizTimer(QUIZ_TIME_LIMIT);
    }

    function handleEssaySubmit() {
        if (!quizState || quizState.answered || !quizState.essay) return;
        quizState.answered = true;
        stopQuizTimer();
        const { word, path } = quizState;
        const stage = currentStage();

        const input = document.getElementById('iq-essay-input');
        const answerText = input.value.trim();
        input.disabled = true;
        document.getElementById('iq-essay-submit').disabled = true;

        const definition = stage.definitions[word];
        const isRelevant = essayIsRelevant(answerText, word, definition);

        const defEl = document.getElementById('iq-correct-def');
        let html = `<b>${word} — Model Answer:</b> ${escapeHtml(definition)}`;
        if (answerText.length > 0) {
            html += `<br><br><b>Your answer:</b> ${escapeHtml(answerText)}`;
            if (!isRelevant) {
                html += `<br><br><i>This didn't match closely enough with the meaning of "${word}" to earn points — compare it with the model answer above.</i>`;
            }
        } else {
            html += `<br><br><i>No answer was written.</i>`;
        }
        defEl.innerHTML = html;
        defEl.style.display = 'block';

        const earnedPoints = isRelevant && quizTimeRemaining > 0 ? BASE_SCORE : 0;

        const panelEl = document.getElementById('inline-quiz');
        panelEl.classList.remove('iq-panel-success', 'iq-panel-basic');
        void panelEl.offsetWidth;
        panelEl.classList.add(isRelevant ? 'iq-panel-success' : 'iq-panel-basic');

        setMascotMood(isRelevant ? 'happy' : 'sad');
        triggerMascotGrow(isRelevant);
        if (isRelevant) {
            playCorrectSound();
        } else {
            playWrongSound();
            state.lives--;
            state.mistakes++;
            renderHud();
            flashLifeLost();
        }

        let feedbackMsg;
        if (answerText.length === 0) {
            feedbackMsg = `You left that blank — no points, and a life was lost.`;
        } else if (answerText.length < ESSAY_MIN_LENGTH) {
            feedbackMsg = `That answer was too short — write at least a short sentence next time.`;
        } else if (!isRelevant) {
            feedbackMsg = `That answer doesn't match "${word}" closely enough — no points, and a life was lost.`;
        } else {
            feedbackMsg = `Nice effort on "${word}"! Compare your answer with the model answer.`;
        }
        setMsg(feedbackMsg);

        setTimeout(() => {
            document.getElementById('inline-quiz').classList.remove('show');
            quizState = null;
            finalizeWordFound(word, path, earnedPoints);
            if (state.lives > 0 && !state.gameOver) {
                startTimer();
            } else if (state.lives <= 0) {
                endGame();
            }
        }, 3200);
    }

    function finalizeWordFound(word, path, earnedPoints) {
        state.foundWords.add(word);
        state.correctWords++;
        if (earnedPoints === undefined) {
            earnedPoints = BASE_SCORE;
        }

        let streakNote = '';
        if (earnedPoints > 0) {
            state.streak = (state.streak || 0) + 1;
            state.bestStreak = Math.max(state.bestStreak || 0, state.streak);
            const mult = streakMultiplier(state.streak);
            if (mult > 1) {
                const bonus = Math.round(earnedPoints * (mult - 1));
                earnedPoints += bonus;
                streakNote = ` (streak x${state.streak}, +${bonus} bonus)`;
            }
        } else {
            state.streak = 0;
        }
        updateStreakHud();

        state.score += earnedPoints;

        state.stageScore = (state.stageScore || 0) + earnedPoints;
        state.stageQuestionScores = state.stageQuestionScores || [];
        state.stageQuestionScores.push(earnedPoints);

        path.forEach(([r, c]) => {
            const el = cellAt(r, c);
            if (el) { el.classList.add('found', 'found-glow'); }
        });
        if (earnedPoints > 0) {
            burstConfetti(16);
            showFloatingPoints(earnedPoints);
        }

        const meaning = currentStage().definitions[word] || '';
        const quotaNote = earnedPoints < QUOTA_PER_QUESTION ? ` (below the ${QUOTA_PER_QUESTION}-pt quota)` : '';
        setMsg(`"${word}" found! +${earnedPoints} pts${streakNote}${quotaNote}. — ${meaning}`);
        showMeaningToast(word);

        renderWordList();
        renderHud();

        const scoreEl = document.getElementById('hud-score');
        scoreEl.classList.remove('score-pop');
        void scoreEl.offsetWidth;
        scoreEl.classList.add('score-pop');

        if (stage_allFound() && !state.gameOver) {
            burstConfetti(60);
            stageComplete();
        }
    }

    function stage_allFound() {
        return state.currentWords.every(w => state.foundWords.has(w));
    }

    function handleWrongSelection(path) {
        state.mistakes++;
        state.lives--;
        state.streak = 0;
        updateStreakHud();
        path.forEach(([r, c]) => {
            const el = cellAt(r, c);
            if (el) {
                el.classList.add('wrong-flash');
                setTimeout(() => el.classList.remove('wrong-flash'), 400);
            }
        });
        setMsg('That trace does not match a term. A life was lost.');
        renderHud();
        flashLifeLost();
        playWrongSound();
        setMascotMood('sad');
        const gridPanel = document.querySelector('.grid-panel');
        gridPanel.classList.remove('shake');
        void gridPanel.offsetWidth;
        gridPanel.classList.add('shake');
        if (state.lives <= 0) {
            setTimeout(() => endGame(), 500);
        }
    }

    function flashLifeLost() {
        const dots = document.querySelectorAll('#hud-lives .life-dot');
        const idx = state.lives;
        if (dots[idx]) {
            dots[idx].classList.remove('losing');
            void dots[idx].offsetWidth;
            dots[idx].classList.add('losing');
        }
    }

    function useHint() {
        if (state.hintsLeft <= 0) return;
        const remaining = state.placements.filter(p => !state.foundWords.has(p.word));
        if (remaining.length === 0) return;
        const pick = remaining[Math.floor(Math.random() * remaining.length)];
        const [r, c] = pick.cells[0];
        const el = cellAt(r, c);
        if (el) {
            el.classList.add('hint-pulse');
            setTimeout(() => el.classList.remove('hint-pulse'), 2700);
        }
        const costIndex = Math.min(state.hintsUsedStage || 0, HINT_COSTS.length - 1);
        const cost = HINT_COSTS[costIndex];
        state.hintsLeft--;
        state.hintsUsed++;
        state.hintsUsedStage = (state.hintsUsedStage || 0) + 1;
        state.score = Math.max(0, state.score - cost);
        state.stageScore = Math.max(0, (state.stageScore || 0) - cost);
        setMsg(`Hint used: -${cost} pts. "${pick.word}" begins near the highlighted tile.`);
        renderHud();

        const scoreEl = document.getElementById('hud-score');
        scoreEl.classList.remove('score-pop');
        void scoreEl.offsetWidth;
        scoreEl.classList.add('score-pop');
    }

    function rankFor(score) {
        if (score >= 1400) return "Senior";
        if (score >= 600) return "Junior";
        return "Beginner";
    }

    function endGame(won, reason = null) {
        stopQuizTimer();
        const timesUpOverlay = document.getElementById('timesup-overlay');
        if (timesUpOverlay) timesUpOverlay.classList.remove('show');
        const inlineQuiz = document.getElementById('inline-quiz');
        if (inlineQuiz) inlineQuiz.classList.remove('show');
        if (state) {
            state.gameOver = true;
            if (state.timerHandle) clearInterval(state.timerHandle);
        }
        if (!won) {
            stopMusic();
            playGameOverSound();
        }
        const totalAttempts = (state.correctWords || 0) + (state.mistakes || 0);
        const accuracy = totalAttempts > 0 ? Math.round((state.correctWords / totalAttempts) * 100) : 0;

        if (reason === 'timesup' || reason === 'timeout') {
            document.getElementById('go-eyebrow').textContent = "⏱️ Time's Up!";
            document.getElementById('go-rank').textContent = rankFor(state.score);
            document.getElementById('go-sub').textContent = "The shift clock ran out before all terms were completed.";
        } else {
            document.getElementById('go-eyebrow').textContent = won ? 'All Stages Complete' : 'Guest Departure';
            document.getElementById('go-rank').textContent = rankFor(state.score);
            document.getElementById('go-sub').textContent = won
                ? 'You completed Front Office, Food and Beverage, and Housekeeping NC II.'
                : 'Your service record for this session.';
        }
        document.getElementById('go-score').textContent = state.score;
        document.getElementById('go-accuracy').textContent = accuracy + '%';
        document.getElementById('go-hints').textContent = state.hintsUsed || 0;
        document.getElementById('go-mistakes').textContent = state.mistakes || 0;
        document.getElementById('go-streak').textContent = state.bestStreak || 0;

        goTo('gameover');
        if (won) {
            burstConfetti(140);
        }

        // Save score to database whenever a game finishes
        if (state && state.score > 0) {
            saveUserScoreToDb(state.score, accuracy, state.hintsUsed || 0, state.mistakes || 0, state.bestStreak || 0);
        }
    }

    function wireGridEvents() {
        const gridEl = document.getElementById('grid');

        gridEl.addEventListener('mousedown', e => {
            if (!state) return;
            const cell = e.target.closest('.cell');
            if (!cell) return;
            beginSelection(+cell.dataset.r, +cell.dataset.c);
        });
        gridEl.addEventListener('mouseover', e => {
            if (!state || !state.selecting) return;
            const cell = e.target.closest('.cell');
            if (!cell) return;
            updateSelection(+cell.dataset.r, +cell.dataset.c);
        });
        window.addEventListener('mouseup', () => {
            if (state && state.selecting) endSelection();
        });

        gridEl.addEventListener('touchstart', e => {
            if (!state) return;
            const t = e.touches[0];
            const el = document.elementFromPoint(t.clientX, t.clientY);
            const cell = el && el.closest('.cell');
            if (cell) { beginSelection(+cell.dataset.r, +cell.dataset.c); e.preventDefault(); }
        }, { passive: false });
        gridEl.addEventListener('touchmove', e => {
            if (!state || !state.selecting) return;
            const t = e.touches[0];
            const el = document.elementFromPoint(t.clientX, t.clientY);
            const cell = el && el.closest('.cell');
            if (cell) { updateSelection(+cell.dataset.r, +cell.dataset.c); }
            e.preventDefault();
        }, { passive: false });
        gridEl.addEventListener('touchend', e => {
            if (state && state.selecting) endSelection();
        });
    }

    function startNewGame(stageIndex = 0) {
        stopQuizTimer();
        quizState = null;
        const timesUpOverlay = document.getElementById('timesup-overlay');
        if (timesUpOverlay) timesUpOverlay.classList.remove('show');
        const inlineQuiz = document.getElementById('inline-quiz');
        if (inlineQuiz) inlineQuiz.classList.remove('show');
        _displayedScore = 0;
        if (_scoreAnimHandle) {
            cancelAnimationFrame(_scoreAnimHandle);
            _scoreAnimHandle = null;
        }
        const scoreEl = document.getElementById('hud-score');
        if (scoreEl) scoreEl.textContent = '0';
        state = freshState();
        goTo('game');
        loadStage(stageIndex);
        startMusic();
    }

    function hydrateStageDefinitions(questions) {
        STAGES.forEach((stage, index) => {
            const stageQuestions = questions.filter(question => Number(question.stage) === index + 1);
            if (stageQuestions.length < 4) {
                stage.pool = Object.keys(stage.definitions || {});
                return;
            }
            stage.definitions = Object.fromEntries(stageQuestions.map(question => [
                question.term,
                question.definition
            ]));
            stage.pool = Object.keys(stage.definitions);
        });

        buildStagePreview();
        buildStageTabs();
        buildGlossary();
    }

    function loadManagedQuestions() {
        const defaults = STAGES.flatMap((stage, index) =>
            Object.entries(stage.definitions).map(([term, definition]) => ({
                stage: index + 1,
                term,
                definition
            }))
        );

        fetch('questions.php?action=get')
            .then(response => response.json().then(data => ({ ok: response.ok, data })))
            .then(({ ok, data }) => {
                if (!ok || data.status !== 'success' || !Array.isArray(data.questions)) {
                    throw new Error(data.message || 'Could not load saved quiz questions.');
                }

                if (data.questions.length === 0) {
                    hydrateStageDefinitions(defaults);
                    return;
                }

                hydrateStageDefinitions(data.questions);
            })
            .catch(error => {
                console.error('Quiz question load error:', error);
                hydrateStageDefinitions(defaults);
                setMsg('Saved questions could not be loaded. The default quiz questions are still available.');
            });
    }

    document.getElementById('btn-play').addEventListener('click', () => showStoryScreen('intro'));
    document.getElementById('btn-play-again').addEventListener('click', () => showStoryScreen('intro'));
    document.querySelectorAll('.stage-choice').forEach(button => {
        button.addEventListener('click', () => startNewGame(Number(button.dataset.stage)));
    });
    document.getElementById('btn-stage-select-back').addEventListener('click', () => goTo('menu'));
    document.getElementById('btn-skip-story').addEventListener('click', () => goTo('stageSelect'));
    document.getElementById('btn-story-next').addEventListener('click', goToStoryNext);
    document.getElementById('btn-story-prev').addEventListener('click', goToStoryPrev);

    document.getElementById('btn-review').addEventListener('click', () => goTo('review'));
    document.getElementById('btn-go-review').addEventListener('click', () => goTo('review'));
    document.getElementById('btn-review-back').addEventListener('click', () => goTo('menu'));

    document.getElementById('btn-options').addEventListener('click', () => goTo('options'));
    document.getElementById('btn-options-back').addEventListener('click', () => goTo('menu'));

    document.getElementById('btn-exit').addEventListener('click', () => { stopMusic(); goTo('exit'); });
    document.getElementById('btn-exit-back').addEventListener('click', () => goTo('menu'));

    document.getElementById('btn-hint').addEventListener('click', useHint);
    document.getElementById('iq-essay-submit').addEventListener('click', handleEssaySubmit);

    document.getElementById('btn-quit-to-menu').addEventListener('click', () => {
        stopMusic();
        goTo('menu');
    });

    function buildOptionsUI() {
        document.querySelectorAll('.diff-card').forEach(card => {
            card.classList.toggle('active', card.dataset.diff === settings.difficulty);
            card.addEventListener('click', () => {
                settings.difficulty = card.dataset.diff;
                document.querySelectorAll('.diff-card').forEach(c => c.classList.remove('active'));
                card.classList.add('active');
            });
        });
        const musicToggle = document.getElementById('music-toggle');
        musicToggle.checked = settings.musicOn;
        musicToggle.addEventListener('change', () => {
            settings.musicOn = musicToggle.checked;
            applyMusicSetting();
        });
    }

    const pauseOverlay = document.getElementById('pause-overlay');
    const confirmBtn = document.getElementById('btn-pause-quit');
    let pauseMode = 'pause';
    function openPause(mode) {
        pauseMode = mode;
        if (state && state.timerHandle) clearInterval(state.timerHandle);
        pauseQuizTimer();
        document.getElementById('pause-title').textContent =
            mode === 'quit' ? 'Quit this game?' : mode === 'restart' ? 'Restart this game?' : 'Paused';
        document.getElementById('pause-sub').textContent =
            mode === 'quit' ? 'Your progress in this run will be lost.'
                : mode === 'restart' ? 'Your progress in this run will be lost and a new run will begin.'
                    : 'The clock is on hold. What would you like to do?';
        confirmBtn.textContent = mode === 'restart' ? 'Restart' : 'Quit to Menu';
        pauseOverlay.classList.add('show');
    }
    function closePauseAndResume() {
        pauseOverlay.classList.remove('show');
        if (quizState && !quizState.answered) {
            resumeQuizTimer();
        } else if (state && !state.gameOver) {
            startTimer();
        }
    }
    document.getElementById('btn-back-pause').addEventListener('click', () => openPause('restart'));
    document.getElementById('btn-quit-pause').addEventListener('click', () => openPause('quit'));
    document.getElementById('btn-resume').addEventListener('click', closePauseAndResume);
    confirmBtn.addEventListener('click', () => {
        stopQuizTimer();
        if (state && state.timerHandle) clearInterval(state.timerHandle);
        pauseOverlay.classList.remove('show');
        if (pauseMode === 'restart') {
            startNewGame();
        } else {
            stopMusic();
            goTo('menu');
        }
    });

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

    const leaderboardOverlay = document.getElementById('leaderboard-overlay');
    const btnLeaderboard = document.getElementById('btn-leaderboard');
    const btnCloseLeaderboard = document.getElementById('btn-close-leaderboard');
    const leaderboardList = document.getElementById('leaderboard-list');

    let currentUser = null;

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

    function saveUserScoreToDb(score, accuracy, hints, mistakes, streak) {
        const fd = new FormData();
        fd.append('action', 'save_score');
        fd.append('score', score);
        fd.append('accuracy', accuracy);
        fd.append('hints_used', hints);
        fd.append('mistakes', mistakes);
        fd.append('best_streak', streak);

        fetch('api.php', { method: 'POST', body: fd })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && data.stats) {
                    if (currentUser) {
                        currentUser.high_score = data.stats.high_score;
                        currentUser.total_score = data.stats.total_score;
                        currentUser.games_played = data.stats.games_played;
                    }
                    updateUserBadgeUI();
                }
            })
            .catch(err => console.error('Error saving score:', err));
    }

    function openLeaderboardModal() {
        if (!leaderboardOverlay) return;
        leaderboardOverlay.classList.add('show');
        leaderboardList.innerHTML = '<div style="text-align:center; padding:15px; color:#888;">Loading leaderboard...</div>';

        fetch('api.php?action=get_leaderboard')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && Array.isArray(data.leaderboard) && data.leaderboard.length > 0) {
                    leaderboardList.innerHTML = data.leaderboard.map((item, idx) => `
                        <div style="display:flex; justify-content:space-between; align-items:center; background:rgba(255,255,255,0.05); padding:10px 14px; border-radius:6px; border:1px solid rgba(233,189,92,0.15);">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <span style="font-weight:bold; width:24px; color:${idx === 0 ? '#ffd700' : idx === 1 ? '#c0c0c0' : idx === 2 ? '#cd7f32' : '#888'};">#${idx + 1}</span>
                                <strong style="color:#fbeec1;">${escapeHtml(item.username)}</strong>
                            </div>
                            <div style="font-size:13px; color:rgba(251,238,193,0.8);">
                                <span style="margin-right:12px; color:#ffd700;">🏆 ${item.high_score} pts</span>
                                <span>🎮 ${item.games_played} games</span>
                            </div>
                        </div>
                    `).join('');
                } else {
                    leaderboardList.innerHTML = '<div style="text-align:center; padding:15px; color:#888;">No high scores recorded yet. Play a game to be the first!</div>';
                }
            })
            .catch(() => {
                leaderboardList.innerHTML = '<div style="text-align:center; padding:15px; color:#e74c3c;">Failed to load leaderboard records.</div>';
            });
    }

    if (btnLeaderboard) btnLeaderboard.addEventListener('click', openLeaderboardModal);
    if (btnCloseLeaderboard) btnCloseLeaderboard.addEventListener('click', () => leaderboardOverlay.classList.remove('show'));

    function showAuthMsg(msg, isError = true) {
        authMsg.textContent = msg;
        authMsg.className = 'auth-msg ' + (isError ? 'error' : 'success');
    }

    tabLoginBtn.addEventListener('click', () => {
        tabLoginBtn.classList.add('active');
        tabRegBtn.classList.remove('active');
        loginForm.style.display = 'flex';
        regForm.style.display = 'none';
        authMsg.textContent = '';
    });

    tabRegBtn.addEventListener('click', () => {
        tabRegBtn.classList.add('active');
        tabLoginBtn.classList.remove('active');
        regForm.style.display = 'flex';
        loginForm.style.display = 'none';
        authMsg.textContent = '';
    });

    function persistAuthVisibility() {
        localStorage.setItem('puzzle-auth-visible', authOverlay.classList.contains('hidden') ? 'hidden' : 'visible');
    }

    function checkAuthStatus() {
        fetch('check_auth.php')
            .then(res => res.json())
            .then(data => {
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
            .catch(err => {
                console.error('Auth check error:', err);
                authOverlay.classList.remove('hidden');
            });
    }

    function restoreAuthOverlayState() {
        const authVisible = localStorage.getItem('puzzle-auth-visible');
        if (authVisible === 'hidden') {
            authOverlay.classList.add('hidden');
        } else {
            authOverlay.classList.remove('hidden');
        }
    }

    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(loginForm);
        fetch('login.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    showAuthMsg(data.message, false);
                    currentUser = data.user;
                    updateUserBadgeUI();
                    setTimeout(() => {
                        authOverlay.classList.add('hidden');
                        persistAuthVisibility();
                        loginForm.reset();
                        authMsg.textContent = '';
                    }, 800);
                } else {
                    showAuthMsg(data.message, true);
                }
            })
            .catch(err => {
                showAuthMsg('Indi maka-connect sa database server (Connection error).', true);
            });
    });

    regForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(regForm);
        fetch('register.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    showAuthMsg(data.message, false);
                    currentUser = data.user;
                    updateUserBadgeUI();
                    setTimeout(() => {
                        authOverlay.classList.add('hidden');
                        persistAuthVisibility();
                        regForm.reset();
                        authMsg.textContent = '';
                    }, 800);
                } else {
                    showAuthMsg(data.message, true);
                }
            })
            .catch(err => {
                showAuthMsg('Indi maka-connect sa database server (Connection error).', true);
            });
    });

    btnLogout.addEventListener('click', () => {
        fetch('logout.php')
            .then(res => res.json())
            .then(() => {
                currentUser = null;
                updateUserBadgeUI();
                authOverlay.classList.remove('hidden');
                persistAuthVisibility();
                tabLoginBtn.click();
            });
    });

    (function () {
        function lockLandscape() {
            if (screen.orientation && screen.orientation.lock) {
                screen.orientation.lock('landscape').catch(function () { });
            }
        }
        document.addEventListener('DOMContentLoaded', lockLandscape);
        window.addEventListener('orientationchange', lockLandscape);
        document.addEventListener('touchstart', function (e) {
            if (e.touches.length > 1) e.preventDefault();
        }, { passive: false });
        var lastTouchEnd = 0;
        document.addEventListener('touchend', function (e) {
            var now = Date.now();
            if (now - lastTouchEnd <= 300) e.preventDefault();
            lastTouchEnd = now;
        }, { passive: false });
    })();

    spawnBgLetters();
    buildStagePreview();
    buildStageTabs();
    buildGlossary();
    buildOptionsUI();
    wireGridEvents();
    loadManagedQuestions();
    restoreAuthOverlayState();
    checkAuthStatus();

    const savedStoryLoaded = loadSavedStoryState();
    const savedScreen = loadSavedScreenState();
    if (savedScreen === 'story' && savedStoryLoaded) {
        renderStoryScreen();
        goTo('story');
    } else if (savedScreen === 'stageSelect') {
        goTo('stageSelect');
    } else if (savedScreen === 'review') {
        goTo('review');
    } else if (savedScreen === 'options') {
        goTo('options');
    } else if (savedScreen === 'game') {
        goTo('game');
    } else if (savedScreen === 'gameover') {
        goTo('gameover');
    } else if (savedScreen === 'exit') {
        goTo('exit');
    } else {
        goTo('menu');
    }

})();