# Project Prompt: Cybersecurity Awareness & Learning Website

**Project Title:** CyberSafe Learn *(or your own custom name)*

## Objective

Build a responsive, educational website that teaches everyday users — students, employees, and general internet users — practical cybersecurity awareness and safe online practices. The site should combine informational content with interactive learning tools to improve engagement and retention, backed by a MySQL database for dynamic content management.

---

## 1. Target Audience

- **Primary:** Students and general non-technical users
- **Secondary:** Small business employees who need basic security awareness training
- Assume little to no prior cybersecurity background

---

## 2. Core Features & Pages

### A. Home Page
- Hero section with a strong headline (e.g., "Stay Safe Online, One Step at a Time")
- Short intro paragraph explaining the site's purpose
- Quick navigation cards to main sections (Learn, Tips, Quiz, Resources)
- "Tip of the Day" widget (pulled dynamically from the database)

### B. Learning Modules Page(s)
Each module should include a short explainer (200-400 words), a real-world example, and a "key takeaway" box. Modules:
1. Cybersecurity Basics (CIA Triad, common threats)
2. Password Security & MFA
3. Phishing & Social Engineering
4. Malware Types & Prevention
5. Network & Wi-Fi Safety
6. Safe Browsing Habits
7. Mobile Device Security
8. Social Media Privacy

### C. Interactive Quiz/Tools Page
- Phishing email identification quiz (multiple choice, show correct answer + explanation after each question)
- Password strength checker (client-side JS, no data sent anywhere)
- Security awareness scored quiz with a results summary (e.g., "Beginner / Intermediate / Advanced" awareness level)
- Quiz results saved per logged-in user for progress tracking

### D. Quick Tips / Cheat Sheet Page
- Bite-sized, scannable tips grouped by category
- Downloadable PDF versions (optional)

### E. Resources Page
- Curated list of legitimate tools (password managers, VPNs, antivirus) with brief descriptions
- Glossary of key terms

### F. About Page
- Purpose of the project, author/team credit, disclaimer (educational purposes only)

### G. User Accounts (Optional but Recommended)
- Registration/login system
- Personalized dashboard showing quiz history and progress over time

### H. Admin Panel (Optional)
- Add/edit/delete modules, tips, and quiz questions without touching raw code
- View basic analytics (e.g., most-taken quizzes, average scores)

---

## 3. Technical Requirements

### 3A. Frontend
- **Stack:** HTML5, CSS3, JavaScript (vanilla or lightweight framework like React if component reuse is desired)
- **Responsive Design:** Mobile-first, works on all screen sizes
- **Accessibility:** Semantic HTML, proper alt text, readable color contrast
- **Performance:** Lightweight, no unnecessary dependencies

### 3B. Backend & Database (MySQL via XAMPP)

**Environment:**
- Local development using XAMPP (Apache + MySQL + PHP)
- Backend language: PHP (native or lightweight MVC-lite structure) connecting to MySQL via `mysqli` or `PDO`

**Database Name:** `cybersecurity_learn_db` *(or your preferred name)*

**Suggested Tables:**

1. **users**
   - `user_id` (PK, auto increment)
   - `username`
   - `email`
   - `password` (hashed via `password_hash()`)
   - `role` (admin/user)
   - `created_at`

2. **modules**
   - `module_id` (PK)
   - `title`
   - `content` (long text or reference to content file)
   - `category` (e.g., Passwords, Phishing, Malware)
   - `created_at`

3. **tips**
   - `tip_id` (PK)
   - `tip_text`
   - `category`
   - `is_featured` (for "Tip of the Day" rotation)

4. **quiz_questions**
   - `question_id` (PK)
   - `question_text`
   - `option_a`, `option_b`, `option_c`, `option_d`
   - `correct_answer`
   - `explanation`
   - `category`

5. **quiz_results**
   - `result_id` (PK)
   - `user_id` (FK → users)
   - `score`
   - `total_questions`
   - `date_taken`

6. **resources**
   - `resource_id` (PK)
   - `name`
   - `description`
   - `url`
   - `category`

**Functionality Enabled by the Database:**
- User registration/login for personalized quiz tracking and progress history
- Dynamic "Tip of the Day" pulled from the `tips` table instead of hardcoded
- Quiz questions stored and fetched dynamically (easy to expand without touching code)
- Admin panel to manage modules, tips, and quiz questions
- Per-user quiz results saved for progress visibility over time

**Technical Notes:**
- Use prepared statements (PDO or `mysqli`) to prevent SQL injection — good practice to demonstrate in a *cybersecurity* project
- Passwords must be hashed, never stored in plain text
- Use a `config.php` or `.env`-style file for DB credentials (exclude from version control if pushing to GitHub)
- Export a `.sql` file (schema + sample data) so the database can be easily imported via phpMyAdmin for grading/demo purposes

---

## 4. Design Direction

- Clean, modern, trustworthy look — avoid "hacker-cliché" aesthetics (e.g., green matrix text); go for professional and approachable
- **Suggested palette:** deep blue/navy (trust, security) + a bright accent color (alerts/highlights) + neutral background
- Clear typography hierarchy, generous whitespace
- Icons for each module/topic (shield, lock, envelope, wifi, etc.)

---

## 5. Content Tone

- Simple, non-technical language
- Avoid jargon or explain it immediately when used
- Practical and actionable — every section should answer "what do I actually do about this?"

---

## 6. Deliverables

- Fully functional website (frontend + PHP/MySQL backend) with all pages above
- Clean, organized file/folder structure
- Exported `.sql` file with schema + sample data for easy import
- Comments in code explaining key sections (useful for academic submission/grading)
- README file with setup instructions (how to import the database, configure XAMPP, run the site locally)

---

## 7. Notable Project Angle

This project doubles as a demonstration of secure coding practices *while* teaching cybersecurity — hashed passwords, prepared statements, and sanitized inputs show the site doesn't just teach security, it practices it. Good angle for a capstone-style writeup or presentation.
