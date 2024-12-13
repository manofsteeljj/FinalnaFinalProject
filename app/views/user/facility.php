<?php
    require_once __DIR__ . '/../../autoload.php'; 
    require_once __DIR__ . '/../../init.php'; 
    
    use controllers\FaciContr;

    $faciContr = new FaciContr();
    $facilities = $faciContr->getFacility();
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
        <h2>Manage Facilities</h2>
        <div class="table-container">
            <div class="table-controls">
                <button onclick="window.location.href='../add/addFaci.php'" class="add-button">Add New Facility</button>
                <input type="text" id="searchBar" placeholder="Search Facilities" onkeyup="searchTable()">
            </div>
            <table id="facilitiesTable">
                <thead>
                    <tr>
                        <th>ID#</th>
                        <th>Equipment Type</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $counter = 1; 
                        foreach ($facilities as $facility): 
                    ?>
                        <tr>
                            <td><?= $counter++ ?></td>
                            <td><?= htmlspecialchars($facility['equipment_type']) ?></td>
                            <td><?= htmlspecialchars($facility['description']) ?></td>
                            <td><?= htmlspecialchars($facility['status']) ?></td>
                            <td>
                                <button class="edit_btn" onclick="window.location.href='/JJF/public/index.php?action=edit_faci&id=<?= $facility['id'] ?>'">Edit</button>
                                <button class="delete_btn" onclick="window.location.href='/JJF/public/index.php?action=del_faci&id=<?= $facility['id'] ?>'">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>