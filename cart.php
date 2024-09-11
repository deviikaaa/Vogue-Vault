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
    <title>Vogue Vault - Cart Details</title>
    <link rel="icon" href="images/favicon.png" sizes="360x360" type="image/x-icon"> <!-- Add this line for favicon -->

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
    .cart_image{
        width:80px;
        height:80px;
        object-fit:contain;
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

<!-- <div class="bg-light">
    <h3 class="text-center">Curated Wardrobe</h3>
    <p class="text-center">One stop fashion destination for women</p>
</div> -->


<div class="container">
    <div class="row">
        <form action="" method="post">
        <table class="table table-bordered text-center">
            
    <?php
    global $con;
    $get_ip_add = getIPAddress();
    $total_price = 0;
    
    // Get all items in the cart for the current user
    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);
    $result_count=mysqli_num_rows($result);
    if($result_count>0){
        echo "<thead>
        <tr>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Remove</th>
            <th colspan=\"2\">Operations</th>
        </tr>
    </thead>
    <tbody>";

    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        
        // Fetch the product details from the products table
        $select_products = "SELECT product_price, product_title, product_image1 FROM `products` WHERE product_id='$product_id'";
        $result_products = mysqli_query($con, $select_products);
        
        if ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = $row_product_price['product_price'];
            $product_title = $row_product_price['product_title'];
            $product_image1 = $row_product_price['product_image1'];

            // Convert price to float and add to total
            $product_price_float = floatval($product_price);
            $total_price += $product_price_float;
    ?>
    <tr>
        <td><?php echo htmlspecialchars($product_title); ?></td>
        <td><img src="./admin_area/product_images/<?php echo htmlspecialchars($product_image1); ?>" alt="" class="cart_image"></td>
        <td><input type="text" name="qty" class="form-input w-50"> </td>
        <?php
                $get_ip_add = getIPAddress();
if(isset($_POST['update_cart'])){
    $quantities=$_POST['qty'];
    $update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_add'";
     $result_product_quantity = mysqli_query($con, $update_cart);
     $total_price=$total_price*$quantities;
}

            ?>
        <td>Rs. <?php echo htmlspecialchars($product_price); ?>/-</td>
        <td><input type="checkbox" name="removeitem[]" value="<?php
                                                            echo $product_id
                                                                ?>"> </td>
        <td> 
            <!-- <button class="bg-dark px-3 py-2 border-0 mx-3" 
             style="color: white;">Update</button> -->
             <input type="submit" value="Update Cart" class="bg-dark px-3 py-2 border-0 mx-3" style="color: white;" name="update_cart">
             <!-- <button class="bg-dark px-3 py-2 border-0 mx-3" style="color: white;">Remove</button> -->
             <input type="submit" value="Remove Cart" class="bg-dark px-3 py-2 border-0 mx-3" style="color: white;" name="remove_cart">

        </td>
    </tr>
    <?php
        }
    }
}
else{
    echo "<h2 class='text-center text-danger'> Cart is empty</h2>";
}
    ?>
</tbody>

        </table>

        <div class="d-flex mb-5">
            <?php
    $get_ip_add = getIPAddress();
    
    
    // Get all items in the cart for the current user
    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);
    $result_count=mysqli_num_rows($result);
    if($result_count>0){
       echo " <h4 class='px-3'>Subtotal: Rs.<strong> $total_price  </strong>/-</h4>
       <input type='submit' value='Continue Shopping' class='bg-dark px-3 py-2 border-0 mx-3'
         style='color: white;' name='continue_shopping'>

<button class='bg-secondary px-3 py-2 border-0' style='color: white;'><a href='./users_area/checkout.php' class='text-light text-decoration-none'>
Checkout</a></button>";
    }
    else{
        echo "<input type='submit' value='Continue Shopping' class='bg-dark px-3 py-2 border-0 mx-3'
         style='color: white;' name='continue_shopping'>";
    }
    if(isset($_POST['continue_shopping'])){
        echo "<script> window.open('index.php','_self')</script>";
    }
            ?>
            
        </div>
    </div>
</div>
</form>
<?php
function remove_cart_item(){
    global $con;
    if(isset($_POST['remove_cart'])){
        foreach($_POST['removeitem'] as $remove_id){
            echo $remove_id;
            $delete_query="Delete from `cart_details` where product_id=$remove_id";
            $run_delete=mysqli_query($con,$delete_query);
            if($run_delete){
                echo "<script>window.open('cart.php','_self') </script>";
            }
        }
    }
}
echo $remove_item=remove_cart_item();
?>
<div class="bg-dark p-3 text-center footer">
    <p class="text-white"> All rights reserved © - Designed by Devika - 2024</p>
</div> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous"></script>  
</body>
</html>
