<?php
/**
 * Login Handler
 * 
 * Processes login form submissions
 * 
 * Note: This is a simplified demo version. In a production environment,
 * you should use a proper database and password hashing with password_verify()
 */

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

// Demo users for testing
$demoUsers = [
    'demo@example.com' => [
        'password' => 'demo123',
        'name' => 'Demo User'
    ],
    'admin@bussin.com' => [
        'password' => 'admin123',
        'name' => 'Admin User'
    ]
];

// Merge demo users with registered users
$allUsers = array_merge($demoUsers, $users);

// Check credentials
if (isset($allUsers[$email])) {
    // In production: use password_verify($password, $allUsers[$email]['password'])
    if ($password === $allUsers[$email]['password']) {
        // Login successful - store user info in session
        $_SESSION['user'] = [
            'email' => $email,
            'name' => $allUsers[$email]['name']
        ];
        
        // Redirect to dashboard using the correct base path
        redirect('dashboard');
    }
}

// Login failed
$_SESSION['error'] = 'Invalid email or password';
redirect('login');
