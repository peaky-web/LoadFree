<?php require_once 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LoadFree — Connect More. Spend Less.</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="navbar">
  <div class="nav-inner">
    <a class="brand" href="index.php"><span class="brand-mark">L</span><span>LoadFree</span></a>
    <button class="menu-toggle" aria-label="Open menu">☰</button>
    <nav>
      <a href="#rewards">Rewards</a>
      <a href="#how">How It Works</a>
      <a href="#faq">FAQ</a>
      <?php if (is_logged_in()): ?>
        <a class="nav-user" href="claim.php">Hi, <?= e($_SESSION['username']) ?></a>
        <a class="btn btn-small btn-outline" href="logout.php">Log out</a>
      <?php else: ?>
        <a class="nav-login" href="login.php">Log in</a>
        <a class="btn btn-small btn-primary" href="register.php">Sign up</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<main>
<section class="hero">
  <div class="hero-content">
    <div class="eyebrow">FREE REWARDS, NO CATCH</div>
    <h1>Connect More.<br><span>Spend Less.</span></h1>
    <p>Claim free mobile load and data packs in under a minute. No fees, no fine print — just rewards that keep you connected.</p>
    <div class="hero-actions">
      <a class="btn btn-primary hero-cta" href="<?= is_logged_in() ? 'claim.php' : 'login.php?redirect=claim.php' ?>">Claim Free Load <span>→</span></a>
      <a class="btn btn-outline hero-secondary" href="#how">See how it works <span>→</span></a>
    </div>
    <div class="trust-row">
      <span><b>✓</b> 250K+ claims sent</span>
      <span><b>✓</b> 5-min delivery</span>
      <span><b>✓</b> All major carriers</span>
    </div>
  </div>
  <div class="hero-visual" aria-label="LoadFree rewards illustration">
    <div class="visual-bubble bubble-top"><span>₱</span><div><strong>₱50 Load</strong><small>Delivered</small></div></div>
    <div class="visual-scene">
      <div class="cloud cloud-one"></div><div class="cloud cloud-two"></div>
      <div class="plant plant-left"></div><div class="plant plant-right"></div>
      <div class="phone-character">
        <div class="phone-notch"></div><div class="phone-face"><i></i><i></i><b>⌣</b></div>
        <div class="phone-arm arm-left"></div><div class="phone-arm arm-right"></div>
        <div class="phone-leg leg-left"></div><div class="phone-leg leg-right"></div>
      </div>
      <div class="cash-stack"><span></span><span></span><span></span></div>
      <div class="coin-stack"><i></i><i></i><i></i></div>
      <div class="person">
        <div class="hair"></div><div class="head"><i></i><i></i><b></b></div><div class="body"></div>
        <div class="arm arm-one"></div><div class="arm arm-two"></div><div class="leg leg-one"></div><div class="leg leg-two"></div>
      </div>
      <div class="spark spark-one">✦</div><div class="spark spark-two">✦</div>
    </div>
    <div class="visual-bubble bubble-bottom"><span>1GB</span><div><strong>Data Pack</strong><small>Ready to claim</small></div></div>
  </div>
</section>

<section id="rewards" class="section rewards-section">
  <div class="section-head">
    <div><h2>Rewards up for grabs</h2><p>Pick a reward, enter your number, and you're set.</p></div>
    <a class="view-all" href="<?= is_logged_in() ? 'claim.php' : 'login.php?redirect=claim.php' ?>">View all →</a>
  </div>
  <div class="reward-grid">
    <article class="reward-card">
      <div class="reward-top"><div class="reward-icon purple">₱50</div><span class="tag green">Popular</span></div>
      <h3>₱50 Free Load</h3><p>Instant credit to any number, all carriers.</p>
      <div class="reward-foot"><span>2,340 claimed</span><a href="login.php?redirect=claim.php" class="btn btn-primary btn-small">Claim Now</a></div>
    </article>
    <article class="reward-card">
      <div class="reward-top"><div class="reward-icon yellow">1GB</div><span class="tag yellow-tag">New</span></div>
      <h3>1GB Data Pack</h3><p>7-day validity, usable on any network.</p>
      <div class="reward-foot"><span>1,870 claimed</span><a href="login.php?redirect=claim.php" class="btn btn-primary btn-small">Claim Now</a></div>
    </article>
    <article class="reward-card">
      <div class="reward-top"><div class="reward-icon green">₱100</div><span class="tag neutral">Weekly</span></div>
      <h3>₱100 Load + 500MB</h3><p>Our combo pack — load plus bonus data.</p>
      <div class="reward-foot"><span>980 claimed</span><a href="login.php?redirect=claim.php" class="btn btn-primary btn-small">Claim Now</a></div>
    </article>
  </div>
</section>

<section id="how" class="how-card">
  <div class="section-head"><div><h2>How it works</h2><p>Three simple steps between you and free rewards.</p></div></div>
  <div class="steps">
    <div class="step"><span class="step-number purple-bg">1</span><h3>Create your account</h3><p>Sign up free in seconds — no card or details beyond your mobile number.</p></div>
    <div class="step"><span class="step-number yellow-bg">2</span><h3>Pick &amp; enter number</h3><p>Choose a reward and type the phone number that should receive it.</p></div>
    <div class="step"><span class="step-number green-bg">3</span><h3>Get it delivered</h3><p>Track your claim status and receive a unique reference number instantly.</p></div>
  </div>
</section>

<section class="cta">
  <div><span class="eyebrow">READY TO TRY?</span><h2>Claim your reward.</h2><p>Sign in to continue to the protected claiming workflow.</p></div>
  <a class="btn btn-primary" href="<?= is_logged_in() ? 'claim.php' : 'login.php?redirect=claim.php' ?>">Claim Free Load →</a>
</section>

<section id="faq" class="section faq">
  <div class="section-head"><div><h2>Questions, answered.</h2></div></div>
  <details><summary>Do I need to log in to browse?</summary><p>No. The homepage, rewards, How It Works, and FAQ are public.</p></details>
  <details><summary>Why is login required for claiming?</summary><p>Your account protects the claiming process with username/password authentication and session management.</p></details>
  <details><summary>Is the load actually transferred to my phone?</summary><p>Claims are recorded in the MySQL database. No actual mobile load, data package, payment, or telecom transaction is performed.</p></details>
  <details><summary>How are passwords stored?</summary><p>Passwords should be stored using PHP's password_hash() and verified with password_verify(), never as plain text.</p></details>
</section>
</main>

<footer><div class="footer-inner"><a class="brand" href="index.php"><span class="brand-mark">L</span><span>LoadFree</span></a><p>© 2026 LoadFree · Connect More. Spend Less.</p><div><a href="#how">How It Works</a><a href="#faq">FAQ</a></div></div></footer>
<script src="assets/app.js"></script>
</body>
</html>
