<?php
require_once '../includes/config.php';
session_start();
$base = BASE_URL;
if (isset($_SESSION['guide_logged_in'])) { header("Location: approve.php"); exit(); }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pin = trim($_POST['pin'] ?? '');
    $name = trim($_POST['guide_name'] ?? '');
    if ($pin === GUIDE_PIN && $name) {
        $_SESSION['guide_logged_in'] = true;
        $_SESSION['guide_name'] = $name;
        header("Location: approve.php"); exit();
    } else {
        $error = "Invalid PIN or name not provided.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Guide Login | Bank Locker Management</title>
<link rel="stylesheet" href="<?= $base ?>/css/style.css">
</head>
<body>
<div class="login-page login-page-guide">
  <div class="login-box">
    <div class="login-logo">
      <div class="icon">📋</div>
      <h1>Guide Approval Portal</h1>
      <p>Bank Locker Management System</p>
      <span class="role-tag role-tag-guide" style="margin-top:8px;">Project Guide</span>
    </div>
    <?php if ($error): ?>
    <div class="alert alert-danger">⚠️ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="form-group">
        <label class="form-label">Guide Name</label>
        <input type="text" name="guide_name" class="form-control" placeholder="Enter your full name" required value="<?= htmlspecialchars($_POST['guide_name']??'') ?>">
      </div>
      <div class="form-group">
        <label class="form-label">Approval PIN</label>
        <input type="password" name="pin" class="form-control" placeholder="Enter guide PIN" required>
      </div>
      <button type="submit" class="btn btn-purple btn-lg" style="width:100%;justify-content:center;">📋 Login as Guide</button>
    </form>
    <div class="text-center mt-15" style="font-size:12px;color:#888;">
      Default PIN: guide123 &nbsp;|&nbsp; <a href="<?= $base ?>/index.php" style="color:var(--guide-purple);">← Back to Home</a>
    </div>
  </div>
</div>
</body>
</html>
