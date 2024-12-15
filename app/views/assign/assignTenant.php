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

        /* Form Container */
        .form-container {
            background-color: #2c3e50;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #fff;
            font-weight: 600;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #34495e;
            color: #fff;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
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

            h2 {
                font-size: 1.5rem;
            }

            .form-container {
                width: 90%;
                padding: 20px;
            }

            button {
                font-size: 14px;
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

    <!-- Main Content -->
    <div class="content">
        <h2>Assign Tenant to Room</h2>
        <div class="form-container">
            <form method="POST" action="/finalnafinalproject-1/public/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>">
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