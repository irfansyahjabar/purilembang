<?php
// koneksi.php

$host = 'localhost';  // Change if your MySQL is on another server
$db   = 'purilemb_hotel';      // Database name
$user = 'purilemb_hotel';       // MySQL username (update if needed)
$pass = '=**tw18}SWt9';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>
