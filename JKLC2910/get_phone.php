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

// Get the selected student name from the POST request
$studentName = $_POST['studentName'];

// Query to fetch the phone number of the selected student
$query = "SELECT pcontact FROM sregister WHERE student_name = '$studentName'";
$result = $conn->query($query);

// Get the phone number
$phoneNumber = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $phoneNumber = $row['pcontact'];
}

echo $phoneNumber;

// Close the database connection
$conn->close();
?>
