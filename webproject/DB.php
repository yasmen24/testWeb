<?php
$servername = "localhost"; // or your server IP address
$username = "root";
$password = "root";
$dbname = "WebProject";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>