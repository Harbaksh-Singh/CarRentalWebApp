<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'CarRental');

// initialize variables
$customer_id = "";
$oldcustomer_id = "";
$first_name = "";
$last_name = "";
$email = "";
$phone_number = "";
$address = "";
$date_of_birth = "";
$update = false;

if (isset($_POST['save'])) {
    $customer_id = $_POST["customer_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];
    $date_of_birth = $_POST["date_of_birth"];

    mysqli_query($db, "INSERT INTO customer (customer_id, first_name, last_name, email, phone_number, address, date_of_birth) VALUES ('$customer_id', '$first_name','$last_name', '$email','$phone_number', '$address','$date_of_birth')");
    $_SESSION['message'] = "Address saved";
    header('location: customer.php');
}
if (isset($_POST['update'])) {
    $oldcustomer_id = $_POST["oldcustomer_id"];
    $customer_id = $_POST["customer_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];
    $date_of_birth = $_POST["date_of_birth"];

    mysqli_query($db, "UPDATE customer SET customer_id='$customer_id', first_name='$first_name', last_name='$last_name', email='$email', phone_number='$phone_number', address='$address', date_of_birth='$date_of_birth' WHERE customer_id='$oldcustomer_id'");
    $_SESSION['message'] = "Address updated!";
    header('location: customer.php');
}

if (isset($_GET['del'])) {
    $customer_id = $_GET['del'];
    mysqli_query($db, "DELETE FROM customer WHERE customer_id='$customer_id'");
    $_SESSION['message'] = "Address deleted!";
    header('location: customer.php');
}
