<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add a click event listener to the Display Customers button
            document.getElementById("displayCustomersBtn").addEventListener("click", function() {
                // Make an AJAX request to fetch customer data from the server
                fetchCustomers();
            });

            // Function to fetch and display customers
            function fetchCustomers() {
                // Make an AJAX request to a PHP script that fetches customer data
                fetch("fetch_customers.php") // Replace with the actual PHP script
                    .then(response => response.text())
                    .then(data => {
                        // Display the customer data in a modal or on the page
                        // You can customize this part based on how you want to display the data
                        displayCustomerData(data);
                    })
                    .catch(error => {
                        console.error("Error fetching customers: " + error);
                    });
            }

            // Function to display customer data (you can customize this)
            function displayCustomerData(data) {
                // You can display the customer data in a Bootstrap modal or any other way you prefer
                // For example, you can replace the content of a div with the data
                document.getElementById("customerDataContainer").innerHTML = data;
            }
        });
    </script>
</head>

<body>
    <?php
    // Function to display all customers
    function displayCustomers()
    {
        // Connect to the MySQL database (replace with your credentials)
        $servername = "localhost";
        $dbname = 'CarRental';
        $username = 'root';
        $password = '';

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch all customers from the database
        $sql = "SELECT * FROM customer";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $output = "<h2>Customers in the Database:</h2>";
            $output .= "<table class='table'>";
            $output .= "<tr><th>Customer ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th><th>Address</th><th>Date of Birth</th></tr>";
            while ($row = $result->fetch_assoc()) {
                $output .= "<tr>";
                $output .= "<td>" . $row["customer_id"] . "</td>";
                $output .= "<td>" . $row["first_name"] . "</td>";
                $output .= "<td>" . $row["last_name"] . "</td>";
                $output .= "<td>" . $row["email"] . "</td>";
                $output .= "<td>" . $row["phone_number"] . "</td>";
                $output .= "<td>" . $row["address"] . "</td>";
                $output .= "<td>" . $row["date_of_birth"] . "</td>";
                $output .= "</tr>";
            }
            $output .= "</table>";
        } else {
            $output = "No customers found in the database.";
        }

        // Close the database connection
        $conn->close();

        echo $output;
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer_id = $_POST["customer_id"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];
        $address = $_POST["address"];
        $date_of_birth = $_POST["date_of_birth"];

        // Connect to the MySQL database (replace with your credentials)
        $servername = "localhost";
        $dbname = 'CarRental';
        $username = 'root';
        $password = '';

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute an SQL query to insert the customer data
        $sql = "INSERT INTO customer (customer_id, first_name, last_name, email, phone_number, address, date_of_birth) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $customer_id, $first_name, $last_name, $email, $phone_number, $address, $date_of_birth);

        if ($stmt->execute()) {
        } else {
        }


        // Close the database connection
        $stmt->close();
        $conn->close();
    }

    // Check if the "Display Customers" button is clicked
    if (isset($_POST["display_customers"])) {
        displayCustomers();
    }
    ?>
    <header>Car Rental Database</header>
    <h2 class="mt-4 text-center">User Registration</h2>
    <div class="container mt-4">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer ID:</label>
                <input type="text" class="form-control" name="customer_id" required>
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" class="form-control" name="first_name" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" class="form-control" name="last_name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number:</label>
                <input type="tel" class="form-control" name="phone_number" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" name="address" required></textarea>
            </div>

            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth:</label>
                <input type="date" class="form-control" name="date_of_birth" required>
            </div>
            <button type="submit" class="btn btn-success mb-4">Submit</button>
        </form>
        <button type="button" id="displayCustomersBtn" class="btn btn-primary">Display Customers</button>

    </div>
</body>

</html>