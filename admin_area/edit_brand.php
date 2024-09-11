<?php
if (isset($_GET['edit_brand'])) {
    $edit_brand = intval($_GET['edit_brand']); // Ensure it's an integer
    $get_brands = "SELECT * FROM `brands` WHERE brand_id=$edit_brand";
    $result = mysqli_query($con, $get_brands);
    $row = mysqli_fetch_assoc($result);
    $brand_title = $row['brand_title'];
}

if (isset($_POST['edit_brand'])) {
    $brand_title = $_POST['brand_title'];
    $update_query = "UPDATE `brands` SET brand_title='$brand_title' WHERE brand_id=$edit_brand";
    $result_brand = mysqli_query($con, $update_query);
    if ($result_brand) {
        echo "<script>alert('Brand has been updated successfully.')</script>";
        echo "<script>window.open('./index.php?view_brands', '_self')</script>";
    } else {
        echo "<script>alert('Error updating brand.')</script>";
    }
}
?>
<div class="container mt-3">
    <h1 class="text-center">Edit Brand</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label">
                Brand Title
            </label>
            <input type="text" name="brand_title" id="brand_title" class="form-control"
             required="required" value='<?php echo htmlspecialchars($brand_title); ?>'>
        </div>
        <div class="text-center">
            <input type="submit" name="edit_brand" class="btn" value="Edit Brand" style="background-color: black; color: white;">
        </div>
    </form>
</div>
