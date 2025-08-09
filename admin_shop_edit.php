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
            $s_name = $_POST["s_name"];
            $s_username = $_POST["s_username"];
            $s_location = $_POST["s_location"];
            $s_email = $_POST["s_email"];
            $s_phoneno = $_POST["s_phoneno"];
            $s_desc = $_POST["s_desc"]; // Get shop description
        
            $update_query = "UPDATE shop 
                             SET s_username = '{$s_username}', 
                                 s_name = '{$s_name}', 
                                 s_location = '{$s_location}', 
                                 s_email = '{$s_email}', 
                                 s_phoneno = '{$s_phoneno}', 
                                 s_desc = '{$s_desc}' 
                             WHERE s_id = {$s_id};";
            $update_result = $mysqli->query($update_query);
        
            if (!empty($_FILES["s_pic"]["name"])) {
                // Handle image upload
                $target_dir = '/img/';
                $temp = explode(".", $_FILES["s_pic"]["name"]);
                $target_newfilename = "shop" . $s_id . "." . strtolower(end($temp));
                $target_file = $target_dir . $target_newfilename;
                if (move_uploaded_file($_FILES["s_pic"]["tmp_name"], SITE_ROOT . $target_file)) {
                    $update_query = "UPDATE shop SET s_pic = '{$target_newfilename}' WHERE s_id = {$s_id};";
                    $update_result = $mysqli->query($update_query);
                } else {
                    $update_result = false;
                }
            }
        
            if ($update_result) {
                header("location: admin_shop_list.php?up_spf=1");
            } else {
                header("location: admin_shop_list.php?up_spf=0");
            }
            exit(1);
        }
        
        include('../head.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <title>Update Shop Information | Hamro Pasal</title>
</head>

<body class="d-flex flex-column h-100 bg-light">
    <?php include('nav_header_admin.php'); ?>
    <br><br>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-warning text-white d-flex align-items-center">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Update Shop Information</h5>
            </div>
            <div class="card-body">

                <?php 
                    $s_id = $_GET["s_id"];
                    $query = "SELECT s_username, s_name, s_location, s_email, s_phoneno FROM shop WHERE s_id = {$s_id} LIMIT 0,1";
                    $result = $mysqli->query($query);
                    $row = $result->fetch_array();
                ?>

                <form method="POST" action="admin_shop_edit.php" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="shopusername" name="s_username" value="<?php echo $row["s_username"]; ?>" required>
                                <label for="shopusername">Username</label>
                                <div class="invalid-feedback">Please provide a valid username.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="shopname" name="s_name" value="<?php echo $row["s_name"]; ?>" required>
                                <label for="shopname">Shop Name</label>
                                <div class="invalid-feedback">Please provide the shop name.</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="s_email" value="<?php echo $row["s_email"]; ?>" required>
                        <label for="email">Email Address</label>
                        <div class="invalid-feedback">Please provide a valid email address.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="shoplocation" name="s_location" value="<?php echo $row["s_location"]; ?>" required>
                                <label for="shoplocation">Shop Location</label>
                                <div class="invalid-feedback">Please provide the shop location.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="shopphoneno" name="s_phoneno" value="<?php echo $row["s_phoneno"]; ?>" required>
                                <label for="shopphoneno">Phone Number</label>
                                <div class="invalid-feedback">Please provide a valid phone number.</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
    <textarea class="form-control" id="shopdesc" name="s_desc" rows="3" required><?php echo $row["s_desc"] ?? ''; ?></textarea>
    <label for="shopdesc">Shop Description</label>
    <div class="invalid-feedback">Please provide a description of the shop.</div>
</div>

                    <div class="mb-3">
                        <label for="s_pic" class="form-label">Upload Shop Image</label>
                        <input class="form-control" type="file" id="s_pic" name="s_pic" accept="image/*">
                    </div>

                    <input type="hidden" name="s_id" value="<?php echo $s_id; ?>">
                    <button class="btn btn-danger w-100" name="upd_confirm" type="submit">Update Shop</button>
                </form>
            </div>
        </div>
    </div><br>

    <?php include('admin_footer.php'); ?>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>

</html>
