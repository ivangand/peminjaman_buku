<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO books (title, author, stock) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $author, $stock);

    if ($stmt->execute()) {
        $message = "Buku berhasil ditambahkan!";
    } else {
        $message = "Terjadi kesalahan: " . $stmt->error;
    }
}

// Ambil data buku dari database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="books.php">Daftar Buku</a></li>
                <li><a href="about.php">Tentang Website</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="logout.php">Keluar</a></li>
            </ul>
        </aside>
        <main class="content">
            <header>
                <h1>Halaman Admin</h1>
            </header>
            <section class="admin-actions">
                <h2>Tambah Buku Baru</h2>
                <?php if (!empty($message)): ?>
                <div class="message"><?php echo htmlspecialchars($message); ?></div>
                <?php endif; ?>
                <form method="post">
                    <label for="title">Judul Buku:</label>
                    <input type="text" id="title" name="title" required>
                    <label for="author">Penulis:</label>
                    <input type="text" id="author" name="author" required>
                    <label for="stock">Stok:</label>
                    <input type="number" id="stock" name="stock" required>
                    <input type="submit" name="add_book" value="Tambah Buku" class="btn">
                </form>
            </section>
            <section class="book-list">
                <h2>Daftar Buku</h2>
                <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['author']); ?></td>
                            <td><?php echo htmlspecialchars($row['stock']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p>Tidak ada buku tersedia.</p>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>
</html>
