# Bussin Foodie 🍔

A simple PHP food ordering application that works with XAMPP.

## Features

- User registration and login system
- Dashboard with food items display
- Responsive design
- Session-based authentication

## Requirements

- XAMPP (or any Apache + PHP server)
- PHP 7.4 or higher
- mod_rewrite enabled in Apache

## Installation

1. **Clone or copy this repository to your XAMPP htdocs folder:**
   ```bash
   # Navigate to your XAMPP htdocs directory
   cd C:\xampp\htdocs
   
   # Clone the repository
   git clone https://github.com/pheenn/bussin_foodie.git
   ```

2. **Enable mod_rewrite in Apache:**
   - Open `C:\xampp\apache\conf\httpd.conf`
   - Find the line `#LoadModule rewrite_module modules/mod_rewrite.so`
   - Remove the `#` to uncomment it
   - Restart Apache in XAMPP Control Panel

3. **Configure AllowOverride:**
   - In the same `httpd.conf` file, find the `<Directory>` section for htdocs
   - Change `AllowOverride None` to `AllowOverride All`
   - Restart Apache

## Usage

1. Start Apache in XAMPP Control Panel
2. Open your browser and navigate to:
   ```
   http://localhost/bussin_foodie/public/index.php
   ```
3. You will be redirected to the login page
4. Use demo credentials or register a new account:
   - **Demo User:** `demo@example.com` / `demo123`
   - **Admin User:** `admin@bussin.com` / `admin123`

## Project Structure

```
bussin_foodie/
├── config/
│   └── config.php      # Configuration with base path handling
├── public/
│   ├── .htaccess       # URL rewriting rules
│   └── index.php       # Front controller (entry point)
├── src/
│   ├── login.php       # Login handler
│   └── register.php    # Registration handler
├── views/
│   ├── login.php       # Login form view
│   ├── register.php    # Registration form view
│   └── dashboard.php   # Main dashboard view
└── README.md
```

## How the URL Fix Works

The main issue with running PHP apps in XAMPP subdirectories is that redirects often use absolute paths like `/login` which go to `http://localhost/login` instead of `http://localhost/bussin_foodie/public/login`.

This project solves it by:

1. **Automatic base path detection** (`config/config.php`):
   ```php
   $scriptName = $_SERVER['SCRIPT_NAME'];
   $basePath = dirname($scriptName);
   define('BASE_PATH', $basePath);
   ```

2. **URL helper function**:
   ```php
   function url(string $path): string {
       return BASE_PATH . '/' . ltrim($path, '/');
   }
   ```

3. **Using the helper everywhere**:
   ```php
   // In forms
   <form action="<?php echo url('login'); ?>">
   
   // In redirects
   redirect('dashboard'); // Uses url() internally
   
   // In links
   <a href="<?php echo url('logout'); ?>">Logout</a>
   ```

This ensures all URLs are correctly prefixed with `/bussin_foodie/public`.

## Security Features

This application includes several security features:

- **CSRF Protection**: All forms include CSRF tokens to prevent cross-site request forgery attacks
- **Password Hashing**: Passwords are hashed using `password_hash()` and verified with `password_verify()`
- **Session Security**: Session IDs are regenerated on login to prevent session fixation
- **Input Validation**: User inputs are validated and sanitized

⚠️ **For production use, consider also:**

- Using a proper database (MySQL, PostgreSQL)
- Implementing HTTPS
- Adding rate limiting for login attempts
- Adding more comprehensive input sanitization

## License

MIT License
