<?php
session_start();
require 'db.php';

if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']);
    $query = "DELETE FROM books WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $book_id);
    $stmt->execute();
    $stmt->close();

    header('Location: books.php');
    exit();
} else {
    header('Location: books.php');
    exit();
}
