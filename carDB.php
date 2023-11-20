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

    mysqli_query($db, "UPDATE car SET VIN_number='$VIN_number', make='$make', model='$model',year='$year',colour='$colour',number_of_seats='$number_of_seats',cost_per_day='$cost_per_day', currently_available='$currently_available' WHERE VIN_number=$oldVin");
    $_SESSION['message'] = "Car updated!";
    header('location: car.php');
}
if (isset($_GET['del'])) {
    $VIN_number = $_GET['del'];
    mysqli_query($db, "DELETE FROM car WHERE VIN_number=$VIN_number");
    $_SESSION['message'] = "Car deleted!";
    header('location: car.php');
}
