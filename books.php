<?php
session_start();
include 'db.php';
require 'db.php';

// Tambah buku jika formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_book'])) {
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

// Hapus buku jika formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_book'])) {
    $book_id = $_POST['book_id'];

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Hapus buku dari tabel borrow terlebih dahulu
        $sql = "DELETE FROM borrow WHERE book_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();

        // Hapus buku dari tabel books
        $sql = "DELETE FROM books WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();

        // Komit transaksi
        $conn->commit();
        $message = "Buku berhasil dihapus.";
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();
        $message = "Terjadi kesalahan: " . $e->getMessage();
    }
}

// Ambil daftar buku
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function toggleModal() {
            var modal = document.getElementById("addBookModal");
            modal.style.display = modal.style.display === "block" ? "none" : "block";
        }

        function confirmDelete(bookId) {
            if (confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
                document.getElementById('deleteBookForm').book_id.value = bookId;
                document.getElementById('deleteBookForm').submit();
            }
        }
    </script>
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
            <h1>Daftar Buku</h1>
            <button class="btn btn-add" onclick="toggleModal()">Tambah Buku</button>
            <?php if (isset($message)): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['author']); ?></td>
                        <td><?php echo htmlspecialchars($row['stock']); ?></td>
                        <td>
                            <?php if ($row['stock'] > 0): ?>
                            <form method="post" action="borrow.php" style="display:inline;">
                                <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-borrow">Pinjam</button>
                            </form>
                            <?php endif; ?>
                            <button class="btn btn-delete" onclick="confirmDelete(<?php echo $row['id']; ?>)">Hapus</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk Tambah Buku -->
    <div id="addBookModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="toggleModal()">&times;</span>
            <h2>Tambah Buku Baru</h2>
            <form method="post" action="books.php">
                <input type="hidden" name="add_book" value="1">
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

    <!-- Form untuk Hapus Buku -->
    <form id="deleteBookForm" method="post" action="books.php" style="display:none;">
        <input type="hidden" name="delete_book" value="1">
        <input type="hidden" name="book_id" value="">
    </form>
</body>
</html>
