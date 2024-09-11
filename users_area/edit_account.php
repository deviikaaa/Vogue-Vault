<?php
// session_start(); // Ensure session is started

// Check if 'edit_account' is set
if(isset($_GET['edit_account'])){
    $user_session_name=$_SESSION['username'];
    
    // Fetch user data from database
    $select_query="SELECT * FROM `user_table` WHERE username='$user_session_name'";
    $result_query=mysqli_query($con, $select_query);
    $row_fetch=mysqli_fetch_assoc($result_query);
    
    // Assign user data to variables
    $user_id = $row_fetch['user_id'];
    $username = $row_fetch['username'];
    $user_email = $row_fetch['user_email'];
    $user_address = $row_fetch['user_address'];
    $user_mobile = $row_fetch['user_mobile'];
    $user_image = $row_fetch['user_image']; // Fetch the current image
}

// Update user data when form is submitted
if(isset($_POST['user_update'])){
    $update_id = $user_id;
    
    // Capture form data
    $username = $_POST['user_username']; // Correct the field name to match form
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];
    
    // Handle image upload
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    
    // Move the uploaded image to the designated folder
    if(!empty($user_image)) {
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
    } else {
        // If no new image is uploaded, keep the current one
        $user_image = $row_fetch['user_image'];
    }

    // Validate that username is not empty before updating
    if (!empty($username)) {
        // Update user data in the database
        $update_data = "UPDATE `user_table` SET 
                        username='$username',
                        user_email='$user_email',
                        user_image='$user_image', 
                        user_address='$user_address', 
                        user_mobile='$user_mobile' 
                        WHERE user_id=$update_id";
        
        $result_query_update = mysqli_query($con, $update_data);

        // If update is successful, log out the user
        if($result_query_update){
            echo "<script>alert('Data updated successfully')</script>";
            echo "<script>window.open('logout.php', '_self')</script>";
        }
    } else {
        echo "<script>alert('Username cannot be empty!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="icon" href="../images/favicon.png" sizes="360x360" type="image/x-icon"> <!-- Add this line for favicon -->

</head>
<body>
    <h3 class="text-center text-success mb-4">Edit Profile</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        <!-- Username Field -->
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $username ?>" name="user_username">
        </div>

        <!-- Email Field -->
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email ?>" name="user_email">
        </div>

        <!-- Profile Image Upload Field -->
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" name="user_image">
            <img src="./user_images/<?php echo $user_image ?>" class="edit_img" width="50" height="50">
        </div>

        <!-- Address Field -->
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_address" value="<?php echo $user_address ?>">
        </div>

        <!-- Mobile Number Field -->
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_mobile ?>">
        </div>

        <!-- Submit Button -->
        <input type="submit" value="Update" class="bg-dark text-light py-2 px-3 border-0" name="user_update">
    </form>
</body>
</html>
