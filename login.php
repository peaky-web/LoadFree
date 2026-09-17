<?php
require_once 'config.php';
require_once 'functions.php';

if (is_logged_in()) {
    header('Location: claim.php');
    exit;
}

$errors = [];
$redirect = $_GET['redirect'] ?? $_POST['redirect'] ?? 'claim.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $errors[] = 'Please enter both username and password.';
    } else {
        // Passwords are compared as stored in the database for this version.
        $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && hash_equals((string)$user['password'], (string)$password)) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int)$user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: claim.php');
            exit;
        }
        $errors[] = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log In — LoadFree</title><link rel="stylesheet" href="assets/style.css">
</head>
<body class="auth-page">
<div class="auth-shell">
  <a class="brand auth-brand" href="index.php"><span class="brand-mark">L</span><span>Load<span>Free</span></span></a>
  <div class="auth-card">
    <div class="auth-icon">L</div>
    <span class="eyebrow">SECURE ACCESS</span>
    <h1>Welcome back.</h1>
    <p class="muted">Log in to continue to the protected claim page.</p>
    <?php if ($errors): ?><div class="alert alert-error"><?= e(implode(' ', $errors)) ?></div><?php endif; ?>
    <form method="POST" novalidate>
      <input type="hidden" name="redirect" value="<?= e($redirect) ?>">
      <label>Username<input name="username" autocomplete="username" placeholder="Enter your username" value="<?= e($_POST['username'] ?? '') ?>" required></label>
      <label>Password<div class="password-wrap"><input id="password" type="password" name="password" autocomplete="current-password" placeholder="Enter your password" required><button type="button" class="show-pass" data-target="password">Show</button></div></label>
      <button class="btn btn-primary full" type="submit">Log In →</button>
    </form>
    <div></div>
    <a class="back-link" href="register.php">Create an account</a>
    <a class="back-link" href="index.php" style="margin-top:10px">← Back to public site</a>
  </div>
</div>
<script src="assets/app.js"></script>
</body>
</html>
