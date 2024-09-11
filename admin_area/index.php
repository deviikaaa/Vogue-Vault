<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="../images/favicon.png" sizes="360x360" type="image/x-icon"> <!-- Add this line for favicon -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container-fluid {
            flex: 1;
        }
        .logo{
    width:7%;
    height:auto;
}

        .admin_image {
            width: 100px;
            object-fit: contain;
        }

        .button {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 10px;
            padding: 10px;
        }

        .button a {
            flex: 1;
            text-align: center;
            padding: 10px;
            color: white;
            text-decoration: none;
            background-color: #343a40;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            min-width: 120px;
        }

        .button a:hover {
            background-color: #495057;
        }

        /* Remove the black background from the "Insert Categories" section and button */
        .content-section {
            background-color: transparent;
            padding: 20px 0;
        }

        .content-section input,
        .content-section button {
            background-color: #f8f9fa; /* Light background */
            border: 1px solid #ced4da; /* Light border */
            color: #343a40; /* Dark text color */
            padding: 10px;
            border-radius: 5px;
        }

        .footer {
            background-color: #343a40;
            padding: 10px;
            text-align: center;
            color: white;
        }

        .body{
            overflow-x:hidden;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="" class="logo">

                <nav class="navbar navbar-expand-lg navbar-light bg-dark">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="color: white;">Welcome Admin</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <div class="bg-light">
            <h3 class="text-center p-2" style="color: #343a40;">
                Manage Inventory
            </h3>

            <div class="row">
                <div class="col-md-12 bg-light p-1 text-center">
                    <div>
                        <a href="#"><img src="../images/admin.jpeg" alt="" class="admin_image"></a>
                    </div>
                    <div class="button">
                        <a href="insert_product.php" class="nav-link">Insert Products</a>
                        <a href="index.php?view_products" class="nav-link">View Products</a>
                        <a href="index.php?insert_category" class="nav-link">Insert Categories</a>
                        <a href="index.php?view_categories" class="nav-link">View Categories</a>
                        <a href="index.php?insert_brand" class="nav-link">Insert Brands</a>
                        <a href="index.php?view_brands" class="nav-link">View Brands</a>
                        <a href="index.php?list_orders" class="nav-link">All Orders</a>
                        <a href="index.php?list_payment" class="nav-link">All Payments</a>
                        <a href="index.php?list_users" class="nav-link">List Users</a>
                        <a href="index.php?logout" class="nav-link">Logout</a>
                    </div>
                </div>
            </div>

            <!-- Insert Categories Section -->
            <div class="container content-section">
                <?php
                if (isset($_GET['insert_category'])) {
                    include('insert_categories.php');
                }

                if (isset($_GET['insert_brand'])) {
                    include('insert_brands.php');
                }
                if (isset($_GET['view_products'])) {
                    include('view_products.php');
                }
                if (isset($_GET['edit_products'])) {
                    include('edit_products.php');
                }
                if (isset($_GET['delete_product'])) {
                    include('delete_product.php');
                }
                if (isset($_GET['view_categories'])) {
                    include('view_categories.php');
                }
                if (isset($_GET['view_brands'])) {
                    include('view_brands.php');
                }
                if (isset($_GET['edit_category'])) {
                    include('edit_category.php');
                }
                if (isset($_GET['edit_brand'])) {
                    include('edit_brand.php');
                }
                if (isset($_GET['delete_category'])) {
                    include('delete_category.php');
                }
                if (isset($_GET['delete_brand'])) {
                    include('delete_brand.php');
                }
                if (isset($_GET['list_orders'])) {
                    include('list_orders.php');
                }
                if (isset($_GET['list_payment'])) {
                    include('list_payment.php');
                }
                if (isset($_GET['list_users'])) {
                    include('list_users.php');
                }
                if (isset($_GET['delete_user'])) {
                    include('delete_user.php');
                }
                if (isset($_GET['delete_payment'])) {
                    include('delete_payment.php');
                }
                if (isset($_GET['delete_order'])) {
                    include('delete_order.php');
                }
                if (isset($_GET['logout'])) {
                    include('logout.php');
                }
                ?>
            </div>

        </div>
    </div>

    <div class="footer">
        <p>All rights reserved © - Designed by Devika - 2024</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
