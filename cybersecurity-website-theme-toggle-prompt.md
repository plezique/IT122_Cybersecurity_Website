# Feature Prompt: Dark/Light Mode Toggle

## Objective
Add a theme switcher that lets users toggle between dark mode (current design) and a new light mode variant, without breaking the site's elegant, cybersecurity-themed aesthetic in either state.

---

## 1. Toggle Functionality

- Add a toggle switch (sun/moon icon style, not emoji — use SVG icons) in the top navigation, near the "Let's Talk" CTA
- Default theme: Dark mode (matches current design)
- Store user preference in `localStorage` so the theme persists across page reloads and visits
- On load, check for saved preference first; if none exists, optionally respect the user's OS-level preference (`prefers-color-scheme`)
- Smooth transition (fade, ~200-300ms) when switching themes — no jarring flash

---

## 2. Light Mode Color Palette

Keep the same structure and hierarchy as dark mode, just inverted and rebalanced for contrast:

- **Background:** Soft off-white (e.g., `#F5F7F5`) — avoid pure white, keep it slightly warm/neutral to match the premium feel
- **Surface/cards:** Slightly darker neutral (e.g., `#EAEDEA`) for section separation
- **Primary text:** Deep near-black green or charcoal (e.g., `#101512`) for headings
- **Secondary text:** Muted gray (e.g., `#5C645F`) for body copy
- **Accent color:** Keep the same glowing green/lime accent, but slightly deepen/desaturate it for light backgrounds (e.g., `#4CAF3D` or `#3FAE5C`) so it doesn't look washed out or lose contrast against white
- **Borders/dividers:** Light gray (e.g., `#D8DCD9`) instead of the subtle dark borders used in dark mode

---

## 3. Contrast & Accessibility Checks

- Test all text/background combinations against WCAG AA contrast minimums (4.5:1 for body text, 3:1 for large text)
- Accent color on light background must still be readable — avoid the "neon on white looks washed out" problem by darkening it slightly compared to the dark-mode version
- Icons, borders, and glow effects should have light-mode equivalents (glow effects especially — a bright glow that works on black can look messy on white, so soften or replace with a subtle shadow/border highlight instead)
- Form fields, buttons, and the password show/hide toggle must remain clearly visible and usable in both themes

---

## 4. Implementation Notes

- Use CSS variables (custom properties) for all colors so switching themes is just swapping variable values at the root/body level, not duplicating styles
- Example structure:

```css
:root {
  --bg-primary: #0A0F0C;
  --bg-surface: #121915;
  --text-primary: #F5F5F0;
  --text-secondary: #A8B0AA;
  --accent: #C6FF3D;
  --border: #1E2A22;
}

[data-theme="light"] {
  --bg-primary: #F5F7F5;
  --bg-surface: #EAEDEA;
  --text-primary: #101512;
  --text-secondary: #5C645F;
  --accent: #3FAE5C;
  --border: #D8DCD9;
}
```

- Toggle logic simply sets `data-theme="light"` or removes it from the `<html>` or `<body>` tag, and saves the value to `localStorage`

---

## 5. Testing Checklist

- [ ] Toggle switches themes instantly and correctly across all pages (Home, Modules, Quiz, Resources, About)
- [ ] Theme choice persists after page refresh/navigation
- [ ] All text remains readable in both modes (no low-contrast text)
- [ ] All icons (nav, password eye toggle, module icons) have visible versions in both themes
- [ ] 3D visuals/floating elements and glow effects don't look broken or overly harsh in light mode
- [ ] Quiz correct/incorrect states, buttons, and form fields are clearly visible in both themes

---

## 6. Deliverable

Fully functional dark/light mode toggle, default to dark, persisted via `localStorage`, with a light mode palette that maintains the site's elegant/cybersecurity identity and passes basic accessibility contrast checks.
