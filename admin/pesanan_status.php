<?php
session_start();
include '../includes/koneksi.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}
if (isset($_POST['id'], $_POST['status'])) {
    $id = (int)$_POST['id'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $allowed = ['pending','approved','completed','cancelled'];
    if (in_array($status, $allowed)) {
        mysqli_query($conn, "UPDATE orders SET status='$status' WHERE id=$id");
    }
}
header('Location: pesanan.php');
exit; 