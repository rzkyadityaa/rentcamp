<?php
session_start();
include '../includes/koneksi.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}
$error = '';
$success = '';
if (isset($_POST['tambah'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $price = (int)$_POST['price'];
    $stock = (int)$_POST['stock'];
    $image = '';
    if ($_FILES['image']['name']) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $imgname = uniqid('prod_').'.'.$ext;
        $target = '../public/images/'.$imgname;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image = $imgname;
        } else {
            $error = 'Upload gambar gagal!';
        }
    }
    if (!$error) {
        $sql = "INSERT INTO products (name, description, price, image, stock) VALUES ('$name', '$desc', $price, '$image', $stock)";
        if (mysqli_query($conn, $sql)) {
            $success = 'Produk berhasil ditambahkan!';
            header('Refresh:2; url=produk.php');
        } else {
            $error = 'Gagal menambah produk!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Admin RentCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">RentCamp Admin</a>
            <div class="d-flex">
                <a href="produk.php" class="btn btn-light me-2">Manajemen Produk</a>
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <h2 class="mb-4">Tambah Produk</h2>
        <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
        <?php if ($success): ?><div class="alert alert-success"><?php echo $success; ?></div><?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>Harga Sewa (per hari)</label>
                <input type="number" name="price" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stock" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label>Gambar Produk</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <button type="submit" name="tambah" class="btn btn-success">Tambah Produk</button>
            <a href="produk.php" class="btn btn-secondary ms-2">Kembali</a>
        </form>
    </div>
</body>
</html> 