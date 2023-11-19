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

// Function to display car
function displayCars()
{
    $conn = openDatabaseConnection();
    $sql = "SELECT * FROM car";
    $result = $conn->query($sql);

    $cars = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }
        echo json_encode($cars);
    } else {
        echo "0 results";
    }

    closeDatabaseConnection($conn);
}


function addCarToDatabase()
{
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $VIN_number = $_POST["VIN_number"];
        $make = $_POST["make"];
        $model = $_POST["model"];
        $year = $_POST["year"];
        $colour = $_POST["colour"];
        $number_of_seats = $_POST["number_of_seats"];
        $cost_per_day = $_POST["cost_per_day"];
        $currently_available = $_POST["currently_available"];

        $conn = openDatabaseConnection();

        // Prepare and execute an SQL query to insert the customer data
        $sql = "INSERT INTO car (VIN_number, make, model, year, colour, number_of_seats, cost_per_day, currently_available ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $VIN_number, $make, $model, $year, $colour, $number_of_seats, $cost_per_day, $currently_available);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Registration failed: " . $stmt->error;
        }

        $stmt->close();
        closeDatabaseConnection($conn);
    }
}

addCarToDatabase();
displayCars();
