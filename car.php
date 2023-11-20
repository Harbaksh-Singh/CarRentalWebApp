<?php include('carDB.php'); ?>
<?php
if (isset($_GET['edit'])) {
    $VIN_number = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM car WHERE VIN_number='$VIN_number'");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);

        $VIN_number = $n['VIN_number'];
        $oldVin = $VIN_number;
        $make = $n['make'];
        $model = $n['model'];
        $year = $n['year'];
        $colour = $n['colour'];
        $number_of_seats = $n['number_of_seats'];
        $cost_per_day = $n['cost_per_day'];
        $currently_available = $n['currently_available'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Car Page</title>
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

    <?php $results = mysqli_query($db, "SELECT * FROM car"); ?>
    <div class="container mt-1 mb-4 border rounded p-4">
        <h2 class="text-center">Cars</h2>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>VIN Nnumber</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Number of Seats</th>
                    <th>Colour</th>
                    <th>Cost Per Day</th>
                    <th>Currently Available</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row['VIN_number']; ?></td>
                        <td><?php echo $row['make']; ?></td>
                        <td><?php echo $row['model']; ?></td>
                        <td><?php echo $row['year']; ?></td>
                        <td><?php echo $row['colour']; ?></td>
                        <td><?php echo $row['number_of_seats']; ?></td>
                        <td><?php echo $row['cost_per_day']; ?></td>
                        <td><?php echo $row['currently_available']; ?></td>
                        <td>
                            <a class="btn btn-primary" href="car.php?edit=<?php echo $row['VIN_number']; ?>">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="car.php?del=<?php echo $row['VIN_number']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form class="border rounded p-4" id="CarForm" method="post" action="carDB.php">
            <input type="hidden" name="oldVin" value="<?php echo $oldVin; ?>">
            <div class="mb-3">
                <label for="VIN_number" class="form-label fw-bold">VIN Number</label>
                <input type="text" class="form-control" name="VIN_number" value="<?php echo $VIN_number; ?>" pattern="[A-Za-z0-9]{1,10}" title="Alphanumeric, maximum 10 characters">
            </div>
            <div class="mb-3">
                <label for="make" class="form-label fw-bold">Make</label>
                <input type="text" class="form-control" name="make" value="<?php echo $make; ?>" required>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label fw-bold">Model</label>
                <input type="text" class="form-control" name="model" value="<?php echo $model; ?>" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label fw-bold">Year</label>
                <input type="number" class="form-control" name="year" value="<?php echo $year; ?>" min="1900" max="2099" required>
            </div>
            <div class="mb-3">
                <label for="colour" class="form-label fw-bold">Colour</label>
                <input type="text" class="form-control" name="colour" value="<?php echo $colour; ?>" required>
            </div>
            <div class="mb-3">
                <label for="number_of_seats" class="form-label fw-bold">Number of Seats</label>
                <input type="number" class="form-control" name="number_of_seats" value="<?php echo $number_of_seats; ?>" min="1" required>
            </div>
            <div class="mb-3">
                <label for="cost_per_day" class="form-label fw-bold">Cost Per Day</label>
                <input type="number" class="form-control" name="cost_per_day" value="<?php echo $cost_per_day; ?>" step="0.01" min="0" required>
            </div>
            <div class="mb-3">
                <label for="currently_available" class="form-label fw-bold">Available</label>
                <select class="form-select" name="currently_available" required>
                    <option value="Y" <?php echo ($currently_available == 'Y') ? 'selected' : ''; ?>>Yes</option>
                    <option value="N" <?php echo ($currently_available == 'N') ? 'selected' : ''; ?>>No</option>
                </select>
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