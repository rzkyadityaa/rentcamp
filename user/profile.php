<?php
session_start();
include '../includes/koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT name, email FROM users WHERE id = $user_id";
$res = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User - RentCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .avatar-profile {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        background: #e8f5e9;
        border: 3px solid #43c06d;
        margin-bottom: 18px;
    }
    </style>
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
        <h2 class="mb-4">Profil User</h2>
        <div class="card text-center">
            <div class="card-body">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Avatar" class="avatar-profile">
                <p><b>Nama:</b> <?php echo htmlspecialchars($user['name']); ?></p>
                <p><b>Email:</b> <?php echo htmlspecialchars($user['email']); ?></p>
                <a href="#" class="btn btn-outline-success disabled">Ubah Password (coming soon)</a>
            </div>
        </div>
    </div>
</body>
</html> 