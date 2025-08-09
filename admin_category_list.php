<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        include('../head.php');
        if ($_SESSION["utype"] != "ADMIN") {
            header("location: ../restricted.php");
            exit(1);
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <link href="../css/main.css" rel="stylesheet">
    <title>Products List | Hamro Pasal</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php') ?>

    <br><br><br><br>
    
    <div class="container py-4">

        <!-- Notification Bar -->
        <?php
        if (isset($_GET["dsb_fdt"])) {
            if ($_GET["dsb_fdt"] == 1) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> Successfully removed Product.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle"></i> Failed to remove Product.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }

        if (isset($_GET["add_fdt"])) {
            if ($_GET["add_fdt"] == 1) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> Successfully added a new Product.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle"></i> Failed to add a new Product.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
        ?>

        <!-- Page Title -->
        <h2 class="mb-4">Category List</h2>

        <!-- Search and Filters -->
        <form class="row gy-3 mb-4" method="GET" action="admin_category_list.php">
            <div class="col-md-4">
                <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Search by Product Name"
                    value="<?php echo isset($_GET['f_name']) ? $_GET['f_name'] : ''; ?>">
            </div>
            <div class="col-md-4">
                <select class="form-select" id="s_id" name="s_id">
                    <option value="" selected>Filter by Shop</option>
                    <?php
                    $option_query = "SELECT s_id, s_name FROM shop;";
                    $option_result = $mysqli->query($option_query);
                    while ($option = $option_result->fetch_assoc()) {
                        $selected = isset($_GET['s_id']) && $_GET['s_id'] == $option['s_id'] ? 'selected' : '';
                        echo "<option value='{$option['s_id']}' $selected>{$option['s_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 d-flex justify-content-start align-items-center gap-2">
                <button type="submit" name="search" value="1" class="btn btn-success">
                    <i class="bi bi-search"></i> Search
                </button>
                <a href="admin_category_list.php" class="btn btn-danger">
                    <i class="bi bi-x-circle"></i> Clear
                </a>
                <a href="admin_category_add.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add Product
                </a>
            </div>
        </form>

        <!-- Product Table -->
        <?php
        if (!isset($_GET["search"])) {
            $search_query = "SELECT f.f_id, s.s_id, f.f_name, f.f_price, s.s_name 
                             FROM category f 
                             INNER JOIN shop s ON f.s_id = s.s_id 
                             ORDER BY f.f_price DESC, f.s_id ASC;";
        } else {
            $search_fn = $_GET['f_name'];
            $search_sid = $_GET['s_id'];
            $sid_clause = $search_sid ? "AND f.s_id = $search_sid" : '';
            $search_query = "SELECT f.f_id, s.s_id, f.f_name, f.f_price, s.s_name 
                             FROM category f 
                             INNER JOIN shop s ON f.s_id = s.s_id 
                             WHERE f.f_name LIKE '%$search_fn%' $sid_clause 
                             ORDER BY f.f_price DESC, f.s_id ASC;";
        }

        $search_result = $mysqli->query($search_query);
        if ($search_result->num_rows == 0) {
            echo '<div class="alert alert-warning" role="alert">
                <i class="bi bi-exclamation-circle"></i> No Product items found! 
                <a href="admin_category_list.php" class="text-decoration-none">Clear Search</a>
            </div>';
        } else {
        ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Shop Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        while ($row = $search_result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['f_name']; ?></td>
                                <td><?php echo $row['s_name']; ?></td>
                                <td><?php echo $row['f_price'] . " NRP"; ?></td>
                                <td>
                                    <a href="admin_category_detail.php?f_id=<?php echo $row['f_id']; ?>" class="btn btn-sm btn-primary">View</a>
                                    <a href="admin_category_edit.php?s_id=<?php echo $row['s_id']; ?>&f_id=<?php echo $row['f_id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                    <a href="admin_category_delete.php?f_id=<?php echo $row['f_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>

    <?php include('admin_footer.php'); ?>
</body>

</html>
