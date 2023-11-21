<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'CarRental');

// initialize variables
$booking_ID = "";
$oldbooking_ID = "";
$customer_id = "";
$VIN_number = "";
$insurance_ID = "";
$pick_up_day = "";
$number_of_days = 0;
$total_amount = 0;
$update = false;


if (isset($_POST['save'])) {
    $booking_ID = $_POST["booking_ID"];
    $customer_id = $_POST["customer_id"];
    $VIN_number = $_POST["VIN_number"];
    $insurance_ID = $_POST["insurance_ID"];
    $pick_up_day = $_POST["pick_up_day"];
    $number_of_days = $_POST["number_of_days"];

    $cost_query = "SELECT * FROM car WHERE VIN_number = '$VIN_number'";
    $cost_result = mysqli_query($db, $cost_query);
    $cost_row = mysqli_fetch_assoc($cost_result);
    $cost_per_day = (float)$cost_row['cost_per_day'];

    // $total_amount = $_POST["total_amount"];
    $total_amount = $number_of_days * $cost_per_day;

    mysqli_query($db, "INSERT INTO booking (booking_ID, customer_id, VIN_number, insurance_ID, pick_up_day, number_of_days, total_amount) VALUES ('$booking_ID', '$customer_id','$VIN_number', '$insurance_ID','$pick_up_day', '$number_of_days','$total_amount')");
    $_SESSION['message'] = "Booking Saved";
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

    $cost_query = "SELECT * FROM car WHERE VIN_number = '$VIN_number'";
    $cost_result = mysqli_query($db, $cost_query);
    $cost_row = mysqli_fetch_assoc($cost_result);
    $cost_per_day = (float)$cost_row['cost_per_day'];


    $insurance_query = "SELECT * FROM insurance WHERE insurance_ID = '$insurance_ID'";
    $insurance_result = mysqli_query($db, $insurance_query);
    $insurance_row = mysqli_fetch_assoc($insurance_result);
    $insurance_cost_per_day = (float)$insurance_row['cost_per_day'];

    // $total_amount = $_POST["total_amount"];
    $total_amount = $number_of_days * ($cost_per_day + $insurance_cost_per_day);

    mysqli_query($db, "UPDATE booking SET booking_ID='$booking_ID', customer_id='$customer_id',VIN_number='$VIN_number',insurance_ID='$insurance_ID',pick_up_day='$pick_up_day',number_of_days='$number_of_days',total_amount='$total_amount' WHERE booking_ID='$oldbooking_ID'");
    $_SESSION['message'] = "Booking Updated!";
    header('location: booking.php');
}

if (isset($_GET['del'])) {
    $booking_ID = $_GET['del'];

    // Attempt to delete records from child tables (e.g., "billing" table)
    $delete_billing_query = "DELETE FROM billing WHERE booking_ID='$booking_ID'";
    if (mysqli_query($db, $delete_billing_query)) {
        // Child records deleted successfully

        // Now, delete the "booking" record
        $delete_booking_query = "DELETE FROM booking WHERE booking_ID='$booking_ID'";
        if (mysqli_query($db, $delete_booking_query)) {
            // Booking record deleted successfully
            $_SESSION['message'] = "Booking Deleted!";
        } else {
            $_SESSION['error_message'] = "Error deleting the booking record.";
        }
    } else {
        $_SESSION['error_message'] = "Error deleting related billing records.";
    }

    header('location: booking.php');
}
