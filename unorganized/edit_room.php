<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$room_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $total_slots = (int) $_POST['total_slots'];
    $remaining_slots = $_POST['remaining_slots'];

    try {
        $stmt = $pdo->prepare("UPDATE rooms SET room_number = :room_number, room_type = :room_type, total_slots = :total_slots, remaining_slots = :remaining_slots WHERE id = :id");
        $stmt->execute([
            ':room_number' => $room_number,
            ':room_type' => $room_type,
            ':total_slots' => $total_slots,
            ':remaining_slots' => $remaining_slots,
            ':id' => $room_id
        ]);
        header("Location: room_manage.php");
        exit;
    } catch (PDOException $e) {
        die("Error updating room: " . $e->getMessage());
    }
}

try {
    $stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = :id");
    $stmt->execute([':id' => $room_id]);
    $room = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching room: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #4e73df, #1f3352);
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: flex-start;
            align-items: stretch;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #34495e;
            position: fixed;
            top: 0;
            left: 0;
            color: #ecf0f1;
            padding-top: 20px;
        }

        .sidebar .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .logo {
            width: 100px;
            height: auto;
        }

        .sidebar h1 {
            font-size: 20px;
            margin: 10px 0 0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 20px 0;
        }

        .sidebar-menu a {
            text-decoration: none;
            color: #ecf0f1;
            padding: 10px 15px;
            display: block;
            transition: background 0.3s ease;
        }

        .sidebar-menu a:hover {
            background-color: #2c3e50;
            border-left: 5px solid #3498db;
        }

        /* Main Content */
        .content {
            margin-left: 270px;
            padding: 30px;
            width: calc(100% - 270px);
            box-sizing: border-box;
        }

        h2 {
            font-size: 2rem;
            color: #fff;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* Form Container */
        .form-container {
            background-color: #2c3e50;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #fff;
            font-weight: 600;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #34495e;
            color: #fff;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Responsive Design */
        @media (max-width: 726px) {
            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;
                width: 100%;
            }

            h2 {
                font-size: 1.5rem;
            }

            .form-container {
                width: 90%;
                padding: 20px;
            }

            button {
                font-size: 14px;
            }
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="images/Dorm.png" alt="Dormitory Logo" class="logo">
            <h1>Dorm Management</h1>
        </div>
        <ul class="sidebar-menu">
            <li><a href="room_manage.php">Manage Rooms</a></li>
            <li><a href="manage_new_tenant.php">Manage New Tenant</a></li>
            <li><a href="manage_tenants.php">Manage Tenants</a></li>
            <li><a href="manage_facilities.php">Manage Facilities</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Edit Room</h2>

        <!-- Form Container -->
        <div class="form-container">
            <form action="edit_room.php?id=<?= $room['id'] ?>" method="POST">
                <label for="room_number">Room Number:</label>
                <input type="text" id="room_number" name="room_number" value="<?= htmlspecialchars($room['room_number']) ?>" required>

                <label for="room_type">Room Type:</label>
                <select id="room_type" name="room_type" required>
                    <option value="Male Double" <?= $room['room_type'] === 'Male Double' ? 'selected' : '' ?>>Male Double</option>
                    <option value="Female Double" <?= $room['room_type'] === 'Female Double' ? 'selected' : '' ?>>Female Double</option>
                    <option value="Female Single" <?= $room['room_type'] === 'Female Single' ? 'selected' : '' ?>>Female Single</option>
                    <option value="Male Single" <?= $room['room_type'] === 'Male Single' ? 'selected' : '' ?>>Male Single</option>
                </select>

                <label for="total_slots">Total Slots:</label>
                <input type="number" id="total_slots" name="total_slots" value="<?= $room['total_slots'] ?>" required>

                <label for="remaining_slots">Remaining Slots:</label>
                <input type="number" id="remaining_slots" name="remaining_slots" value="<?= $room['remaining_slots'] ?>" required>

                <button type="submit">Update Room</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const content = document.querySelector('.content');
            content.style.opacity = 0;
            content.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                content.style.transition = 'all 1s ease-in-out';
                content.style.opacity = 1;
                content.style.transform = 'translateY(0)';
            }, 300);
        });
    </script>
</body>
</html>
