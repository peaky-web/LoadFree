<?php

$host = 'switchyard.proxy.rlwy.net';
$db   = 'YOUR_RAILWAY_DATABASE';
$user = 'YOUR_RAILWAY_USERNAME';
$pass = 'YOUR_RAILWAY_PASSWORD';
$port = 15181;
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    die("Database connection failed.");
}