<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $user_id = $_SESSION['user_id'];
    $borrow_date = date('Y-m-d'); // Tanggal peminjaman hari ini

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Periksa apakah book_id valid dan ambil stok saat ini
        $sql = "SELECT stock FROM books WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Buku dengan ID tersebut tidak ditemukan.");
        }

        $row = $result->fetch_assoc();
        $stock = $row['stock'];

        // Cek apakah stok buku masih tersedia
        if ($stock <= 0) {
            throw new Exception("Stok buku habis.");
        }

        // Tambahkan peminjaman buku
        $sql = "INSERT INTO borrow (user_id, book_id, borrow_date) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $user_id, $book_id, $borrow_date);
        $stmt->execute();

        // Kurangi stok buku
        $sql = "UPDATE books SET stock = stock - 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();

        // Komit transaksi
        $conn->commit();

        echo "Buku berhasil dipinjam.";
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>
