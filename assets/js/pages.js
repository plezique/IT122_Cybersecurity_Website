/**
 * Page-specific rendering for static HTML pages.
 */

function formatParagraphs(text) {
    if (!text) return '';
    return text.split('\n\n').map(p => `<p>${escapeHtml(p)}</p>`).join('');
}

function getTipOfTheDay() {
    const featured = CYBERSAFE_DATA.tips.filter(t => t.is_featured);
    const pool = featured.length ? featured : CYBERSAFE_DATA.tips;
    const dayIndex = new Date().getDate() % pool.length;
    return pool[dayIndex];
}

function initIndexPage() {
    const tipEl = document.getElementById('tip-of-day');
    if (!tipEl) return;

    const tip = getTipOfTheDay();
    tipEl.innerHTML = `
        <div class="tip-widget reveal" role="complementary" aria-label="Tip of the Day">
            <div class="tip-label">${getIcon('signal')} Tip of the Day</div>
            <p>${escapeHtml(tip.tip_text)}</p>
            <span class="tip-category">${escapeHtml(tip.category)}</span>
        </div>`;
}

function initLearnPage() {
    const grid = document.getElementById('module-grid');
    if (!grid) return;

    grid.innerHTML = CYBERSAFE_DATA.modules.map((mod, i) => `
        <a href="module.html?id=${mod.id}" class="card card-link reveal${i % 4 ? ` reveal-delay-${i % 4}` : ''}">
            <div class="card-icon" aria-hidden="true">${getModuleIcon(mod.icon)}</div>
            <h3>${escapeHtml(mod.title)}</h3>
            <p>${escapeHtml(mod.category)}</p>
        </a>`).join('');
}

function initModulePage() {
    const params = new URLSearchParams(window.location.search);
    const moduleId = parseInt(params.get('id'), 10);
    const module = CYBERSAFE_DATA.modules.find(m => m.id === moduleId);

    if (!module) {
        window.location.href = 'learn.html';
        return;
    }

    document.title = `${module.title} | ${CYBERSAFE_DATA.siteName}`;

    const headerEl = document.getElementById('module-header');
    const contentEl = document.getElementById('module-content');
    const quizEl = document.getElementById('module-quiz-area');

    if (headerEl) {
        headerEl.innerHTML = `
            <p class="text-muted mb-2"><a href="learn.html">&larr; Back to Modules</a></p>
            <span class="data-tag">${escapeHtml(module.category)}</span>
            <h1 class="mt-2">${escapeHtml(module.title)}</h1>`;
    }

    const quizTitle = document.getElementById('module-quiz-title');
    if (quizTitle) {
        quizTitle.textContent = `Test Your Knowledge: ${module.title}`;
    }

    if (contentEl) {
        let html = '<h2>Overview</h2>' + formatParagraphs(module.content);
        if (module.example_text) {
            html += `<div class="example-box"><h4>Real-World Example</h4><p>${escapeHtml(module.example_text)}</p></div>`;
        }
        if (module.key_takeaway) {
            html += `<div class="takeaway-box"><h4>Key Takeaway</h4><p>${escapeHtml(module.key_takeaway)}</p></div>`;
        }
        contentEl.innerHTML = html;
    }

    if (quizEl) {
        const questions = CYBERSAFE_DATA.questions.filter(q => q.category === module.category);
        if (!questions.length) {
            quizEl.innerHTML = `
                <div class="alert alert-info mt-2">
                    Quiz questions for this module are coming soon.
                    <a href="quiz.html">Try the general awareness quiz</a> in the meantime.
                </div>`;
            return;
        }

        quizEl.innerHTML = `
            <div class="quiz-container">
                <div class="quiz-engine"
                     data-quiz-type="module"
                     data-module-id="${module.id}">
                    <div class="quiz-progress"><div class="quiz-progress-bar"></div></div>
                    <div class="quiz-question-area">
                        <div class="question-card">
                            <h3 class="quiz-question-text"></h3>
                            <ul class="quiz-options"></ul>
                            <div class="explanation-box" style="display:none;"></div>
                        </div>
                        <button class="btn btn-primary quiz-next-btn" style="display:none;">Next Question</button>
                    </div>
                    <div class="quiz-result" style="display:none;">
                        <div class="score-circle"><span class="score-value"></span></div>
                        <div class="awareness-badge"></div>
                        <h3>Module Quiz Complete!</h3>
                        <p class="result-message"></p>
                        <button type="button" class="btn btn-outline mt-2 quiz-retake-btn">Retake Quiz</button>
                    </div>
                </div>
            </div>`;

        const engine = quizEl.querySelector('.quiz-engine');
        engine.dataset.questions = JSON.stringify(questions);
        initQuiz(engine);
    }
}

