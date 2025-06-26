<?php
session_start();
include '../includes/koneksi.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}
// Ambil data pesanan
$pesanan = mysqli_query($conn, "SELECT o.*, u.name as user_name FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.order_date DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - Admin RentCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">RentCamp Admin</a>
            <div class="d-flex">
                <a href="dashboard.php" class="btn btn-light me-2">Dashboard</a>
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <h2 class="mb-4">Manajemen Pesanan</h2>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($pesanan)): ?>
                    <tr>
                        <td>#<?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                        <td><?php echo date('d-m-Y H:i', strtotime($row['order_date'])); ?></td>
                        <td>
                            <form method="post" action="pesanan_status.php" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <select name="status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                                    <option value="pending" <?php if($row['status']=='pending') echo 'selected'; ?>>Pending</option>
                                    <option value="approved" <?php if($row['status']=='approved') echo 'selected'; ?>>Disetujui</option>
                                    <option value="completed" <?php if($row['status']=='completed') echo 'selected'; ?>>Selesai</option>
                                    <option value="cancelled" <?php if($row['status']=='cancelled') echo 'selected'; ?>>Dibatalkan</option>
                                </select>
                            </form>
                        </td>
                        <td>Rp <?php echo number_format($row['total_price'],0,',','.'); ?></td>
                        <td>
                            <a href="pesanan_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> 