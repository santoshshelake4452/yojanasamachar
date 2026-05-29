<?php
// =============================================
// includes/config.php
// Database configuration for XAMPP / MySQL
// =============================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // XAMPP default
define('DB_PASS', '');            // XAMPP default (blank)
define('DB_NAME', 'yojanasamachar');
define('DB_CHARSET', 'utf8mb4');

define('ADMIN_SECRET', 'admin123');  // Change this!

// ── Create connection ──────────────────────
function getDB(): mysqli {
    static $conn = null;
    if ($conn !== null) return $conn;

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        http_response_code(500);
        die(json_encode([
            'success' => false,
            'error'   => 'Database connection failed: ' . $conn->connect_error
        ]));
    }

    $conn->set_charset(DB_CHARSET);
    return $conn;
}

// ── Session helper ─────────────────────────
function getSessionId(): string {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['uid'])) {
        $_SESSION['uid'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['uid'];
}

// ── JSON response helper ───────────────────
function jsonOk(array $data = []): void {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array_merge(['success' => true], $data));
    exit;
}

function jsonErr(string $msg, int $code = 400): void {
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'error' => $msg]);
    exit;
}