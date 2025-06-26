<?php
session_start();
include '../includes/koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
$user_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];
// Ambil riwayat pemesanan user
$sql = "SELECT o.id, o.order_date, o.status, o.total_price
        FROM orders o
        WHERE o.user_id = $user_id
        ORDER BY o.order_date DESC";
$orders = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - RentCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="../index.php">RentCamp</a>
            <div class="d-flex">
                <a href="profile.php" class="btn btn-light me-2">Profil</a>
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Dashboard User</h2>
            <a href="order.php" class="btn btn-success">Sewa Alat Camping</a>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <h5>Selamat datang, <b><?php echo htmlspecialchars($name); ?></b>!</h5>
                <p>Berikut adalah riwayat pemesanan Anda:</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-success text-white">Riwayat Pemesanan</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (mysqli_num_rows($orders) > 0):
                            while ($row = mysqli_fetch_assoc($orders)): ?>
                            <tr>
                                <td>#<?php echo $row['id']; ?></td>
                                <td><?php echo date('d-m-Y H:i', strtotime($row['order_date'])); ?></td>
                                <td><span class="badge bg-<?php
                                    switch($row['status']) {
                                        case 'approved': echo 'primary'; break;
                                        case 'completed': echo 'success'; break;
                                        case 'cancelled': echo 'danger'; break;
                                        default: echo 'secondary';
                                    }
                                ?>"><?php echo ucfirst($row['status']); ?></span></td>
                                <td>Rp <?php echo number_format($row['total_price'],0,',','.'); ?></td>
                                <td><a href="order_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-success">Lihat</a></td>
                            </tr>
                        <?php endwhile; else: ?>
                            <tr><td colspan="5" class="text-center">Belum ada pemesanan.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 