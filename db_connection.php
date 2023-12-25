<!-- db_connection.php -->

<?php
$servername = "localhost";
$username = "root";
$password = "karosql20";
$database = "admissionportal";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$conn->close();
?>
