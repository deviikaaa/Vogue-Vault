

<h3 class="text-center">All Payments</h3>

<?php
$get_payment = "SELECT * FROM `user_payments`";
$result = mysqli_query($con, $get_payment);
$row_count = mysqli_num_rows($result);

if ($row_count == 0) {
    // Display a message if there are no payments
    echo "<h2 class='text-danger text-center mt-5'>No payments yet.</h2>";
} else {
    // If payments exist, display the table
    echo "
    <table class='table table-bordered mt-5'>
        <thead class='bg-dark text-light'>
            <tr>
                <th>Sl no</th>
                <th>Invoice Number</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Payment Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light'>
    ";

    $number = 0;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $payment_id = $row_data['payment_id'];
        $invoice_number = $row_data['invoice_number'];
        $amount = $row_data['amount'];
        $payment_mode = $row_data['payment_mode'];
        $date = $row_data['date'];
        $number++;

        echo "
            <tr class='text-center'>
                <td>$number</td>
                <td>$invoice_number</td>
                <td>₹$amount</td>
                <td>$payment_mode</td>
                <td>$date</td>
                <td>
                    <a href='index.php?delete_payment=$payment_id' class='btn btn-dark text-light'>
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
