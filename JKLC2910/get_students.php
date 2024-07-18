<?php
// Database connection settings
$host = "localhost";
$user = "root";
$password = "";
$database = "jklc";

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected class from the POST request
$class = $_POST['class'];

// Query to fetch student names based on the selected class
$query = "SELECT student_name FROM sregister WHERE class = '$class'";
$result = $conn->query($query);

// Prepare the HTML options for the student names dropdown
$options = "<option value=''>Select Student</option>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row['student_name'] . "'>" . $row['student_name'] . "</option>";
    }
}

echo $options;

// Close the database connection
$conn->close();
?>
