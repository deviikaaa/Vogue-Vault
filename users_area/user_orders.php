<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="path_to_your_stylesheet.css"> <!-- Link your CSS file if needed -->
</head>
<body>
    <?php
    $username = $_SESSION['username']; // User's session
    $get_user = "SELECT * FROM `user_table` WHERE username='$username'";
    $result = mysqli_query($con, $get_user);
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id']; // Get user ID
    ?>

    <h3 class="text-success">All Orders</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-dark text-light">
        <tr>
            <th>Sl No</th>
            <th>Order number</th>
            <th>Amount Due</th>
            <th>Total Products</th>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Complete/Incomplete</th>
            <th>Status</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
        <?php
        // Fetch all orders related to the user
        $get_order_details = "SELECT * FROM `user_orders` WHERE user_id=$user_id";
        $result_orders = mysqli_query($con, $get_order_details);
        $number = 1;

        // Serial number
        while ($row_orders = mysqli_fetch_assoc($result_orders)) {
            $order_id = $row_orders['order_id'];

            $amount_due = $row_orders['amount_due'];
            // $total_products = isset($row_orders['total_product']) ? $row_orders['total_product'] : 'N/A'; // Check if total_product exists
            $total_products = $row_orders['total_products'];
            $invoice_number = $row_orders['invoice_number'];
            $order_status = $row_orders['order_status'];
            $order_date = $row_orders['order_date'];
            // if($order_status=='pending'){
            //     $order_status='Incomplete';
            // }
            // else{
            //     $order_status='Complete';
            // }

            echo "
            <tr>
                <td>$number</td>
                <td>$order_id</td>

                <td>₹ $amount_due</td>
                <td>$total_products</td>
                <td>$invoice_number</td>
                <td>$order_date</td>
                <td>$order_status</td> ";
                ?>
<?php
if($order_status=='Complete'){
    echo "<td>Paid</td>";
}
else{
               echo" <td><a href='confirm_payment.php?order_id=$order_id' class='text-dark'>Confirm</a></td>
               </tr>";
}       
            $number++; // Increment serial number
        }
        ?>
        </tbody>
    </table>
</body>
</html>
