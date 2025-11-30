<?php
// admin/dashboard.php - top
session_start();
include __DIR__ . "/../db.php"; // adjust relative path if needed

if (empty($_SESSION['admin_id'])) {
    // Not an admin → send to login (not to index)
    header("Location: /photography-site/login.php"); // adjust path as needed
    exit();
}

// load admin dashboard...

include "../db.php";

// fetch all bookings
$sql = "SELECT * FROM bookings ORDER BY id DESC";
$res = $conn->query($sql);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard — ZEIRO</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .admin-header { padding:16px; font-weight:700; background:#111; color:#fff; }
        .admin-container { padding:24px; max-width:1100px; margin:20px auto; }
        .admin-table { width:100%; border-collapse:collapse; }
        .admin-table th, .admin-table td { padding:8px 10px; border:1px solid #222; color:#ddd; }
        .actions a { margin-right:8px; }
    </style>
</head>
<body>
<div class="admin-header">ZEIRO Photography — Admin Panel (Welcome <?=htmlspecialchars($_SESSION['user_name'] ?? 'Admin')?>)</div>

<div class="admin-container">
    <h2>All Bookings</h2>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th><th>Client</th><th>Email</th><th>Phone</th><th>Experience</th>
                <th>Package</th><th>Price</th><th>Payment Status</th><th>Payment ID</th><th>Created At</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($res && $res->num_rows > 0): ?>
            <?php while($r = $res->fetch_assoc()): ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= htmlspecialchars($r['name']) ?></td>
                    <td><?= htmlspecialchars($r['email']) ?></td>
                    <td><?= htmlspecialchars($r['phone']) ?></td>
                    <td><?= htmlspecialchars($r['experience']) ?></td>
                    <td><?= htmlspecialchars($r['package_choice'] ?? $r['package']) ?></td>
                    <td><?= htmlspecialchars($r['price_total'] ?? $r['package_price'] ?? '') ?></td>
                    <td><?= htmlspecialchars($r['payment_status'] ?? '') ?></td>
                    <td><?= htmlspecialchars($r['payment_id'] ?? '') ?></td>
                    <td><?= htmlspecialchars($r['created_at'] ?? '') ?></td>
                    <td class="actions">
                        <a href="view_booking.php?id=<?= $r['id'] ?>">View</a>
                        <a href="assign_photographer.php?id=<?= $r['id'] ?>">Assign</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="11">No bookings yet.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <p style="margin-top:20px;"><a href="../logout.php">Logout</a></p>
</div>
</body>
</html>
