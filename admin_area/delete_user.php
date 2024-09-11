<?php
// Handle delete user request
if (isset($_GET['delete_user'])) {
    $delete_user_id = $_GET['delete_user'];

    // Query to delete the user from the database
    $delete_query = "DELETE FROM `user_table` WHERE user_id=$delete_user_id";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        echo "<script>alert('User has been deleted successfully')</script>";
        echo "<script>window.open('index.php?view_users', '_self')</script>";
    } else {
        echo "<script>alert('Failed to delete the user')</script>";
    }
}
?>