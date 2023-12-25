<?php
// Start the session to access session variables
session_start();
// Include the database connection code
include('db_connection.php');
// Retrieve the student ID from the query parameter
$studentId = isset($_GET['studentId']) ? $_GET['studentId'] : '';

//  code to display the user profile based on $studentId


// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    // Redirect to login page if not logged in
    header("Location: Portal.html");
    exit();
}

// Retrieve logged-in user's data from the database
$userID = $_SESSION['UserID'];
$sql = "SELECT Users.FirstName, Users.LastName, Users.MatNumber, Courses.CourseName, Grades.Grade
        FROM Users
        JOIN Grades ON Users.UserID = Grades.UserID
        JOIN Courses ON Grades.CourseID = Courses.CourseID
        WHERE Users.UserID = $userID";
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
    //start the loop from the beginning of the result set
    $result->data_seek(0);
    while ($row = $result->fetch_assoc()) {
        $courseName = $row['CourseName'];
        $grade = $row['Grade'];
        echo "<li>$courseName: $grade</li>";
    }
    echo "</ul>";

    //  print transcript (you may implement this using JavaScript)
    echo "<button onclick='printTranscript()'>Print Transcript</button>";
} else {
    // Handle query error
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>

<!-- Include the JavaScript code for printing transcript -->
<script>
    function printTranscript() {
        // Implement the printing logic using JavaScript
        alert('Printing transcript...');
    }
</script>

?>
