<!DOCTYPE html>
<html>
<head>
    <title>Aadhar Data Retrieval Result</title>
</head>
<body>
    <h1>Aadhar Data Retrieval Result</h1>
    <?php
    // Retrieve Aadhar number from the form
    $aadhar_number = $_POST['aadharnum'];

    // Simulated database connection
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = 'root';
    $db_name = 'mydb';

    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query the database to retrieve user data
    $query = "SELECT * FROM aadhar WHERE aadharnum = '$aadhar_number'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        // Display user data
        echo "<p>Aadhar Number: " . $user_data['aadharnum'] . "</p>";
        echo "<p>Name: " . $user_data['name'] . "</p>";
        echo "<p>Age: " . $user_data['age'] . "</p>";
        echo "<p>Father Name: " . $user_data['fathername'] . "</p>";
        echo "<p>Address: " . $user_data['address'] . "</p>";
        echo "<p>Phone Number: " . $user_data['phonenum'] . "</p>";
        // Add more fields as needed
    } else {
        echo "<p>No data found for the provided Aadhar number.</p>";
    }

    // Close the database connection
    mysqli_close($connection);
    ?>
    <p><a href="Adhartest.html">Go back</a></p>
</body>
</html>
