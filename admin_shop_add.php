<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        if($_SESSION["utype"]!="ADMIN"){
            header("location: ../restricted.php");
            exit(1);
        }
        if (isset($_POST["add_confirm"])) {
            $s_name = $_POST["s_name"];
            $s_username = $_POST["s_username"];
            $s_location = $_POST["s_location"];
            $s_email = $_POST["s_email"];
            $s_phoneno = $_POST["s_phoneno"];
            $s_pwd = $_POST["s_pwd"];
            $s_desc = $_POST["s_desc"]; // Get shop description
        
            // Update the INSERT query to include s_desc
            $insert_query = "INSERT INTO shop (s_username, s_name, s_pwd, s_location, s_email, s_phoneno, s_desc) 
            VALUES ('{$s_username}', '{$s_name}', '{$s_pwd}', '{$s_location}', '{$s_email}', '{$s_phoneno}', '{$s_desc}');";
            
            $insert_result = $mysqli->query($insert_query);
        
            // Handle image upload (remains the same)
            if (!empty($_FILES["s_pic"]["name"]) && $insert_result) {
                $s_id = $mysqli->insert_id;
                $target_dir = '/img/';
                $temp = explode(".", $_FILES["s_pic"]["name"]);
                $target_newfilename = "shop" . $s_id . "." . strtolower(end($temp));
                $target_file = $target_dir . $target_newfilename;
                if (move_uploaded_file($_FILES["s_pic"]["tmp_name"], SITE_ROOT . $target_file)) {
                    $insert_query = "UPDATE shop SET s_pic = '{$target_newfilename}' WHERE s_id = {$s_id};";
                    $insert_result = $mysqli->query($insert_query);
                } else {
                    $insert_result = false;
                }
            }
            if ($insert_result) {
                header("location: admin_shop_list.php?add_shp=1");
            } else {
                header("location: admin_shop_list.php?add_shp=0");
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
    <title>Add new shop | Hamro Pasal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php')?>
    <br><br><br>
    <div class="container my-5">
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-header bg-warning text-white text-center">
            <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Add New Shop</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="admin_shop_add.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="shopusername" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="shopusername" name="s_username" placeholder="Enter username" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="shopname" class="form-label">Shop Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-shop"></i></span>
                        <input type="text" class="form-control" id="shopname" name="s_name" placeholder="Enter shop name" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="shoppwd" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="shoppwd" name="s_pwd" placeholder="Enter password" minlength="8" maxlength="45" required>
                    </div>
                    <div id="passwordHelpBlock" class="form-text">
                        Your password must be at least 8 characters long.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="shopcfpwd" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control" id="shopcfpwd" name="cfpwd" placeholder="Confirm password" minlength="8" maxlength="45" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="s_email" placeholder="Enter email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="shoplocation" class="form-label">Shop Location</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" class="form-control" id="shoplocation" name="s_location" placeholder="Enter shop location" required>
                    </div>
                </div>
                <div class="mb-3">
    <label for="shopdesc" class="form-label">Shop Description</label>
    <textarea class="form-control" id="shopdesc" name="s_desc" rows="3" placeholder="Enter shop description" required></textarea>
</div>

                <div class="mb-3">
                    <label for="shopphoneno" class="form-label">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        <input type="text" class="form-control" id="shopphoneno" name="s_phoneno" placeholder="Enter phone number" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="s_pic" class="form-label">Upload Shop Image</label>
                    <input class="form-control" type="file" id="s_pic" name="s_pic" accept="image/*">
                </div>
                <button type="submit" name="add_confirm" class="btn btn-danger w-100">
                    <i class="bi bi-plus-circle me-2"></i>Add New Shop
                </button>
            </form>
        </div>
    </div>
</div>


    <?php include('admin_footer.php')?>
</body>

</html>