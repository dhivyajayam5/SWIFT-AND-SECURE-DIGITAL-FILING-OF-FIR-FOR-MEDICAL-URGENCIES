<?php
// Replace the following with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mydb";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Replace "cases" with your actual table name


$sql = "SELECT cases.*, your_table_name.PhotoData 
        FROM cases 
        LEFT JOIN your_table_name ON cases.aadhar = your_table_name.aadhar
        WHERE cases.approved = 0
        ORDER BY cases.`order` DESC";







$result = $conn->query($sql);

$registeredComplaints = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $registeredComplaints[] = $row;
    }
}

// Close the database connection
$conn->close();

// Return the registered complaints as JSON
header('Content-Type: application/json');
echo json_encode($registeredComplaints);
?>
