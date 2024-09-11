<?php
if (isset($_GET['delete_brand'])) {
    $delete_brand = intval($_GET['delete_brand']); // Ensure it's an integer
    $delete_query = "DELETE FROM `brands` WHERE brand_id=$delete_brand";
    $result = mysqli_query($con, $delete_query);
    if ($result) {
        echo "<script>alert('Brand has been deleted successfully.')</script>";
        echo "<script>window.open('./index.php?view_brands', '_self')</script>";
    } else {
        echo "<script>alert('Error deleting brand.')</script>";
    }
}
?>
