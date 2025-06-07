<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['publication_year'];

    $stmt = $conn->prepare("INSERT INTO books (title, author, publication_year) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $author, $year);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<h2>Add New Book</h2>
<form method="post">
    Title: <input type="text" name="title" required><br><br>
    Author: <input type="text" name="author" required><br><br>
    Year: <input type="number" name="publication_year" required><br><br>
    <button type="submit">Add Book</button>
</form>
