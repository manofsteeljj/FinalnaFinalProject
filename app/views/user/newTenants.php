<?php
        require_once __DIR__ . '/../../autoload.php'; 
        require_once __DIR__ . '/../../init.php'; 

    use controllers\TenantsContr;

    $tenantsContr = new TenantsContr();
    $tenants = $tenantsContr->getTenants();
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
        <h2>Manage New Tenant</h2>
        <div class="table-container">
            <div class="table-controls">
                <button onclick="window.location.href='../add/addTenant.php'" class="add-button">Add New Tenant</button>
                <input type="text" id="searchBar" placeholder="Search Tenants" onkeyup="searchTable()">
            </div>
            <table id="tenantsTable">
                <thead>
                    <tr>
                        <th>ID#</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Mobile Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $counter = 1; 
                        foreach ($tenants as $tenant): 
                    ?>
                        <tr>
                            <td><?= $counter++ ?></td> 
                            <td><?= htmlspecialchars($tenant['full_name']) ?></td>
                            <td><?= htmlspecialchars($tenant['gender']) ?></td>
                            <td><?= htmlspecialchars($tenant['mobile_number']) ?></td>
                            <td>
                                <button class="manage_btn" onclick="window.location.href='/JJF/public/index.php?action=assign_tenant&id=<?= $tenant['id'] ?>'">Assign</button>
                                <button class="edit_btn" onclick="window.location.href='/JJF/public/index.php?action=edit_tenant&id=<?= $tenant['id'] ?>'">Edit</button>
                                <button class="delete_btn" onclick="window.location.href='/JJF/public/index.php?action=del_tenant&id=<?= $tenant['id'] ?>'">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>