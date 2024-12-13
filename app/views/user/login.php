<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dormitory Login</title>
    <link rel="stylesheet" href="/JJF/public/CSS/loginstyles.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if ($error): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form action="/JJF/public/index.php" method="POST">
            <input type="hidden" name="action" value="login">
            <input type="text" name="username" placeholder="Username" >
            <input type="password" name="password" placeholder="Password" >
            <input class="but" type="submit" name="login" value="Login">
        </form>
        <div class="register-container">
            <p>Don't have an account?</p>
            <button onclick="window.location.href='../app/views/user/signUp.php'">Register</button>
        </div>
    </div>
</body>
</html>
