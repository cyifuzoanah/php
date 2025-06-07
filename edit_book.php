<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['publication_year'];

    $update = $conn->prepare("UPDATE books SET title=?, author=?, publication_year=? WHERE id=?");
    $update->bind_param("ssii", $title, $author, $year, $id);
    $update->execute();

    header("Location: index.php");
    exit();
}
?>

<h2>Edit Book</h2>
<form method="post">
    Title: <input type="text" name="title" value="<?= $book['title'] ?>" required><br><br>
    Author: <input type="text" name="author" value="<?= $book['author'] ?>" required><br><br>
    Year: <input type="number" name="publication_year" value="<?= $book['publication_year'] ?>" required><br><br>
    <button type="submit">Update Book</button>
</form>
