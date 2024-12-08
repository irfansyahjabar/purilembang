<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'hotel';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the selected room type from the AJAX request
    $room_type = $_POST['room_type'];

    // Query to fetch available room numbers based on room type
    $query = "SELECT no_kamar FROM kamar WHERE tipe_kamar = '$room_type' AND status_kamar = 'tersedia'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<option value="'.$row['no_kamar'].'">'.$row['no_kamar'].'</option>';
        }
    } else {
        echo '<option value="">No rooms available</option>';
    }
}

mysqli_close($conn);
?>
