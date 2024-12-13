<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="CSS/index_styles.css">
</head>
<body>
    <div class="dashboard">
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
        <main class="content">
            <h1>Welcome to Dormitory Management System</h1>
            <p>Select a menu item from the sidebar to begin.</p>
        </main>
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
