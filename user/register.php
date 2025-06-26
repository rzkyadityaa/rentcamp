<?php
session_start();
include '../includes/koneksi.php';

$error = '';
$success = '';
if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    if ($password !== $confirm) {
        $error = 'Konfirmasi password tidak cocok!';
    } else {
        $cek = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
        if (mysqli_num_rows($cek) > 0) {
            $error = 'Email sudah terdaftar!';
        } else {
            $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'user')";
            if (mysqli_query($conn, $sql)) {
                $success = 'Registrasi berhasil! Silakan login.';
                header('Refresh:2; url=../login.php');
            } else {
                $error = 'Registrasi gagal!';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User - RentCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="mb-4 text-center">Registrasi User</h3>
                        <?php if ($error) { echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
                        <?php if ($success) { echo '<div class="alert alert-success">'.$success.'</div>'; } ?>
                        <form method="post">
                            <div class="mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="confirm" class="form-control" required>
                            </div>
                            <button type="submit" name="register" class="btn btn-success w-100">Register</button>
                        </form>
                        <div class="mt-3 text-center">
                            Sudah punya akun? <a href="../login.php">Login di sini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 