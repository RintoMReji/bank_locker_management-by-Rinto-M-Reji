<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';
if (session_status() === PHP_SESSION_NONE) session_start();
requireAdminLogin();
$page_title = isset($page_title) ? $page_title . ' | Admin' : 'Admin Panel';
$base = BASE_URL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<link rel="stylesheet" href="<?= $base ?>/css/style.css">
</head>
<body>
<div class="wrapper">
<aside class="sidebar">
  <div class="sidebar-header">
    <div class="bank-icon">🏦</div>
    <h2>SecureBank</h2>
    <p>Admin Panel</p>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-section-label">Main</div>
    <a href="<?= $base ?>/admin/dashboard.php" <?= (basename($_SERVER['PHP_SELF'])=='dashboard.php')?'class="active"':'' ?>>
      <span class="icon">📊</span> Dashboard
    </a>
    <div class="nav-section-label">Locker</div>
    <a href="<?= $base ?>/admin/lockers.php" <?= (basename($_SERVER['PHP_SELF'])=='lockers.php')?'class="active"':'' ?>>
      <span class="icon">🔒</span> Manage Lockers
    </a>
    <a href="<?= $base ?>/admin/allocations.php" <?= (basename($_SERVER['PHP_SELF'])=='allocations.php')?'class="active"':'' ?>>
      <span class="icon">📋</span> Allocations
    </a>
    <a href="<?= $base ?>/admin/allocate_locker.php" <?= (basename($_SERVER['PHP_SELF'])=='allocate_locker.php')?'class="active"':'' ?>>
      <span class="icon">➕</span> Allocate Locker
    </a>
    <div class="nav-section-label">Customers</div>
    <a href="<?= $base ?>/admin/customers.php" <?= (basename($_SERVER['PHP_SELF'])=='customers.php')?'class="active"':'' ?>>
      <span class="icon">👥</span> Customers
    </a>
    <a href="<?= $base ?>/admin/add_customer.php" <?= (basename($_SERVER['PHP_SELF'])=='add_customer.php')?'class="active"':'' ?>>
      <span class="icon">👤</span> Add Customer
    </a>
    <div class="nav-section-label">Reports</div>
    <a href="<?= $base ?>/admin/access_log.php" <?= (basename($_SERVER['PHP_SELF'])=='access_log.php')?'class="active"':'' ?>>
      <span class="icon">📝</span> Access Log
    </a>
    <div class="nav-section-label">Account</div>
    <a href="<?= $base ?>/admin/logout.php"><span class="icon">🚪</span> Logout</a>
  </nav>
</aside>
<div class="main-content">
<div class="topbar">
  <h1><?= $page_title ?></h1>
  <div class="topbar-right">
    <div class="user-info">
      <div class="user-avatar"><?= strtoupper(substr($_SESSION['admin_name']??'A',0,1)) ?></div>
      <div>
        <div style="font-weight:600;color:#1e293b;"><?= htmlspecialchars($_SESSION['admin_name']??'Admin') ?></div>
        <div style="font-size:11px;">Administrator</div>
      </div>
    </div>
  </div>
</div>
<div class="content">
