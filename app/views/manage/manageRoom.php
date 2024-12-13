<?php
    require_once __DIR__ . '/../../autoload.php'; 
    require_once __DIR__ . '/../../init.php'; 
    
    use controllers\RoomsContr;
use controllers\TenantsContr;

    $roomContr = new RoomsContr();
    $room = $roomContr->findRoom();

    $tenantContr = new TenantsContr();
    $tenants = $tenantContr->getTenant();
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
        <h2>Manage Room: <?= htmlspecialchars($room['room_number']) ?></h2>
        <p><strong>Room Type:</strong> <?= htmlspecialchars($room['room_type']) ?></p>
        <p><strong>Total Slots:</strong> <?= $room['total_slots'] ?></p>
        <p><strong>Remaining Slots:</strong> <?= $room['remaining_slots'] ?></p>

        <h3>Tenants</h3>

        <!-- Table Container -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID#</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Contact#</th>
                        <th>Stay From</th>
                        <th>Stay To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tenants as $tenant): ?>
                        <tr>
                            <td><?= htmlspecialchars($tenant['id']) ?></td>
                            <td><?= htmlspecialchars($tenant['full_name']) ?></td>
                            <td><?= htmlspecialchars($tenant['gender']) ?></td>
                            <td><?= htmlspecialchars($tenant['mobile_number']) ?></td>
                            <td><?= htmlspecialchars($tenant['stay_from']) ?></td>
                            <td><?= htmlspecialchars($tenant['stay_to']) ?></td>
                            <td>
                                <button onclick="window.location.href='/JJF/public/index.php?action=checkOut_tenant&id=<?= $room['id'] ?>'">Check Out</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>