

<h3 class="text-center">All Orders</h3>

<?php
$get_orders = "SELECT * FROM `user_orders`";
$result = mysqli_query($con, $get_orders);
$row_count = mysqli_num_rows($result);

if ($row_count == 0) {
    // Display a message if there are no orders
    echo "<h2 class='text-danger text-center mt-5'>No orders available</h2>";
} else {
    // If orders exist, display the table
    echo "
    <table class='table table-bordered mt-5'>
        <thead class='bg-dark text-light'>
            <tr>
                <th>Sl no</th>
                <th>Due Amount</th>
                <th>Invoice Number</th>
                <th>Total Products</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light'>
    ";

    $number = 0;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $order_id = $row_data['order_id'];
        $user_id = $row_data['user_id'];
        $amount_due = $row_data['amount_due'];
        $invoice_number = $row_data['invoice_number'];
        $total_products = $row_data['total_products'];
        $order_date = $row_data['order_date'];
        $order_status = $row_data['order_status'];
        $number++;
    //     <td>
    //     <a href='index.php?delete_order=$order_id' class='btn btn-dark text-light'>
    //         <i class='fa-solid fa-trash'></i> Delete
    //     </a>
    // </td>
        echo "
    <tr class='text-center'>
        <td>$number</td>
        <td>₹$amount_due</td>
        <td>$invoice_number</td>
        <td>$total_products</td>
        <td>$order_date</td>
        <td>$order_status</td>
        <td>
            <a href='index.php?delete_order=$order_id' class='btn btn-dark text-light'>
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
