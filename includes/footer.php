    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <div class="footer-brand">
                <strong><?= e(SITE_NAME) ?></strong>
                <p>Educational cybersecurity awareness for everyone.</p>
            </div>
            <nav class="footer-nav" aria-label="Footer navigation">
                <a href="<?= baseUrl('learn.php') ?>">Learn</a>
                <a href="<?= baseUrl('quiz.php') ?>">Quiz</a>
                <a href="<?= baseUrl('tips.php') ?>">Tips</a>
                <a href="<?= baseUrl('resources.php') ?>">Resources</a>
                <a href="<?= baseUrl('about.php') ?>">About</a>
            </nav>
            <p class="footer-disclaimer">
                &copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. For educational purposes only.
            </p>
        </div>
    </footer>

    <script src="<?= baseUrl('assets/js/main.js') ?>"></script>
    <script src="<?= baseUrl('assets/js/password-toggle.js') ?>"></script>
    <?php if (isset($extraScripts)): ?>
        <?php foreach ($extraScripts as $script): ?>
            <script src="<?= baseUrl($script) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
