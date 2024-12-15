<?php
    require_once __DIR__ . '/../../autoload.php'; 
    require_once __DIR__ . '/../../init.php'; 
    
    use controllers\RoomsContr;
use controllers\TenantsContr;

    $roomContr = new RoomsContr();
    $rooms = $roomContr->availRooms();
    
    $tenantContr = new TenantsContr();
    $tenant = $tenantContr->fetchTenants();
    
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

        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4e73df, #1f3352); /* Deep blue gradient */
            color: #fff;
            height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #34495e;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            color: #ecf0f1;
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
        }

        .sidebar-menu li {
            margin: 15px 0;
        }

        .sidebar-menu a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            transition: background 0.3s ease;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: #2c3e50;
            border-left: 5px solid #3498db;
        }

        /* Content */
        .content {
            margin-left: 270px;
            padding: 30px;
            width: calc(100% - 270px);
            box-sizing: border-box;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Form Container */
        .form-container {
            background-color: #2c3e50;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            font-weight: bold;
            color: #ecf0f1;
            margin-bottom: 8px;
        }

        select, input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
        }

        select:focus, input:focus {
            outline: none;
            border: 2px solid #3498db;
            box-shadow: 0 0 5px #3498db;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Responsive */
        @media (max-width: 768px) {
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
            <li><a href="../user/home.php" class="active">Manage Rooms</a></li>
            <li><a href="../user/newTenants.php">Manage New Tenant</a></li>
            <li><a href="../user/tenants.php">Manage Tenants</a></li>
            <li><a href="../user/facility.php">Manage Facilities</a></li>
            <li><a href="../user/logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h2>Change Room for Tenant</h2>
        <div class="form-container">
            <form method="POST" action="/finalnafinalproject-1/public/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>">
                <label for="room_id">New Room:</label>
                <input type="hidden" name="action" value="change_room" >
                <select id="room_id" name="room_id" required>
                    <?php foreach ($rooms as $room): ?>
                        <option value="<?php echo $room['id']; ?>"><?php echo $room['room_number']; ?> (<?php echo $room['room_type']; ?>)</option>
                    <?php endforeach; ?>
                </select>

                <label for="stay_from">Stay From:</label>
                <input type="date" id="stay_from" name="stay_from" required>

                <label for="stay_to">Stay To:</label>
                <input type="date" id="stay_to" name="stay_to" required>

                <button type="submit">Change Room</button>
            </form>
        </div>
    </div>
