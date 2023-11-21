<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'CarRental');

// initialize variables
$insurance_id = "";
$oldinsurance_id = "";
$coverage_type = "";
$cost_per_day = "";
$insurance_provider = "";
$update = false;

if (isset($_POST['save'])) {
    $insurance_id = $_POST["insurance_id"];
    $coverage_type = $_POST["coverage_type"];
    $cost_per_day = $_POST["cost_per_day"];
    $insurance_provider = $_POST["insurance_provider"];

    mysqli_query($db, "INSERT INTO insurance (insurance_id, coverage_type, cost_per_day, insurance_provider) VALUES ('$insurance_id', '$coverage_type','$cost_per_day', '$insurance_provider')");
    $_SESSION['message'] = "Address saved";
    header('location: insurance.php');
}
if (isset($_POST['update'])) {
    $oldinsurance_id = $_POST["oldinsurance_id"];
    $insurance_id = $_POST["insurance_id"];
    $coverage_type = $_POST["coverage_type"];
    $cost_per_day = $_POST["cost_per_day"];
    $insurance_provider = $_POST["insurance_provider"];

    mysqli_query($db, "UPDATE insurance SET insurance_id='$insurance_id', coverage_type='$coverage_type', cost_per_day='$cost_per_day', insurance_provider='$insurance_provider' WHERE insurance_id='$oldinsurance_id'");
    $_SESSION['message'] = "Address updated!";
    header('location: insurance.php');
}

if (isset($_GET['del'])) {
    $insurance_id = $_GET['del'];
    mysqli_query($db, "DELETE FROM insurance WHERE insurance_id='$insurance_id'");
    $_SESSION['message'] = "Address deleted!";
    header('location: insurance.php');
}
