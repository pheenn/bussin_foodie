<?php
/**
 * Application Configuration
 * 
 * This file contains the base path configuration which is crucial for
 * XAMPP installations where the app runs in a subdirectory.
 */

// Automatically detect the base path based on the script location
// This ensures URLs work correctly whether running in a subdirectory or root
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$basePath = dirname($scriptName);
if ($basePath === '/') {
    $basePath = '';
}

// Define constants for the application
define('BASE_PATH', $basePath);
define('APP_ROOT', dirname(__DIR__));

/**
 * Generate a URL with the correct base path
 * 
 * @param string $path The relative path (e.g., '/login', '/dashboard')
 * @return string The full URL with base path
 */
function url(string $path = ''): string {
    $path = ltrim($path, '/');
    if (BASE_PATH === '') {
        return '/' . $path;
    }
    return BASE_PATH . '/' . $path;
}

/**
 * Generate a CSRF token for form protection
 * 
 * @return string The CSRF token
 */
function generateCsrfToken(): string {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token from form submission
 * 
 * @param string $token The token from the form
 * @return bool True if token is valid
 */
function verifyCsrfToken(string $token): bool {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Redirect to a URL using the correct base path
 * 
 * @param string $path The relative path to redirect to
 * @return void
 */
function redirect(string $path): void {
    header('Location: ' . url($path));
    exit;
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
