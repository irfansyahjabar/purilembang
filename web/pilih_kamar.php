<?php
// Koneksi ke database
require 'koneksi.php'

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mendapatkan semua kamar
$query = "SELECT * FROM kamar";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Seaplace Hotel - Gallery</title>
	
	<link rel="icon" href="img/favicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
	<link rel="stylesheet" href="vendors/magnefic-popup/magnific-popup.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">	

	<link rel="stylesheet" href="css/style.css">
    <style>
        .room-grid { display: flex; flex-wrap: wrap; gap: 20px; }
        .room-card {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            position: relative;
        }
        .room-card:hover { transform: scale(1.05); }
        .room-img { width: 100%; height: 200px; object-fit: cover; }
        .room-content { padding: 15px; }
        .room-content h5 { margin: 0 0 10px; font-size: 1.2em; }
        .room-content p { margin: 0; color: #666; }
        .btn-select { margin-top: 15px; }

        /* Style kamar yang terisi */
        .unavailable {
            opacity: 0.6;
            pointer-events: none;
        }
        .unavailable .unavailable-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 0, 0, 0.2);
            color: red;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    
<div class="container mt-5">
    <h2 class="text-center">Pilih Kamar</h2>
    <div class="room-grid">

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="room-card <?= $row['status_kamar'] === 'terisi' ? 'unavailable' : ''; ?>">
                <img src="<?= $row['gambar']; ?>" alt="Kamar <?= $row['no_kamar']; ?>" class="room-img">
                <div class="room-content">
                    <h5>Kamar No: <?= $row['no_kamar']; ?></h5>
                    <p>Tipe: <?= ucfirst($row['tipe_kamar']); ?></p>
                    <p>Harga: Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                    <p>Bed: <?= $row['bed']; ?></p>

                    <?php if ($row['status_kamar'] === 'tersedia'): ?>
                        <!-- Form untuk kamar yang tersedia -->
                        <form action="transaksi1.php" method="POST">
                            <input type="hidden" name="id_kamar" value="<?= $row['id_kamar']; ?>">
                            <input type="hidden" name="no_kamar" value="<?= $row['no_kamar']; ?>">
                            <input type="hidden" name="tipe_kamar" value="<?= $row['tipe_kamar']; ?>">
                            <input type="hidden" name="harga" value="<?= $row['harga']; ?>">
                            <input type="hidden" name="bed" value="<?= $row['bed']; ?>">
                            <button type="submit" class="btn btn-primary btn-block btn-select">Pilih Kamar</button>
                        </form>

                    <?php else: ?>
                        <!-- Overlay untuk kamar yang tidak tersedia -->
                        <div class="unavailable-overlay">Kamar Terisi</div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>

    </div>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>
