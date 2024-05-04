<?php
$servername = "sql101.infinityfree.com"; // or your server IP address
$username = "if0_36484547";
$password = "DesignMate3213";
$dbname = "if0_36484547_webproject";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>
