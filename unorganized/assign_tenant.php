<?php
require_once('db.php');

// Get tenant ID from URL
$tenantId = $_GET['id'];

// Fetch all available rooms
$query = "SELECT * FROM rooms WHERE remaining_slots > 0";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rooms = $stmt->fetchAll();

// Process the form data when submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomId = $_POST['room_id'];
    $stayFrom = $_POST['stay_from'];
    $stayTo = $_POST['stay_to'];

    // Assign the tenant to the selected room
    $query = "UPDATE tenants SET room_id = :room_id, stay_from = :stay_from, stay_to = :stay_to WHERE id = :tenant_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'room_id' => $roomId,
        'stay_from' => $stayFrom,
        'stay_to' => $stayTo,
        'tenant_id' => $tenantId
    ]);

    // Update the remaining slots for the room
    $query = "UPDATE rooms SET remaining_slots = remaining_slots - 1 WHERE id = :room_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['room_id' => $roomId]);

    // Redirect to the manage new tenant page
    header("Location: manage_new_tenant.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Tenant to Room</title>
    <style>
        /* Basic Reset */
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
    <div class="sidebar">
        <div class="logo-container">
            <img src="images/Dorm.png" alt="Dormitory Logo" class="logo">
            <h1>Dorm Management</h1>
        </div>
        <ul class="sidebar-menu">
            <li><a href="room_manage.php">Manage Rooms</a></li>
            <li><a href="manage_new_tenant.php" class="active">Manage New Tenant</a></li>
            <li><a href="manage_tenants.php">Manage Tenants</a></li>
            <li><a href="manage_facilities.php">Manage Facilities</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Assign Tenant to Room</h2>
        <div class="form-container">
            <form method="POST" action="assign_tenant.php?id=<?php echo htmlspecialchars($_GET['id']); ?>">
                <label for="room_id">Room:</label>
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
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const content = document.querySelector('.content');
            content.style.opacity = 0;
            content.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                content.style.transition = 'all 1s ease-in-out';
                content.style.opacity = 1;
                content.style.transform = 'translateY(0)';
            }, 300);
        });
    </script>
</body>
</html>
