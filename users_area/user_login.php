<?php
include('../includes/connect.php'); 
include('../functions/common_function.php');
@session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
     crossorigin="anonymous" referrerpolicy="no-referrer">
     <style>
        body{
            overflow-x:hidden;
        }
        </style>
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center mb-4">User Login</h2>
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8 col-xl-6">
                <form action="" method="post" >
                    <div class="mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required name="user_username"/>
                    </div>

                    
                    <div class="mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required name="user_password"/>
                    </div>

                    <div class="text-center">
                    <input type="submit" class="btn btn-dark text-white" name="user_login"
                        value="Login">
                    </div>
                    <p class="small fw-bold mt-2 pt-1 text-center">Don't have an account? <a href="user_registration.php" class="text-danger">Register</a></p>

                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];
    echo $user_password;

    $select_query_cart="Select * from `user_table` where username='$user_username'";
    $result=mysqli_query($con,$select_query_cart);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();

    $select_query_cart="Select * from `cart_details` where ip_address='$user_ip'" ;
    $select_cart=mysqli_query($con,$select_query_cart);

    $row_count_cart=mysqli_num_rows($select_cart);

    if($row_count>0){
            if(password_verify($user_password,$row_data['user_password'])){
                // echo "<script>alert('Login Successful')</script>";
                if($row_count==1 and $row_count_cart==0){
                    $_SESSION['username']=$user_username;

                    echo "<script>alert('Login Successful')</script>";
                    echo "<script>window.open('profile.php','_self')</script>";

                }
                else{
                    $_SESSION['username']=$user_username;

                    echo "<script>alert('Login Successful')</script>";
                    echo "<script>window.open('payment.php','_self')</script>";
                }
            }
            else{
                echo "<script>alert('Invalid Credentials')</script>";

            }
    }
    else{
        echo "<script>alert('Invalid Credentials')</script>";
    }

}

?>

