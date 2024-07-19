<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <!-- Tab bar menu -->
        <div class="sidebar">
            <div class="logo">
                <h2>MyLibrary</h2>
            </div>
            <ul class="nav-menu">
                <li><a href="index.php">Beranda</a></li>
                <li><a href="books.php">Daftar Buku</a></li>
                <li><a href="about.php">Tentang Website</a></li>
                <?php if ($_SESSION['is_admin']): ?>
                <li><a href="admin.php">Admin</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Konten utama -->
        <div class="main-content">
            <header>
                <h1>Selamat Datang di MyLibrary</h1>
                <p>Temukan koleksi buku terbaik dan pinjam buku favorit Anda dengan mudah.</p>
            </header>
            
            <section class="features">
                <div class="feature">
                    <h2>Koleksi Buku Lengkap</h2>
                    <p>MyLibrary menawarkan berbagai koleksi buku dari berbagai genre dan kategori. Dari fiksi hingga non-fiksi, Anda akan menemukan buku yang sesuai dengan minat dan kebutuhan Anda.</p>
                </div>
                <div class="feature">
                    <h2>Peminjaman Mudah</h2>
                    <p>Dengan sistem peminjaman yang mudah digunakan, Anda dapat meminjam buku dengan beberapa klik saja. Cek ketersediaan buku dan lakukan peminjaman tanpa ribet.</p>
                </div>
                <div class="feature">
                    <h2>Update dan Notifikasi</h2>
                    <p>Kami memberikan notifikasi terkait buku yang baru ditambahkan dan berita terkini tentang perpustakaan. Jangan lewatkan informasi penting!</p>
                </div>
            </section>

            <section class="about">
                <h2>Tentang Kami</h2>
                <p>MyLibrary adalah platform perpustakaan digital yang bertujuan untuk mempermudah akses ke berbagai koleksi buku. Kami percaya bahwa buku adalah sumber pengetahuan yang sangat berharga dan harus dapat diakses oleh siapa saja.</p>
                <p>Kami berkomitmen untuk memberikan pengalaman pengguna yang terbaik dengan menyediakan antarmuka yang ramah dan layanan yang efisien. Bergabunglah dengan kami dan jelajahi dunia pengetahuan!</p>
            </section>

            <section class="testimonials">
                <h2>Testimoni Pengguna</h2>
                <div class="testimonial">
                    <p>"MyLibrary membuat peminjaman buku sangat mudah dan menyenangkan. Koleksi buku yang lengkap dan sistem yang efisien!"</p>
                    <cite>- Spongebob</cite>
                </div>
                <div class="testimonial">
                    <p>"Saya sangat suka dengan antarmuka MyLibrary yang bersih dan mudah digunakan. Terima kasih untuk pengalaman yang luar biasa!"</p>
                    <cite>- Tuan Krab</cite>
                </div>
            </section>

            <section class="contact">
                <h2>Kontak Kami</h2>
                <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi kami:</p>
                <ul>
                    <li>Email: irfanganendra2408@gmail.com</li>
                    <li>Telepon: +62 821 1844 7655</li>
                    <li>Alamat: Jawa Barat ,Bandung ,Cileuyi</li>
                </ul>
            </section>
        </div>
    </div>
</body>
</html>