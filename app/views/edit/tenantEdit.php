<?php
    require_once __DIR__ . '/../../autoload.php'; 
    require_once __DIR__ . '/../../init.php'; 
    
    use controllers\TenantsContr;

    $tenantContr = new TenantsContr();
    $tenant = $tenantContr->getId();
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

<!-- Main Content -->
<div class="content">
        <h2>Edit Tenant</h2>
        <div class="form-container">
            <form method="POST" action="/JJF/public/index.php?id=<?php echo $tenant['id']; ?>">
                <label for="full_name">Full Name:</label>
                <input type="hidden" name="action" value="edit_tenant" >
                <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($tenant['full_name']); ?>" required>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male" <?php echo $tenant['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $tenant['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                </select>

                <label for="mobile_number">Mobile Number:</label>
                <input type="text" id="mobile_number" name="mobile_number" value="<?php echo htmlspecialchars($tenant['mobile_number']); ?>" required>

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>


</body>
</html>