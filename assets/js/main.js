/**
 * Main JavaScript — mobile navigation, scroll animations, and UI helpers
 */

document.addEventListener('DOMContentLoaded', () => {
    initThemeToggle();
    initMobileNav();
    initQuizTabs();
    initScrollReveal();
    initHeroParallax();
});

const THEME_STORAGE_KEY = 'cybersafe-theme';

function getPreferredTheme() {
    const saved = localStorage.getItem(THEME_STORAGE_KEY);
    if (saved === 'light' || saved === 'dark') {
        return saved;
    }
    return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
}

function applyTheme(theme, animate = false) {
    const root = document.documentElement;
    const body = document.body;

    if (animate) {
        body.classList.add('theme-animate');
    }

    if (theme === 'light') {
        root.setAttribute('data-theme', 'light');
    } else {
        root.removeAttribute('data-theme');
    }

    localStorage.setItem(THEME_STORAGE_KEY, theme);
    updateThemeToggleUI(theme);

    if (animate) {
        window.setTimeout(() => {
            body.classList.remove('theme-animate');
        }, 300);
    }
}

function updateThemeToggleUI(theme) {
    const toggle = document.querySelector('.theme-toggle');
    if (!toggle) return;

    const isLight = theme === 'light';
    toggle.setAttribute('aria-pressed', String(isLight));
    toggle.setAttribute('aria-label', isLight ? 'Switch to dark mode' : 'Switch to light mode');
    toggle.setAttribute('title', isLight ? 'Switch to dark mode' : 'Switch to light mode');
}

function initThemeToggle() {
    const toggle = document.querySelector('.theme-toggle');
    if (!toggle) return;

    updateThemeToggleUI(getPreferredTheme());

    toggle.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
        applyTheme(currentTheme === 'light' ? 'dark' : 'light', true);
    });

    window.matchMedia('(prefers-color-scheme: light)').addEventListener('change', (event) => {
        if (localStorage.getItem(THEME_STORAGE_KEY)) return;
        applyTheme(event.matches ? 'light' : 'dark', true);
    });
}

function initMobileNav() {
    const navToggle = document.querySelector('.nav-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (!navToggle || !mainNav) return;

    navToggle.addEventListener('click', () => {
        const isOpen = mainNav.classList.toggle('open');
        navToggle.setAttribute('aria-expanded', isOpen);
    });

    mainNav.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            mainNav.classList.remove('open');
            navToggle.setAttribute('aria-expanded', 'false');
        });
    });
}

function initQuizTabs() {
    const quizTabs = document.querySelectorAll('.quiz-tab');
    const quizPanels = document.querySelectorAll('.quiz-panel');

    quizTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.tab;

            quizTabs.forEach(t => t.classList.remove('active'));
            quizPanels.forEach(p => p.classList.remove('active'));

            tab.classList.add('active');
            const panel = document.getElementById(target);
            if (panel) panel.classList.add('active');
        });
    });
}

function initScrollReveal() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const revealElements = document.querySelectorAll('.reveal');

    if (!revealElements.length) return;

    if (prefersReducedMotion) {
        revealElements.forEach(el => el.classList.add('visible'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -40px 0px'
    });

    revealElements.forEach(el => observer.observe(el));
}

function initHeroParallax() {
    const heroVisual = document.querySelector('.hero-shield-wrap');
    const floaters = document.querySelectorAll('.floater');
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion || !heroVisual) return;

    let ticking = false;

    function onMouseMove(e) {
        if (ticking) return;
        ticking = true;

        requestAnimationFrame(() => {
            const x = (e.clientX / window.innerWidth - 0.5) * 2;
            const y = (e.clientY / window.innerHeight - 0.5) * 2;

            heroVisual.style.transform = `translate(${x * 8}px, ${y * 6}px)`;

            floaters.forEach((floater, i) => {
                const factor = (i + 1) * 3;
                floater.style.transform = `translate(${x * factor}px, ${y * factor}px)`;
            });

            ticking = false;
        });
    }

    document.addEventListener('mousemove', onMouseMove, { passive: true });
}
