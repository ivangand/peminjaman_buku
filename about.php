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
    <title>Tentang Website</title>
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
                <h1>Tentang MyLibrary</h1>
            </header>

            <section class="about">
                <div class="intro">
                    <h2>Selamat Datang di MyLibrary</h2>
                    <p>MyLibrary adalah platform perpustakaan digital yang dirancang untuk memberikan akses mudah ke koleksi buku yang luas dan beragam. Kami percaya bahwa membaca adalah salah satu cara terbaik untuk memperluas pengetahuan dan imajinasi, dan kami berkomitmen untuk membuat pengalaman membaca semudah mungkin untuk semua orang.</p>
                </div>

                <div class="mission-vision">
                    <h2>Visi dan Misi</h2>
                    <p><strong>Visi:</strong> Menjadi platform perpustakaan digital terkemuka yang memudahkan akses buku dan sumber daya pendidikan kepada semua orang di seluruh dunia.</p>
                    <p><strong>Misi:</strong> Menyediakan antarmuka yang ramah pengguna, koleksi buku yang lengkap, dan layanan peminjaman yang efisien untuk mempromosikan kebiasaan membaca dan pembelajaran berkelanjutan.</p>
                </div>

                <div class="features">
                    <h2>Fitur Utama</h2>
                    <ul>
                        <li><strong>Koleksi Buku:</strong> Akses ke ribuan buku dari berbagai genre dan kategori.</li>
                        <li><strong>Peminjaman Buku:</strong> Sistem peminjaman yang mudah digunakan untuk meminjam buku favorit Anda.</li>
                        <li><strong>Update dan Notifikasi:</strong> Dapatkan informasi terbaru tentang buku baru dan berita terkini dari perpustakaan.</li>
                        <li><strong>Antarmuka Ramah Pengguna:</strong> Desain yang intuitif dan mudah digunakan untuk pengalaman yang menyenangkan.</li>
                    </ul>
                </div>

                <div class="team">
                    <h2>Tim Kami</h2>
                    <p>Tim MyLibrary terdiri dari individu yang berdedikasi dalam bidang teknologi dan pendidikan. Kami bekerja keras untuk memastikan bahwa platform kami memberikan pengalaman terbaik bagi pengguna kami.</p>
                    <div class="team-members">
                        <div class="team-member">
                            <h3>Naruto</h3>
                            <p>Pengembang Utama</p>
                        </div>
                        <div class="team-member">
                            <h3>Sasuke</h3>
                            <p>Desainer UI/UX</p>
                        </div>
                        <div class="team-member">
                            <h3>Madara</h3>
                            <p>Manajer Proyek</p>
                        </div>
                    </div>
                </div>

                <div class="contact">
                    <h2>Hubungi Kami</h2>
                    <p>Jika Anda memiliki pertanyaan atau umpan balik, jangan ragu untuk menghubungi tim kami melalui informasi kontak di bawah ini:</p>
                    <ul>
                        <li>Email: irfanganendra2408.com</li>
                        <li>Telepon: +62 821 1844 7655</li>
                        <li>Alamat: Jawa Barat ,Bandung ,Cileuyi</li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
