<?php
// Handle delete payment request
if (isset($_GET['delete_payment'])) {
    $delete_payment_id = $_GET['delete_payment'];

    // Query to delete the payment from the database
    $delete_query = "DELETE FROM `user_payments` WHERE payment_id=$delete_payment_id";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        echo "<script>alert('Payment has been deleted successfully')</script>";
        echo "<script>window.open('index.php?view_payments', '_self')</script>";
    } else {
        echo "<script>alert('Failed to delete the payment')</script>";
    }
}
?>