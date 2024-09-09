<?php
include('../includes/connect.php'); 
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
     integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
     crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<style>
    .payment_img{
        width:90%;
        margin: auto;
        display:block;

    }
    </style>
<body>
    <?php
$user_ip=getIPAddress();
$get_user="Select * from `user_table` where user_ip='$user_ip'";
$result=mysqli_query($con,$get_user);
$run_query=mysqli_fetch_array($result);
$user_id=$run_query['user_id'];


?>
    <div class="container">
        <h2 class="text-center text-dark" >Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
            <a href="https://www.paypal.com" target="_blank">
            <img src="../images/upi.jpeg" alt="" class="payment_img"></a>
            </div>
            <div class="col-md-6">
            <a href="order.php?user_id=<?php echo $user_id  ?>"><h2 class="text-center">
                Pay Offline</h2></a>
            </div>
            
        </div>
    </div>
</body>
</html>