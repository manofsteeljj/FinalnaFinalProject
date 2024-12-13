<?php
require_once('db.php');

// Get facility ID from URL
$facilityId = $_GET['id'];

// Fetch the facility details
$query = "SELECT * FROM facilities WHERE id = :facility_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['facility_id' => $facilityId]);
$facility = $stmt->fetch();

// Process the form data when submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipmentType = $_POST['equipment_type'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Update the facility's details
    $query = "UPDATE facilities SET equipment_type = :equipment_type, description = :description, status = :status WHERE id = :facility_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'equipment_type' => $equipmentType,
        'description' => $description,
        'status' => $status,
        'facility_id' => $facilityId
    ]);

    // Redirect to the manage facilities page after updating the facility
    header("Location: manage_facilities.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Facility</title>
</head>
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
<body>
<div class="sidebar">
        <div class="logo-container">
            <img src="images/Dorm.png" alt="Dormitory Logo" class="logo">
            <h1>Dorm Management</h1>
        </div>
        <ul class="sidebar-menu">
            <li><a href="room_manage.php">Manage Rooms</a></li>
            <li><a href="manage_new_tenant.php">Manage New Tenant</a></li>
            <li><a href="manage_tenants.php">Manage Tenants</a></li>
            <li><a href="manage_facilities.php">Manage Facilities</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>


    <div class="content">
        <h2>Edit Facility</h2>

        <form class="form-container" method="POST" action="edit_facility.php?id=<?php echo $facility['id']; ?>">
            <label for="equipment_type">Equipment Type:</label>
            <input type="text" id="equipment_type" name="equipment_type" value="<?php echo htmlspecialchars($facility['equipment_type']); ?>" required>

            <label for="description">Description (Model Name):</label>
            <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($facility['description']); ?>" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Available" <?php echo ($facility['status'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                <option value="Being Used" <?php echo ($facility['status'] == 'Being Used') ? 'selected' : ''; ?>>Being Used</option>
                <option value="Faulty" <?php echo ($facility['status'] == 'Faulty') ? 'selected' : ''; ?>>Faulty</option>
            </select>

            <button type="submit">Update Facility</button>
        </form>
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
