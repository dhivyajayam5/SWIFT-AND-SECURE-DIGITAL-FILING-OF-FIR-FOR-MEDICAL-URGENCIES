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

// Get the complaint ID from the POST request
$complaintId = $_POST['complaintId'];

// Update the 'approved' column in the database for the given complaint
$sql = "UPDATE cases SET approved = 1 WHERE uuid = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $complaintId);

if ($stmt->execute()) {
    echo "Complaint approved successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
?>
