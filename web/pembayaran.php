<?php
// Handle file upload when the user submits the proof of transaction
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    require 'koneksi.php'

    $conn = mysqli_connect($host, $user, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get pesanan ID from query or hidden field
    $pesanan_id = $_POST['pesanan_id'];

    // Handle the file upload for bukti_transfer
    $bukti_transfer = $_FILES['photo'];
    $photo_name = $bukti_transfer['name'];
    $photo_tmp_name = $bukti_transfer['tmp_name'];
    $photo_size = $bukti_transfer['size'];
    $photo_error = $bukti_transfer['error'];

    // Directory where we want to store the uploads
    $upload_dir = 'uploads/';

    // Check if the uploads directory exists, if not, create it
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);  // Create directory with write permissions
    }

    // Check if the file was uploaded without errors
    if ($photo_error === 0) {
        // Check file size (optional: e.g., max 2MB)
        if ($photo_size <= 2000000) {
            // Create a unique file name to avoid overwriting
            $photo_new_name = uniqid('', true) . "-" . $photo_name;
            $photo_destination = $upload_dir . $photo_new_name;

            // Move the uploaded file to the destination folder
            if (move_uploaded_file($photo_tmp_name, $photo_destination)) {
                // File successfully uploaded and moved
                $photo_path = $photo_destination;

                // Update the pesanan table with bukti_transfer
                $query_update = "UPDATE pesanan SET bukti_transfer = '$photo_path' WHERE id_pesanan = '$pesanan_id'";
                
                if (mysqli_query($conn, $query_update)) {
                    // Redirect to confirmation page after successful upload
                    header("Location: sukses.html");
                    exit();
                }
                 else {
                    echo "Error updating record: " . mysqli_error($conn); // SQL error handler
                }

            } else {
                die("Error uploading the photo.");
            }
        } else {
            die("File size is too large.");
        }
    } else {
        die("Error uploading the photo.");
    }

    mysqli_close($conn);
} else {
    // Display the form if no POST request has been made
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Seaplace Hotel - Pembayaran</title>
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .card {
      margin: 20px auto;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      max-width: 500px;
      transition: none;
    }
    .card-title {
      text-align: center;
    }
    .bank-details {
      margin-top: 20px;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .bank-details h5 {
      color: #007bff;
    }
  </style>
</head>
<body>

  <!-- ================ Transaksi Pembayaran Section ================= -->
  <div class="card">
    <div class="form-group">
      <h5 class="card-title">Form Pembayaran</h5>
      <label>Nama :</label> 
      <?php echo htmlspecialchars($_GET['name']); ?>
    </div>
    <div class="form-group">
      <label>Total : </label> 
      Rp <?php echo number_format($_GET['total'], 2); ?>
    </div>

    <!-- Detailed payment information -->
    <div class="bank-details">
      <h5>Bank BRI</h5>
      <p>Nomor Rekening: 1234567890</p>
    </div>

    <div class="bank-details">
      <h5>Bank BNI</h5>
      <p>Nomor Rekening: 0987654321</p>
    </div>

    <form action="pembayaran.php" method="POST" enctype="multipart/form-data">
      <!-- Passing the pesanan_id as a hidden field to associate the upload with the correct pesanan -->
      <input type="hidden" name="pesanan_id" value="<?php echo htmlspecialchars($_GET['pesanan_id']); ?>"> <!-- Assuming pesanan_id is passed via GET -->

      <div class="form-group">
        <label for="photo">Bukti Transaksi</label>
        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
      </div>

      <div class="button-container" style="margin-top: 20px;">
        <button type="submit" class="btn btn-primary" style="width: 100%;">Upload Bukti Pembayaran</button>
      </div>
    </form>
  </div>

</body>
</html>
<?php
}
?>
