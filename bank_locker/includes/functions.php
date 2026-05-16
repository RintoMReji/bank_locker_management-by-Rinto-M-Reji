<?php
require_once __DIR__ . '/config.php';

// Session check for admin
function requireAdminLogin() {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: " . BASE_URL . "/admin/login.php");
        exit();
    }
}

// Session check for customer
function requireCustomerLogin() {
    if (!isset($_SESSION['customer_id'])) {
        header("Location: " . BASE_URL . "/customer/login.php");
        exit();
    }
}

// Generate unique customer ID
function generateCustomerID($conn) {
    $year = date('Y');
    $result = $conn->query("SELECT COUNT(*) as cnt FROM customers");
    $row = $result->fetch_assoc();
    $num = str_pad($row['cnt'] + 1, 4, '0', STR_PAD_LEFT);
    return "CUST{$year}{$num}";
}

// Generate unique allocation number
function generateAllocationNo($conn) {
    $year = date('Y');
    $result = $conn->query("SELECT COUNT(*) as cnt FROM allocations");
    $row = $result->fetch_assoc();
    $num = str_pad($row['cnt'] + 1, 4, '0', STR_PAD_LEFT);
    return "ALLOC{$year}{$num}";
}

// Sanitize input
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Format currency
function formatCurrency($amount) {
    return '₹' . number_format($amount, 2);
}

// Get locker size label
function getLockerSizeLabel($size) {
    $labels = ['small' => 'Small', 'medium' => 'Medium', 'large' => 'Large'];
    return $labels[$size] ?? ucfirst($size);
}

// Get status badge HTML
function getStatusBadge($status) {
    $badges = [
        'available'  => '<span class="badge badge-success">Available</span>',
        'allocated'  => '<span class="badge badge-danger">Allocated</span>',
        'maintenance'=> '<span class="badge badge-warning">Maintenance</span>',
        'active'     => '<span class="badge badge-success">Active</span>',
        'inactive'   => '<span class="badge badge-secondary">Inactive</span>',
        'paid'       => '<span class="badge badge-success">Paid</span>',
        'pending'    => '<span class="badge badge-warning">Pending</span>',
        'overdue'    => '<span class="badge badge-danger">Overdue</span>',
        'surrendered'=> '<span class="badge badge-secondary">Surrendered</span>',
    ];
    return $badges[$status] ?? '<span class="badge badge-secondary">' . ucfirst($status) . '</span>';
}

// Dashboard stats
function getDashboardStats($conn) {
    $stats = [];
    $stats['total_lockers']     = $conn->query("SELECT COUNT(*) as c FROM lockers")->fetch_assoc()['c'];
    $stats['available_lockers'] = $conn->query("SELECT COUNT(*) as c FROM lockers WHERE status='available'")->fetch_assoc()['c'];
    $stats['allocated_lockers'] = $conn->query("SELECT COUNT(*) as c FROM lockers WHERE status='allocated'")->fetch_assoc()['c'];
    $stats['total_customers']   = $conn->query("SELECT COUNT(*) as c FROM customers")->fetch_assoc()['c'];
    $stats['active_allocations']= $conn->query("SELECT COUNT(*) as c FROM allocations WHERE status='active'")->fetch_assoc()['c'];
    $stats['total_revenue']     = $conn->query("SELECT COALESCE(SUM(rent_paid),0) as c FROM allocations WHERE payment_status='paid'")->fetch_assoc()['c'];
    return $stats;
}
