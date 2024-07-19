<?php
session_start();
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: books.php");
    exit;
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO books (title, author, stock) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $author, $stock);

    if ($stmt->execute()) {
        $message = "Buku berhasil ditambahkan.";
    } else {
        $message = "Terjadi kesalahan: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
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
            <h1>Tambah Buku Baru</h1>
            <?php if (isset($message)): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <form method="post" action="add_book.php">
                <label for="title">Judul:</label>
                <input type="text" id="title" name="title" required>
                <label for="author">Penulis:</label>
                <input type="text" id="author" name="author" required>
                <label for="stock">Stok:</label>
                <input type="number" id="stock" name="stock" required min="0">
                <button type="submit" class="btn">Tambahkan Buku</button>
            </form>
        </div>
    </div>
</body>
</html>
