<?php
$host = "localhost";
$user = "root"; // use your MySQL username
$pass = "";     // use your MySQL password
$dbname = "book_system";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
