<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'CarRental');

// initialize variables
$VIN_number = "";
$oldVin = "";
$make = "";
$model = "";
$year = "";
$colour = "";
$number_of_seats = "";
$cost_per_day = "";
$currently_available = "";
$update = false;


if (isset($_POST['save'])) {
    $VIN_number = $_POST["VIN_number"];
    $make = $_POST["make"];
    $model = $_POST["model"];
    $year = $_POST["year"];
    $colour = $_POST["colour"];
    $number_of_seats = $_POST["number_of_seats"];
    $cost_per_day = $_POST["cost_per_day"];
    $currently_available = $_POST["currently_available"];

    mysqli_query($db, "INSERT INTO car (VIN_number, make, model, year, colour, number_of_seats, cost_per_day, currently_available) VALUES ('$VIN_number', '$make','$model', '$year','$colour', '$number_of_seats','$cost_per_day', '$currently_available')");
    $_SESSION['message'] = "Car saved";
    header('location: car.php');
}
if (isset($_POST['update'])) {
    $oldVin = $_POST["oldVin"];
    $VIN_number = $_POST["VIN_number"];
    $make = $_POST["make"];
    $model = $_POST["model"];
    $year = $_POST["year"];
    $colour = $_POST["colour"];
    $number_of_seats = $_POST["number_of_seats"];
    $cost_per_day = $_POST["cost_per_day"];
    $currently_available = $_POST["currently_available"];

    mysqli_query($db, "UPDATE car SET VIN_number='$VIN_number', make='$make', model='$model',year='$year',colour='$colour',number_of_seats='$number_of_seats',cost_per_day='$cost_per_day', currently_available='$currently_available' WHERE VIN_number='$oldVin'");
    $_SESSION['message'] = "Car updated!";
    header('location: car.php');
}
if (isset($_GET['del'])) {
    $VIN_number = $_GET['del'];

    // Attempt to delete records from child tables (e.g., "booking" and "maintenance") that reference the car
    $delete_booking_query = "DELETE FROM booking WHERE VIN_number='$VIN_number'";
    $delete_billing_query = "DELETE FROM billing WHERE booking_ID IN (SELECT booking_ID FROM booking WHERE VIN_number='$VIN_number')";
    $delete_maintenance_query = "DELETE FROM maintenance WHERE VIN_number='$VIN_number'";

    if (mysqli_query($db, $delete_billing_query) && mysqli_query($db, $delete_booking_query) && mysqli_query($db, $delete_maintenance_query)) {
        // Child records deleted successfully

        // Now, delete the car record
        $delete_car_query = "DELETE FROM car WHERE VIN_number='$VIN_number'";
        if (mysqli_query($db, $delete_car_query)) {
            // Car record deleted successfully
            $_SESSION['message'] = "Car Deleted!";
        } else {
            $_SESSION['error_message'] = "Error deleting the car record.";
        }
    } else {
        $_SESSION['error_message'] = "Error deleting related records (e.g., bookings and maintenance).";
    }

    header('location: car.php');
}
