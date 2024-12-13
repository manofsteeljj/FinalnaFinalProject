<?php
    require_once __DIR__ . '/../../autoload.php'; 
    require_once __DIR__ . '/../../init.php'; 
    
    use controllers\FaciContr;

    $faciContr = new FaciContr();
    $facility = $faciContr->getId();
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

    <div class="content">
        <h2>Edit Facility</h2>

        <form class="form-container" method="POST" action="/JJF/public/index.php?id=<?php echo $facility['id']; ?>">
        <input type="hidden" name="action" value="edit_faci">
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


</body>
</html>