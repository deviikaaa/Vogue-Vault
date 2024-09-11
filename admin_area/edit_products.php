<?php
if (isset($_GET['edit_products'])) {
    $edit_id = intval($_GET['edit_products']); // Ensuring it's an integer
    
    // Fetch product details
    $get_data = "SELECT * FROM `products` WHERE product_id=$edit_id";
    $result = mysqli_query($con, $get_data);
    $row = mysqli_fetch_assoc($result);
    
    // Check if the row is retrieved
    if (!$row) {
        die("Product not found.");
    }
    
    // Extract product details
    $product_title = $row['product_title'] ?? '';
    $product_description = $row['product_description'] ?? '';
    $product_keywords = $row['product_keywords'] ?? '';
    $category_id = $row['category_id'] ?? '';
    $brand_id = $row['brand_id'] ?? '';
    $product_image1 = $row['product_image1'] ?? '';
    $product_image2 = $row['product_image2'] ?? '';
    $product_image3 = $row['product_image3'] ?? '';
    $product_price = $row['product_price'] ?? '';

    // Fetch category title
    $select_category = "SELECT * FROM `categories` WHERE category_id=$category_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $category_title = $row_category['category_title'] ?? '';

    // Fetch brand title
    $select_brand = "SELECT * FROM `brands` WHERE brand_id=$brand_id";
    $result_brand = mysqli_query($con, $select_brand);
    $row_brand = mysqli_fetch_assoc($result_brand);
    $brand_title = $row_brand['brand_title'] ?? '';
}
?>

<div class="container mt-5">
    <h2 class="text-center">Edit Products</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Product Title -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" id="product_title" name="product_title" value="<?php echo htmlspecialchars($product_title) ?>" class="form-control" placeholder="Enter product title" required>
        </div>

        <!-- Product Description -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_description" class="form-label">Product Description</label>
            <textarea id="product_description" name="product_description" class="form-control" rows="4" placeholder="Enter product description" required><?php echo htmlspecialchars($product_description) ?></textarea>
        </div>

        <!-- Product Keywords -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <textarea id="product_keywords" name="product_keywords" class="form-control" rows="2" placeholder="Enter product keywords" required><?php echo htmlspecialchars($product_keywords) ?></textarea>
        </div>

        <!-- Product Category -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label">Product Category</label>
            <select name="product_category" id="product_category" class="form-select" required>
                <option value="<?php echo htmlspecialchars($category_id) ?>"><?php echo htmlspecialchars($category_title) ?></option>
                <?php
                $select_category_all = "SELECT * FROM `categories`";
                $result_category_all = mysqli_query($con, $select_category_all);
                while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                    $category_title_all = $row_category_all['category_title'];
                    $category_id_all = $row_category_all['category_id'];
                    echo "<option value='$category_id_all'>$category_title_all</option>";
                }
                ?>
            </select>
        </div>

        <!-- Product Brand -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_brands" class="form-label">Product Brands</label>
            <select name="product_brands" id="product_brands" class="form-select" required>
                <option value="<?php echo htmlspecialchars($brand_id) ?>"><?php echo htmlspecialchars($brand_title) ?></option>
                <?php
                $select_brand_all = "SELECT * FROM `brands`";
                $result_brand_all = mysqli_query($con, $select_brand_all);
                while ($row_brand_all = mysqli_fetch_assoc($result_brand_all)) {
                    $brand_title_all = $row_brand_all['brand_title'];
                    $brand_id_all = $row_brand_all['brand_id'];
                    echo "<option value='$brand_id_all'>$brand_title_all</option>";
                }
                ?>
            </select>
        </div>

        <!-- Product Image 1 -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">Product Image 1</label>
            <div class="d-flex">
                <input type="file" id="product_image1" name="product_image1" class="form-control w-90 m-auto">
                <img src="./product_images/<?php echo htmlspecialchars($product_image1) ?>" width="50" height="50" alt="" class="edit_img">
            </div>
        </div>

        <!-- Product Image 2 -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label">Product Image 2</label>
            <div class="d-flex">
                <input type="file" id="product_image2" name="product_image2" class="form-control w-90 m-auto">
                <img src="./product_images/<?php echo htmlspecialchars($product_image2) ?>" width="50" height="50" alt="" class="edit_img">
            </div>
        </div>

        <!-- Product Image 3 -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image3" class="form-label">Product Image 3</label>
            <div class="d-flex">
                <input type="file" id="product_image3" name="product_image3" class="form-control w-90 m-auto">
                <img src="./product_images/<?php echo htmlspecialchars($product_image3) ?>" width="50" height="50" alt="" class="edit_img">
            </div>
        </div>

        <!-- Product Price -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price (₹)</label>
            <input type="text" id="product_price" name="product_price" class="form-control" placeholder="Enter product price" required value="<?php echo htmlspecialchars($product_price) ?>">
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <input type="submit" name="edit_product" class="btn" value="Edit Product" style="background-color: black; color: white;">
        </div>
    </form>
</div>

<?php
if (isset($_POST['edit_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // Move uploaded images if they are set
    if ($product_image1) {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
    } else {
        $product_image1 = $row['product_image1']; // Retain the old image if no new image is uploaded
    }
    if ($product_image2) {
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
    } else {
        $product_image2 = $row['product_image2']; // Retain the old image if no new image is uploaded
    }
    if ($product_image3) {
        move_uploaded_file($temp_image3, "./product_images/$product_image3");
    } else {
        $product_image3 = $row['product_image3']; // Retain the old image if no new image is uploaded
    }

    $update_product = "UPDATE `products` SET 
        product_title='$product_title',
        product_description='$product_description',
        product_keywords='$product_keywords',
        category_id='$product_category',
        brand_id='$product_brands',
        product_image1='$product_image1',
        product_image2='$product_image2',
        product_image3='$product_image3',
        product_price='$product_price',
        date=NOW()
        WHERE product_id=$edit_id";

    $result_update = mysqli_query($con, $update_product);

    if ($result_update) {
        echo "<script>alert('Product updated successfully.')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    } else {
        echo "<script>alert('Error updating product.')</script>";
    }
}
?>
