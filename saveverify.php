<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'));

    if (!$data || empty($data->aadharNumber) || empty($data->photoData)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid data']);
        exit;
    }

    $aadharNumber = htmlspecialchars($data->aadharNumber);
    $photoData = htmlspecialchars($data->photoData);

    // Establish a connection to your MySQL database
    $servername = "localhost"; // Replace with your server name or IP address
    $username = "root";    // Replace with your MySQL username
    $password = "root";    // Replace with your MySQL password
    $database = "mydb"; // Replace with your database name

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        http_response_code(500);
        echo json_encode(['error' => 'Database connection failed']);
        exit;
    }

    // Prepare and execute the SQL INSERT statement
    $aadharNumber = $conn->real_escape_string($aadharNumber);
    $photoData = $conn->real_escape_string($photoData);

    $sql = "INSERT INTO your_table_name (aadhar, PhotoData) VALUES ('$aadharNumber', '$photoData')";

    if ($conn->query($sql) === TRUE) {
        // Insertion successful
        http_response_code(200);
        echo json_encode(['message' => 'Data saved successfully']);
    } else {
        // Insertion failed
        http_response_code(500);
        echo json_encode(['error' => 'Error saving data: ' . $conn->error]);
    }

    // Close the database connection
    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>
