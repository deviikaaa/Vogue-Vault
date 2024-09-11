<?php
include('../includes/connect.php');
include('../functions/common_function.php');

session_start(); // Ensure session is started at the very top of the page
if (!isset($_SESSION['username'])) {
  echo "
  <div class='container mt-5'>
      <div class='alert alert-danger text-center'>
          <h4>You need to log in to access this page!</h4>
          <p>
              <a href='user_login.php' class='btn btn-primary text-center'>
                  <span class='text-success' style='font-size: 1.5rem;'>Log in here</span>
              </a>
          </p>
      </div>
  </div>";
  exit();
}

   
$username = $_SESSION['username']; // Now this will work if session is set
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username']?> </title>
    <link rel="icon" href="../images/favicon.png" sizes="360x360" type="image/x-icon"> <!-- Add this line for favicon -->

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
        .profile_img{
            width:70%;
            margin:auto;
            display: block;
            height:100%;
            object-fit:contain;
        }
        .edit_img{
            width:100px;
            height:100px;
            object-fit:contain;

        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <img src="../images/logo.png" alt="Logo" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">My Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: Rs. <?php total_cart_price(); ?>/-</a>
        </li>
      </ul>
      <form class="d-flex ms-auto" role="search" action="../search_product.php" method="get">
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

<div class="row">
    <div class="col-md-2 p-0">
        <ul class="navbar-nav bg-secondary text-center">
        <li class="nav-item ">
          <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
        </li>
        <?php
$get_user = "SELECT * FROM `user_table` WHERE username='$username'";
$result = mysqli_query($con, $get_user);

// Check if user data is found
if ($result && mysqli_num_rows($result) > 0) {
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id'];
    $user_image = $row_fetch['user_image'];
} else {
    echo "User not found!";
    exit(); // Stop further execution if user is not found
}
?>



        <li class="nav-item ">
          <a class="nav-link text-light" href="profile.php"><h5>Pending Orders</h5></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" href="profile.php?edit_account"><h5>Edit Profile</h5></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" href="profile.php?my_orders"><h5>My orders</h5></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" href="profile.php?delete_account"><h5>Delete Profile</h5></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" href="logout.php"><h5>Logout</h5></a>
        </li>

        </ul>
    </div>
    <div class="col-md-10 text-center">
        <?php
        get_user_order_details();
        if(isset($_GET['edit_account'])){
            include('edit_account.php');

        }
        if(isset($_GET['my_orders'])){
            include('user_orders.php');

        }
        if(isset($_GET['delete_account'])){
          include('delete_account.php');

      }?>
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
