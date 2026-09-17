<?php
require_once 'config.php';
require_once 'functions.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (!preg_match('/^[A-Za-z0-9_]{3,30}$/', $username)) {
        $errors[] = 'Username must be 3–30 characters and use only letters, numbers, or underscore.';
    }
    $errors = array_merge($errors, password_rules($password));
    if ($password !== $confirm) $errors[] = 'Passwords do not match.';

    if (!$errors) {
        $check = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $check->execute([$username]);
        if ($check->fetch()) {
            $errors[] = 'That username is already registered.';
        } else {
            // Store the password as plain text for this version.
            $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $stmt->execute([$username, $password]);
            header('Location: login.php?registered=1');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Create Account — LoadFree</title><link rel="stylesheet" href="assets/style.css"></head>
<body class="auth-page"><div class="auth-shell">
<a class="brand auth-brand" href="index.php"><span class="brand-mark">L</span><span>Load<span>Free</span></span></a>
<div class="auth-card">
<span class="eyebrow">CREATE ACCOUNT</span><h1>Create account.</h1><p class="muted">Create your LoadFree account to access available rewards.</p>
<?php if ($errors): ?><div class="alert alert-error"><?= e(implode(' ', $errors)) ?></div><?php endif; ?>
<form method="POST" novalidate>
<label>Username<input name="username" placeholder="Choose a username" required></label>
<label>Password<div class="password-wrap"><input id="regpass" type="password" name="password" placeholder="Create a password" required><button type="button" class="show-pass" data-target="regpass">Show</button></div></label>
<div class="rules"><strong>Password requirements</strong><span>At least 8 characters</span><span>1 uppercase letter</span><span>1 lowercase letter</span><span>1 number</span></div>
<label>Confirm password<input type="password" name="confirm_password" placeholder="Repeat your password" required></label>
<button class="btn btn-primary full" type="submit">Create Account →</button>
</form>
<a class="back-link" href="login.php">Already have an account? Log in</a>
</div></div><script src="assets/app.js"></script></body></html>
