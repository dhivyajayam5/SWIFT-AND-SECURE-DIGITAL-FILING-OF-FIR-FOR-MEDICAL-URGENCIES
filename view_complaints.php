<?php
// Establish a database connection (you'll need to provide your connection details)
$conn = mysqli_connect("localhost", "root", "root", "mydb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch complaints from the database
$sql = "SELECT * FROM cases";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output each complaint with an "Approve" button
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="complaint">';
        echo '<p>' . $row["uuid"] . '</p>';
        echo '<button onclick="approveComplaint(' . $row["complaint_id"] . ')">Approve</button>';
        echo '</div>';
    }
} else {
    echo "No complaints found.";
}

// Close the database connection
mysqli_close($conn);
?>
