/**
 * Password show/hide toggle — works on all .password-field wrappers sitewide.
 */

const EYE_OPEN_SVG =
    '<svg class="toggle-password-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';

const EYE_OFF_SVG =
    '<svg class="toggle-password-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/><path d="M1 1l22 22"/><path d="M14.12 14.12a3 3 0 01-4.24-4.24"/></svg>';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-password').forEach(initPasswordToggle);
});

function initPasswordToggle(btn) {
    const targetId = btn.dataset.target;
    const input = targetId ? document.getElementById(targetId) : btn.closest('.password-field')?.querySelector('input');

    if (!input) return;

    btn.innerHTML = EYE_OFF_SVG;
    btn.setAttribute('aria-label', 'Show password');

    btn.addEventListener('click', () => {
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        btn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
        btn.classList.toggle('is-visible', isHidden);
        btn.innerHTML = isHidden ? EYE_OPEN_SVG : EYE_OFF_SVG;
    });

    btn.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            btn.click();
        }
    });
}
