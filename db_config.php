<?php
$servername = "localhost";
$username = "root"; // default username for XAMPP is "root"
$password = ""; // default password for XAMPP is empty
$database = "photographer_website";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>