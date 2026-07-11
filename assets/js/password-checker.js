/**
 * Password Strength Checker — runs entirely client-side.
 * Supports the quiz tool page and registration form.
 */

document.addEventListener('DOMContentLoaded', () => {
    initPasswordCheckerTool();
    initRegisterPasswordStrength();
});

const STRENGTH_CRITERIA = [
    { id: 'length', test: (p) => p.length >= 12 },
    { id: 'upper', test: (p) => /[A-Z]/.test(p) },
    { id: 'lower', test: (p) => /[a-z]/.test(p) },
    { id: 'number', test: (p) => /[0-9]/.test(p) },
    { id: 'special', test: (p) => /[^A-Za-z0-9]/.test(p) },
    { id: 'unique', test: (p) => !/(.)\1{2,}/.test(p) },
];

function scorePassword(password) {
    let score = 0;

    STRENGTH_CRITERIA.forEach((criterion) => {
        if (criterion.test(password)) score++;
    });

    if (password.length >= 16) score += 0.5;
    if (password.length >= 20) score += 0.5;

    return score;
}

function getStrengthMeta(password, score) {
    if (password.length === 0) {
        return { label: 'Enter a password to check', className: 'strength-empty' };
    }
    if (score <= 2) {
        return { label: 'Weak', className: 'strength-weak' };
    }
    if (score <= 4) {
        return { label: 'Fair', className: 'strength-fair' };
    }
    if (score <= 5) {
        return { label: 'Good', className: 'strength-good' };
    }
    return { label: 'Strong', className: 'strength-strong' };
}

function updateStrengthUI(password, meterEl, labelEl, criteriaList) {
    const score = scorePassword(password);
    const percentage = Math.min(100, (score / STRENGTH_CRITERIA.length) * 100);
    const meta = getStrengthMeta(password, score);

    if (meterEl) {
        meterEl.style.width = `${percentage}%`;
        meterEl.className = `strength-meter-fill ${meta.className}`;
    }

    if (labelEl) {
        labelEl.textContent = meta.label;
        labelEl.className = `strength-label ${meta.className}`;
    }

    if (criteriaList) {
        STRENGTH_CRITERIA.forEach((criterion) => {
            const met = criterion.test(password);
            const li = criteriaList.querySelector(`[data-criterion="${criterion.id}"]`);
            if (li) {
                li.classList.toggle('met', met);
                li.classList.toggle('unmet', !met);
            }
        });
    }
}

function initPasswordCheckerTool() {
    const passwordInput = document.getElementById('password-input');
    const strengthMeter = document.getElementById('strength-meter-fill');
    const strengthLabel = document.getElementById('strength-label');
    const criteriaList = document.getElementById('strength-criteria');

    if (!passwordInput) return;

    passwordInput.addEventListener('input', () => {
        updateStrengthUI(passwordInput.value, strengthMeter, strengthLabel, criteriaList);
    });
}

function initRegisterPasswordStrength() {
    const passwordInput = document.querySelector('[data-strength-check]');
    const confirmInput = document.getElementById('confirm_password');
    const strengthMeter = document.getElementById('register-strength-fill');
    const strengthLabel = document.getElementById('register-strength-label');
    const matchHint = document.getElementById('password-match-hint');

    if (!passwordInput) return;

    function updateMatchHint() {
        if (!confirmInput || !matchHint) return;

        const mismatch = confirmInput.value.length > 0 && passwordInput.value !== confirmInput.value;
        matchHint.hidden = !mismatch;
    }

    passwordInput.addEventListener('input', () => {
        const password = passwordInput.value;
        const label = password.length === 0
            ? 'At least 6 characters required'
            : getStrengthMeta(password, scorePassword(password)).label;

        if (strengthMeter) {
            const score = scorePassword(password);
            const percentage = Math.min(100, (score / STRENGTH_CRITERIA.length) * 100);
            const meta = getStrengthMeta(password, score);
            strengthMeter.style.width = `${percentage}%`;
            strengthMeter.className = `strength-meter-fill ${meta.className}`;
        }

        if (strengthLabel) {
            strengthLabel.textContent = label;
            strengthLabel.className = `strength-label ${password.length ? getStrengthMeta(password, scorePassword(password)).className : ''}`;
        }

        updateMatchHint();
    });

    if (confirmInput) {
        confirmInput.addEventListener('input', updateMatchHint);
    }
}
