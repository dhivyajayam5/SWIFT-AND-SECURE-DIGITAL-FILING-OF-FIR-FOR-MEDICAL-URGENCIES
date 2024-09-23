<?php
// Establish a database connection (update with your credentials)
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data based on the primary key
$uuid = $_POST["uuid"];
$sql = "SELECT * FROM cases WHERE uuid = '$uuid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<style>
            .vertical-table {
                font-family: Arial, sans-serif;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .table-row {
                display: flex;
                flex-direction: row;
                margin: 10px;
                border: 1px solid #dddddd;
                padding: 10px;
                width: 70%;
                transition: transform 0.2s ease-in-out;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            }

            .table-row:hover {
                transform: scale(1.05);
                background-color: #f2f2f2;
            }

            .table-label {
                font-weight: bold;
                width: 30%;
                padding: 5px;
            }

            .table-data {
                width: 70%;
                padding: 5px;
            }

            .approval-status-row {
                background-color: white; 
            }

    
            .approval-status {
               font-weight: bold; 
               color: #00ff00;
            }
            

            .table-row:nth-child(even) {
                background-color: #f2f2f2;
            }
          </style>';
    
    echo '<div class="vertical-table">';
    
    while ($row = $result->fetch_assoc()) {
        echo '<div class="table-row approval-status-row"> 
                <div class="table-label">Approval Status: </div>
                <div class="table-data approval-status">' . $row["approval_status"] . '</div>
              </div>';
        echo '<div class="table-row">
                <div class="table-label">Aadhar:</div>
                <div class="table-data">' . $row["aadhar"] . '</div>
              </div>';
        echo '<div class="table-row">
                <div class="table-label">Name:</div>
                <div class="table-data">' . $row["name"] . '</div>
              </div>';
        echo '<div class="table-row">
                <div class="table-label">Phone:</div>
                <div class="table-data">' . $row["phone"] . '</div>
              </div>';
        echo '<div class="table-row">
                <div class="table-label">Case Description:</div>
                <div class="table-data">' . $row["case_description"] . '</div>
              </div>';
        echo '<div class="table-row">
                <div class="table-label">Condition:</div>
                <div class="table-data">' . $row["condition"] . '</div>
              </div>';
        echo '<div class="table-row">
                <div class="table-label">Hospital Name:</div>
                <div class="table-data">' . $row["hospital_name"] . '</div>
              </div>';
        echo '<div class="table-row">
                <div class="table-label">Hospital City:</div>
                <div class="table-data">' . $row["hospital_city"] . '</div>
              </div>';
        echo '<div class="table-row">
                <div class="table-label">Image Path:</div>
                <div class="table-data">' . $row["image_path"] . '</div>
              </div>';
        echo '<div class="table-row">
                <div class="table-label">Created At:</div>
                <div class="table-data">' . $row["created_at"] . '</div>
              </div>';
        
    }
    
    echo '</div>';
} else {
    echo "No results found.";
}

$conn->close();
?>
