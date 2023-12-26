<?php
// This is a simple PHP file for testing
echo "Hello, this is a test!";
?>


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

// ... (database connection code)

// Sample query
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === FALSE) {
    die("Query failed: " . $conn->error);
}

// Print the results
while ($row = $result->fetch_assoc()) {
    echo "ID: " . $row["id"] . " - Name: " . $row["name"] . "<br>";
}

// Close the database connection
$conn->close();
?>
