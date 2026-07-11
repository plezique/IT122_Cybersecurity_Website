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

## Run Locally with XAMPP

The full version of the site (login, dashboard, admin panel, and database-backed content) runs on **PHP + MySQL** via XAMPP.

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) installed (Apache + MySQL + PHP)
- The project folder placed in your XAMPP `htdocs` directory

### Setup Steps

1. **Copy the project into `htdocs`**
   - Example: `C:\xampp\htdocs\CYBERSECURITY WEB\`

2. **Start XAMPP services**
   - Open the XAMPP Control Panel
   - Start **Apache**
   - Start **MySQL**

3. **Create the database**
   - Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Go to **Import**
   - Choose `database/cybersecurity_learn_db.sql`
   - Click **Go** to import the schema and sample data

4. **Configure the app**
   - Copy `config/config.example.php` to `config/config.php` (if it does not exist yet)
   - Set `BASE_URL` to match your folder name under `htdocs`:
     ```php
     define('BASE_URL', '/CYBERSECURITY WEB');
     ```
   - Default XAMPP database settings (usually no changes needed):
     - Host: `localhost`
     - Database: `cybersecurity_learn_db`
     - User: `root`
     - Password: *(empty)*

5. **Open the site in your browser**
   - [http://localhost/CYBERSECURITY%20WEB/index.php](http://localhost/CYBERSECURITY%20WEB/index.php)

### Demo Accounts

| Role  | Username    | Password   |
|-------|-------------|------------|
| Admin | `admin`     | `admin123` |
| User  | `demo_user` | `user123`  |

### Troubleshooting

- **Blank page or 500 error** — check that Apache and MySQL are running in XAMPP
- **Database connection failed** — confirm `config/config.php` credentials and that the database was imported
- **Broken links or missing styles** — verify `BASE_URL` in `config/config.php` matches your `htdocs` folder name exactly (including spaces)

## Static Version (No Server)

The `.html` files in the project root are a static version for GitHub Pages or quick preview without a database.

1. Clone the repository
2. Open any `.html` file in VS Code
3. Use the **Live Server** extension to preview (recommended)
4. Or open `index.html` directly in a browser

No database or server setup required. Quiz progress is saved in the browser's `localStorage` only.

## Deploy to GitHub Pages

1. Push this project to a GitHub repository
2. Go to **Settings → Pages**
3. Under **Source**, select **Deploy from branch**
4. Choose the `main` branch and `/ (root)` folder
5. Click **Save**
6. Your site will be live at `https://yourusername.github.io/repo-name/`

## Quiz Progress

- **XAMPP / PHP version:** Logged-in users have quiz results saved to the database and shown on the Dashboard.
- **Static HTML version:** Quiz results are saved in the browser's `localStorage` only — no account or server needed.

## For Academic Submission

- **Course:** IT 122 — Information Assurance Security 2
- **Institution:** Bicol University Polangui
- **Authors:** Enrick Guiller Relos | Danielle Sapico
- **Year:** 2026

## License

Educational project — IT 122, 2026.
