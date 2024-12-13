<?php
    require_once __DIR__ . '/../../autoload.php'; 
    require_once __DIR__ . '/../../init.php'; 
    
    use controllers\RoomsContr;

    $roomContr = new RoomsContr();
    $rooms = $roomContr->getRooms();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="images/Dorm.png" alt="Dormitory Logo" class="logo">
            <h1>Dorm Management</h1>
        </div>
        <ul class="sidebar-menu">
        <li><a href="../user/home.php" class="active">Manage Rooms</a></li>
            <li><a href="../user/newTenants.php">Manage New Tenant</a></li>
            <li><a href="../user/tenants.php">Manage Tenants</a></li>
            <li><a href="../user/facility.php">Manage Facilities</a></li>
            <li><a href="../user/logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="tap-area"></div>

    <!-- Main Content -->
    <div class="content">
        <h2>Add New Room</h2>
        <div class="form-container">
            <form action="/JJF/public/index.php" method="POST">
                <label for="room_number">Room Number:</label>
                <input type="hidden" name="action" value="add_room">
                <input type="text" id="room_number" name="room_number" required>

                <label for="room_type">Room Type:</label>
                <select id="room_type" name="room_type" required>
                    <option value="Male Double">Male Double</option>
                    <option value="Female Double">Female Double</option>
                    <option value="Female Single">Female Single</option>
                    <option value="Male Single">Male Single</option>
                </select>

                <label for="total_slots">Total Slots:</label>
                <input type="number" id="total_slots" name="total_slots" required>

                <button type="submit">Add Room</button>
            </form>
        </div>
    </div>
    </div>
</body>
</html>