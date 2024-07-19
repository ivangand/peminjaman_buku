<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $borrower_name = $_POST['borrower_name'];
    $loan_date = date('Y-m-d');

    // Insert loan record
    $sql = "INSERT INTO loans (book_id, borrower_name, loan_date) VALUES ('$book_id', '$borrower_name', '$loan_date')";
    if ($conn->query($sql) === TRUE) {
        // Update book stock
        $sql = "UPDATE books SET stock = stock - 1 WHERE id = '$book_id'";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error updating stock: " . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $book_id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id = '$book_id'";
    $result = $conn->query($sql);
    $book = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Library Management System</h1>
    </header>
    <main>
        <section class="loan-form">
            <h2>Pinjam Buku: <?php echo htmlspecialchars($book['title']); ?></h2>
            <form method="post">
                <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['id']); ?>">
                <label for="borrower_name">Nama Peminjam:</label>
                <input type="text" id="borrower_name" name="borrower_name" required>
                <input type="submit" value="Pinjam" class="btn">
            </form>
        </section>
    </main>
    <header>
        <h1>Library Management System</h1>
        <nav>
            <a href="admin.php">Admin</a>
        </nav>
    </header>

    <footer>
        <p>&copy; 2024 Library Management System</p>
    </footer>
</body>

</html>