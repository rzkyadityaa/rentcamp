<?php
session_start();
include '../includes/koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
$user_id = $_SESSION['user_id'];
$order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
// Ambil data order
$sql = "SELECT * FROM orders WHERE id = $order_id AND user_id = $user_id";
$res = mysqli_query($conn, $sql);
$order = mysqli_fetch_assoc($res);
if (!$order) {
    echo '<div class="alert alert-danger">Pesanan tidak ditemukan.</div>';
    exit;
}
// Ambil item pesanan
$sql_items = "SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = $order_id";
$items = mysqli_query($conn, $sql_items);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #<?php echo $order_id; ?> - RentCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">RentCamp</a>
            <div class="d-flex">
                <a href="dashboard.php" class="btn btn-light me-2">Dashboard</a>
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <h2 class="mb-4">Detail Pesanan #<?php echo $order_id; ?></h2>
        <div class="card mb-4">
            <div class="card-body">
                <p><b>Tanggal Pesan:</b> <?php echo date('d-m-Y H:i', strtotime($order['order_date'])); ?></p>
                <p><b>Status:</b> <span class="badge bg-<?php
                    switch($order['status']) {
                        case 'approved': echo 'primary'; break;
                        case 'completed': echo 'success'; break;
                        case 'cancelled': echo 'danger'; break;
                        default: echo 'secondary';
                    }
                ?>"><?php echo ucfirst($order['status']); ?></span></p>
                <p><b>Kontak:</b> <?php echo htmlspecialchars($order['contact']); ?></p>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-success text-white">Daftar Item Pesanan</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Sewa</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $total = 0; while ($row = mysqli_fetch_assoc($items)): $subtotal = $row['quantity'] * $row['price']; $total += $subtotal; ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>Rp <?php echo number_format($row['price'],0,',','.'); ?>/hari</td>
                                <td>Rp <?php echo number_format($subtotal,0,',','.'); ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th>Rp <?php echo number_format($total,0,',','.'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <a href="dashboard.php" class="btn btn-secondary mt-4">Kembali ke Dashboard</a>
    </div>
</body>
</html> 