<?php
include('includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vogue Vault</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
     crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">
    <style>
    html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .container {
        flex: 1; /* This makes the container take up the available space */
    }

    .footer {
        background-color: #343a40; /* Dark background to match the navbar */
        color: white;
        text-align: center;
        padding: 10px 0;
        width: 100%;
        margin-top: auto; /* Ensures the footer stays at the bottom of the page */
    }
</style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <img src="./images/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price:</a>
        </li>
      </ul>
      <form class="d-flex ms-auto" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">Welcome Guest</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
        </li>
    </ul>
</nav>

<div class="bg-light">
    <h3 class="text-center">Curated Wardrobe</h3>
    <p class="text-center">One stop fashion destination for women</p>
</div>

<div class="container">
    <div class="row px-3">
        <div class="col-md-10">
            <div class="row">

            <?php
            $select_query = "SELECT * FROM `products` order by rand() limit 0,9";
            $result_query = mysqli_query($con, $select_query);

            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];

                echo "<div class='col-md-4 mb-2'> 
                    <div class='card'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <a href='#' class='btn btn-dark'>Add to cart</a>
                            <a href='#' class='btn btn-secondary'>View more</a>
                        </div>
                    </div>
                </div>";
            }
            ?>

            </div>
        </div>
        
        <div class="col-md-2 bg-secondary p-0">
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-dark">
                    <a href="#" class="nav-link" style="color: white;"><h4>Brands</h4></a>
                </li>
                <?php
                $select_brands = "SELECT * FROM `brands`";
                $result_brands = mysqli_query($con, $select_brands);

                while ($row_data = mysqli_fetch_assoc($result_brands)) {
                    $brand_title = $row_data['brand_title'];
                    $brand_id = $row_data['brand_id'];
                    echo "<li class='nav-item'>
                        <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
                    </li>";
                }
                ?>
            </ul>

            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-dark">
                    <a href="#" class="nav-link" style="color: white;"><h4>Categories</h4></a>
                </li>
                <?php
                $select_categories = "SELECT * FROM `categories`";
                $result_categories = mysqli_query($con, $select_categories);

                while ($row_data = mysqli_fetch_assoc($result_categories)) {
                    $category_title = $row_data['category_title'];
                    $category_id = $row_data['category_id'];
                    echo "<li class='nav-item'>
                        <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
                    </li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<div class="bg-dark p-3 text-center footer">
    <p class="text-white"> All rights reserved © - Designed by Devika - 2024</p>
</div> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous"></script>  
</body>
</html>
