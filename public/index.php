<?php
/**
 * Front Controller
 * 
 * All requests go through this file. It handles routing and dispatches
 * requests to the appropriate handlers.
 */

// Load configuration
require_once __DIR__ . '/../config/config.php';

// Get the requested route
$route = $_GET['route'] ?? '';
$route = trim($route, '/');

// Simple routing based on the request
switch ($route) {
    case '':
    case 'index':
    case 'index.php':
        // Home/Index page - redirect to login if not authenticated
        if (!isset($_SESSION['user'])) {
            redirect('login');
        } else {
            redirect('dashboard');
        }
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle login form submission
            require_once __DIR__ . '/../src/login.php';
        } else {
            // Show login form
            require_once __DIR__ . '/../views/login.php';
        }
        break;

    case 'logout':
        // Clear session and redirect to login
        session_destroy();
        redirect('login');
        break;

    case 'dashboard':
        // Protected route - requires authentication
        if (!isset($_SESSION['user'])) {
            redirect('login');
        }
        require_once __DIR__ . '/../views/dashboard.php';
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../src/register.php';
        } else {
            require_once __DIR__ . '/../views/register.php';
        }
        break;

    default:
        // 404 Not Found
        http_response_code(404);
        echo '<!DOCTYPE html>
<html>
<head>
    <title>404 - Page Not Found</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        h1 { color: #e74c3c; }
        a { color: #3498db; }
    </style>
</head>
<body>
    <h1>404 - Page Not Found</h1>
    <p>The page you are looking for does not exist.</p>
    <a href="' . htmlspecialchars(url('login')) . '">Go to Login</a>
</body>
</html>';
        break;
}
