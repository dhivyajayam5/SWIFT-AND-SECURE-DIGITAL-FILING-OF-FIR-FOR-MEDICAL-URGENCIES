<?php
// Establish a MySQL database connection here

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate a UUID using MySQL
    $uuid = uniqid();

    $aadhar = $_POST["aadhar"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $caseDescription = $_POST["case-description"];
    $hospitalName = $_POST["hospital-name"];
    $hospitalCity = $_POST["hospital-city"];
    $condition = $_POST["condition"];
    
    // Handle file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    // Insert data into the database (you should replace these placeholders with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "mydb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO cases (uuid, aadhar, name, phone, case_description, hospital_name, hospital_city, `condition`, image_path) VALUES ('$uuid', '$aadhar', '$name', '$phone', '$caseDescription', '$hospitalName', '$hospitalCity', '$condition', '$targetFile')";

    if ($conn->query($sql) === TRUE) {
        echo '<h1>Complaint Submitted Successfully</h1><br>';
        
        // Retrieve the UUID based on Aadhar number
        $sql = "SELECT uuid FROM cases WHERE aadhar = '$aadhar'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $retrievedUuid = $row["uuid"];

            echo '<h3>Kindly Use This Tracking ID For Reference Of Your Complaint: </h3> <h2> <span style="color: blue;">' . $retrievedUuid . '</span></h2><br>';

// Add a button to redirect to USERLOGIN.html
    echo '<form action="indexuuid.html">';
    echo '<input type="submit" value="Track Here">';
    echo '</form>';

        } else {
            echo "UUID not found for Aadhar: $aadhar";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
