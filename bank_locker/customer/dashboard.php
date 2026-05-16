<?php
$page_title = "My Dashboard";
require_once '../includes/header_customer.php';
$conn = getDBConnection();
$cid = $_SESSION['customer_id'];

$allocs = $conn->query("
    SELECT a.*, l.locker_number, l.locker_size, l.location, l.annual_rent
    FROM allocations a JOIN lockers l ON a.locker_id=l.id
    WHERE a.customer_id=$cid ORDER BY a.created_at DESC
");
$rows = [];
while ($r = $allocs->fetch_assoc()) $rows[] = $r;

$active_count = count(array_filter($rows, fn($r) => $r['status']==='active'));
$last_access = $conn->query("
    SELECT al.access_date, al.access_time, l.locker_number
    FROM access_log al JOIN lockers l ON al.locker_id=l.id
    WHERE al.customer_id=$cid ORDER BY al.created_at DESC LIMIT 1
")->fetch_assoc();
?>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon blue">🔒</div>
    <div class="stat-info">
      <div class="stat-value"><?= $active_count ?></div>
      <div class="stat-label">Active Locker(s)</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon purple">📋</div>
    <div class="stat-info">
      <div class="stat-value"><?= count($rows) ?></div>
      <div class="stat-label">Total Allocations</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon green">📅</div>
    <div class="stat-info">
      <div class="stat-value"><?= $last_access ? $last_access['access_date'] : '—' ?></div>
      <div class="stat-label">Last Access</div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header"><h3>🔑 My Locker Allocations</h3></div>
  <div class="table-responsive">
    <table>
      <thead>
        <tr><th>Alloc No.</th><th>Locker</th><th>Size</th><th>Location</th><th>From</th><th>Expiry</th><th>Rent</th><th>Payment</th><th>Status</th></tr>
      </thead>
      <tbody>
        <?php if(empty($rows)): ?>
        <tr><td colspan="9" class="text-center" style="padding:30px;color:#888;">No allocations found. Contact the bank to get a locker.</td></tr>
        <?php else: foreach($rows as $a): ?>
        <tr>
          <td><strong><?= htmlspecialchars($a['allocation_no']) ?></strong></td>
          <td><?= htmlspecialchars($a['locker_number']) ?></td>
          <td><?= getLockerSizeLabel($a['locker_size']) ?></td>
          <td style="font-size:12px;"><?= htmlspecialchars($a['location']) ?></td>
          <td><?= $a['allocation_date'] ?></td>
          <td><?= $a['expiry_date'] ?></td>
          <td><?= formatCurrency($a['rent_paid']) ?></td>
          <td><?= getStatusBadge($a['payment_status']) ?></td>
          <td><?= getStatusBadge($a['status']) ?></td>
        </tr>
        <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php $conn->close(); require_once '../includes/footer_customer.php'; ?>
