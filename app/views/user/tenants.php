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
    <style>
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
        }

        h2 {
            font-size: 2rem;
            color: #fff;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* Table Container */
        .table-container {
            background-color: #2c3e50;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }

        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        #searchBar {
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: none;
            outline: none;
            width: 40%;
        }

        #searchBar:focus {
            box-shadow: 0 0 5px #3498db;
            border: 1px solid #3498db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #3b474b;
            color: #fff;
        }

        table td {
            background-color: #444;
        }
        tbody tr {
            opacity: 0;
            transform: translateY(20px);
            animation: fade-in 0.5s ease-in-out forwards;
        }

        @keyframes fade-in {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .edit-btn, .delete-btn, .check-out-btn, .change-room-btn {
            padding: 10px 15px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .edit-btn {
            background-color: #f39c12;
        }

        .delete-btn {
            background-color: red;
        }

        .check-out-btn {
            background-color: #2980b9;
        }

        .change-room-btn {
            background-color: green;
        }

        button:hover {
            opacity: 0.9;
        }

        button:hover {
            animation: bounce 0.6s ease infinite alternate;
        }

        @keyframes bounce {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
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
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="/FinalnaFinalProject-1/images/Dorm.png" alt="Dormitory Logo" class="logo">
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
                                <button class="edit-btn" onclick="window.location.href='/finalnafinalproject-1/public/index.php?action=edit_tenant&id=<?= $tenant['id'] ?>'">Edit</button>
                                <button class="delete-btn" onclick="window.location.href='/finalnafinalproject-1/public/index.php?action=del_tenant&id=<?= $tenant['id'] ?>'">Delete</button>
                                <button class="change-room-btn" onclick="window.location.href='/finalnafinalproject-1/public/index.php?action=change_room&id=<?= $tenant['id'] ?>'">Change Room</button>
                                <button class="check-out-btn" onclick="window.location.href='/finalnafinalproject-1/public/index.php?action=checkOut_tenant&id=<?= $tenant['id'] ?>'">Check Out</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>