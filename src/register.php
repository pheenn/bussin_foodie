<?php
/**
 * Register Handler
 * 
 * Processes registration form submissions with proper security measures
 */

// Verify CSRF token
$csrfToken = $_POST['csrf_token'] ?? '';
if (!verifyCsrfToken($csrfToken)) {
    $_SESSION['error'] = 'Invalid security token. Please try again.';
    redirect('register');
}

// Validate input
$name = trim($_POST['name'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

// Validation checks
if (empty($name)) {
    $_SESSION['error'] = 'Please enter your name';
    redirect('register');
}

if (!$email) {
    $_SESSION['error'] = 'Please enter a valid email address';
    redirect('register');
}

if (strlen($password) < 6) {
    $_SESSION['error'] = 'Password must be at least 6 characters long';
    redirect('register');
}

if ($password !== $confirmPassword) {
    $_SESSION['error'] = 'Passwords do not match';
    redirect('register');
}

// Check if user already exists
$users = $_SESSION['registered_users'] ?? [];

if (isset($users[$email])) {
    $_SESSION['error'] = 'An account with this email already exists';
    redirect('register');
}

// Register the user with hashed password
$users[$email] = [
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8')
];

$_SESSION['registered_users'] = $users;

// Set success message and redirect to login
$_SESSION['success'] = 'Account created successfully! Please login.';
redirect('login');
