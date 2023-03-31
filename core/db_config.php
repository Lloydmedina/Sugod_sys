<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qpsii_lgusystem";
$port = '3308';

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname,$port);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
