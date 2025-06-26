<?php
session_start();
include '../includes/koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
$user_id = $_SESSION['user_id'];

// Ambil produk dari database
$produk = mysqli_query($conn, "SELECT * FROM products WHERE stock > 0 ORDER BY name");
$produk_arr = [];
while ($row = mysqli_fetch_assoc($produk)) {
    $produk_arr[$row['id']] = $row;
}

// Proses pemesanan
$success = '';
$error = '';
if (isset($_POST['order'])) {
    $items = $_POST['items']; // array of [product_id, quantity, days]
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $total = 0;
    $valid = true;
    $order_items = [];
    foreach ($items as $item) {
        $pid = (int)$item['product_id'];
        $qty = (int)$item['quantity'];
        $days = (int)$item['days'];
        if (!isset($produk_arr[$pid])) {
            $valid = false;
            $error = 'Produk tidak ditemukan!';
            break;
        }
        if ($qty < 1 || $qty > $produk_arr[$pid]['stock']) {
            $valid = false;
            $error = 'Jumlah tidak valid untuk produk ' . htmlspecialchars($produk_arr[$pid]['name']) . '!';
            break;
        }
        if ($days < 1) {
            $valid = false;
            $error = 'Lama penyewaan minimal 1 hari untuk produk ' . htmlspecialchars($produk_arr[$pid]['name']) . '!';
            break;
        }
        $subtotal = $produk_arr[$pid]['price'] * $qty * $days;
        $total += $subtotal;
        $order_items[] = [
            'product_id' => $pid,
            'quantity' => $qty,
            'days' => $days,
            'price' => $produk_arr[$pid]['price'],
            'subtotal' => $subtotal
        ];
    }
    if ($valid && count($order_items) > 0) {
        $sql = "INSERT INTO orders (user_id, status, total_price, contact, payment_method) VALUES ($user_id, 'pending', $total, '$contact', '$payment_method')";
        if (mysqli_query($conn, $sql)) {
            $order_id = mysqli_insert_id($conn);
            foreach ($order_items as $oi) {
                mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, {$oi['product_id']}, {$oi['quantity']}, {$oi['price']})");
                // Update stok
                mysqli_query($conn, "UPDATE products SET stock = stock - {$oi['quantity']} WHERE id = {$oi['product_id']}");
            }
            $success = 'Pemesanan berhasil!';
        } else {
            $error = 'Gagal memproses pemesanan!';
        }
    } elseif ($valid) {
        $error = 'Minimal pilih satu barang.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Alat Camping - RentCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
    // Data produk untuk JS
    const produkData = <?php echo json_encode($produk_arr); ?>;
    function addRow() {
        const tbody = document.getElementById('items-body');
        const idx = tbody.children.length;
        let options = '<option value="">-- Pilih Produk --</option>';
        for (const id in produkData) {
            const p = produkData[id];
            options += `<option value="${id}">${p.name} (Stok: ${p.stock}) - Rp ${parseInt(p.price).toLocaleString('id-ID')}/hari</option>`;
        }
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><select name="items[${idx}][product_id]" class="form-select" required onchange="updateDetail(this)">${options}</select><div class="text-success small detail-barang"></div></td>
            <td><input type="number" name="items[${idx}][quantity]" class="form-control" min="1" value="1" required oninput="updateSubtotal(this)"></td>
            <td><input type="number" name="items[${idx}][days]" class="form-control" min="1" value="1" required oninput="updateSubtotal(this)"></td>
            <td class="harga-barang">-</td>
            <td class="subtotal-barang">-</td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
        `;
        tbody.appendChild(row);
    }
    function removeRow(btn) {
        btn.closest('tr').remove();
        updateTotal();
    }
    function updateDetail(sel) {
        const tr = sel.closest('tr');
        const pid = sel.value;
        const detail = tr.querySelector('.detail-barang');
        const harga = tr.querySelector('.harga-barang');
        if (produkData[pid]) {
            detail.innerHTML = `<b>${produkData[pid].name}</b><br>Harga: Rp ${parseInt(produkData[pid].price).toLocaleString('id-ID')}/hari`;
            harga.innerText = 'Rp ' + parseInt(produkData[pid].price).toLocaleString('id-ID') + '/hari';
        } else {
            detail.innerHTML = '';
            harga.innerText = '-';
        }
        updateSubtotal(tr.querySelector('input[name$="[quantity]"]'));
    }
    function updateSubtotal(input) {
        const tr = input.closest('tr');
        const pid = tr.querySelector('select').value;
        const qty = parseInt(tr.querySelector('input[name$="[quantity]"]').value) || 0;
        const days = parseInt(tr.querySelector('input[name$="[days]"]').value) || 0;
        const subtotalTd = tr.querySelector('.subtotal-barang');
        let subtotal = 0;
        if (produkData[pid] && qty > 0 && days > 0) {
            subtotal = produkData[pid].price * qty * days;
        }
        subtotalTd.innerText = subtotal > 0 ? 'Rp ' + subtotal.toLocaleString('id-ID') : '-';
        updateTotal();
    }
    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal-barang').forEach(function(td) {
            const val = td.innerText.replace(/[^\d]/g, '');
            total += parseInt(val) || 0;
        });
        document.getElementById('total-harga').innerText = 'Total: Rp ' + total.toLocaleString('id-ID');
    }
    window.onload = function() {
        addRow();
    };
    </script>
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
        <h2 class="mb-4">Form Pemesanan Alat Camping</h2>
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Lama (hari)</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="items-body">
                </tbody>
            </table>
            <button type="button" class="btn btn-outline-success mb-3" onclick="addRow()">Tambah Barang</button>
            <div class="mb-3">
                <label>Kontak (WA/HP)</label>
                <input type="text" name="contact" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Metode Pembayaran</label>
                <select name="payment_method" class="form-select" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="COD">Bayar di Tempat (COD)</option>
                    <option value="QRIS">QRIS</option>
                </select>
            </div>
            <div class="mb-3">
                <span id="total-harga" class="fw-bold text-primary">Total: Rp 0</span>
            </div>
            <button type="submit" name="order" class="btn btn-success">Pesan</button>
        </form>
    </div>
</body>
</html> 