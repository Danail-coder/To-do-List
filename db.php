<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "todo_list"; // Make sure it matches the database you created

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>