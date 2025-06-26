<?php
session_start();
include 'includes/koneksi.php';

$error = '';
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        if ($password === $row['password']) {
            if ($row['role'] === 'admin') {
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_name'] = $row['name'];
                header('Location: admin/dashboard.php');
                exit;
            } else {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                header('Location: user/dashboard.php');
                exit;
            }
        } else {
            $error = 'Password salah!';
        }
    } else {
        $error = 'Email tidak ditemukan!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RentCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="mb-4 text-center">Login</h3>
                        <?php if ($error) { echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
                        <form method="post">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-success w-100">Login</button>
                        </form>
                        <div class="mt-3 text-center">
                            Belum punya akun? <a href="user/register.php">Daftar di sini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 