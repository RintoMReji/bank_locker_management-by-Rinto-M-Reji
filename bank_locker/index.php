<?php 
require_once __DIR__ . '/includes/config.php';
session_start(); 
$base = BASE_URL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bank Locker Management System</title>
<link rel="stylesheet" href="<?= $base ?>/css/style.css">
<style>
.landing{min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;background:linear-gradient(135deg,#1a3a5c 0%,#0f2845 100%);color:white;text-align:center;padding:20px}
.landing-logo{font-size:80px;margin-bottom:20px}
.landing h1{font-size:36px;font-weight:700;margin-bottom:10px}
.landing p{font-size:16px;opacity:.75;margin-bottom:40px;max-width:500px}
.landing-buttons{display:flex;gap:15px;flex-wrap:wrap;justify-content:center}
.btn-land{display:inline-flex;align-items:center;gap:8px;padding:14px 30px;border-radius:10px;font-size:15px;font-weight:600;text-decoration:none;transition:all .2s;border:none;cursor:pointer}
.btn-admin{background:#e8a020;color:#1a3a5c}
.btn-admin:hover{background:#f0b030}
.btn-cust{background:rgba(255,255,255,.15);color:white;border:2px solid rgba(255,255,255,.3)}
.btn-cust:hover{background:rgba(255,255,255,.25)}
.features{display:flex;gap:20px;margin-top:50px;flex-wrap:wrap;justify-content:center}
.feature{background:rgba(255,255,255,.08);border-radius:12px;padding:20px 25px;text-align:center;max-width:200px}
.feature .f-icon{font-size:32px;margin-bottom:10px}
.feature h3{font-size:14px;font-weight:600;margin-bottom:5px}
.feature p{font-size:12px;opacity:.65}
</style>
</head>
<body>
<div class="landing">
  <div class="landing-logo">🏦</div>
  <h1>Bank Locker Management System</h1>
  <p>Secure, digital management of bank locker services for customers and administrators</p>
  <div class="landing-buttons">
    <a href="<?= $base ?>/admin/login.php" class="btn-land btn-admin">🔐 Admin Login</a>
    <a href="<?= $base ?>/customer/login.php" class="btn-land btn-cust">👤 Customer Login</a>
    <a href="<?= $base ?>/customer/register.php" class="btn-land btn-cust">📝 New Customer? Register</a>
  </div>
  <div class="features">
    <div class="feature"><div class="f-icon">🔒</div><h3>Secure Lockers</h3><p>Multiple locker sizes to fit your needs</p></div>
    <div class="feature"><div class="f-icon">📊</div><h3>Real-time Status</h3><p>Instant locker availability tracking</p></div>
    <div class="feature"><div class="f-icon">📋</div><h3>Digital Records</h3><p>Complete access history maintained</p></div>
    <div class="feature"><div class="f-icon">⚡</div><h3>Fast Service</h3><p>Quick allocation and management</p></div>
  </div>
  <p style="margin-top:40px;font-size:12px;opacity:.4">Koshys Institute of Management Studies | BCA Project by Rinto M Reji</p>
</div>
</body>
</html>
