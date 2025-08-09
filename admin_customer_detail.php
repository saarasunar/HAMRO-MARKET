<!DOCTYPE html>
<html lang="en">

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
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <title>Customer Profile | Hamro Pasal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .notibar {
            max-width: 600px;
            margin: 10px auto;
        }

        .btn {
            border-radius: 50px;
            padding: 8px 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .btn-outline-secondary {
            color: #6c757d;
        }

        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        dl dt {
            font-weight: bold;
        }

        dl dd {
            margin-bottom: 10px;
            color: #495057;
        }

        h2 {
            color: #343a40;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<br>
<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php') ?>
<br><br><br>
    <div class="container px-5 py-4 mt-5">
        <div class="row pb-3 border-bottom">
            <?php 
            if (isset($_GET["up_pwd"])) {
                if ($_GET["up_pwd"] == 1) {
            ?>
            <!-- START SUCCESSFULLY UPDATE PASSWORD -->
            <div class="alert alert-success notibar">
                <i class="bi bi-check-circle me-2"></i> Successfully updated customer password!
            </div>
            <!-- END SUCCESSFULLY UPDATE PASSWORD -->
            <?php } else { ?>
            <!-- START FAILED UPDATE PASSWORD -->
            <div class="alert alert-danger notibar">
                <i class="bi bi-x-circle me-2"></i> Failed to update customer password.
            </div>
            <!-- END FAILED UPDATE PASSWORD -->
            <?php }
            }
            ?>

<!-- Notification Messages -->
<?php if(isset($_GET["del_cst"])): ?>
    <div class="alert alert-<?php echo $_GET["del_cst"] == 1 ? "success" : ($_GET["del_cst"] == "admin" ? "warning" : "danger"); ?> d-flex align-items-center" role="alert">
        <i class="bi <?php echo $_GET["del_cst"] == 1 ? "bi-check-circle-fill" : ($_GET["del_cst"] == "admin" ? "bi-exclamation-circle-fill" : "bi-x-circle-fill"); ?> me-2"></i>
        <div>
            <?php 
            if ($_GET["del_cst"] == 1) {
                echo "Customer account deleted successfully.";
            } elseif ($_GET["del_cst"] == "admin") {
                echo "Admin account cannot be deleted.";
            } else {
                echo "Failed to delete customer account.";
            }
            ?>
        </div>
    </div>
<?php endif; ?>

            <h2 class="pt-3"><i class="bi bi-person-circle me-2"></i>Customer Profile</h2>
        </div>
<br>
        <div class="d-flex gap-2 mb-4">
            <a class="btn btn-primary" href="admin_customer_edit.php?c_id=<?php echo $_GET["c_id"] ?>">
                <i class="bi bi-pencil-square"></i> Update Profile
            </a>
            <a class="btn btn-danger" href="admin_customer_delete.php?c_id=<?php echo $_GET["c_id"] ?>">
                <i class="bi bi-trash"></i> Delete Profile
            </a>
        </div>

        <!-- START CUSTOMER INFORMATION -->
        <?php
        $cid = $_GET["c_id"];
        $query = "SELECT c_username, c_firstname, c_lastname, c_email, c_gender, c_type 
                  FROM customer WHERE c_id = {$cid} LIMIT 1";
        $result = $mysqli->query($query);
        $row = $result->fetch_array();
        ?>
        <div class="card">
            <dl class="row">
                <dt class="col-sm-3">Username</dt>
                <dd class="col-sm-9"><?php echo $row["c_username"]; ?></dd>

                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9"><?php echo $row["c_firstname"] . " " . $row["c_lastname"]; ?></dd>

                <dt class="col-sm-3">Gender</dt>
                <dd class="col-sm-9"><?php echo ($row["c_gender"] == "M" ? "Male" : "Female"); ?></dd>

                <dt class="col-sm-3">Account Type</dt>
                <dd class="col-sm-9">
                    <?php 
                    $types = [
                        "STD" => "Student",
                        "STF" => "Faculty Staff",
                        "GUE" => "Guest",
                        "ADM" => "Admin",
                    ];
                    echo $types[$row["c_type"]] ?? "Others";
                    ?>
                </dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9"><?php echo $row["c_email"]; ?></dd>
            </dl>
        </div>
        <!-- END CUSTOMER INFORMATION -->
    </div>
    <?php include('admin_footer.php') ?>
</body>

</html>
