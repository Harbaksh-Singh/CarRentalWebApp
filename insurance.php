<?php include('insuranceDB.php'); ?>
<?php
if (isset($_GET['edit'])) {
    $insurance_id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM insurance WHERE insurance_id='$insurance_id'");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);

        $insurance_id = $n['insurance_id'];
        $oldinsurance_id = $insurance_id;
        $coverage_type = $n['coverage_type'];
        $cost_per_day = $n['cost_per_day'];
        $insurance_provider = $n['insurance_provider'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>insurance Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="teststyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
			body {
				background-color: #f8f9fa;
			}

			header a {
				color: #ffffff;
				text-decoration: none;
			}

			header a:hover {
				color: #f8f9fa;
			}

			.container {
				margin-top: 30px;
			}

			h1 {
				color: #343a40;
			}

			table {
				background-color: #ffffff;
			}

			table th,
			table td {
				text-align: center;
			}

			.smaller-image {
				max-width: 20%;
				height: auto;
			}
		</style>
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
                            <a class="nav-link" href="insurance.php">insurance</a>
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

    <div class="container" >
			<h1 class="mt-5">Explore Our Insurance Coverage Types</h1>
			<p class="lead">
				Choose the perfect coverage for your journey with CityZoom Rentals.
			</p>

			<div class="row mt-4">
    <div class="col-lg-6 mx-auto text-center">
        <img
            src="https://cdn-icons-png.flaticon.com/512/2237/2237750.png"
            alt="Insurance Coverage Image"
            class="img-fluid smaller-image"
        />
        <h3 class="mt-3">Comprehensive Coverage</h3>
        <p>
            Get peace of mind with our comprehensive coverage that includes a wide range of protections.
        </p>
    </div>

    <div class="col-lg-6 mx-auto text-center">
        <img
            src="https://cdn-icons-png.flaticon.com/512/20/20111.png"
            alt="Insurance Coverage Image 2"
            class="img-fluid smaller-image"
        />
        <h3 class="mt-3">Prepare For The Unexpected</h3>
        <p>
            Minimize your liability for damage to the rental car in case of an accident. Opt in for insurance to ensure that you are protected from unexpected charges.
        </p>
    </div>
</div>


    <div class="container mt-3 d-flex justify-content-center">
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif ?>
    </div>

    <?php $results = mysqli_query($db, "SELECT * FROM insurance"); ?>
    <div class="container mt-1 mb-4 border rounded p-4">
        <h2 class="text-center">Insurance</h2>
        <br>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>Insurance ID</th>
                    <th>Coverage Type</th>
                    <th>Cost Per Day ($)</th>
                    <th>Insurance Provider</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row['insurance_id']; ?></td>
                        <td><?php echo $row['coverage_type']; ?></td>
                        <td><?php echo $row['cost_per_day']; ?></td>
                        <td><?php echo $row['insurance_provider']; ?></td>
                        <td>
                            <a class="btn btn-primary" href="insurance.php?edit=<?php echo $row['insurance_id']; ?>">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="insurance.php?del=<?php echo $row['insurance_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form class="border rounded p-4" id="insuranceForm" method="post" action="insuranceDB.php">
            <input type="hidden" name="oldinsurance_id" value="<?php echo $oldinsurance_id; ?>">
            <div class="mb-3">
            <label for="insurance_id" class="form-label fw-bold">Insurance ID</label>
            <input type="text" class="form-control" name="insurance_id" value="<?php echo $insurance_id; ?>" required pattern="[0-9]+" title="Numeric characters only">
            </div>
            <div class="mb-3">
                <label for="coverage_type" class="form-label fw-bold">Coverage Type</label>
                <input type="text" class="form-control" name="coverage_type" value="<?php echo $coverage_type; ?>" required pattern="[A-Za-z ]+" title="Alphabetic characters only">
            </div>
            <div class="mb-3">
                <label for="cost_per_day" class="form-label fw-bold">Cost Per Day</label>
                <input type="text" class="form-control" name="cost_per_day" value="<?php echo $cost_per_day; ?>" required pattern="[0-9]+" title="Numeric characters only">
            </div>
            <div class="mb-3">
                <label for="insurance_provider" class="form-label fw-bold">Insurance Provider</label>
                <input type="text" class="form-control" name="insurance_provider" value="<?php echo $insurance_provider; ?>" required pattern="[A-Za-z ]+" title="Alphabetic characters only">
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