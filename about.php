<?php
/**
 * About Page — project purpose, credits, and disclaimer.
 */
$pageTitle = 'About';
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="data-tag">About</span>
        <h1 class="mt-2">About CyberSafe Learn</h1>
        <p>An educational cybersecurity awareness platform for students and everyday internet users.</p>
    </div>
</div>

<section class="section">
    <div class="container" style="max-width: 800px;">
        <article class="module-content">
            <h2>Our Purpose</h2>
            <p>CyberSafe Learn was created to make cybersecurity education accessible to everyone — not just IT professionals. In a world where phishing emails, data breaches, and online scams are everyday occurrences, basic security awareness is a life skill everyone needs.</p>
            <p>This website combines clear, jargon-free explanations with interactive quizzes and practical tools so you can learn at your own pace and immediately apply what you've learned.</p>

            <h2 class="mt-3">What You'll Learn</h2>
            <ul style="padding-left: 1.5rem; margin-bottom: 1rem;">
                <li>How to recognize and avoid phishing attacks</li>
                <li>How to create and manage strong passwords</li>
                <li>How to protect yourself on public Wi-Fi and mobile devices</li>
                <li>How to browse the web safely and protect your privacy on social media</li>
                <li>What malware is and how to prevent infections</li>
            </ul>

            <h2>Built With Security in Mind</h2>
            <p>This project doesn't just teach cybersecurity — it practices it. The site demonstrates secure coding principles including:</p>
            <ul style="padding-left: 1.5rem; margin-bottom: 1rem;">
                <li><strong>Hashed passwords</strong> — stored using PHP's <code>password_hash()</code>, never in plain text</li>
                <li><strong>Prepared statements</strong> — all database queries use PDO prepared statements to prevent SQL injection</li>
                <li><strong>Output sanitization</strong> — all user-facing content is escaped with <code>htmlspecialchars()</code> to prevent XSS</li>
                <li><strong>Client-side password checking</strong> — the password strength tool never sends data to a server</li>
            </ul>

            <h2>Project Credits</h2>
            <p>Developed as an academic project for IT 122 — Information Assurance Security 2.</p>
            <p><strong>Author:</strong> Enrick Guiller Relos | Danielle Sapico</p>
            <p><strong>Institution:</strong> Bicol University Polangui</p>
            <p><strong>Year:</strong> 2026</p>

            <div class="example-box mt-3">
                <h4>Disclaimer</h4>
                <p>This website is for <strong>educational purposes only</strong>. The security advice provided is general in nature and may not cover every scenario. For organization-specific security policies, consult your IT department. Tool recommendations are suggestions, not endorsements — always evaluate software based on your own needs.</p>
            </div>
        </article>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
