<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'db_host'    => $_ENV['DB_HOST'],
    'db_name'    => $_ENV['DB_NAME'],
    'db_user'    => $_ENV['DB_USER'],
    'db_pass'    => $_ENV['DB_PASS'],
    'admin_pass' => $_ENV['ADMIN_PASS'],
];
