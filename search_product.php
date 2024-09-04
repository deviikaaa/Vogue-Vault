<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();

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
    .logo{
        width:7%;
        height:auto;
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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./users_area/user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: Rs. <?php total_cart_price();
          ?>/-</a>
        </li>
      </ul>
      <form class="d-flex ms-auto" role="search" action="search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<?php
cart();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
    <?php
        if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
                <a class='nav-link' href='#'>Welcome Guest</a>
            </li>";
        } else {
            echo "<li class='nav-item'>
                <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
            </li>";
        }
    
        if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
                <a class='nav-link' href='./users_area/user_login.php'>Login</a>
            </li>";
        } else {
            echo "<li class='nav-item'>
                <a class='nav-link' href='./users_area/logout.php'>Logout</a>
            </li>";
        }
        ?>
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
            search_product();
            get_unique_categories();
            get_unique_brands();
            ?>

            </div>
        </div>
        
        <div class="col-md-2 bg-secondary p-0">
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-dark">
                    <a href="#" class="nav-link" style="color: white;"><h4>Brands</h4></a>
                </li>
                <?php
                getbrands();
                ?>
            </ul>

            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-dark">
                    <a href="#" class="nav-link" style="color: white;"><h4>Categories</h4></a>
                </li>
                <?php
                getcategories();
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
