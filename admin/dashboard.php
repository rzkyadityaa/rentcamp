<?php
session_start();
include '../includes/koneksi.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}
$admin_name = $_SESSION['admin_name'];
// Statistik
$jml_produk = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM products"))[0];
$jml_pesanan = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM orders"))[0];
$jml_user = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE role='user'"))[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - RentCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">RentCamp Admin</a>
            <div class="d-flex">
                <span class="text-white me-3">Halo, <?php echo htmlspecialchars($admin_name); ?></span>
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <h2 class="mb-4">Dashboard Admin</h2>
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card text-center border-success">
                    <div class="card-body">
                        <div class="mb-2" style="font-size:2.2rem; color:#218838;"><i class="bi bi-box-seam"></i>📦</div>
                        <h5 class="card-title">Jumlah Produk</h5>
                        <div class="display-6 fw-bold"><?php echo $jml_produk; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center border-success">
                    <div class="card-body">
                        <div class="mb-2" style="font-size:2.2rem; color:#218838;">📝</div>
                        <h5 class="card-title">Jumlah Pesanan</h5>
                        <div class="display-6 fw-bold"><?php echo $jml_pesanan; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center border-success">
                    <div class="card-body">
                        <div class="mb-2" style="font-size:2.2rem; color:#218838;">👤</div>
                        <h5 class="card-title">Jumlah User</h5>
                        <div class="display-6 fw-bold"><?php echo $jml_user; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="produk.php" class="btn btn-success w-100 py-3 fs-5">Manajemen Produk</a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="pesanan.php" class="btn btn-outline-success w-100 py-3 fs-5">Manajemen Pesanan</a>
            </div>
        </div>
    </div>
</body>
</html>
