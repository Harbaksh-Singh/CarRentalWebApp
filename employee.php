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

// Function to display employees
function displayEmployees()
{
    $conn = openDatabaseConnection();
    $sql = "SELECT * FROM employee";
    $result = $conn->query($sql);

    $employees = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        echo json_encode($employees);
    } else {
        echo "0 results";
    }

    closeDatabaseConnection($conn);
}


function addUserToDatabase()
{
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $employee_ID = $_POST["employee_ID"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];
        $position = $_POST["position"];

        $conn = openDatabaseConnection();

        // Prepare and execute an SQL query to insert the employee data
        $sql = "INSERT INTO employee (employee_ID, first_name, last_name, email, phone_number, position) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $employee_ID, $first_name, $last_name, $email, $phone_number, $position);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Registration failed: " . $stmt->error;
        }

        $stmt->close();
        closeDatabaseConnection($conn);
    }
}


// // Check if the form is submitted before adding a user
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// }

// // Display employees only if the form is not submitted
// if ($_SERVER["REQUEST_METHOD"] != "POST") {
// }
addUserToDatabase();
displayEmployees();

//test 
