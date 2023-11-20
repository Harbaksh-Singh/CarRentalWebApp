<?php include('customerDB.php'); ?>
<?php
if (isset($_GET['edit'])) {
    $customer_id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM customer WHERE customer_id=$customer_id");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);

        $customer_id = $n['customer_id'];
        $oldcustomer_id = $customer_id;
        $first_name = $n['first_name'];
        $last_name = $n['last_name'];
        $email = $n['email'];
        $phone_number = $n['phone_number'];
        $address = $n['address'];
        $date_of_birth = $n['date_of_birth'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="teststyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand" href="index.php">CityZoom Rentals</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="customer.html">Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="car.html">Car</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="employee.html">Employee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="billing.html">Billing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="insurance.html">Insurance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="maintenance.html">Maintenance</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-3 d-flex justify-content-center">
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif ?>
    </div>

    <?php $results = mysqli_query($db, "SELECT * FROM customer"); ?>
    <div class="container mt-4 mb-4 border rounded p-4">
        <h2 class="text-center">Customers</h2>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Date of Birth</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row['customer_id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone_number']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['date_of_birth']; ?></td>
                        <td>
                            <a class="btn btn-primary" href="customerDB.php?edit=<?php echo $row['customer_id']; ?>">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="customerDB.php?del=<?php echo $row['customer_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form class="border rounded p-4" id="customerForm" method="post" action="customerDB.php">
            <input type="hidden" name="oldcustomer_id" value="<?php echo $oldcustomer_id; ?>">
            <div class="mb-3">
                <label for="customer_id" class="form-label fw-bold">Customer ID</label>
                <input type="text" class="form-control" name="customer_id" value="<?php echo $customer_id; ?>" required pattern="[A-Za-z0-9]+" title="Alphanumeric characters only">
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label fw-bold">First Name</label>
                <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>" required pattern="[A-Za-z]+" title="Alphabetic characters only">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label fw-bold">Last Name</label>
                <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>" required pattern="[A-Za-z]+" title="Alphabetic characters only">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label fw-bold">Phone number</label>
                <input type="tel" class="form-control" name="phone_number" value="<?php echo $phone_number; ?>" required pattern="[0-9]+" title="Numeric characters only">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label fw-bold">Address</label>
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" required>
            </div>
            <div class="mb-3">
                <label for="date_of_birth" class="form-label fw-bold">Date of Birth</label>
                <input type="date" class="form-control" name="date_of_birth" value="<?php echo $date_of_birth; ?>" required>
            </div>
            <div class="mb-3">
                <?php if ($update == true) : ?>
                    <button class="btn btn-primary" type="submit" name="update" style="background: #556B2F;">update</button>
                <?php else : ?>
                    <button class="btn btn-primary" type="submit" name="save">Save</button>
                <?php endif ?>
            </div>
        </form>

    </div>

</body>

</html>