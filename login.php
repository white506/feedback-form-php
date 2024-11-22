<?php
session_start();

$config = require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $admin_password = $config['admin_pass'];

    if ($_POST['password'] === $admin_password) {
        $_SESSION['is_admin'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Admin Login</h1>
        <?php if (!empty($error)): ?>
            <p style="color: red;">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>
        <form method="POST">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
