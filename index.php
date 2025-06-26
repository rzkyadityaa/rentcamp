<?php
include 'includes/koneksi.php';
// Ambil produk dari database
$produk = mysqli_query($conn, "SELECT * FROM products ORDER BY name");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentCamp - Sewa Alat Camping</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">RentCamp</a>
            <div class="d-flex">
                <a href="login.php" class="btn btn-light me-2">Login</a>
                <a href="user/register.php" class="btn btn-outline-light">Register</a>
            </div>
        </div>
    </nav>
    <header class="bg-light py-5">
        <div class="container text-center">
            <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f3d5.svg" class="hero-icon" alt="Camping Icon">
            <h1 class="display-4">Sewa Alat Camping Mudah & Terpercaya</h1>
            <p class="lead">RentCamp menyediakan berbagai alat camping berkualitas untuk kebutuhan petualangan Anda. Proses mudah, harga terjangkau, dan layanan ramah!</p>
        </div>
    </header>
    <section class="container my-5">
        <div class="row text-center mb-5">
            <div class="col-md-3 mb-3">
                <div class="card h-100 fitur-card">
                    <div class="card-body">
                        <svg class="fitur-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        <h5 class="card-title text-success">Proses Mudah</h5>
                        <p class="card-text">Pemesanan online cepat, tanpa ribet, dan konfirmasi instan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card h-100 fitur-card">
                    <div class="card-body">
                        <svg class="fitur-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M16 12a4 4 0 01-8 0"/></svg>
                        <h5 class="card-title text-success">Alat Bersih & Terawat</h5>
                        <p class="card-text">Semua alat camping selalu dicek dan dibersihkan sebelum disewakan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card h-100 fitur-card">
                    <div class="card-body">
                        <svg class="fitur-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        <h5 class="card-title text-success">Harga Terjangkau</h5>
                        <p class="card-text">Harga sewa alat camping sangat bersaing dan ramah di kantong.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card h-100 fitur-card">
                    <div class="card-body">
                        <svg class="fitur-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        <h5 class="card-title text-success">Support 24 Jam</h5>
                        <p class="card-text">Tim kami siap membantu Anda kapan saja selama masa sewa.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h3 class="mb-3">Cara Pemesanan</h3>
                <ol>
                    <li>Registrasi atau login ke akun Anda.</li>
                    <li>Pilih alat camping yang ingin disewa.</li>
                    <li>Isi form pemesanan dan konfirmasi.</li>
                    <li>Ambil alat di lokasi atau pilih layanan antar.</li>
                </ol>
                <a href="user/register.php" class="btn btn-success me-2">Daftar Sekarang</a>
                <a href="#katalog" class="btn btn-outline-success">Lihat Katalog</a>
            </div>
        </div>
        <h3 class="mb-4 text-center">Testimoni Pelanggan</h3>
        <div class="row justify-content-center mb-5 testimoni">
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <span class="quote">“</span>
                    <div class="text-center">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="avatar" alt="Dwi">
                    </div>
                    <div class="card-body">
                        <p class="card-text">"Alatnya bersih, proses sewa gampang, adminnya ramah banget!"</p>
                        <div class="fw-bold text-success">- Dwi, Bandung</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <span class="quote">“</span>
                    <div class="text-center">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" class="avatar" alt="Rina">
                    </div>
                    <div class="card-body">
                        <p class="card-text">"Sangat membantu untuk camping keluarga, harga oke dan alat lengkap."</p>
                        <div class="fw-bold text-success">- Rina, Cimahi</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <span class="quote">“</span>
                    <div class="text-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="avatar" alt="Andi">
                    </div>
                    <div class="card-body">
                        <p class="card-text">"Sudah langganan, selalu puas dengan pelayanannya!"</p>
                        <div class="fw-bold text-success">- Andi, Lembang</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container my-5" id="katalog">
        <h2 class="mb-4 text-center">Katalog Alat Camping</h2>
        <div class="row justify-content-center">
            <?php if (mysqli_num_rows($produk) > 0):
                while ($row = mysqli_fetch_assoc($produk)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="public/images/<?php echo htmlspecialchars($row['image'] ?: 'tenda.jpg'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="fw-bold">Rp <?php echo number_format($row['price'],0,',','.'); ?>/hari</p>
                            <a href="login.php" class="btn btn-success w-100">Sewa</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; else: ?>
                <div class="col-12 text-center text-muted">Belum ada produk tersedia.</div>
            <?php endif; ?>
        </div>
    </section>
    <section class="bg-success text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h2 class="mb-3"><svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:8px;"><circle cx="12" cy="12" r="10"/><path d="M16 8c0 2.21-2.69 4-6 4s-6-1.79-6-4"/></svg>Kontak Kami</h2>
                    <p class="mb-2"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:6px;"><path d="M4 4h16v16H4z"/><path d="M22 6l-10 7L2 6"/></svg>Email: <a href="mailto:info@rentcamp.com" class="text-white text-decoration-underline">info@rentcamp.com</a></p>
                    <p class="mb-2"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:6px;"><path d="M22 16.92V19a2 2 0 0 1-2 2A18 18 0 0 1 3 5a2 2 0 0 1 2-2h2.09a2 2 0 0 1 2 1.72c.13.81.36 1.6.68 2.34a2 2 0 0 1-.45 2.11l-.27.27a16 16 0 0 0 6.29 6.29l.27-.27a2 2 0 0 1 2.11-.45c.74.32 1.53.55 2.34.68A2 2 0 0 1 19 16.91z"/></svg>WhatsApp: <a href="https://wa.me/6281234567890" class="text-white text-decoration-underline">0812-3456-7890</a></p>
                </div>
                <div class="col-md-6">
                    <p class="mb-0"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:6px;"><path d="M21 10.5a8.38 8.38 0 0 1-1.9 5.4c-1.5 2-4.6 5.1-6.1 6.4a1.7 1.7 0 0 1-2.1 0c-1.5-1.3-4.6-4.4-6.1-6.4A8.38 8.38 0 0 1 3 10.5C3 6.36 6.36 3 10.5 3S18 6.36 18 10.5z"/><circle cx="12" cy="10.5" r="3.5"/></svg>Alamat: <span class="fw-bold">Jl. Petualang No. 123, Bandung</span></p>
                </div>
            </div>
        </div>
    </section>
    <section class="container my-5">
        <h3 class="mb-4 text-center">Lokasi Kami</h3>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body p-0">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9!2d107.6!3d-6.9!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7b5b5b5b5b5%3A0x2e68e7b5b5b5b5b5!2sJl.%20Petualang%20No.%20123%2C%20Bandung!5e0!3m2!1sen!2sid!4v1234567890" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">&copy; 2024 RentCamp. All rights reserved.</div>
    </footer>
    <div id="loading-overlay" class="loading-overlay" style="display:none;">
        <div class="loading-spinner"></div>
    </div>
    <div id="toast-custom" class="toast-custom"></div>
    <script>
    // Animasi masuk untuk card dan section
    function revealOnScroll() {
        var reveals = document.querySelectorAll('.card, section.container');
        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 80;
            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add('visible');
            }
        }
    }
    window.addEventListener('scroll', revealOnScroll);
    window.addEventListener('DOMContentLoaded', revealOnScroll);
    // Animasi loading
    function showLoading() {
        document.getElementById('loading-overlay').style.display = 'flex';
    }
    function hideLoading() {
        document.getElementById('loading-overlay').style.display = 'none';
    }
    // Notifikasi toast
    function showToast(msg, isError = false) {
        var toast = document.getElementById('toast-custom');
        toast.textContent = msg;
        toast.className = 'toast-custom show' + (isError ? ' error' : '');
        setTimeout(() => { toast.className = 'toast-custom'; }, 3000);
    }
    // Contoh penggunaan (bisa di-trigger dari aksi form, dsb)
    // showLoading(); setTimeout(hideLoading, 2000);
    // showToast('Berhasil melakukan aksi!');
    // showToast('Terjadi kesalahan!', true);
    </script>
</body>
</html> 