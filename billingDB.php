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
$update = false;

if (isset($_POST['save'])) {
    $billing_ID = $_POST["billing_ID"];
    $booking_ID = $_POST["booking_ID"];
    $bill_date = $_POST["bill_date"];
    $status = $_POST["status"];
    $discount_amount = $_POST["discount_amount"];
    $late_fees = $_POST["late_fees"];
    $taxed_amount = $_POST["taxed_amount"];

    mysqli_query($db, "INSERT INTO billing (billing_ID, booking_ID, bill_date, status, discount_amount, late_fees, taxed_amount) VALUES ('$billing_ID', '$booking_ID', '$bill_date','$status', '$discount_amount', '$late_fees','$taxed_amount')");
    $_SESSION['message'] = "Bill Saved";
    header('location: billing.php');
}
if (isset($_POST['update'])) {
    $billing_ID = $_POST["billing_ID"];
    $oldbilling_ID = $_POST["oldbilling_ID"];
    $booking_ID = $_POST["booking_ID"];
    $bill_date = $_POST["bill_date"];
    $status = $_POST["status"];
    $discount_amount = $_POST["discount_amount"];
    $late_fees = $_POST["late_fees"];
    $taxed_amount = $_POST["taxed_amount"];

    mysqli_query($db, "UPDATE billing SET billing_ID='$billing_ID', booking_ID='$booking_ID', bill_date='$bill_date',status='$status',discount_amount='$discount_amount',late_fees='$late_fees',taxed_amount='$taxed_amount'  WHERE billing_ID='$oldbilling_ID'");
    $_SESSION['message'] = "Bill Updated!";
    header('location: billing.php');
}
if (isset($_GET['del'])) {
    $billing_ID = $_GET['del'];
    mysqli_query($db, "DELETE FROM billing WHERE billing_ID='$billing_ID'");
    $_SESSION['message'] = "Bill Deleted!";
    header('location: billing.php');
}
