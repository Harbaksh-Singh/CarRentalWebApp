<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'CarRental');

// initialize variables
$employee_ID = "";
$old_Employee_ID = "";
$first_name = "";
$last_name = "";
$email = "";
$phone_number = "";
$position = "";
$update = false;

if (isset($_POST['save'])) {
    $employee_ID = $_POST["employee_ID"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $position = $_POST["position"];

    mysqli_query($db, "INSERT INTO employee (employee_ID, first_name, last_name, email, phone_number, position) VALUES ('$employee_ID', '$first_name','$last_name', '$email','$phone_number', '$position')");
    $_SESSION['message'] = "Employee Added!";
    header('location: employee.php');
}
if (isset($_POST['update'])) {

    $old_Employee_ID = $_POST["old_Employee_ID"];
    $employee_ID = $_POST["employee_ID"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $position = $_POST["position"];

    mysqli_query($db, "UPDATE employee SET employee_ID='$employee_ID', first_name='$first_name',last_name='$last_name',email='$email',phone_number='$phone_number',position='$position' WHERE employee_ID='$old_Employee_ID'");
    $_SESSION['message'] = "Employee Updated!";
    header('location: employee.php');
}
if (isset($_GET['del'])) {
    $employee_ID = $_GET['del'];
    mysqli_query($db, "DELETE FROM employee WHERE employee_ID='$employee_ID'");
    $_SESSION['message'] = "Employee Removed!";
    header('location: employee.php');
}
