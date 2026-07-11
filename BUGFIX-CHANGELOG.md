# Bug Fix & UX Changelog

## Quiz Functionality

### Issues found
- Answer selection used `click` on labels instead of `change` on radios, so keyboard navigation did not register answers.
- Both quizzes shared the same radio `name`, which could cause cross-quiz interference when both panels were on the same page.
- Correct-answer comparison was case-sensitive and did not trim whitespace.
- Empty or invalid question data failed silently with no user feedback.
- Retake required a full page reload instead of resetting quiz state in place.
- Double-clicking options could fire multiple handlers before state locked.

### Fixes applied
- Centralized quiz state (`currentIndex`, `score`, `answered`) per quiz instance.
- Unique radio group names per quiz engine.
- Normalized answer comparison with trim + uppercase.
- Switched to `change` events on radio inputs for reliable selection (mouse, keyboard, touch).
- Added fallback UI: "Unable to load quiz. Please try again."
- Added in-place retake via `.quiz-retake-btn` without page reload.
- Disabled options and blocked pointer events after each answer to prevent double submission.
- Highlighting now uses each option's value instead of list index.

## Password Field UX

### Added
- Show/hide password toggle on all password fields:
  - Login (`auth/login.php`)
  - Registration (`auth/register.php`) — Password and Confirm Password
  - Password checker tool (`quiz.php`)
- Accessible toggle buttons (`type="button"`, dynamic `aria-label`, keyboard Enter/Space support).
- SVG eye icons (open = visible, slashed = hidden) matching the site's line-art style.
- Muted gray default color with accent green on hover/focus.
- Real-time password strength feedback on the registration form (reuses checker logic).
- Live "Passwords do not match" hint on registration confirm field.
- Strength meter colors aligned with the dark theme CSS variables.

## Files changed
- `assets/js/quiz.js`
- `assets/js/password-toggle.js` (new)
- `assets/js/password-checker.js`
- `assets/css/style.css`
- `quiz.php`
- `auth/login.php`
- `auth/register.php`
- `includes/footer.php`
- `includes/icons.php`
