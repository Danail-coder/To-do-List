<?php
session_start();
include 'db.php';
$result = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="confetti.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        fadeIn: "fadeIn 0.5s ease-in-out",
                        slideIn: "slideIn 0.5s ease-out",
                        shake: "shake 0.4s ease-in-out infinite",
                        fadeOut: "fadeOut 0.5s ease-out",
                        glow: "glow 0.8s ease-in-out infinite",
                    },
                    keyframes: {
                        fadeIn: { "0%": { opacity: "0" }, "100%": { opacity: "1" } },
                        slideIn: { "0%": { transform: "translateY(-10px)", opacity: "0" }, "100%": { transform: "translateY(0)", opacity: "1" } },
                        shake: { "0%, 100%": { transform: "translateX(0)" }, "25%": { transform: "translateX(-3px)" }, "50%": { transform: "translateX(3px)" }, "75%": { transform: "translateX(-3px)" } },
                        fadeOut: { "0%": { opacity: "1" }, "100%": { opacity: "0" } },
                        glow: { "0%, 100%": { boxShadow: "0 0 10px rgba(255, 255, 255, 0.5)" }, "50%": { boxShadow: "0 0 20px rgba(255, 255, 255, 1)" } }
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-cover bg-center min-h-screen flex justify-center items-center"
      style="background-image: url('premium_photo-1683309568772-57011d6c1b7b.jpeg');">

    <div class="bg-white bg-opacity-90 p-2 rounded-lg shadow-lg w-96 animate-fadeIn">
        <h2 class="text-2xl font-bold mb-4 text-center">To-Do List</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <form action="process.php" method="POST">
            <input type="text" name="task" required class="border p-2 w-full rounded" placeholder="New Task">
            <input type="datetime-local" name="due_time" class="border p-2 w-full rounded mt-2">
            <button type="submit" name="add" class="bg-blue-500 text-white px-4 py-2 mt-2 w-full rounded hover:bg-blue-600 transition duration-300">Add Task</button>
        </form>

        <ul class="mt-4 space-y-2">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li id="task-<?= $row['id'] ?>" class="flex justify-between items-center bg-gray-200 p-2 rounded hover:animate-glow transition duration-300">
                    <div>
                        <span class="<?= isset($row['completed']) && $row['completed'] ? 'text-gray-500' : '' ?>">
                            <?= htmlspecialchars($row['title']) ?>
                        </span>
                        <?php if ($row['due_time']): ?>
                            <div class="text-sm text-gray-600">Due: <?= date("M d, Y H:i", strtotime($row['due_time'])) ?></div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="text-yellow-600 px-2 hover:text-yellow-700">✏ Edit</a>
                        <a href="process.php?complete=<?= $row['id'] ?>"class="text-green-600 px-2 hover:text-green-700">✔</button>
                        <a href="process.php?delete=<?= $row['id'] ?>" class="text-red-600 px-2 hover:text-red-700">✖</button>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

<script>
function deleteTask(id) {
    let taskElement = document.getElementById(task-${id});
    taskElement.classList.remove()
    taskElement.classList.add("animate-fadeOut");
    //setTimeout(() => { window.location.href = process.php?delete=${id}; }, 500);
}

function completeTask(id) {
    confetti({ particleCount: 100, spread: 70, origin: { y: 0.6 } });
    setTimeout(() => { window.location.href = process.php?complete=${id}; }, 1000);
}
</script>
</body>
</html>