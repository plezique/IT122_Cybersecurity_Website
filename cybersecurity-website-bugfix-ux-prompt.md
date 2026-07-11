# Bug Fixes & UX Improvements Prompt: CyberSafe Learn

## Objective
Fix functional bugs in the interactive quiz feature and improve password field UX with a show/hide toggle. Maintain the existing dark, elegant, cybersecurity-themed design system throughout all fixes.

---

## 1. Quiz Functionality — Bug Fixes

### Known Issue
The quiz does not function correctly (exact symptoms to confirm/diagnose — see checklist below).

### Diagnostic Checklist
Go through each of these systematically to identify and fix the root cause(s):

- [ ] **Question loading:** Do quiz questions load correctly from the `quiz_questions` table? Check the PHP/JS fetch logic and confirm data is being returned and parsed properly (check browser console + network tab for errors).
- [ ] **Answer selection:** Does clicking/selecting an answer option register correctly? Check event listeners (`onClick`/`addEventListener`) are properly bound, especially if questions are rendered dynamically (listeners may not attach to dynamically injected elements).
- [ ] **Answer validation:** Is the selected answer being compared correctly against `correct_answer` in the database? Check for data type mismatches (e.g., string vs int) or case sensitivity issues (`"A"` vs `"a"`).
- [ ] **Feedback display:** Does the correct/incorrect explanation show properly after answering? Confirm the explanation text and correct/incorrect styling render as intended.
- [ ] **Score tracking:** Is the score incrementing correctly per question? Check for off-by-one errors or score resets mid-quiz.
- [ ] **Question progression:** Does the quiz correctly move to the next question after answering, and does it stop after the last question?
- [ ] **Results summary:** Does the final results page/section calculate and display the correct score, total questions, and awareness level (Beginner/Intermediate/Advanced)?
- [ ] **Result saving (if logged in):** Are quiz results being correctly inserted into the `quiz_results` table via prepared statements? Confirm `user_id`, `score`, `total_questions`, and `date_taken` are saving accurately.
- [ ] **Retake functionality:** Can the user retake the quiz without needing to refresh the page, and does state reset properly (no leftover selected answers or old scores)?
- [ ] **Edge cases:** What happens if a user refreshes mid-quiz, double-clicks an answer, or navigates away and back?

### Fix Requirements
- Add proper error handling (try/catch on fetch calls, fallback UI if questions fail to load — e.g., "Unable to load quiz. Please try again.")
- Ensure all quiz state (current question index, selected answers, score) is managed cleanly (e.g., centralized state object if using vanilla JS, or proper state management if using React)
- Add console logging temporarily during debugging, then remove/clean up before final submission
- Test the full quiz flow end-to-end after fixes: load → answer all questions → view results → retake

---

## 2. Password Field UX — Show/Hide Toggle

### Requirement
Add a show/hide password toggle (eye icon) to **all password input fields** across the site — registration form, login form, and any password-related fields (e.g., change password, if applicable).

### Functional Specs
- Icon should sit inside the input field, right-aligned, vertically centered
- Default state: password hidden (`type="password"`), eye icon shown in "closed/crossed-out" state
- On click: toggle input `type` between `password` and `text`, and swap icon to reflect state (open eye = visible, closed/slashed eye = hidden)
- Toggle should work independently for each password field if multiple exist on the same page (e.g., "Password" and "Confirm Password" fields should each have their own independent toggle)
- Must be accessible:
  - Use a `<button type="button">` (not a submit button) to avoid accidentally submitting the form
  - Add `aria-label` that updates dynamically (e.g., "Show password" / "Hide password")
  - Ensure it's keyboard-navigable (tab-focusable, activates on Enter/Space)

### Visual Design (matching existing site aesthetic)
- Icon style: simple line-art eye icon (open/closed states), matching the thin-stroke, minimal icon style used elsewhere on the site
- Color: muted gray by default, accent color (e.g., glow green) on hover/focus to stay consistent with the site's interactive states
- No emoji-based icons — use SVG icons only

### Implementation Notes
```html
<div class="password-field">
  <input type="password" id="password" name="password" />
  <button type="button" class="toggle-password" aria-label="Show password" data-target="password">
    <!-- SVG eye icon here, swapped via JS -->
  </button>
</div>
```
```javascript
document.querySelectorAll('.toggle-password').forEach(btn => {
  btn.addEventListener('click', () => {
    const input = document.getElementById(btn.dataset.target);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
    btn.classList.toggle('is-visible', isHidden);
  });
});
```

---

## 3. General UX Polish (Optional but Recommended)

- Add subtle transition/animation when toggling password visibility (e.g., quick fade on icon swap) to match the site's calm, controlled motion style
- Add real-time password strength feedback near the field if not already present, reusing the password strength checker tool from the quiz/tools page for consistency
- Ensure form validation messages (e.g., "Passwords do not match") are styled consistently with the site's dark theme and accent colors, not default browser red-alert styling
- Confirm all fixes are tested across major browsers (Chrome, Firefox, Edge) and on mobile screen sizes

---

## 4. Deliverables

- Fixed, fully functional quiz (load → answer → score → results → retake, all working correctly)
- Show/hide password toggle implemented on all password fields sitewide
- Brief changelog/notes summarizing what was broken and what was fixed (useful for documentation or grading purposes)
