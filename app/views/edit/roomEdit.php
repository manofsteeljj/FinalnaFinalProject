<?php
    require_once __DIR__ . '/../../autoload.php'; 
    require_once __DIR__ . '/../../init.php'; 
    
    use controllers\RoomsContr;

    $roomContr = new RoomsContr();
    $room = $roomContr->getId();
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
        <h2>Edit Room</h2>

        <!-- Form Container -->
        <div class="form-container">
            <form action="/JJF/public/index.php?id=<?= $room['id'] ?>" method="POST">
                <label for="room_number">Room Number:</label>
                <input type="hidden" name="action" value="up_room">
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


</body>
</html>