<?php
// Include the database connection
require 'koneksi.php';

// Get the ID of the transaction to delete
$id = $_GET['id'];

// Delete query
try {
    $stmt = $pdo->prepare("DELETE FROM transaksi WHERE id_transaksi = ?");
    $stmt->execute([$id]);

    // Redirect back to index
    header("Location: index.php");
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
