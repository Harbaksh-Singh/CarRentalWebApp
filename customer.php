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

// if (isset($_POST['action']) && $_POST['action'] === 'removeCustomer') {
//     $customer_id_to_remove = $_POST['customer_id'];

//     $conn = openDatabaseConnection();

//     $sql = "DELETE FROM customer WHERE customer_id = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("s", $customer_id_to_remove);

//     if ($stmt->execute()) {
//         echo "Customer removed successfully.";
//     } else {
//         echo "Error removing customer: " . $stmt->error;
//     }

//     $stmt->close();
//     closeDatabaseConnection($conn);
// }

function removeUser()
{
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $customer_id = $_POST["remove_input"];

        $conn = openDatabaseConnection();

        // Prepare and execute an SQL query to insert the customer data
        $sql = "DELETE FROM `customer` WHERE `customer`.`customer_id` = '123'";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $customer_id);

        if ($stmt->execute()) {
            echo "User removed successfully!";
        } else {
            echo "Error removing user: " . $stmt->error;
        }

        $stmt->close();
        closeDatabaseConnection($conn);
    }
}


removeUser();
addUserToDatabase();
displayCustomers();
