<?php
include('../includes/connect.php');

if(isset($_POST['insert_product'])){

    $product_title = $_POST['product_title'];
    $description = $_POST['description'];  // Fixed variable name
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];  // Fixed typo
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];
    
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // Check if any of the required fields are empty
    if($product_title == '' || $description == '' || $product_keywords == '' || $product_category == '' 
    || $product_brands == '' || $product_price == '' || $product_image1 == '' ||  $product_image2 == '' || $product_image3 == '' ) {
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    } else {
        // Moving the uploaded images to the product_images directory
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        // Inserting the product into the database
        $insert_products = "INSERT INTO `products` (product_title, product_description, product_keywords, category_id, 
        brand_id, product_image1, product_image2, product_image3, product_price, date, status) VALUES 
        ('$product_title', '$description', '$product_keywords', '$product_category', 
        '$product_brands', '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(), 
        '$product_status')";

        $result_query = mysqli_query($con, $insert_products);
        if($result_query){
            echo "<script>alert('Successfully inserted the product')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product - Admin Dashboard</title>
    <link rel="icon" href="../images/favicon.png" sizes="360x360" type="image/x-icon"> <!-- Add this line for favicon -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>

        <form action="" method="post" enctype="multipart/form-data">

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title"
             autocomplete="off" required="required">
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="description" class="form-label">Product Description</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Enter description"
             autocomplete="off" required="required">
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords"
             autocomplete="off" required="required">
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_category" id="product_category" class="form-select">
                <option value="">Select a Category</option>
                <?php
                $select_query = "SELECT * FROM `categories`";
                $result_query = mysqli_query($con, $select_query);
                while($row = mysqli_fetch_assoc($result_query)){
                    $category_title = $row['category_title'];
                    $category_id = $row['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_brands" id="product_brands" class="form-select">
                <option value="">Select a Brand</option>
                <?php
                $select_query = "SELECT * FROM `brands`";
                $result_query = mysqli_query($con, $select_query);
                while($row = mysqli_fetch_assoc($result_query)){
                    $brand_title = $row['brand_title'];
                    $brand_id = $row['brand_id'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image1" class="form-label">Product Image 1</label>
            <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image2" class="form-label">Product Image 2</label>
            <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image3" class="form-label">Product Image 3</label>
            <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter price of the product"
             autocomplete="off" required="required">
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="insert_product" class="btn btn-dark mb-3 px-3" value="Insert Product">
        </div>

        </form>
    </div>
</body>
</html>
