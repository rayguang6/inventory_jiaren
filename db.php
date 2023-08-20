<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myinventory";
$port = 3325;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
