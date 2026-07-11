/**
 * Shared site header and footer for static HTML pages.
 */
const SITE_NAME = 'CyberSafe Learn';

function isActivePage(currentPage, linkPage) {
    if (linkPage === 'learn' && (currentPage === 'learn' || currentPage === 'module')) return 'active';
    return currentPage === linkPage ? 'active' : '';
}

function renderHeader(currentPage) {
    return `
    <a href="#main-content" class="skip-link">Skip to main content</a>
    <header class="site-header">
        <div class="container header-inner">
            <a href="index.html" class="logo">
                <span class="logo-icon" aria-hidden="true">${getIcon('shield', 'logo-icon-svg')}</span>
                <span class="logo-text">${SITE_NAME}</span>
            </a>
            <nav class="main-nav" aria-label="Main navigation">
                <ul>
                    <li><a href="index.html" class="${isActivePage(currentPage, 'index')}">Home</a></li>
                    <li><a href="learn.html" class="${isActivePage(currentPage, 'learn')}">Learn</a></li>
                    <li><a href="quiz.html" class="${isActivePage(currentPage, 'quiz')}">Quiz &amp; Tools</a></li>
                    <li><a href="resources.html" class="${isActivePage(currentPage, 'resources')}">Resources</a></li>
                    <li><a href="about.html" class="${isActivePage(currentPage, 'about')}">About</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <button type="button" class="theme-toggle" aria-label="Switch to light mode" aria-pressed="false" title="Toggle dark/light mode">
                    <span class="theme-toggle-track" aria-hidden="true">
                        <span class="theme-toggle-icon theme-toggle-icon--sun">${getIcon('sun', 'theme-toggle-svg')}</span>
                        <span class="theme-toggle-icon theme-toggle-icon--moon">${getIcon('moon', 'theme-toggle-svg')}</span>
                        <span class="theme-toggle-thumb">
                            <span class="theme-toggle-thumb-icon theme-toggle-thumb-icon--sun">${getIcon('sun', 'theme-toggle-svg')}</span>
                            <span class="theme-toggle-thumb-icon theme-toggle-thumb-icon--moon">${getIcon('moon', 'theme-toggle-svg')}</span>
                        </span>
                    </span>
                </button>
                <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </header>`;
}

function renderFooter() {
    const year = new Date().getFullYear();
    return `
    <footer class="site-footer">
        <div class="container footer-inner">
            <div class="footer-brand">
                <strong>${SITE_NAME}</strong>
                <p>Educational cybersecurity awareness for everyone.</p>
            </div>
            <nav class="footer-nav" aria-label="Footer navigation">
                <a href="learn.html">Learn</a>
                <a href="quiz.html">Quiz</a>
                <a href="tips.html">Tips</a>
                <a href="resources.html">Resources</a>
                <a href="about.html">About</a>
            </nav>
            <p class="footer-disclaimer">&copy; ${year} ${SITE_NAME}. For educational purposes only.</p>
        </div>
    </footer>`;
}

function initLayout() {
    const currentPage = document.body.dataset.page || '';
    const headerEl = document.getElementById('site-header');
    const footerEl = document.getElementById('site-footer');

    if (headerEl) headerEl.innerHTML = renderHeader(currentPage);
    if (footerEl) footerEl.innerHTML = renderFooter();
}

document.addEventListener('DOMContentLoaded', initLayout);