function initTipsPage() {
    const container = document.getElementById('tips-container');
    if (!container) return;

    const byCategory = {};
    CYBERSAFE_DATA.tips.forEach(tip => {
        if (!byCategory[tip.category]) byCategory[tip.category] = [];
        byCategory[tip.category].push(tip.tip_text);
    });

    container.innerHTML = Object.entries(byCategory).map(([category, tips]) => `
        <div class="tips-category">
            <h2>${escapeHtml(category)}</h2>
            <ul class="tip-list">
                ${tips.map(t => `<li>${escapeHtml(t)}</li>`).join('')}
            </ul>
        </div>`).join('');
}

function initResourcesPage() {
    const toolsEl = document.getElementById('tools-container');
    const glossaryEl = document.getElementById('glossary-container');
    if (!toolsEl || !glossaryEl) return;

    const categoryOrder = [
        'Password Managers',
        'VPN Services',
        'Antivirus Tools',
        'Browser Privacy & Security Extensions',
        'Two-Factor Authentication (2FA) Apps',
        'Data Breach & Security Check Tools',
        'Learning & News Sources',
        'Mobile Security Tools',
    ];

    const pricingLabels = {
        free: 'Free',
        paid: 'Paid',
        freemium: 'Freemium',
        'built-in': 'Built-in',
    };

    const byCategory = {};
    CYBERSAFE_DATA.tools.forEach(tool => {
        if (!byCategory[tool.category]) byCategory[tool.category] = [];
        byCategory[tool.category].push(tool);
    });

    const sortedCategories = Object.keys(byCategory).sort((a, b) => {
        const posA = categoryOrder.indexOf(a);
        const posB = categoryOrder.indexOf(b);
        const orderA = posA === -1 ? Number.MAX_SAFE_INTEGER : posA;
        const orderB = posB === -1 ? Number.MAX_SAFE_INTEGER : posB;
        return orderA - orderB;
    });

    toolsEl.innerHTML = sortedCategories.map(category => {
        const tools = byCategory[category];
        return `
        <h3 class="mt-3 mb-2" style="color: var(--color-text); font-family: var(--font-heading);">${escapeHtml(category)}</h3>
        <div class="card-grid mb-3">
            ${tools.map(tool => `
                <div class="card">
                    <div class="resource-card">
                        <span class="resource-icon" aria-hidden="true">${getIcon('tool')}</span>
                        <div>
                            <div class="resource-card-header">
                                <h3>${escapeHtml(tool.name)}</h3>
                                ${tool.pricing && pricingLabels[tool.pricing] ? `<span class="resource-pricing-tag">${escapeHtml(pricingLabels[tool.pricing])}</span>` : ''}
                            </div>
                            <p>${escapeHtml(tool.description)}</p>
                            ${tool.url ? `<a href="${escapeHtml(tool.url)}" target="_blank" rel="noopener noreferrer">Visit website &rarr;</a>` : ''}
                        </div>
                    </div>
                </div>`).join('')}
        </div>`;
    }).join('');

    glossaryEl.innerHTML = CYBERSAFE_DATA.glossary.map(term => `
        <div class="glossary-item">
            <dt>${escapeHtml(term.name)}</dt>
            <dd>${escapeHtml(term.description)}</dd>
        </div>`).join('');
}

function initQuizPage() {
    const phishing = CYBERSAFE_DATA.questions.filter(q => q.quiz_type === 'phishing');
    const awareness = CYBERSAFE_DATA.questions.filter(q => q.quiz_type === 'awareness');

    const phishingEngine = document.getElementById('phishing-quiz-engine');
    const awarenessEngine = document.getElementById('awareness-quiz-engine');

    if (phishingEngine) {
        phishingEngine.dataset.questions = JSON.stringify(phishing);
    }
    if (awarenessEngine) {
        awarenessEngine.dataset.questions = JSON.stringify(awareness);
    }

    document.querySelectorAll('.quiz-engine').forEach(initQuiz);
}

document.addEventListener('DOMContentLoaded', () => {
    const page = document.body.dataset.page;
    switch (page) {
        case 'index': initIndexPage(); break;
        case 'learn': initLearnPage(); break;
        case 'module': initModulePage(); break;
        case 'tips': initTipsPage(); break;
        case 'resources': initResourcesPage(); break;
        case 'quiz': initQuizPage(); break;
    }
});
