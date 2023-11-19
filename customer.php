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

// Function to display customers
function displayCustomers()
{
    $conn = openDatabaseConnection();
    $sql = "SELECT * FROM customer";
    $result = $conn->query($sql);

    $customers = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
        echo json_encode($customers);
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
        $customer_id = $_POST["customer_id"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];
        $address = $_POST["address"];
        $date_of_birth = $_POST["date_of_birth"];

        $conn = openDatabaseConnection();

        // Prepare and execute an SQL query to insert the customer data
        $sql = "INSERT INTO customer (customer_id, first_name, last_name, email, phone_number, address, date_of_birth) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $customer_id, $first_name, $last_name, $email, $phone_number, $address, $date_of_birth);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Registration failed: " . $stmt->error;
        }

        $stmt->close();
        closeDatabaseConnection($conn);
    }
}

addUserToDatabase();
displayCustomers();


//test 