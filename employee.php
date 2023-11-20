<?php include('employeeDB.php'); ?>
<?php
if (isset($_GET['edit'])) {
    $employee_ID = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM employee WHERE employee_ID='$employee_ID'");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);

        $employee_ID = $n['employee_ID'];
        $old_Employee_ID = $employee_ID;
        $first_name = $n['first_name'];
        $last_name = $n['last_name'];
        $email = $n['email'];
        $phone_number = $n['phone_number'];
        $position = $n['position'];
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
                            <a class="nav-link" href="booking.php">Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="customer.php">Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="car.php">Car</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="employee.php">Employee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="billing.php">Billing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="insurance.php">Insurance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="maintenance.php">Maintenance</a>
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

    <?php $results = mysqli_query($db, "SELECT * FROM employee"); ?>
    <div class="container mt-1 mb-4 border rounded p-4">
        <h2 class="text-center">Employees</h2>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Position</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row['employee_ID']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone_number']; ?></td>
                        <td><?php echo $row['position']; ?></td>
                        <td>
                            <a class="btn btn-primary" href="employee.php?edit=<?php echo $row['employee_ID']; ?>">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="employee.php?del=<?php echo $row['employee_ID']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form class="border rounded p-4" id="customerForm" method="post" action="employeeDB.php">
            <input type="hidden" name="oldcustomer_id" value="<?php echo $oldcustomer_id; ?>">
            <div class="mb-3">
                <label for="employee_ID" class="form-label fw-bold">Employee ID</label>
                <input type="text" class="form-control" name="employee_ID" value="<?php echo $employee_ID; ?>" required pattern="[A-Za-z0-9]+" title="Alphanumeric characters only">
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
                <input type="tel" class="form-control" name="phone_number" value="<?php echo $phone_number; ?>" required pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title="Phone number must be in the format XXX-XXX-XXXX">
            </div>

            <div class="mb-3">
                <label for="position" class="form-label fw-bold">Position</label>
                <input type="text" class="form-control" name="position" value="<?php echo $position; ?>" required>
            </div>
            <div class="mb-3">
                <?php if ($update == true) : ?>
                    <button class="btn btn-primary" type="submit" name="update">update</button>
                <?php else : ?>
                    <button class="btn btn-primary" type="submit" name="save">Save</button>
                <?php endif ?>
            </div>
        </form>

    </div>

</body>

</html>