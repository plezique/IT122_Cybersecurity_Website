<?php
/**
 * Database connection using PDO with prepared statements.
 * Demonstrates secure database access practices for this cybersecurity project.
 */

require_once __DIR__ . '/../config/config.php';

/**
 * Get a PDO database connection (singleton pattern).
 */
function getDB(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die('Database connection failed. Please check config/config.php and ensure MySQL is running.');
        }
    }

    return $pdo;
}

/**
 * Sanitize output for HTML display (XSS prevention).
 */
function e(string $string): string {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Get the site base URL path for links.
 */
function baseUrl(string $path = ''): string {
    $base = rtrim(BASE_URL, '/');
    $path = ltrim($path, '/');
    return $path ? $base . '/' . $path : $base;
}

/**
 * Redirect to a path within the site.
 */
function redirect(string $path): void {
    header('Location: ' . baseUrl($path));
    exit;
}

/**
 * Get today's featured tip from the database.
 */
function getTipOfTheDay(): ?array {
    $db = getDB();
    $stmt = $db->query(
        'SELECT tip_text, category FROM tips WHERE is_featured = 1 ORDER BY RAND() LIMIT 1'
    );
    $tip = $stmt->fetch();
    return $tip ?: null;
}
