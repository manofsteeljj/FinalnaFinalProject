<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="/JJF/public/CSS/register_styles.css">
</head>
<body>
    <div class="register-container">
        <h1>Register Admin</h1>
        <form action="/JJF/public/index.php" method="POST">
            <input type="hidden" name="action" value="signUp">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <p><a href="/JJF/public/index.php">Back to Login</a></p>
    </div>
</body>
</html>
