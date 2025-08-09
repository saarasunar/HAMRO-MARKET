<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    include("../conn_db.php");
    if ($_SESSION["utype"] != "ADMIN") {
        header("location: ../restricted.php");
        exit(1);
    }
    if (isset($_POST["upd_confirm"])) {
        $s_id = $_POST["s_id"];
        $f_id = $_POST["f_id"];
        $f_name = $_POST["f_name"];
        $f_price = $_POST["f_price"];
        $f_qty = $_POST["f_qty"]; // Get product quantity
        $f_desc = $_POST["f_desc"]; // Get product description
    
        // Update query to include f_qty and f_desc
        $update_query = "UPDATE category 
                         SET f_name = '{$f_name}', 
                             f_price = '{$f_price}', 
                             f_qty = '{$f_qty}', 
                             f_desc = '{$f_desc}' 
                         WHERE f_id = {$f_id};";
        $update_result = $mysqli->query($update_query);
    
        if (!empty($_FILES["f_pic"]["name"])) {
            $target_dir = '/img/';
            $temp = explode(".", $_FILES["f_pic"]["name"]);
            $target_newfilename = $f_id . "_" . $s_id . "." . strtolower(end($temp));
            $target_file = $target_dir . $target_newfilename;
            if (move_uploaded_file($_FILES["f_pic"]["tmp_name"], SITE_ROOT . $target_file)) {
                $update_query = "UPDATE category SET f_pic = '{$target_newfilename}' WHERE f_id = {$f_id};";
                $update_result = $mysqli->query($update_query);
            } else {
                $update_result = false;
            }
        }
    
        if ($update_result) {
            header("location: admin_category_detail.php?f_id={$f_id}&up_fdt=1");
        } else {
            header("location: admin_category_detail.php?f_id={$f_id}&up_fdt=0");
        }
        exit(1);
    }
    
    include('../head.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Category Details | Hamro Pasal</title>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">
    <?php include('nav_header_admin.php'); ?>
    <br><br>
    <div class="container mt-5 mb-auto">
        <div class="card shadow-lg">
            <div class="card-header bg-warning text-white">
                <h3 class="card-title"><i class="bi bi-pencil-square me-2"></i>Update Product Details</h3>
            </div>
            <div class="card-body">
                <?php
                $f_id = $_GET["f_id"];
                $query = "SELECT * FROM category WHERE f_id = {$f_id} LIMIT 1";
                $result = $mysqli->query($query);
                $row = $result->fetch_array();
                ?>
                <form method="POST" action="admin_category_edit.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="f_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter menu name"
                            value="<?php echo $row['f_name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="f_price" class="form-label">Price (NPR)</label>
                        <input type="number" step="0.25" min="0.00" max="999.75" class="form-control" id="f_price"
                            name="f_price" placeholder="Enter price" value="<?php echo $row['f_price']; ?>" required>
                    </div>
                    <div class="mb-3">
    <label for="f_qty" class="form-label">Product Quantity</label>
    <input type="number" class="form-control" id="f_qty" name="f_qty" placeholder="Enter quantity (max 999)"
        min="1" max="999" value="<?php echo $row['f_qty'] ?? ''; ?>" required>
</div>
<div class="mb-3">
    <label for="f_desc" class="form-label">Product Description</label>
    <textarea class="form-control" id="f_desc" name="f_desc" rows="3"
        placeholder="Enter product description" required><?php echo $row['f_desc'] ?? ''; ?></textarea>
</div>

                    <div class="mb-3">
                        <label for="f_pic" class="form-label">Upload Product Image</label>
                        <input type="file" class="form-control" id="f_pic" name="f_pic" accept="image/*">
                    </div>
                    <input type="hidden" name="s_id" value="<?php echo $s_id; ?>">
                    <input type="hidden" name="f_id" value="<?php echo $f_id; ?>">
                    <button type="submit" name="upd_confirm" class="btn btn-danger w-100">Update Product</button>
                </form>
            </div>
        </div>
    </div><br>

    <?php include('admin_footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
