<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipmentType = $_POST['equipment_type'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $query = "INSERT INTO facilities (equipment_type, description, status) VALUES (:equipment_type, :description, :status)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'equipment_type' => $equipmentType,
        'description' => $description,
        'status' => $status
    ]);

    header("Location: manage_facilities.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Facility</title>
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
    opacity: 0;
    transform: translateY(30px);
    transition: all 1s ease-in-out;
}

h2 {
    font-size: 2rem;
    color: #fff;
    font-weight: 600;
    margin-bottom: 20px;
}

/* Form Styling */
form {
    background-color: #2c3e50;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    max-width: 500px;
    margin: auto;
}

label {
    font-size: 16px;
    margin-bottom: 8px;
    display: block;
    color: #ecf0f1;
}

input[type="text"], select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: none;
    background-color: #444;
    color: #fff;
    font-size: 14px;
}

input[type="text"]:focus, select:focus {
    box-shadow: 0 0 5px #3498db;
    border: 1px solid #3498db;
}

button {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    background-color: green;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #27ae60;
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
            <li><a href="room_manage.php">Manage Rooms</a></li>
            <li><a href="manage_new_tenant.php">Manage New Tenant</a></li>
            <li><a href="manage_tenants.php">Manage Tenants</a></li>
            <li><a href="manage_facilities.php" class="active">Manage Facilities</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Add New Facility</h2>

        <form method="POST" action="add_new_facility.php">
            <label for="equipment_type">Equipment Type:</label>
            <input type="text" id="equipment_type" name="equipment_type" required>

            <label for="description">Description (Model Name):</label>
            <input type="text" id="description" name="description" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Available">Available</option>
                <option value="Being Used">Being Used</option>
                <option value="Faulty">Faulty</option>
            </select>

            <button type="submit">Add Facility</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const content = document.querySelector('.content');
            setTimeout(() => {
                content.style.opacity = 1;
                content.style.transform = 'translateY(0)';
            }, 300);
        });
    </script>
</body>
</html>
