<?php
// Connect to the database
require 'koneksi.php';

// Get the id_pesanan from the URL
$id_pesanan = $_GET['id'] ?? null;

// Check if id_pesanan is provided
if ($id_pesanan) {
    // Prepare the query to fetch the payment proof path
    $query = "SELECT bukti_pembayaran FROM pesanan WHERE id_pesanan = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_pesanan]);
    $order = $stmt->fetch();

    // Check if bukti_pembayaran exists for the given id_pesanan
    if ($order && !empty($order['bukti_pembayaran'])) {
        // Add 'web/' to the path
        $bukti_pembayaran = 'web/' . $order['bukti_pembayaran'];
    } else {
        $error_message = "Bukti pembayaran tidak ditemukan.";
    }
} else {
    $error_message = "ID pesanan tidak valid.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Bukti Pembayaran</title>
    <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">Bukti Pembayaran</h3>
        <div class="text-center">
            <?php if (isset($bukti_pembayaran)): ?>
                <img src="<?php echo htmlspecialchars($bukti_pembayaran); ?>" alt="Bukti Pembayaran" style="max-width: 100%; height: auto;">
            <?php else: ?>
                <p class="text-danger"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
