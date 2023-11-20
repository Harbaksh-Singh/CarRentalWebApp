<?php

function openDatabaseConnection()
{
    $servername = "localhost";
    $dbname = 'CarRental';
    $username = 'root';
    $password = '';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Function to close database connection
function closeDatabaseConnection($conn)
{
    $conn->close();
}


// Check if the action is to get insurance coverage types
if (isset($_GET['action']) && $_GET['action'] === 'getInsuranceTypes') {
    $conn = openDatabaseConnection();
    // Create an array to store the insurance coverage types
    $insuranceTypes = array();

    // Query to fetch insurance coverage types
    $sql = "SELECT * FROM insurance";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $insuranceTypes[] = $row;
        }
    }

    // Close the database connection
    closeDatabaseConnection($conn);

    // Return the insurance coverage types as JSON data
    header('Content-Type: application/json');
    echo json_encode($insuranceTypes);
}
