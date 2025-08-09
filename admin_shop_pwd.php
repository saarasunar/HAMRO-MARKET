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
        if(isset($_POST["rst_confirm"])){
            $s_id = $_POST["s_id"];
            $newpwd = $_POST["new_pwd"];
            $newcfpwd = $_POST["new_cfpwd"];
            if($newpwd != $newcfpwd){
                ?>
                    <script>
                        alert('The new passwords do not match. Please try again.');
                        history.back();
                    </script>
                <?php
                exit(1);
            }else{
                $query = "UPDATE shop SET s_pwd = '{$newpwd}' WHERE s_id = {$s_id}";
                $result = $mysqli -> query($query);
                if($result){
                    header("location: admin_shop_detail.php?s_id={$s_id}&up_pwd=1");
                }else{
                    header("location: admin_shop_detail.php?s_id={$s_id}&up_pwd=0");
                }
            }
        }
        include('../head.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <title>Update Shop Password | Hamro Pasal</title>
    <style>
        .form-container {
            max-width: 500px;
            margin: auto;
        }

        .form-container h2 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .btn-custom {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #218838;
        }
    </style>
</head>

<body class="d-flex flex-column h-100 bg-light">
    <?php include('nav_header_admin.php'); ?>
    <br><br><br><br>
    <div class="container form-container my-auto">
        <form method="POST" action="admin_shop_pwd.php" class="shadow p-4 bg-white rounded">
            <h2 class="mb-4"><i class="bi bi-key me-2"></i>Update Shop Password</h2>

            <div class="form-floating mb-3 position-relative">
    <input type="password" class="form-control" id="new_pwd" minlength="8" maxlength="45" 
        placeholder="New Password" name="new_pwd" required>
    <label for="new_pwd">New Password</label>
    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" 
       id="toggleNewPwd" style="cursor: pointer;"></i>
</div>

<div class="form-floating mb-3 position-relative">
    <input type="password" class="form-control" id="confirm_new_pwd" minlength="8" maxlength="45" 
        placeholder="Confirm New Password" name="new_cfpwd" required>
    <label for="confirm_new_pwd">Confirm New Password</label>
    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" 
       id="toggleConfirmPwd" style="cursor: pointer;"></i>
    <div id="passwordHelpBlock" class="form-text text-muted">
        Password must be at least 8 characters long.
    </div>
</div>

            <input type="hidden" name="s_id" value="<?php echo $_GET['s_id']; ?>">

            <button class="btn btn-warning w-100" name="rst_confirm" type="submit" 
                onclick="return confirm('Do you want to update this shop password?');">
                Update Password
            </button>
        </form>
    </div>

    <?php include('admin_footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
<script>
    // Toggle visibility for New Password
    document.getElementById('toggleNewPwd').addEventListener('click', function () {
        const newPwd = document.getElementById('new_pwd');
        if (newPwd.type === 'password') {
            newPwd.type = 'text';
            this.classList.remove('bi-eye-slash');
            this.classList.add('bi-eye');
        } else {
            newPwd.type = 'password';
            this.classList.remove('bi-eye');
            this.classList.add('bi-eye-slash');
        }
    });

    // Toggle visibility for Confirm New Password
    document.getElementById('toggleConfirmPwd').addEventListener('click', function () {
        const confirmPwd = document.getElementById('confirm_new_pwd');
        if (confirmPwd.type === 'password') {
            confirmPwd.type = 'text';
            this.classList.remove('bi-eye-slash');
            this.classList.add('bi-eye');
        } else {
            confirmPwd.type = 'password';
            this.classList.remove('bi-eye');
            this.classList.add('bi-eye-slash');
        }
    });
</script>
</body>

</html>
