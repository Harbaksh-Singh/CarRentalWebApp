<?php include('billingDB.php'); ?>
<?php
if (isset($_GET['edit'])) {
    $billing_ID = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM billing WHERE billing_ID='$billing_ID'");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);

        $billing_ID = $n['billing_ID'];
        $oldbilling_ID = $billing_ID;
        $bill_date = $n['bill_date'];
        $status = $n['status'];
        $discount_amount = $n['discount_amount'];
        $late_fees = $n['late_fees'];
        $taxed_amount = $n['taxed_amount'];
    }
}
?>

<?php
// Retrieve customer data from the database
$booking_query = "SELECT booking_ID, total_amount FROM booking";
$booking_result = mysqli_query($db, $booking_query);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Billing Page</title>
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

    <?php $results = mysqli_query($db, "SELECT * FROM billing"); ?>
    <div class="container mt-1 mb-4 border rounded p-4">
        <h2 class="text-center">Billings</h2>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>Billing ID</th>
                    <th>Booking ID</th>
                    <th>Bill Date</th>
                    <th>Insurance ID</th>
                    <th>Status</th>
                    <th>Discount Amount</th>
                    <th>Late Fees</th>
                    <th>Taxed Amount</th>
                    <th>Bill Amount</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row['billing_ID']; ?></td>
                        <td><?php echo $row['booking_ID']; ?></td>
                        <td><?php echo $row['bill_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['insurance_ID']; ?></td>
                        <td><?php echo $row['pick_up_day']; ?></td>
                        <td><?php echo $row['number_of_days']; ?></td>
                        <td><?php echo $row['total_amount']; ?></td>
                        <td>
                            <a class="btn btn-primary" href="billing.php?edit=<?php echo $row['billing_ID']; ?>">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="billing.php?del=<?php echo $row['billing_ID']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- FORM -->
        <form class="border rounded p-4" id="billingForm" method="post" action="billingDB.php">
            <input type="hidden" name="booking_ID" value="<?php echo $booking_ID; ?>">
            <div class="mb-3">
                <label for="billing_ID" class="form-label fw-bold">Billing ID</label>
                <input type="text" class="form-control" name="billing_ID" value="<?php echo $booking_ID; ?>" required pattern="[A-Za-z0-9]+" title="Alphanumeric characters only">
            </div>
            <!-- BOOKING DROPDOWN -->
            <div class="mb-3">
                <label for="booking_ID" class="form-label fw-bold">Booking ID</label>
                <select class="form-select" name="booking_ID" required>
                    <option value="" disabled selected>
                        Select Booking
                    </option>
                    <?php
                    while ($booking_row = mysqli_fetch_assoc($booking_result)) {
                        $selected = ($booking_row['booking_ID'] == $booking_ID) ? 'selected' : '';
                        echo "<option value='{$booking_row['booking_ID']}' $selected>{$booking_row['booking_ID']} - {$booking_row['total_amount']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="bill_date" class="form-label fw-bold">Bill Date</label>
                <input type="date" class="form-control" name="bill_date" value="<?php echo $bill_date; ?>" required pattern="[0-9]+" title="Numeric characters only">
            </div>
            <div class="mb-3">
                <label for="pick_up_day" class="form-label fw-bold">Pick Up Day</label>
                <input type="date" class="form-control" name="pick_up_day" value="<?php echo $pick_up_day; ?>" required pattern="[0-9]+" title="Numeric characters only">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label fw-bold">Status</label>
                <select class="form-select" name="status" required>
                    <option value="BILLED" <?php echo ($status == 'BILLED') ? 'selected' : ''; ?>>BILLED</option>
                    <option value="NOT BILLED" <?php echo ($status == 'NOT BILLED') ? 'selected' : ''; ?>>NOT BILLED</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="discount_amount" class="form-label fw-bold">Discount Amount</label>
                <input type="number" class="form-control" name="discount_amount" value="<?php echo $discount_amount; ?>" required>
            </div>
            <div class="mb-3">
                <label for="late_fees" class="form-label fw-bold">Late Fees</label>
                <input type="number" class="form-control" name="late_fees" value="<?php echo $late_fees; ?>" required>
            </div>
            <div class="mb-3">
                <label for="taxed_amount" class="form-label fw-bold">Taxed Amount</label>
                <input type="number" class="form-control" name="taxed_amount" value="<?php echo $taxed_amount; ?>" required>
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