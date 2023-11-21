<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" type="text/css">
    <style>
        body {
            padding-bottom: 100px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Custom font */
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
            /* Adjusted font size */
        }

        .about-container,
        .contact-container,
        .image-grid {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            text-align: center;
        }

        h1,
        h2,
        h3 {
            font-weight: bold;
            color: #343a40;
        }

        p {
            color: #6c757d;
        }

        .carousel {
            margin-top: -56px;
        }

        .grid-img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
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

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://www.hdcarwallpapers.com/walls/range_rover_autobiography_2022_5k-HD.jpg" class="d-block w-100" alt="Car 1" />
            </div>
            <div class="carousel-item">
                <img src="https://images7.alphacoders.com/110/1109489.jpg" class="d-block w-100" alt="Car 2" />
            </div>
            <div class="carousel-item">
                <img src="https://www.hdcarwallpapers.com/walls/porsche_911_sport_classic_2022_4k-HD.jpg" class="d-block w-100" alt="Car 3" />
            </div>
            <div class="carousel-item">
                <img src="https://wallpapers.com/images/hd/bmw-m5-4k-0hqwywtf6okdfagy.jpg" class="d-block w-100" alt="Car 4" />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container mt-4">
        <h1 class="text-center">Welcome to Our Car Rental Service</h1>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="about-container">
                    <h2>About Us</h2>
                    <p>
                        Welcome to CityZoom Rentals, where we bring speed and style to
                        your urban adventures. Explore Toronto with our diverse fleet of
                        well-maintained vehicles, designed to make every journey
                        memorable. Experience the city on your terms with CityZoom
                        Rentals, where convenience meets quality.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-container">
                    <h2>Contact Information</h2>
                    <p>Email: info@example.com</p>
                    <p>Phone: +1 123 456 7890</p>
                    <p>Address: 43 Car Rental Rd, Ontario, L3A 8H4 <br><br></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Grid Section -->
    <div class="container image-grid">
        <h2 class="text-center">Explore Our Fleet</h2>
        <div class="row">
            <div class="col-md-4">
                <img src="https://platform.cstatic-images.com/xlarge/in/v2/stock_photos/ed92ac67-8b56-4852-8838-a8dabf471b44/abe3c646-b187-49a4-bcfb-9e082e46757f.png" class="grid-img" alt="Car 1">
            </div>
            <div class="col-md-4">
                <img src="https://platform.cstatic-images.com/xlarge/in/v2/stock_photos/3b3bc49f-2ebe-48f8-914c-e2035a287c6b/e6b794c0-4d89-4f3a-80fc-03779f6a50cb.png" class="grid-img" alt="Car 2">
            </div>
            <div class="col-md-4 mt-5">
                <img src="https://dynamictint.com/wp-content/uploads/2022/09/2022-BMW-M3-white-full_color-driver_side_front_quarter.png" class="grid-img" alt="Car 3">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Footer Section -->
    <div class="footer">
        &copy; 2023 CityZoom Rentals. All rights reserved.
    </div>
</body>

</html>