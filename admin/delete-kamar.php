<?php
// Include the database connection
require 'koneksi.php';

$id = $_GET['id'];

// Delete query
try {
    $stmt = $pdo->prepare('DELETE FROM kamar WHERE id_kamar = ?');
    $stmt->execute([$id]);

    // Redirect back to the room list after deletion
    header("Location: index-kamar.php");
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
