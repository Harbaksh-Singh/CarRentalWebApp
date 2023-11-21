<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'CarRental');

// initialize variables
$billing_ID = "";
$oldbilling_ID = "";
$booking_ID = "";
$bill_date = "";
$status = "";
$discount_amount = 0;
$late_fees = 0;
$taxed_amount = 0;
$total_amount = 0;
$update = false;

if (isset($_POST['save'])) {
    $billing_ID = $_POST["billing_ID"];
    $booking_ID = $_POST["booking_ID"];
    $bill_date = $_POST["bill_date"];
    $status = $_POST["status"];
    $discount_amount = $_POST["discount_amount"];
    $late_fees = $_POST["late_fees"];
    $taxed_amount = $_POST["taxed_amount"];
    $total_amount = $_POST["total_amount"];

    $cost_query = "SELECT * FROM booking WHERE booking_ID = '$booking_ID'";
    $cost_result = mysqli_query($db, $cost_query);
    $cost_row = mysqli_fetch_assoc($cost_result);
    $booking_total_cost = (float)$cost_row['total_amount'];

    $total_amount = $late_fees + $taxed_amount + $booking_total_cost - $discount_amount;

    mysqli_query($db, "INSERT INTO billing (billing_ID, booking_ID, bill_date, status, discount_amount, late_fees, taxed_amount, total_amount) VALUES ('$billing_ID', '$booking_ID', '$bill_date','$status', '$discount_amount', '$late_fees','$taxed_amount', '$total_amount')");
    $_SESSION['message'] = "Bill Saved";
    header('location: billing.php');
}
if (isset($_POST['update'])) {

    $oldbilling_ID = $_POST["oldbilling_ID"];
    $billing_ID = $_POST["billing_ID"];
    $booking_ID = $_POST["booking_ID"];
    $bill_date = $_POST["bill_date"];
    $status = $_POST["status"];
    $discount_amount = $_POST["discount_amount"];
    $late_fees = $_POST["late_fees"];
    $taxed_amount = $_POST["taxed_amount"];
    $total_amount = $_POST["total_amount"];

    $cost_query = "SELECT * FROM booking WHERE booking_ID = '$booking_ID'";
    $cost_result = mysqli_query($db, $cost_query);
    $cost_row = mysqli_fetch_assoc($cost_result);
    $booking_total_cost = (float)$cost_row['total_amount'];
    $total_amount = $late_fees + $taxed_amount + $booking_total_cost - $discount_amount;

    mysqli_query($db, "UPDATE billing SET billing_ID='$billing_ID', booking_ID='$booking_ID', bill_date='$bill_date',status='$status',discount_amount='$discount_amount',late_fees='$late_fees',taxed_amount='$taxed_amount' ,total_amount='$total_amount'  WHERE billing_ID='$oldbilling_ID'");
    $_SESSION['message'] = "Bill Updated!";
    header('location: billing.php');
}
if (isset($_GET['del'])) {
    $billing_ID = $_GET['del'];
    mysqli_query($db, "DELETE FROM billing WHERE billing_ID='$billing_ID'");
    $_SESSION['message'] = "Bill Deleted!";
    header('location: billing.php');
}
