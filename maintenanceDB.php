<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'CarRental');

// initialize variables
$maintenance_ID = "";
$old_maintenance_id = "";
$VIN_number = "";
$maintenance_type = "";
$maintenance_date = "";
$description = "";
$employee_ID = "";
$total_cost = "";
$update = false;

if (isset($_POST['save'])) {
    $maintenance_ID = $_POST["maintenance_ID"];
    $VIN_number = $_POST["VIN_number"];
    $maintenance_type = $_POST["maintenance_type"];
    $maintenance_date = $_POST["maintenance_date"];
    $description = $_POST["description"];
    $employee_ID = $_POST["employee_ID"];
    $total_cost = $_POST["total_cost"];

    mysqli_query($db, "INSERT INTO maintenance (maintenance_ID, VIN_number, maintenance_type, maintenance_date, description, employee_ID, total_cost) VALUES ('$maintenance_ID', '$VIN_number','$maintenance_type', '$maintenance_date','$description', '$employee_ID','$total_cost')");
    $_SESSION['message'] = "Record saved";
    header('location: maintenance.php');
}
if (isset($_POST['update'])) {
    $maintenance_ID = $_POST["maintenance_ID"];
    $old_maintenance_id = $_POST["old_maintenance_id"];
    $VIN_number = $_POST["VIN_number"];
    $maintenance_type = $_POST["maintenance_type"];
    $maintenance_date = $_POST["maintenance_date"];
    $description = $_POST["description"];
    $employee_ID = $_POST["employee_ID"];
    $total_cost = $_POST["total_cost"];

    mysqli_query($db, "UPDATE maintenance SET maintenance_ID='$maintenance_ID', VIN_number='$VIN_number', maintenance_type='$maintenance_type', maintenance_date='$maintenance_date', description='$description', employee_ID='$employee_ID', total_cost='$total_cost' WHERE maintenance_ID='$old_maintenance_id'");
    $_SESSION['message'] = "Record updated!";
    header('location: maintenance.php');
}

if (isset($_GET['del'])) {
    $maintenance_ID = $_GET['del'];
    mysqli_query($db, "DELETE FROM maintenance WHERE maintenance_ID='$maintenance_ID'");
    $_SESSION['message'] = "Record deleted!";
    header('location: maintenance.php');
}
