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

// Retrieve approved complaints from the database along with PhotoData
$sql = "SELECT cases.*, your_table_name.PhotoData 
        FROM cases 
        INNER JOIN your_table_name ON cases.aadhar = your_table_name.aadhar
        WHERE cases.approved = 1";

$result = $conn->query($sql);

$approvedComplaints = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $approvedComplaints[] = $row;
    }
}

// Close the database connection
$conn->close();

// Return the approved complaints as JSON
header('Content-Type: application/json');
echo json_encode($approvedComplaints);
?>
