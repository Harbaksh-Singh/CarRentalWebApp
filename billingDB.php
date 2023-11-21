<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'CarRental');

// initialize variables
$billing_ID = "";
$oldbilling_ID = "";
$booking_ID = "";
$bill_date = "";
$status = "";
$discount_amount = "";
$late_fees = "";
$taxed_amount = "";
$bill_amount = "";
$update = false;

if (isset($_POST['save'])) {
    $booking_ID = $_POST["booking_ID"];
    $customer_id = $_POST["customer_id"];
    $VIN_number = $_POST["VIN_number"];
    $insurance_ID = $_POST["insurance_ID"];
    $pick_up_day = $_POST["pick_up_day"];
    $number_of_days = $_POST["number_of_days"];
    $total_amount = $_POST["total_amount"];

    mysqli_query($db, "INSERT INTO booking (booking_ID, customer_id, VIN_number, insurance_ID, pick_up_day, number_of_days, total_amount) VALUES ('$booking_ID', '$customer_id','$VIN_number', '$insurance_ID','$pick_up_day', '$number_of_days','$total_amount')");
    $_SESSION['message'] = "number_of_days saved";
    header('location: booking.php');
}
if (isset($_POST['update'])) {

    $oldbooking_ID = $_POST["oldbooking_ID"];
    $booking_ID = $_POST["booking_ID"];
    $customer_id = $_POST["customer_id"];
    $VIN_number = $_POST["VIN_number"];
    $insurance_ID = $_POST["insurance_ID"];
    $pick_up_day = $_POST["pick_up_day"];
    $number_of_days = $_POST["number_of_days"];
    $total_amount = $_POST["total_amount"];

    mysqli_query($db, "UPDATE booking SET booking_ID='$booking_ID', customer_id='$customer_id',VIN_number='$VIN_number',insurance_ID='$insurance_ID',pick_up_day='$pick_up_day',number_of_days='$number_of_days',total_amount='$total_amount' WHERE booking_ID='$oldbooking_ID'");
    $_SESSION['message'] = "number_of_days updated!";
    header('location: booking.php');
}
if (isset($_GET['del'])) {
    $booking_ID = $_GET['del'];
    mysqli_query($db, "DELETE FROM booking WHERE booking_ID='$booking_ID'");
    $_SESSION['message'] = "number_of_days deleted!";
    header('location: booking.php');
}
