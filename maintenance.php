<?php include('maintenanceDB.php'); ?>
<?php
if (isset($_GET['edit'])) {
    $maintenance_ID = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM maintenance WHERE maintenance_ID='$maintenance_ID'");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);

        $maintenance_ID = $n['maintenance_ID'];
        $old_maintenance_id = $maintenance_ID;
        $VIN_number = $n['VIN_number'];
        $maintenance_type = $n['maintenance_type'];
        $maintenance_date = $n['maintenance_date'];
        $description = $n['description'];
        $employee_ID = $n['employee_ID'];
        $total_cost = $n['total_cost'];
    }
}
?>

<?php
// Retrieve car data from the database
$VIN_query = "SELECT VIN_number, make FROM car";
$VIN_result = mysqli_query($db, $VIN_query);
?>
<?php
// Retrieve employee data from the database
$employee_query = "SELECT employee_ID, first_name FROM employee";
$employee_result = mysqli_query($db, $employee_query);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Maintenance Page</title>
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

    <?php $results = mysqli_query($db, "SELECT * FROM maintenance"); ?>
    <div class="container mt-1 mb-4 border rounded p-4">
        <h2 class="text-center">Customers</h2>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>Maintenance ID</th>
                    <th>VIN Number</th>
                    <th>Maintenance Type</th>
                    <th>Maintenance Date</th>
                    <th>Description</th>
                    <th>Employee ID</th>
                    <th>Total Cost</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row['maintenance_ID']; ?></td>
                        <td><?php echo $row['VIN_number']; ?></td>
                        <td><?php echo $row['maintenance_type']; ?></td>
                        <td><?php echo $row['maintenance_date']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['employee_ID']; ?></td>
                        <td><?php echo $row['total_cost']; ?></td>
                        <td>
                            <a class="btn btn-primary" href="maintenance.php?edit=<?php echo $row['maintenance_ID']; ?>">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="maintenance.php?del=<?php echo $row['maintenance_ID']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form class="border rounded p-4" id="maintenanceForm" method="post" action="maintenanceDB.php">
            <input type="hidden" name="old_maintenance_id" value="<?php echo $old_maintenance_id; ?>">
            <div class="mb-3">
                <label for="maintenance_ID" class="form-label fw-bold">Maintenance ID</label>
                <input type="number" class="form-control" name="maintenance_ID" value="<?php echo $maintenance_ID; ?>" required>
            </div>
            <!-- CAR DROPDOWN -->
            <div class="mb-3">
                <label for="VIN_number" class="form-label fw-bold">VIN Number</label>
                <select class="form-select" name="VIN_number" required>
                    <option value="" disabled selected>
                        Select Vehicle
                    </option>
                    <?php
                    while ($VIN_row = mysqli_fetch_assoc($VIN_result)) {
                        $selected = ($VIN_row['VIN_number'] == $VIN_number) ? 'selected' : '';
                        echo "<option value='{$VIN_row['VIN_number']}' $selected>{$VIN_row['VIN_number']} - {$VIN_row['make']}</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- EMPLOYEE DROPDOWN -->
            <div class="mb-3">
                <label for="employee_ID" class="form-label fw-bold">Employee ID</label>
                <select class="form-select" name="employee_ID" required>
                    <option value="" disabled selected>
                        Select Employee
                    </option>
                    <?php
                    while ($employee_row = mysqli_fetch_assoc($employee_result)) {
                        $selected = ($employee_row['employee_ID'] == $VIN_number) ? 'selected' : '';
                        echo "<option value='{$employee_row['employee_ID']}' $selected>{$employee_row['employee_ID']} - {$employee_row['first_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="maintenance_type" class="form-label fw-bold">Maintenance Type</label>
                <input type="text" class="form-control" name="maintenance_type" value="<?php echo $maintenance_type; ?>" required>
            </div>
            <div class="mb-3">
                <label for="maintenance_date" class="form-label fw-bold">Maintenance Date</label>
                <input type="date" class="form-control" name="maintenance_date" value="<?php echo $maintenance_date; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <input type="text" class="form-control" name="description" value="<?php echo $description; ?>" required>
            </div>

            <div class="mb-3">
                <label for="total_cost" class="form-label fw-bold">Total Cost</label>
                <input type="number" step="any" class="form-control" name="total_cost" value="<?php echo $total_cost; ?>" required>
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