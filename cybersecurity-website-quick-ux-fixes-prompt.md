# Quick UX Fixes Prompt: CyberSafe Learn

## Objective
Address three UX issues found during light mode review: low contrast making elements hard to see, an unnecessary nav item, and missing per-module quizzes for the Learn section.

---

## 1. Fix Light Mode Contrast

### Issue
In light mode, several elements are too faint and hard to distinguish against the background — this includes the shield/lock icons, floating tag labels ("ENCRYPTED", "VERIFIED", "THREAT DETECTED"), section dividers, and secondary icons. Everything currently reads as washed-out gray-on-gray.

### Fix Requirements
- **Icons (lock, shield, chip/circuit icons):** Increase contrast against the light background. Replace faint gray (`#D8DCD9`-range) with a darker, more defined stroke color (e.g., `#4A544D` or similar deep neutral) so they're clearly visible without needing to squint
- **Floating data tags** (e.g., "ENCRYPTED", "VERIFIED", "THREAT DETECTED"): Currently blend into the background in light mode. Give them a clearly visible background fill (light green tint, e.g., `#E3F5E6`) with a defined border (e.g., `#3FAE5C` or darker) and readable text color — should look like a distinct badge/chip, not a ghost element
- **Hero illustration (shield graphic):** The large shield/lock hero visual is nearly invisible in light mode. Increase the outline contrast and consider adding a subtle fill or shadow so the shape reads clearly against the background, similar to how it pops in dark mode
- **Borders and dividers:** Darken slightly from the original `#D8DCD9` to something with more definition (e.g., `#C2C8C4`) so section boundaries and card outlines are visible
- **General rule:** Every icon, illustration, badge, and border in light mode should pass a quick visual check — if it's hard to spot at a glance, it needs more contrast. Re-test against WCAG AA (3:1 minimum for graphical/UI elements, 4.5:1 for text)

### Suggested Updated Light Mode Values
```css
[data-theme="light"] {
  --bg-primary: #F5F7F5;
  --bg-surface: #EAEDEA;
  --text-primary: #101512;
  --text-secondary: #4A544D;      /* darkened from #5C645F for better readability */
  --accent: #2E9A4C;               /* deepened slightly for stronger contrast */
  --border: #C2C8C4;               /* darkened from #D8DCD9 */
  --icon-default: #4A544D;         /* new: dedicated icon color, no longer near-invisible */
  --badge-bg: #E3F5E6;             /* new: visible background for floating tags */
  --badge-border: #2E9A4C;
}
```

---

## 2. Remove "Tips" from Header Navigation

### Fix Requirements
- Remove the "TIPS" nav item from the main header navigation bar
- Update nav order to: `HOME | LEARN | QUIZ & TOOLS | RESOURCES | ABOUT`
- If the Tips/Cheat Sheet page still exists on the site, keep the page itself intact — just remove it from the top-level nav (it can live as a link within the Resources page or footer instead, so the content isn't lost, just decluttered from the main menu)
- Double check mobile nav (hamburger menu) reflects the same update

---

## 3. Add Per-Module Quizzes

### Issue
Currently there's only one general quiz under "Quiz & Tools." Each learning module (Basics, Passwords & MFA, Phishing, Malware, Network Safety, Safe Browsing, Mobile Security, Social Media Privacy) should have its own short quiz to reinforce that specific topic.

### Fix Requirements
- Add a short quiz (5-8 questions) at the end of each individual learning module page
- Reuse the existing quiz component/functionality — same UI style, scoring logic, and answer feedback already built for the general quiz — just scoped to a specific module's `category`
- Update the `quiz_questions` table usage: filter questions by `category` matching the module (this should already be supported by the existing schema — just needs to be wired up per module page instead of pulling the full question pool)
- Each module quiz should:
  - Appear as a distinct section at the bottom of the module page (e.g., "Test Your Knowledge: Phishing & Social Engineering")
  - Show a short results summary specific to that module (score out of total, pass/fail or awareness level)
  - Save results to `quiz_results` with a way to distinguish which module the result belongs to (add a `module_id` or `category` column to `quiz_results` if not already present)
- The general "Quiz & Tools" page can remain as a longer, mixed-topic quiz pulling from all categories — module quizzes are additional, not a replacement

### Database Note
If `quiz_results` doesn't currently track which quiz/module a result belongs to, add a column:
```sql
ALTER TABLE quiz_results ADD COLUMN module_id INT NULL;
ALTER TABLE quiz_results ADD FOREIGN KEY (module_id) REFERENCES modules(module_id);
```
This allows the dashboard (if user accounts are implemented) to show progress per module, not just an overall score.

---

## 4. Deliverables

- Light mode with corrected contrast across icons, badges, hero illustration, and borders — verified visually and against WCAG AA where applicable
- Header nav updated (Tips removed, updated order confirmed on desktop and mobile)
- Each learning module page includes its own scoped quiz, fully functional (load, answer, score, results, retake)
- Updated database schema if needed to track per-module quiz results
