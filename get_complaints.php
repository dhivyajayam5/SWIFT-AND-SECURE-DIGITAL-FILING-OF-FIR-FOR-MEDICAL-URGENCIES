<?php
// Include your database connection code here.
// For example:
$conn = mysqli_connect("localhost", "root", "root", "mydb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT uuid FROM cases";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>" . $row["uuid"] . "</p>";
    }
} else {
    echo "No complaints found.";
}

mysqli_close($conn);
?>
