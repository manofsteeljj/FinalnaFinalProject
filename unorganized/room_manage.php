<?php
require 'db.php'; // Include the database connection
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch rooms from the database
try {
    $stmt = $pdo->query("SELECT * FROM rooms");
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching rooms: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms</title>
</head>
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
    background: linear-gradient(135deg, #4e73df, #1f3352); /* Deep blue gradient */
    color: #fff;
    height: 100vh;
    display: flex;
}

.sidebar {
    position: fixed;
    width: 250px;
    height: 100vh;
    color: #ecf0f1;
    padding-top: 20px;
    background-color: #34495e;
    left: -300px;
    animation: sidebar-slide-in 1s ease-in-out forwards;
}

@keyframes sidebar-slide-in {
    0% { left: -300px; }
    100% { left: 0; }
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

.sidebar-menu a:hover, .sidebar-menu a.active {
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

/* Table Container */
.table-container {
    background-color: #2c3e50;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-bottom: 30px;
}

.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

#searchBar {
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    border: none;
    outline: none;
    width: 40%;
}

#searchBar:focus {
    box-shadow: 0 0 5px #3498db;
    border: 1px solid #3498db;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 8px;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

table th {
    background-color: #3b474b;
    color: #fff;
}

table td {
    background-color: #444;
}

tbody tr {
    opacity: 0;
    transform: translateY(20px);
    animation: fade-in 0.5s ease-in-out forwards;
}

@keyframes fade-in {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

.manage_btn, .edit_btn, .delete_btn, .add-button {
    padding: 10px 15px;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

button {
    transition: transform 0.3s ease;
}

button:hover {
    animation: bounce 0.6s ease infinite alternate;
}

@keyframes bounce {
    0% { transform: translateY(0); }
    100% { transform: translateY(-10px); }
}

.add-button {
    background-color: green;
}

.manage_btn {
    background-color: green;
}

.edit_btn {
    background-color: #f39c12;
}

.delete_btn {
    background-color: red;
}

button:hover {
    opacity: 0.9;
}

/* Hide sidebar by default on small screens */
@media (max-width: 726px) {
    /* Sidebar styles */
    .sidebar {
        position: fixed;
        left: -250px; /* Sidebar hidden initially */
        width: 250px;
        height: 100vh;
        background-color: #34495e;
        transition: left 0.3s ease-in-out;
    }

    /* Show the sidebar when active */
    .sidebar.active {
        left: 0; /* Slide in */
    }

    /* Left-side tap area to activate sidebar */
    .tap-area {
        position: absolute;
        top: 0;
        left: 0;
        width: 50px; /* Make it narrow, just for tapping */
        height: 100vh;
        background-color: transparent; /* Invisible, just for the click detection */
        z-index: 99;
        cursor: pointer;
    }

    /* Adjust content when sidebar is active */
    .content {
        margin-left: 0;
        transition: margin-left 0.3s ease;
    }

    .content.sidebar-active {
        margin-left: 250px; /* Shift content to make space for sidebar */
    }
}
</style>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="images/Dorm.png" alt="Dormitory Logo" class="logo">
            <h1>Dorm Management</h1>
        </div>
        <ul class="sidebar-menu">
            <li><a href="room_manage.php" class="active">Manage Rooms</a></li>
            <li><a href="manage_new_tenant.php">Manage New Tenant</a></li>
            <li><a href="manage_tenants.php">Manage Tenants</a></li>
            <li><a href="manage_facilities.php">Manage Facilities</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="tap-area"></div>

    <!-- Main Content -->
    <div class="content">
        <h2>Manage Rooms</h2>
        <div class="table-container">
            <div class="table-controls">
                <button onclick="window.location.href='add_room.php'" class="add-button">Add New Room</button>
                <input type="text" id="searchBar" placeholder="Search Rooms" onkeyup="searchTable()">
            </div>
            <table id="roomsTable">
                <thead>
                    <tr>
                        <th>ID#</th>
                        <th>Room Number</th>
                        <th>Room Type</th>
                        <th>Total Slots</th>
                        <th>Remaining Slots</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $counter = 1; 
                        foreach ($rooms as $room): 
                    ?>
                        <tr>
                            <td><?= $counter++ ?></td> 
                            <td><?= htmlspecialchars($room['room_number']) ?></td>
                            <td><?= htmlspecialchars($room['room_type']) ?></td>
                            <td><?= htmlspecialchars($room['total_slots']) ?></td>
                            <td><?= htmlspecialchars($room['remaining_slots']) ?></td>
                            <td>
                                <button class="manage_btn" onclick="window.location.href='manage_room.php?id=<?= $room['id'] ?>'">Manage</button>
                                <button class="edit_btn" onclick="window.location.href='edit_room.php?id=<?= $room['id'] ?>'">Edit</button>
                                <button class="delete_btn" onclick="deleteRoom(<?= $room['id'] ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Function to toggle the sidebar visibility
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');

            // Toggle the "active" class on the sidebar to slide it in and out
            sidebar.classList.toggle('active');
            
            // Add a class to the content to shift it when the sidebar is visible
            content.classList.toggle('sidebar-active');
        }

        // Add event listener to the left-side area to trigger the toggle when clicked
        document.querySelector('.tap-area').addEventListener('click', toggleSidebar);


        document.addEventListener("DOMContentLoaded", () => {
            const content = document.querySelector('.content');
            content.style.opacity = 0;
            content.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                content.style.transition = 'all 1s ease-in-out';
                content.style.opacity = 1;
                content.style.transform = 'translateY(0)';
            }, 300);
        });

        // Search functionality for the table
        function searchTable() {
            const input = document.getElementById("searchBar").value.toLowerCase();
            const rows = document.getElementById("roomsTable").getElementsByTagName("tr");
            for (let i = 1; i < rows.length; i++) {
                let match = false;
                const cells = rows[i].getElementsByTagName("td");
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().includes(input)) {
                        match = true;
                        break;
                    }
                }
                rows[i].style.display = match ? "" : "none";
            }
        }

        // Delete room functionality
        function deleteRoom(id) {
            if (confirm("Are you sure you want to delete this room?")) {
                window.location.href = `delete_room.php?id=${id}`;
            }
        }
    </script>
</body>
</html>
