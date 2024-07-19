<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $is_admin = 0; // Default role

    // Cek apakah username sudah ada
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message = "Username sudah digunakan.";
    } else {
        // Daftar pengguna baru
        $sql = "INSERT INTO users (username, password, is_admin) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $password, $is_admin);

        if ($stmt->execute()) {
            $message = "Pendaftaran berhasil!";
        } else {
            $message = "Terjadi kesalahan: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-form">
            <h2>Daftar</h2>
            <?php if (!empty($message)): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <form method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" name="register" value="Daftar" class="btn">
            </form>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a>.</p>
        </div>
    </div>
</body>
</html>
