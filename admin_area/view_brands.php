<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Brands</title>
    <link rel="icon" href="../images/favicon.png" sizes="360x360" type="image/x-icon"> <!-- Add this line for favicon -->

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .btn-black {
            background-color: black;
            color: white;
            border: none;
        }
        .btn-black:hover {
            background-color: #333;
            color: white;
        }
        .text-light {
            color: #fff;
        }
    </style>
</head>
<body>

<h1 class="text-center">All Brands</h1>
<table class="table table-bordered mt-5">
    <thead class="bg-dark text-light">
        <tr class="text-center">
            <th>Sl no</th>
            <th>Brand Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $select_cat = "SELECT * FROM `brands`";
        $result = mysqli_query($con, $select_cat);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $brand_id = $row['brand_id'];
            $brand_title = $row['brand_title'];
            $number++;
        ?>
        <tr class="text-center">
            <td><?php echo $number; ?></td>
            <td><?php echo $brand_title; ?></td>
            <td>
                <a href="index.php?edit_brand=<?php echo $brand_id ?>" class="btn btn-black">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
            </td>
            <td>
                <button class="btn btn-black" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $brand_id; ?>">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Are you sure you want to delete this brand?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a href="#" id="confirmDelete" class="btn btn-black">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Set the data-id attribute of the confirm delete button
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var brandId = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('#confirmDelete').attr('href', 'index.php?delete_brand=' + brandId);
    });
</script>

</body>
</html>
