<?php
/**
 * Home Page — hero, navigation cards, and Tip of the Day widget.
 */
$pageTitle = 'Home';
require_once __DIR__ . '/includes/header.php';

$tipOfDay = getTipOfTheDay();
?>

<section class="hero">
    <div class="hero-floaters" aria-hidden="true">
        <div class="floater floater--1"><?= icon('lock') ?></div>
        <div class="floater floater--2"><?= icon('chip') ?></div>
        <div class="floater floater--3"><?= icon('shield') ?></div>
        <div class="floater floater--4"><?= icon('lock') ?></div>
    </div>

    <div class="container hero-grid">
        <div class="hero-content">
            <span class="hero-label data-tag">Secure by Design</span>
            <h1><?= e(SITE_TAGLINE) ?></h1>
            <p>Learn practical cybersecurity skills to protect yourself online. Whether you're a student, employee, or everyday internet user, CyberSafe Learn makes security simple and actionable.</p>
            <div class="hero-actions">
                <a href="<?= baseUrl('learn.php') ?>" class="btn btn-primary">
                    Start Learning
                    <?= icon('arrow-right') ?>
                </a>
                <a href="<?= baseUrl('quiz.php') ?>" class="btn btn-secondary">
                    Take a Quiz
                    <?= icon('arrow-right') ?>
                </a>
            </div>
        </div>

        <div class="hero-visual" aria-hidden="true">
            <div class="hero-shield-wrap">
                <div class="hero-scan-line"></div>
                <span class="hero-data-tag hero-data-tag--1">ENCRYPTED</span>
                <span class="hero-data-tag hero-data-tag--2">VERIFIED</span>
                <span class="hero-data-tag hero-data-tag--3">THREAT DETECTED</span>
                <svg class="hero-shield" viewBox="0 0 320 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="shieldGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="var(--shield-grad-1)"/>
                            <stop offset="50%" stop-color="var(--shield-grad-2)"/>
                            <stop offset="100%" stop-color="var(--shield-grad-3)"/>
                        </linearGradient>
                        <linearGradient id="glowGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="var(--shield-accent)" stop-opacity="0"/>
                            <stop offset="50%" stop-color="var(--shield-accent)" stop-opacity="0.8"/>
                            <stop offset="100%" stop-color="var(--shield-accent)" stop-opacity="0"/>
                        </linearGradient>
                        <filter id="glow">
                            <feGaussianBlur stdDeviation="3" result="blur"/>
                            <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
                        </filter>
                    </defs>
                    <!-- Shield body -->
                    <path d="M160 30 L60 70 L60 180 C60 260 110 320 160 350 C210 320 260 260 260 180 L260 70 Z" fill="url(#shieldGrad)" stroke="var(--shield-stroke-muted)" stroke-width="1"/>
                    <!-- Inner shield outline -->
                    <path d="M160 55 L85 88 L85 178 C85 245 125 295 160 318 C195 295 235 245 235 178 L235 88 Z" fill="none" stroke="var(--shield-stroke-accent-faint)" stroke-width="1"/>
                    <!-- Circuit paths -->
                    <path d="M120 140 L160 120 L200 140 L200 200 L160 220 L120 200 Z" fill="none" stroke="var(--shield-accent)" stroke-width="1.5" opacity="0.6" filter="url(#glow)"/>
                    <circle cx="160" cy="170" r="8" fill="none" stroke="var(--shield-accent)" stroke-width="1.5" opacity="0.8"/>
                    <circle cx="160" cy="170" r="3" fill="var(--shield-accent)" opacity="0.9"/>
                    <!-- Network nodes -->
                    <line x1="120" y1="140" x2="90" y2="110" stroke="var(--shield-accent)" stroke-width="1" opacity="0.4"/>
                    <line x1="200" y1="140" x2="230" y2="110" stroke="var(--shield-accent)" stroke-width="1" opacity="0.4"/>
                    <line x1="120" y1="200" x2="90" y2="230" stroke="var(--shield-accent)" stroke-width="1" opacity="0.4"/>
                    <line x1="200" y1="200" x2="230" y2="230" stroke="var(--shield-accent)" stroke-width="1" opacity="0.4"/>
                    <circle cx="90" cy="110" r="4" fill="var(--shield-node-fill)" stroke="var(--shield-accent)" stroke-width="1" opacity="0.6"/>
                    <circle cx="230" cy="110" r="4" fill="var(--shield-node-fill)" stroke="var(--shield-accent)" stroke-width="1" opacity="0.6"/>
                    <circle cx="90" cy="230" r="4" fill="var(--shield-node-fill)" stroke="var(--shield-accent)" stroke-width="1" opacity="0.6"/>
                    <circle cx="230" cy="230" r="4" fill="var(--shield-node-fill)" stroke="var(--shield-accent)" stroke-width="1" opacity="0.6"/>
                    <!-- Data flow line -->
                    <path d="M70 280 Q120 250 160 270 T250 280" fill="none" stroke="url(#glowGrad)" stroke-width="2" opacity="0.7"/>
                    <!-- Lock icon inside -->
                    <rect x="148" y="155" width="24" height="20" rx="3" fill="none" stroke="var(--shield-accent)" stroke-width="1.5" opacity="0.7"/>
                    <path d="M154 155 V148 C154 142 158 138 164 138 C170 138 174 142 174 148 V155" fill="none" stroke="var(--shield-accent)" stroke-width="1.5" opacity="0.7"/>
                </svg>
            </div>
        </div>
    </div>

    <a href="#explore" class="scroll-cue">
        Scroll to discover
        <?= icon('arrow-down') ?>
    </a>
