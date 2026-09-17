# LoadFree — Connect More. Spend Less.

A PHP + MySQL website for public browsing, username/password authentication, PHP sessions, protected reward claiming, password validation, and claim records.

## Requirements
- PHP 8.0+
- MySQL 5.7+/8.x or MariaDB
- Apache (XAMPP/WAMP/LAMP is fine)

## Setup with XAMPP
1. Copy the `LoadFree` folder into `xampp/htdocs/`.
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin.
4. Import `database.sql`.
5. Check `config.php` and set the MySQL username/password if your local setup differs.
6. Visit `http://localhost/LoadFree/`.

## Password storage
Passwords are intentionally stored and compared as plaintext in MySQL for this version.

**Do not use this approach in a real application.** Production systems should use `password_hash()` and `password_verify()`.

## Features
- Public homepage with no forced login
- Rewards, How It Works and FAQ sections
- Claim buttons redirect unauthenticated users to login
- Username/password authentication against MySQL
- Password validation: 8+ characters, uppercase, lowercase, number
- PHP session management
- Protected `claim.php`
- Claims saved to MySQL
- Claim history for the authenticated user
- Logout/session destruction
- Responsive desktop/mobile layout
- Prepared SQL statements
