<?php
    require_once __DIR__ . '/../../autoload.php'; 
    require_once __DIR__ . '/../../init.php'; 
    
    use controllers\RoomsContr;

    $roomContr = new RoomsContr();
    $rooms = $roomContr->availRooms();
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

    <!-- Main Content -->
    <div class="content">
        <h2>Assign Tenant to Room</h2>
        <div class="form-container">
            <form method="POST" action="/JJF/public/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>">
                <label for="room_id">Room:</label>
                <input type="hidden" name="action" value="assign_tenant" >
                <select id="room_id" name="room_id" required>
                    <?php foreach ($rooms as $room): ?>
                        <option value="<?php echo $room['id']; ?>"><?php echo $room['room_number']; ?> (<?php echo $room['room_type']; ?>)</option>
                    <?php endforeach; ?>
                </select>

                <label for="stay_from">Stay From:</label>
                <input type="date" id="stay_from" name="stay_from" required>

                <label for="stay_to">Stay To:</label>
                <input type="date" id="stay_to" name="stay_to" required>

                <button type="submit">Assign Tenant</button>
            </form>
        </div>
    </div>


</body>
</html>