<?php
session_start();
include 'db.php';

if (isset($_POST['add'])) {
    $task = $_POST['task'];
    $due_time = $_POST['due_time'];
    $stmt = $conn->prepare("INSERT INTO tasks (title, due_time) VALUES (?, ?)");
    $stmt->bind_param("ss", $task, $due_time);
    $stmt->execute();
    $_SESSION['message'] = "Task added!";
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM tasks WHERE id=$id");
}

if (isset($_GET['complete'])) {
    $id = $_GET['complete'];
    $conn->query("UPDATE tasks SET completed=1 WHERE id=$id");
}

header("Location: index.php");
exit();
?>
