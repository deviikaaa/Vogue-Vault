<?php
include('../includes/connect.php'); 
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="icon" href="../images/favicon.png" sizes="360x360" type="image/x-icon"> <!-- Add this line for favicon -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center mb-4">User Registration</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required name="user_username"/>
                    </div>

                    <div class="mb-4">
                        <label for="user_email" class="form-label">User Email</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required name="user_email"/>
                    </div>

                    <div class="mb-4">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" id="user_image" class="form-control" required name="user_image"/>
                    </div>

                    <div class="mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required name="user_password"/>
                    </div>

                    <div class="mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" placeholder="Confirm password" autocomplete="off" required name="conf_user_password"/>
                    </div>

                    <div class="mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required name="user_address"/>
                    </div>

                    <div class="mb-4">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required name="user_contact"/>
                    </div>

                    <div class="text-center">
                    <input type="submit" class="btn btn-dark text-white" name="user_register"
                        value="Register">
                        <p class="small fw-bold mt-2 pt-1">Already have an account? <a href="user_login.php" class="text-danger"> Login</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['user_register'])){
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress(); 

    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if($rows_count > 0){
        echo "<script>alert('Username and Email already exist')</script>";
    } else if($user_password != $conf_user_password){
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        // Move the uploaded image to the user_images directory
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");

        // Insert query with the hashed password
        $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile)
                         VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";

        $sql_execute = mysqli_query($con, $insert_query);

        if($sql_execute){
            // Redirect to avoid form resubmission on page reload
            echo "<script>alert('Registration successful');</script>";
            header("Location: user_registration.php?status=success");
            exit(); // Ensures that no further code is executed after the redirect
        }
    }
    $select_cart_items="Select * from `cart_details` where ip_address='$user_ip'";
    $result_cart = mysqli_query($con, $select_cart_items);
    $rows_count = mysqli_num_rows($result_cart);
    if($rows_count>0){
        $_SESSION['username']=$user_username;
        echo "<script>alert('You have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";


    }
    else{
        echo "<script>window.open('../index.php','_self')</script>";

    }

}
?>


