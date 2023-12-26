<?php
// Start the session to access session variables
session_start();
// Include the database connection code
include('db_connection.php');
// Retrieve the student ID from the query parameter
$studentId = isset($_GET['studentId']) ? $_GET['studentId'] : '';

// Function to get UserID based on MatNumber
function getUserId($matNumber) {
    // Include the database connection code
    include('db_connection.php');

    $sql = "SELECT UserID FROM Users WHERE MatNumber = '$matNumber'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Close the result set
        $result->close();
        // Close the database connection
        $conn->close();
        return $row['UserID'];
    } else {
        // Close the database connection
        $conn->close();
        // Return some default or error value
        return -1;
    }
}

// Check if the user is logged in
if (empty($studentId)) {
    // Redirect to login page if not logged in
    header("Location: Portal.html");
    exit();
}

// Retrieve logged-in user's data from the database
$userID = getUserId($studentId);
$sql = "SELECT Users.FirstName, Users.LastName, Users.MatNumber, Courses.CourseName, Grades.Grade
        FROM Users
        JOIN Grades ON Users.UserID = Grades.UserID
        JOIN Courses ON Grades.CourseID = Courses.CourseID
        WHERE Users.UserID = $userID";

// Perform the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch user data and display it
    $userData = $result->fetch_assoc();
    $firstName = $userData['FirstName'];
    $lastName = $userData['LastName'];
    $matNumber = $userData['MatNumber'];

    // Display user information
    echo "<h2>Welcome, $firstName $lastName!</h2>";
    echo "<p>MatNumber: $matNumber</p>";

    // Display courses and grades
    echo "<h3>Your Courses and Grades</h3>";
    echo "<ul>";

    // Reset the result set pointer to the beginning
    $result->data_seek(0);

    while ($row = $result->fetch_assoc()) {
        $courseName = $row['CourseName'];
        $grade = $row['Grade'];
        echo "<li>$courseName: $grade</li>";
    }

    echo "</ul>";

    // Display the transcript section
    echo "<section id='transcript' class='hidden'>";
    echo "<h2>Transcript</h2>";
    echo "<p>This is the transcript for $firstName $lastName</p>";
    echo "</section>";

    //  print transcript 
    echo "<button onclick='printTranscript()'>Print Transcript</button>";

    // Close the result set
    $result->close();
} else {
    // Handle query error
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
