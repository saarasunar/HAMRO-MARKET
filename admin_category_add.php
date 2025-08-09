<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        if($_SESSION["utype"] != "ADMIN") {
            header("location: ../restricted.php");
            exit(1);
        }
        if (isset($_POST["add_confirm"])) {
            $f_name = $_POST["f_name"];
            $s_id = $_POST["s_id"];
            $f_price = $_POST["f_price"];
            $f_qty = $_POST["f_qty"]; // Get product quantity
            $f_desc = $_POST["f_desc"]; // Get product description
        
            // Update the INSERT query to include f_qty and f_desc
            $insert_query = "INSERT INTO category (f_name, f_price, s_id, f_qty, f_desc) 
                             VALUES ('{$f_name}', {$f_price}, {$s_id}, {$f_qty}, '{$f_desc}');";
            $insert_result = $mysqli->query($insert_query);
        
            if (!empty($_FILES["f_pic"]["name"]) && $insert_result) {
                $f_id = $mysqli->insert_id;
                $target_dir = '/img/';
                $temp = explode(".", $_FILES["f_pic"]["name"]);
                $target_newfilename = $f_id . "_" . $s_id . "." . strtolower(end($temp));
                $target_file = $target_dir . $target_newfilename;
                if (move_uploaded_file($_FILES["f_pic"]["tmp_name"], SITE_ROOT . $target_file)) {
                    $insert_query = "UPDATE category SET f_pic = '{$target_newfilename}' WHERE f_id = {$f_id};";
                    $insert_result = $mysqli->query($insert_query);
                } else {
                    $insert_result = false;
                }
            }
            $redirect_location = $insert_result ? "admin_category_list.php?add_fdt=1" : "admin_category_list.php?add_fdt=0";
            header("location: {$redirect_location}");
            exit(1);
        }
        
        include('../head.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <title>Update Product Detail | Hamro Pasal</title>
</head>

<body class="d-flex flex-column h-100 bg-light">
    <?php include('nav_header_admin.php') ?>
<br><br>
    <div class="container my-5">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0">Add New Product</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="admin_category_add.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="s_id" class="form-label">Shop Name</label>
                        <select class="form-select" id="s_id" name="s_id" required>
                            <option selected value="">Select Shop</option>
                            <?php
                                $option_query = "SELECT s_id, s_name FROM shop;";
                                $option_result = $mysqli->query($option_query);
                                if ($option_result->num_rows != 0) {
                                    while ($option_arr = $option_result->fetch_array()) {
                                        echo "<option value='{$option_arr["s_id"]}'>{$option_arr["s_name"]}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="f_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter product name" required>
                    </div>
                    <div class="mb-3">
                        <label for="f_price" class="form-label">Price (NRP)</label>
                        <input type="number" step="0.25" min="0.00" max="99999999.75" class="form-control" id="f_price" name="f_price" placeholder="Enter price" required>
                    </div>
                    <div class="mb-3">
    <label for="f_qty" class="form-label">Product Quantity</label>
    <input type="number" class="form-control" id="f_qty" name="f_qty" placeholder="Enter quantity" min="1" max="999" required>
</div>
<div class="mb-3">
    <label for="f_desc" class="form-label">Product Description</label>
    <textarea class="form-control" id="f_desc" name="f_desc" rows="3" placeholder="Enter product description" required></textarea>
</div>

                    <div class="mb-3">
                        <label for="f_pic" class="form-label">Upload Product Image</label>
                        <input class="form-control" type="file" id="f_pic" name="f_pic" accept="image/*">
                    </div>
                    <button type="submit" name="add_confirm" class="btn btn-warning w-100">
                        <i class="bi bi-plus-circle me-2"></i>Add Product
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php include('admin_footer.php') ?>
</body>

</html>
