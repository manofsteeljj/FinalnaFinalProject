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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #4e73df, #1f3352);
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: flex-start;
            align-items: stretch;
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

        .sidebar-menu a:hover {
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

        h3 {
            font-size: 1.5rem;
            color: #fff;
            margin-bottom: 20px;
        }

        /* Container for the Table */
        .table-container {
            background-color: #2c3e50;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #34495e;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #34495e;
        }

        tr:hover {
            background-color: #2c3e50;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #2980b9;
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

            table, th, td {
                font-size: 14px;
            }

            button {
                font-size: 12px;
                padding: 4px 8px;
            }
        }
        button:hover {
    animation: bounce 0.6s ease infinite alternate;
}

@keyframes bounce {
    0% { transform: translateY(0); }
    100% { transform: translateY(-10px); }
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
                                <button onclick="window.location.href='/finalnafinalproject-1/public/index.php?action=checkOut_tenant&id=<?= $room['id'] ?>'">Check Out</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>