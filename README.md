# CyberSafe Learn

A responsive, educational cybersecurity awareness website built with **HTML, CSS, JavaScript, and Bootstrap**. Designed for students and everyday internet users to learn practical online safety skills through interactive modules, quizzes, and tools.

**Live site:** Deployed on GitHub Pages (see Setup below).

## Features

- **8 Learning Modules** — Passwords, phishing, malware, Wi-Fi safety, and more
- **Interactive Quizzes** — Phishing identification quiz and security awareness scored quiz
- **Password Strength Checker** — Client-side tool (no data sent to server)
- **Tip of the Day** — Randomly selected from featured tips
- **Quick Tips Cheat Sheet** — Printable/PDF-friendly tips by category
- **Resources & Glossary** — Curated tools and term definitions
- **Dark / Light Theme** — Toggle with preference saved in browser

## Technologies Used

| Technology | Purpose |
|------------|---------|
| HTML5 | Page structure and semantic markup |
| CSS3 | Custom dark/light theme styling |
| JavaScript | Quizzes, password checker, dynamic content |
| Bootstrap 5 | Responsive grid and layout |
| GitHub Pages | Static site hosting |

## Project Structure

```
CYBERSECURITY WEB/
├── index.html             # Home page
├── learn.html             # Learning modules list
├── module.html            # Single module view (?id=1)
├── quiz.html              # Quizzes and password checker
├── tips.html              # Quick tips cheat sheet
├── resources.html         # Tools and glossary
├── about.html             # About page
├── assets/
│   ├── css/style.css      # Custom theme styles
│   └── js/
│       ├── data.js        # All site content (modules, tips, quizzes)
│       ├── icons.js       # SVG icon helpers
│       ├── layout.js      # Shared header/footer
│       ├── pages.js       # Page-specific rendering
│       ├── main.js        # Navigation, theme toggle, animations
│       ├── quiz.js        # Interactive quiz engine
│       ├── password-checker.js
│       └── password-toggle.js
└── .nojekyll              # GitHub Pages config
```

## Local Development

1. Clone the repository
2. Open any `.html` file in VS Code
3. Use the **Live Server** extension to preview (recommended)
4. Or open `index.html` directly in a browser

No database or server setup required.

## Deploy to GitHub Pages

1. Push this project to a GitHub repository
2. Go to **Settings → Pages**
3. Under **Source**, select **Deploy from branch**
4. Choose the `main` branch and `/ (root)` folder
5. Click **Save**
6. Your site will be live at `https://yourusername.github.io/repo-name/`

## Quiz Progress

Quiz results are saved in your browser's `localStorage` — no account or server needed. Progress stays on your device only.

## For Academic Submission

- **Course:** IT 122 — Information Assurance Security 2
- **Institution:** Bicol University Polangui
- **Authors:** Enrick Guiller Relos | Danielle Sapico
- **Year:** 2026

## License

Educational project — IT 122, 2026.
