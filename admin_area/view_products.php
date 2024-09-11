<h1 class="text-center">All Products</h1>
<table class="table table-bordered mt-5">
    <thead class="bg-dark text-light">
        <tr>
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Product Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        // Ensure you have a connection to the database
        $get_products = "SELECT * FROM `products`"; // Adjust the table name as needed
        $result = mysqli_query($con, $get_products);

        if (!$result) {
            // Display error message if the query fails
            echo "<tr><td colspan='8' class='text-center text-danger'>Error fetching products: " . mysqli_error($con) . "</td></tr>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $status = $row['status']; // Assuming status is available (e.g., Active/Inactive)

                // Query to count the total products sold
                $get_count = "SELECT * FROM `orders_pending` WHERE product_id = $product_id";
                $result_count = mysqli_query($con, $get_count);
                $rows_count = mysqli_num_rows($result_count);

                echo "
                <tr class='text-center'>
                    <td>$product_id</td>
                    <td>$product_title</td>
                    <td><img src='./product_images/$product_image1' width='50' height='50'></td>
                    <td>₹ $product_price</td>
                    <td>$rows_count</td>
                    <td>$status</td>
                    <td><a href='index.php?edit_products=$product_id'><i class='fa-solid fa-pen-to-square'></i> Edit</a></td>
                    <td><a href='index.php?delete_product=$product_id'><i class='fa-solid fa-trash'></i> Delete</a></td>
                </tr>
                ";
            }
        }
        ?>
    </tbody>
</table>
