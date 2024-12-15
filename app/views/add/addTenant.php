<?php
    require_once __DIR__ . '/../../autoload.php'; 
    require_once __DIR__ . '/../../init.php'; 
    
    use controllers\RoomsContr;

    $roomContr = new RoomsContr();
    $rooms = $roomContr->getRooms();
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

/* Form Styles */
form {
    background-color: #2c3e50;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    max-width: 600px;
    margin: auto;
}

label {
    font-size: 16px;
    color: #fff;
    margin-bottom: 8px;
    display: block;
}

input[type="text"], select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    border: 1px solid #ccc;
    background-color: #444;
    color: #fff;
}

input[type="text"]:focus, select:focus {
    box-shadow: 0 0 5px #3498db;
    border: 1px solid #3498db;
}

button {
    padding: 10px 20px;
    background-color: green;
    color: #fff;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #27ae60;
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
        <h2>Add New Tenant</h2>

        <form method="POST" action="/finalnafinalproject-1/public/index.php">
            <label for="full_name">Full Name:</label>
            <input type="hidden" name="action" value="add_tenant">

            <input type="text" id="full_name" name="full_name" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

            <label for="mobile_number">Mobile Number:</label>
            <input type="text" id="mobile_number" name="mobile_number" required>

            <button type="submit">Add Tenant</button>
        </form>
    </div>
    </div>
</body>
</html>