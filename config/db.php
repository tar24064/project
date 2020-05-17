<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "student";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
$conn->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
//error_reporting(E_ALL ^ E_NOTICE);
?>
