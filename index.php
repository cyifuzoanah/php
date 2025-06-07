<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM books");
?>

<h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
<a href="logout.php">Logout</a> | <a href="add_book.php">Add New Book</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th><th>Title</th><th>Author</th><th>Year</th><th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['title'] ?></td>
        <td><?= $row['author'] ?></td>
        <td><?= $row['publication_year'] ?></td>
        <td>
            <a href="edit_book.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="delete_book.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>
