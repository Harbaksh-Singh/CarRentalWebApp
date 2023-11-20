<?php include('bookingDB.php'); ?>
<?php
if (isset($_GET['edit'])) {
    $customer_id = $_GET['edit'];
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
$customer_query = "SELECT customer_id, first_name FROM customer";
$customer_result = mysqli_query($db, $customer_query);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bookings Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="teststyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
                            <a class="nav-link" href="customer.php">Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="car.php">Car</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="employee.php">Employee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="billing.html">Billing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="insurance.">Insurance</a>
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

    <?php $results = mysqli_query($db, "SELECT * FROM booking"); ?>
    <div class="container mt-1 mb-4 border rounded p-4">
        <h2 class="text-center">Bookings</h2>
        <table class="table table-striped ">
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
        <form class="border rounded p-4" id="bookingForm" method="post" action="bookingDB.php">
            <input type="hidden" name="booking_ID" value="<?php echo $booking_ID; ?>">
            <div class="mb-3">
                <label for="booking_ID" class="form-label fw-bold">Booking ID</label>
                <input type="text" class="form-control" name="booking_ID" value="<?php echo $booking_ID; ?>" required pattern="[A-Za-z0-9]+" title="Alphanumeric characters only">
            </div>
            <div class="mb-3">
            <label for="customer_id" class="form-label fw-bold">Customer ID</label>
            <select class="form-select" name="customer_id" required>
                <?php
                while ($customer_row = mysqli_fetch_assoc($customer_result)) {
                    $selected = ($customer_row['customer_id'] == $customer_id) ? 'selected' : '';
                    echo "<option value='{$customer_row['customer_id']}' $selected>{$customer_row['first_name']}</option>";
                }
                ?>
            </select>
            </div>

            <div class="mb-3">
                <label for="VIN_number" class="form-label fw-bold">VIN Number</label>
                <input type="text" class="form-control" name="VIN_number" value="<?php echo $VIN_number; ?>" required pattern="[A-Za-z0-9]+" title="Alphanumeric characters">
            </div>
            <div class="mb-3">
                <label for="insurance_ID" class="form-label fw-bold">Insurance ID</label>
                <input type="text" class="form-control" name="insurance_ID" value="<?php echo $insurance_ID; ?>" required pattern="[A-Za-z0-9]+">
            </div>
            <div class="mb-3">
                <label for="pick_up_day" class="form-label fw-bold">Pick Up Day</label>
                <input type="date" class="form-control" name="pick_up_day" value="<?php echo $pick_up_day; ?>" required pattern="[0-9]+" title="Numeric characters only">
            </div>
            <div class="mb-3">
                <label for="number_of_days" class="form-label fw-bold">Number Of Days</label>
                <input type="text" class="form-control" name="number_of_days" value="<?php echo $number_of_days; ?>" required>
            </div>
            <div class="mb-3">
                <label for="total_amount" class="form-label fw-bold">Total Amount</label>
                <input type="text" class="form-control" name="total_amount" value="<?php echo $total_amount; ?>" required>
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