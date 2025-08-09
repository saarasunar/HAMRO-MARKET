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
        if (isset($_POST["rst_confirm"])) {
            $c_id = $_POST["c_id"];
            $newpwd = $_POST["new_pwd"];
            $newcfpwd = $_POST["new_cfpwd"];
            if ($newpwd != $newcfpwd) {
                ?>
                <script>
                    alert('Your new password does not match. Please re-enter.');
                    history.back();
                </script>
                <?php
                exit(1);
            } else {
                $query = "UPDATE customer SET c_pwd = '{$newpwd}' WHERE c_id = {$c_id}";
                $result = $mysqli->query($query);
                if ($result) {
                    header("location: admin_customer_detail.php?c_id={$c_id}&up_pwd=1");
                } else {
                    header("location: admin_customer_detail.php?c_id={$c_id}&up_pwd=0");
                }
            }
        }
        include('../head.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <title>Update Customer Password | Hamro Pasal</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 2rem auto;
        }
        .form-header {
            text-align: center;
            margin-bottom: 1rem;
        }
        .form-header h2 {
            font-size: 1.8rem;
            color: #343a40;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .form-text {
            font-size: 0.85rem;
        }
        @media (max-width: 576px) {
            .form-container {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <?php include('nav_header_admin.php') ?>

    <br><br><br><br>
    <div class="container form-container">
        <a class="text-decoration-none text-muted" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go Back
        </a>
        <div class="form-header">
            <h2><i class="bi bi-key me-2"></i>Update Customer Password</h2>
        </div>
        <form method="POST" action="admin_customer_pwd.php">
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="new_pwd" name="new_pwd" minlength="8" maxlength="45" placeholder="New Password" required>
                <label for="new_pwd">New Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="new_cfpwd" name="new_cfpwd" minlength="8" maxlength="45" placeholder="Confirm New Password" required>
                <label for="new_cfpwd">Confirm New Password</label>
                <div class="form-text">
                    Password must be at least 8 characters long.
                </div>
            </div>
            <input type="hidden" name="c_id" value="<?php echo $_GET['c_id']; ?>">
            <button class="btn btn-success w-100" type="submit" name="rst_confirm" onclick="return confirm('Do you want to update this customer password?');">
                Update Password
            </button>
        </form>
    </div>

    <?php include('admin_footer.php') ?>
</body>

</html>
