<?php
$servername = "localhost"; // Change to your MySQL server's host
$username = "root"; // Change to your MySQL username
$password = "root"; // Change to your MySQL password
$dbname = "mydb"; // Change to your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get Aadhar number from the form
$aadharnum = $_POST["aadharnum"];

// Query the database
$sql = "SELECT * FROM aadhar WHERE aadharnum = '$aadharnum'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display the results
    $row = $result->fetch_assoc();
    echo "<h2>Details for Aadhar Number: " . $row["aadharnum"] . "</h2>";
    echo "<p>Name: " . $row["name"] . "</p>";
    echo "<p>aadharnum: " . $row["aadharnum"] . "</p>";
   
} else {
    echo "Aadhar number not found.";
}

// Close the database connection
$conn->close();
?>
