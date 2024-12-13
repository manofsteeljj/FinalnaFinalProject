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
            <li><a href="home.php" class="active">Manage Rooms</a></li>
            <li><a href="newTenants.php">Manage New Tenant</a></li>
            <li><a href="tenants.php">Manage Tenants</a></li>
            <li><a href="facility.php">Manage Facilities</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="tap-area"></div>

    <!-- Main Content -->
    <div class="content">
        <h2>Manage Rooms</h2>
        <div class="table-container">
            <div class="table-controls">
                <button onclick="window.location.href='../add/addRoom.php'" class="add-button">Add New Room</button>
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
                    <?php if (empty($rooms)): ?>
                        <tr>
                            <td colspan="6">No Product found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($rooms as $index => $room): ?>
                            <tr>
                                <td><?= (int)$index + 1 ?></td> 
                                <td><?= htmlspecialchars($room['room_number']) ?></td>
                                <td><?= htmlspecialchars($room['room_type']) ?></td>
                                <td><?= htmlspecialchars($room['total_slots']) ?></td>
                                <td><?= htmlspecialchars($room['remaining_slots']) ?></td>
                                <td>
                                    <button class="manage_btn" onclick="window.location.href='/JJF/public/index.php?action=manage_room&id=<?= $room['id'] ?>'">Manage</button>
                                    <button class="edit_btn" onclick="window.location.href='/JJF/public/index.php?action=edit_room&id=<?= $room['id'] ?>'">Edit</button>
                                    <button class="delete_btn" onclick="window.location.href='/JJF/public/index.php?action=del_room&id=<?= $room['id'] ?>'">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>