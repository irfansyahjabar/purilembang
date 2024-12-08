<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require 'koneksi.php'; // Database connection

// Get the admin details from the session
$admin_id = $_SESSION['admin_id'];

// Fetch admin data from the database
$stmt = $pdo->prepare("SELECT * FROM admin WHERE id_admin = ?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Profil Admin</h2>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Nama Staf: <?php echo $admin['nama_staf']; ?></h5>
                <p class="card-text">ID Admin: <?php echo $admin['id_admin']; ?></p>
                <p class="card-text">Username: <?php echo $admin['username']; ?></p>

                <!-- Button to switch account (log out) -->
                <a href="logout.php" class="btn btn-danger">Ganti Akun</a>
            </div>
        </div>
    </div>
</body>
</html>
