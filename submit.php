<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Incorrect email format.");
    }

    try {
        $stmt = $pdo->prepare(
            "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)"
        );
        $stmt->execute([$name, $email, $message]);
    } catch (PDOException $e) {
        die("Error when saving data: " . $e->getMessage());
    }

    header("Location: success.html");
    exit;
}
?>
