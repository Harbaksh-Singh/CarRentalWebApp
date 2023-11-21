<?php include('bookingDB.php'); ?>
<?php
if (isset($_GET['edit'])) {
    $booking_ID = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM booking WHERE booking_ID='$booking_ID'");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);

        $booking_ID = $n['booking_ID'];
        $oldbooking_ID = $booking_ID;
        $customer_id = $n['customer_id'];
        $VIN_number = $n['VIN_number'];
        $insurance_ID = $n['insurance_ID'];
        $pick_up_day = $n['pick_up_day'];
        $number_of_days = $n['number_of_days'];
        $total_amount = $n['total_amount'];
    }
}
?>

<?php
// Retrieve customer data from the database
$customer_query = "SELECT * FROM customer";
$customer_result = mysqli_query($db, $customer_query);
?>
<?php
// Retrieve car data from the database
$VIN_query = "SELECT * FROM car WHERE currently_available='Y'";
$VIN_result = mysqli_query($db, $VIN_query);
?>
<?php
// Retrieve insurance data from the database
$insurance_query = "SELECT * FROM insurance";
$insurance_result = mysqli_query($db, $insurance_query);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
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

    <?php $results = mysqli_query($db, "SELECT * FROM booking"); ?>
    <div class="container mt-1 mb-4 border rounded p-4">
        <h2 class="text-center">Bookings</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Customer ID</th>
                    <th>VIN Number</th>
                    <th>Insurance ID</th>
                    <th>Pick Up Day</th>
                    <th>Number Of Days</th>
                    <th>Total Amount</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row['booking_ID']; ?></td>
                        <td><?php echo $row['customer_id']; ?></td>
                        <td><?php echo $row['VIN_number']; ?></td>
                        <td><?php echo $row['insurance_ID']; ?></td>
                        <td><?php echo $row['pick_up_day']; ?></td>
                        <td><?php echo $row['number_of_days']; ?></td>
                        <td><?php echo $row['total_amount']; ?></td>
                        <td>
                            <a class="btn btn-primary" href="booking.php?edit=<?php echo $row['booking_ID']; ?>">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="booking.php?del=<?php echo $row['booking_ID']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- FORM -->
        <form class="border rounded p-4" id="bookingForm" method="post" action="bookingDB.php">
            <input type="hidden" name="oldbooking_ID" value="<?php echo $oldbooking_ID; ?>">
            <div class="mb-3">
                <label for="booking_ID" class="form-label fw-bold">Booking ID</label>
                <input type="text" class="form-control" name="booking_ID" value="<?php echo $booking_ID; ?>" required pattern="[A-Za-z0-9]+" title="Alphanumeric characters only">
            </div>
            <!-- CUSTOMER DROPDOWN -->
            <div class="mb-3">
                <label for="customer_id" class="form-label fw-bold">Customer ID</label>
                <select class="form-select" name="customer_id" required>
                    <option value="" disabled selected>
                        Select Customer
                    </option>
                    <?php
                    while ($customer_row = mysqli_fetch_assoc($customer_result)) {
                        $selected = ($customer_row['customer_id'] == $customer_id) ? 'selected' : '';
                        echo "<option value='{$customer_row['customer_id']}' $selected>{$customer_row['customer_id']} - {$customer_row['first_name']} {$customer_row['last_name']}</option>";
                    }
                    ?>
                </select>
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
                        echo "<option value='{$VIN_row['VIN_number']}' $selected>{$VIN_row['VIN_number']} - {$VIN_row['make']} - {$VIN_row['model']} - {$VIN_row['year']} - {$VIN_row['cost_per_day']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- INSURANCE DROPDOWN -->
            <div class="mb-3">
                <label for="insurance_ID" class="form-label fw-bold">Insurance ID</label>
                <select class="form-select" name="insurance_ID" required>
                    <option value="" disabled selected>
                        Select Insurance
                    </option>
                    <?php
                    while ($insurance_row = mysqli_fetch_assoc($insurance_result)) {
                        $selected = ($insurance_row['insurance_id'] == $insurance_ID) ? 'selected' : '';
                        echo "<option value='{$insurance_row['insurance_id']}' $selected>{$insurance_row['insurance_id']} - {$insurance_row['insurance_provider']} - {$insurance_row['coverage_type']} - {$insurance_row['cost_per_day']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="pick_up_day" class="form-label fw-bold">Pick Up Day</label>
                <input type="date" class="form-control" name="pick_up_day" value="<?php echo $pick_up_day; ?>" required pattern="[0-9]+" title="Numeric characters only">
            </div>
            <div class="mb-3">
                <label for="number_of_days" class="form-label fw-bold">Number Of Days</label>
                <input type="number" class="form-control" name="number_of_days" value="<?php echo $number_of_days; ?>" required>
            </div>
            <div class="mb-3">
                <label for="total_amount" class="form-label fw-bold">Total Amount</label>
                <span class="form-control"><?php echo $total_amount; ?></span>
            </div>

            <div class="mb-3">
                <?php if ($update == true) : ?>
                    <button class="btn btn-primary" type="submit" name="update">Update</button>
                <?php else : ?>
                    <button class="btn btn-primary" type="submit" name="save">Save</button>
                <?php endif ?>
            </div>
        </form>

    </div>

</body>

</html>