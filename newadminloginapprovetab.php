<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the complaint ID from the AJAX request
$complaintId = $_POST['complaintId'];

// Update the 'approved' column in the database for the given complaint
$sql = "UPDATE cases SET approved = 1 WHERE uuid = '$complaintId'";

if ($conn->query($sql) === TRUE) {
    echo "Complaint approved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