</section>

<section id="explore" class="section">
    <div class="container">
        <?php if ($tipOfDay): ?>
        <div class="tip-widget reveal" role="complementary" aria-label="Tip of the Day">
            <div class="tip-label">
                <?= icon('signal') ?>
                Tip of the Day
            </div>
            <p><?= e($tipOfDay['tip_text']) ?></p>
            <span class="tip-category"><?= e($tipOfDay['category']) ?></span>
        </div>
        <?php endif; ?>

        <h2 class="section-title reveal">Explore CyberSafe Learn</h2>
        <p class="section-subtitle reveal reveal-delay-1">Choose a section to start building your security knowledge.</p>

        <div class="card-grid">
            <a href="<?= baseUrl('learn.php') ?>" class="card card-link reveal reveal-delay-1">
                <div class="card-icon" aria-hidden="true"><?= icon('book', 'card-icon-svg') ?></div>
                <h3>Learning Modules</h3>
                <p>8 bite-sized lessons covering passwords, phishing, malware, and more — with real-world examples.</p>
            </a>
            <a href="<?= baseUrl('quiz.php') ?>" class="card card-link reveal reveal-delay-2">
                <div class="card-icon" aria-hidden="true"><?= icon('target', 'card-icon-svg') ?></div>
                <h3>Quiz & Tools</h3>
                <p>Test your skills with interactive quizzes and check your password strength — all in your browser.</p>
            </a>
            <a href="<?= baseUrl('tips.php') ?>" class="card card-link reveal reveal-delay-3">
                <div class="card-icon" aria-hidden="true"><?= icon('zap', 'card-icon-svg') ?></div>
                <h3>Quick Tips</h3>
                <p>Scannable security tips organized by category — perfect for a quick refresher.</p>
            </a>
            <a href="<?= baseUrl('resources.php') ?>" class="card card-link reveal reveal-delay-4">
                <div class="card-icon" aria-hidden="true"><?= icon('link', 'card-icon-svg') ?></div>
                <h3>Resources</h3>
                <p>Trusted tools, password managers, and a glossary of key cybersecurity terms.</p>
            </a>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container text-center">
        <h2 class="section-title reveal">Why Cybersecurity Matters</h2>
        <p class="section-subtitle reveal reveal-delay-1" style="max-width: 700px; margin-left: auto; margin-right: auto;">
            Most cyber attacks don't target technology — they target people. A single click on a phishing link or a reused password can lead to identity theft, financial loss, or compromised accounts. The good news? Simple habits prevent the majority of attacks.
        </p>
        <?php if (!isLoggedIn()): ?>
            <a href="<?= baseUrl('auth/register.php') ?>" class="btn btn-primary reveal reveal-delay-2">
                Create a Free Account
                <?= icon('arrow-right') ?>
            </a>
            <p class="text-muted mt-2 reveal reveal-delay-3">Track your quiz progress and build your security awareness over time.</p>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
