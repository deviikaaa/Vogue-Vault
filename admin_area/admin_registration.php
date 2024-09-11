


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="icon" href="../images/favicon.png" sizes="360x360" type="image/x-icon"> <!-- Add this line for favicon -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <img src="../images/adm_regn.jpeg" alt="adm regn" class="img-fluid" style="width: 100%; height: auto;">
            </div>

            <div class="col-lg-6">
            <form action="" method="post">
    <div class="form-outline mb-4 w-50">
        <label for="admin_name" class="form-label">Username</label>
        <input type="text" id="admin_name" name="admin_name" autocomplete="off"placeholder="Enter your username"
               required="required" class="form-control">
    </div>
    <div class="form-outline mb-4 w-50">
        <label for="admin_email" class="form-label">Email</label>
        <input type="email" id="admin_email" name="admin_email" autocomplete="off"placeholder="Enter your email"
               required="required" class="form-control">
    </div>
    <div class="form-outline mb-4 w-50">
        <label for="admin_password" class="form-label">Password</label>
        <input type="password" id="admin_password" name="admin_password" placeholder="Enter your password"
               required="required" class="form-control">
    </div>
    <div class="form-outline mb-4 w-50">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password"
               required="required" class="form-control">
    </div>
    <div class="form-outline mb-4 w-50">
        <input type="submit" class="btn btn-dark text-white w-50" name="admin_registration" value="Register">
    </div>
    <div class="text-left">
        <p class="small fw-bold mt-2 pt-1">Already have an account?
            <a href="admin_login.php" class="text-danger">Login</a>
        </p>
    </div>
</form>


            </div>
        </div>
    </div>
</body>
</html>

<?php
include('../includes/connect.php');

if (isset($_POST['admin_registration'])) {
    // Check if the required fields are set
    if (isset($_POST['admin_name']) && isset($_POST['admin_email']) && isset($_POST['admin_password']) && isset($_POST['confirm_password'])) {
        $admin_name = $_POST['admin_name'];
        $admin_email = $_POST['admin_email'];
        $admin_password = $_POST['admin_password'];
        $conf_user_password = $_POST['confirm_password'];
        
        // Hash the password
        $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);

        // Check if username or email already exists
        $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name' OR admin_email='$admin_email'";
        $result = mysqli_query($con, $select_query);
        $rows_count = mysqli_num_rows($result);

        if ($rows_count > 0) {
            echo "<script>alert('Username or Email already exists')</script>";
        } else if ($admin_password != $conf_user_password) {
            echo "<script>alert('Passwords do not match')</script>";
        } else {
            // Insert query with the hashed password
            $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password)
                             VALUES ('$admin_name', '$admin_email', '$hash_password')";
            $sql_execute = mysqli_query($con, $insert_query);

            if ($sql_execute) {
                echo "<script>alert('Registration successful');</script>";
                echo "<script>window.open('admin_registration.php?status=success', '_self')</script>";
            } else {
                echo "<script>alert('Error in registration')</script>";
            }
        }
    } else {
        echo "<script>alert('Please fill all fields')</script>";
    }
}
?>
