<?php
session_start();
if (empty($_SESSION['is_admin'])) {
    header("Location: login.php");
    exit;
}

$config = require 'config.php';

try {
    $pdo = new PDO(
        "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8",
        $config['db_user'],
        $config['db_pass']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}

$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container admin">
        <h1>Admin Panel</h1>
        <a class="logout-button" href="form.html">Logout</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $msg): ?>
                    <?php list($date, $time) = explode(' ', $msg['created_at']); ?>
                    <tr>
                        <td class="id"><?= htmlspecialchars($msg['id']) ?></td>
                        <td><?= htmlspecialchars($msg['name']) ?></td>
                        <td><?= htmlspecialchars($msg['email']) ?></td>
                        <td><?= htmlspecialchars($msg['message']) ?></td>
                        <td class="date">
                            <?= htmlspecialchars($date) ?><br><?= htmlspecialchars($time) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
