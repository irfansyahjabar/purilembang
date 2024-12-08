<?php
// Include the database connection
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $no_kamar = $_POST['no_kamar'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $harga = $_POST['harga'];
    $status_kamar = $_POST['status_kamar'];

    // Insert query
    try {
        $stmt = $pdo->prepare('INSERT INTO kamar (no_kamar, tipe_kamar, harga, status_kamar) VALUES (?, ?, ?, ?)');
        $stmt->execute([$no_kamar, $tipe_kamar, $harga, $status_kamar]);

        // Redirect back to the room list after successful insertion
        header("Location: index-kamar.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
