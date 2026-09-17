<?php
require_once 'config.php';
require_once 'functions.php';
require_login();

$rewards = [
    1 => ['name' => '500 MB Data', 'description' => 'Mobile data reward', 'value' => '500 MB', 'type' => 'DATA'],
    2 => ['name' => '1 GB Data', 'description' => 'Mobile data reward', 'value' => '1 GB', 'type' => 'DATA'],
    3 => ['name' => '2 GB Data', 'description' => 'Mobile data reward', 'value' => '2 GB', 'type' => 'DATA'],
    4 => ['name' => '₱20 Load', 'description' => 'Prepaid load credit', 'value' => '₱20', 'type' => 'LOAD'],
];

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reward_id = (int)($_POST['reward_id'] ?? 0);
    if (!isset($rewards[$reward_id])) {
        $error = 'Please select a valid reward.';
    } else {
        $reward = $rewards[$reward_id];
        $stmt = $pdo->prepare('INSERT INTO claims (user_id, reward_name, reward_value, reward_type, status) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$_SESSION['user_id'], $reward['name'], $reward['value'], $reward['type'], 'RECORDED']);
        $message = 'Success! Your ' . $reward['name'] . ' claim has been recorded.';
    }
}

$stmt = $pdo->prepare('SELECT reward_name, reward_value, reward_type, status, claimed_at FROM claims WHERE user_id = ? ORDER BY claimed_at DESC LIMIT 5');
$stmt->execute([$_SESSION['user_id']]);
$claims = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Claim Reward — LoadFree</title><link rel="stylesheet" href="assets/style.css"></head>
<body>
<header class="navbar"><div class="nav-inner"><a class="brand" href="index.php"><span class="brand-mark">L</span><span>Load<span>Free</span></span></a><nav><a href="index.php#rewards">Public Rewards</a><a href="index.php#faq">FAQ</a><span class="nav-user">Hi, <?= e($_SESSION['username']) ?></span><a class="btn btn-small btn-outline" href="logout.php">Log out</a></nav><button class="menu-toggle">☰</button></div></header>
<main class="claim-page">
<div class="claim-header"><div><span class="eyebrow">PROTECTED AREA</span><h1>Choose your reward.</h1><p class="muted">You're authenticated. Select one reward and confirm your claim.</p></div><div class="secure-badge">✓ Authenticated</div></div>
<?php if ($message): ?><div class="alert alert-success"><?= e($message) ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
<div class="claim-layout">
<section><form method="POST" id="claimForm" class="claim-grid">
<?php foreach ($rewards as $id => $reward): ?>
<label class="claim-option"><input type="radio" name="reward_id" value="<?= $id ?>" required><div class="claim-option-inner"><span class="radio-dot"></span><span class="reward-icon small">◉</span><div><small><?= e($reward['type']) ?></small><h3><?= e($reward['name']) ?></h3><p><?= e($reward['description']) ?></p></div><strong><?= e($reward['value']) ?></strong></div></label>
<?php endforeach; ?>
<button class="btn btn-primary full" type="submit">Confirm Claim →</button>
</form></section>
<aside class="history"><h3>Recent claims</h3><?php if (!$claims): ?><p class="muted">No claims yet.</p><?php else: foreach ($claims as $claim): ?><div class="history-item"><span class="history-icon">✓</span><div><strong><?= e($claim['reward_name']) ?></strong><small><?= e($claim['status']) ?> · <?= e($claim['claimed_at']) ?></small></div></div><?php endforeach; endif; ?></aside>
</div>
<div></div>
</main><footer><div class="footer-inner"><a class="brand" href="index.php"><span class="brand-mark">L</span><span>Load<span>Free</span></span></a><p>© 2026 LoadFree</p></div></footer><script src="assets/app.js"></script></body></html>
