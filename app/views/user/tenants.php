<?php
        require_once __DIR__ . '/../../autoload.php'; 
        require_once __DIR__ . '/../../init.php'; 

use controllers\TenantsContr;

    $tenantsContr = new TenantsContr();
    $tenants = $tenantsContr->assigned();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="images/Dorm.png" alt="Dormitory Logo" class="logo">
            <h1>Dorm Management</h1>
        </div>
        <ul class="sidebar-menu">
            <li><a href="home.php">Manage Rooms</a></li>
            <li><a href="newTenants.php">Manage New Tenant</a></li>
            <li><a href="tenants.php">Manage Tenants</a></li>
            <li><a href="facility.php" class="active">Manage Facilities</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Manage Tenants</h2>
        <div class="table-container">
            <div class="table-controls">
                <input type="text" id="searchBar" placeholder="Search Tenants" onkeyup="searchTable()">
            </div>
            <table id="tenantsTable">
                <thead>
                    <tr>
                        <th>ID#</th>
                        <th>Name</th>
                        <th>Room</th>
                        <th>Stay From</th>
                        <th>Stay To</th>
                        <th>Period Remaining</th>
                        <th>Gender</th>
                        <th>Mobile#</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tenants as $tenant): ?>
                        <tr>
                            <td><?= htmlspecialchars($tenant['id']) ?></td>
                            <td><?= htmlspecialchars($tenant['full_name']) ?></td>
                            <td><?= htmlspecialchars($tenant['room_number'] . ' (' . $tenant['room_type'] . ')') ?></td>
                            <td><?= htmlspecialchars($tenant['stay_from']) ?></td>
                            <td><?= htmlspecialchars($tenant['stay_to']) ?></td>
                            <td>
                                <?php
                                $stayTo = new DateTime($tenant['stay_to']);
                                $today = new DateTime();
                                $interval = $stayTo->diff($today);
                                echo $interval->format('%a days remaining');
                                ?>
                            </td>
                            <td><?= htmlspecialchars($tenant['gender']) ?></td>
                            <td><?= htmlspecialchars($tenant['mobile_number']) ?></td>
                            <td>
                                <button class="edit-btn" onclick="window.location.href='/JJF/public/index.php?action=edit_tenant&id=<?= $tenant['id'] ?>'">Edit</button>
                                <button class="delete-btn" onclick="window.location.href='/JJF/public/index.php?action=del_tenant&id=<?= $tenant['id'] ?>'">Delete</button>
                                <button class="change-room-btn" onclick="window.location.href='/JJF/public/index.php?action=change_room&id=<?= $tenant['id'] ?>'">Change Room</button>
                                <button class="check-out-btn" onclick="window.location.href='/JJF/public/index.php?action=checkOut_tenant&id=<?= $tenant['id'] ?>'">Check Out</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>