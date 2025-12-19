<?php
/**
 * Login Handler
 * 
 * Processes login form submissions with proper security measures
 */

// Verify CSRF token
$csrfToken = $_POST['csrf_token'] ?? '';
if (!verifyCsrfToken($csrfToken)) {
    $_SESSION['error'] = 'Invalid security token. Please try again.';
    redirect('login');
}

// Validate input
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';

if (!$email) {
    $_SESSION['error'] = 'Please enter a valid email address';
    redirect('login');
}

if (empty($password)) {
    $_SESSION['error'] = 'Please enter your password';
    redirect('login');
}

// Check for registered users in session storage (demo purposes)
// In production, this would query a database
$users = $_SESSION['registered_users'] ?? [];

// Demo users for testing (passwords are hashed)
$demoUsers = [
    'demo@example.com' => [
        'password' => password_hash('demo123', PASSWORD_DEFAULT),
        'name' => 'Demo User'
    ],
    'admin@bussin.com' => [
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
        'name' => 'Admin User'
    ]
];

// Merge demo users with registered users
$allUsers = array_merge($demoUsers, $users);

// Check credentials using secure password verification
if (isset($allUsers[$email])) {
    if (password_verify($password, $allUsers[$email]['password'])) {
        // Login successful - store user info in session
        $_SESSION['user'] = [
            'email' => $email,
            'name' => $allUsers[$email]['name']
        ];
        
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);
        
        // Redirect to dashboard using the correct base path
        redirect('dashboard');
    }
}

// Login failed
$_SESSION['error'] = 'Invalid email or password';
redirect('login');
