<?php
session_start(); // Start the session

include('../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" href="../images/favicon.png" sizes="360x360" type="image/x-icon"> <!-- Add this line for favicon -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <img src="../images/adm_regn.jpeg" alt="adm regn" class="img-fluid" style="width: 100%; height: auto;">
            </div>

            <div class="col-lg-6">
                <form action="" method="post">
                    <div class="form-outline mb-4 w-50">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" autocomplete="off" placeholder="Enter your username"
                               required="required" class="form-control">
                    </div>
                   
                    <div class="form-outline mb-4 w-50">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                               required="required" class="form-control">
                    </div>
                   
                    <!-- Adjust button alignment -->
                    <div class="form-outline mb-4 w-50">
                        <input type="submit" class="btn btn-dark text-white w-50" name="admin_login" value="Login">
                    </div>
                    <div class="text-left">
                        <p class="small fw-bold mt-2 pt-1">Do not have an account? 
                            <a href="admin_registration.php" class="text-danger">Register</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['admin_login'])){
    $admin_name = $_POST['username'];
    $admin_password = $_POST['password'];

    // Query to check the credentials
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if($row_count > 0){
        if(password_verify($admin_password, $row_data['admin_password'])){
            $_SESSION['admin_name'] = $admin_name;
            echo "<script>alert('Login Successful');</script>";
            echo "<script>window.open('index.php', '_self');</script>";
        } else {
            echo "<script>alert('Invalid Credentials');</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>
