<?php
session_start();
include '../includes/koneksi.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}
// Ambil data produk
$produk = mysqli_query($conn, "SELECT * FROM products ORDER BY name");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - Admin RentCamp</title>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Manajemen Produk</h2>
            <a href="produk_tambah.php" class="btn btn-success">+ Tambah Produk</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; while ($row = mysqli_fetch_assoc($produk)): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><img src="../public/images/<?php echo htmlspecialchars($row['image'] ?: 'tenda.jpg'); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="width:60px; height:60px; object-fit:contain; background:#fff; border-radius:8px;"></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td>Rp <?php echo number_format($row['price'],0,',','.'); ?>/hari</td>
                        <td><?php echo $row['stock']; ?></td>
                        <td>
                            <a href="produk_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="produk_hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus produk ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> 