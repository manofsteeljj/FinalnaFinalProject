<?php
$error = isset($_GET['error']) ? $_GET['error'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dormitory Login</title>
    <link rel="stylesheet" href="CSS/loginstyles.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if ($error): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form action="validate_login.php" method="POST">
            <input type="text" name="username" placeholder="Username" >
            <input type="password" name="password" placeholder="Password" >
            <button type="submit">Login</button>
        </form>
        <div class="register-container">
            <p>Don't have an account?</p>
            <button onclick="window.location.href='register.php'">Register</button>
        </div>
    </div>
</body>
</html>
