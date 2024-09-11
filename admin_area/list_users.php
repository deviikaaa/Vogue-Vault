

<h3 class="text-center">All Users</h3>

<?php
$get_users = "SELECT * FROM `user_table`";
$result = mysqli_query($con, $get_users);
$row_count = mysqli_num_rows($result);

if ($row_count == 0) {
    // Display a message if there are no users
    echo "<h2 class='text-danger text-center mt-5'>No users yet.</h2>";
} else {
    // If users exist, display the table
    echo "
    <table class='table table-bordered mt-5'>
        <thead class='bg-dark text-light'>
            <tr>
                <th>Sl no</th>
                <th>Username</th>
                <th>User email</th>
                <th>User image</th>
                <th>User address</th>
                <th>User mobile</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light'>
    ";

    $number = 0;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $user_id = $row_data['user_id'];
        $username = $row_data['username'];
        $user_email = $row_data['user_email'];
        $user_image = $row_data['user_image'];
        $user_address = $row_data['user_address'];
        $user_mobile = $row_data['user_mobile'];
        $number++;

        echo "
            <tr class='text-center'>
                <td>$number</td>
                <td>$username</td>
                <td>$user_email</td>
<td><img src='../users_area/user_images/$user_image' alt='$username' style='width:30px; height:30px;'></td>
                <td>$user_address</td>
                <td>$user_mobile</td>
                <td>
                    <a href='index.php?delete_user=$user_id' class='btn btn-dark text-light'>
                        <i class='fa-solid fa-trash'></i> Delete
                    </a>
                </td>
            </tr>";
    }

    echo "
        </tbody>
    </table>";
}
?>
