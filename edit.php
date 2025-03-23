<?php
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tasks WHERE id=$id");
$task = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center min-h-screen flex justify-center items-center"
      style="background-image: url('premium_photo-1683309568772-57011d6c1b7b.jpeg');">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-4 text-center">Edit Task</h2>
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
            <input type="text" name="task" required value="<?= htmlspecialchars($task['title']) ?>" class="border p-2 w-full rounded">
            <input type="datetime-local" name="due_time" value="<?= date('Y-m-d\TH:i', strtotime($task['due_time'])) ?>" class="border p-2 w-full rounded mt-2">
            <button type="submit" name="update" class="bg-blue-500 text-white px-4 py-2 mt-2 w-full rounded hover:bg-blue-600 transition duration-300">Update Task</button>
        </form>
        <a href="index.php" class="block text-center text-gray-600 mt-4">Back</a>
    </div>
</body>
</html>