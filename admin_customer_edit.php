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
            $c_id = $_POST["c_id"];
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $gender = $_POST["gender"];
            $type = $_POST["type"];

            $query = "UPDATE customer SET c_firstname = '{$firstname}', c_lastname = '{$lastname}', c_email = '{$email}', c_gender = '{$gender}', c_type = '{$type}' WHERE c_id = {$c_id}";
            $result = $mysqli->query($query);
            if ($result) {
                header("location: admin_customer_list.php?up_prf=1");
            } else {
                header("location: admin_customer_list.php?up_prf=0");
            }
            exit(1);
        }
        include('../head.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <title>Update Profile | Hamro Pasal</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-floating label {
            font-size: 14px;
        }
      
    </style>
</head>

<body>
    <?php include('nav_header_admin.php'); ?>
<br><br><br><br>
    <div class="container form-container">
        <?php 
            $c_id = $_GET["c_id"];
            $query = "SELECT c_firstname, c_lastname, c_email, c_gender, c_type FROM customer WHERE c_id = {$c_id} LIMIT 1";
            $result = $mysqli->query($query);
            $row = $result->fetch_array();
        ?>
        <form method="POST" action="admin_customer_edit.php" class="form-floating">
            <div class="form-title"><i class="bi bi-pencil-square me-2"></i>Update Profile</div>
            
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row["c_firstname"]; ?>" required>
                <label for="firstname">First Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row["c_lastname"]; ?>" required>
                <label for="lastname">Last Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row["c_email"]; ?>" required>
                <label for="email">E-mail</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="gender" name="gender" required>
                    <option value="M" <?php echo $row["c_gender"] == "M" ? "selected" : ""; ?>>Male</option>
                    <option value="F" <?php echo $row["c_gender"] == "F" ? "selected" : ""; ?>>Female</option>
                </select>
                <label for="gender">Gender</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="type" name="type" required>
                    <option value="CUS" <?php echo $row["c_type"] == "CUS" ? "selected" : ""; ?>>Regular_Customer</option>
                    <option value="ADM" <?php echo $row["c_type"] == "ADM" ? "selected" : ""; ?>>Admin</option>
                  
                </select>
                <label for="type">Role</label>
            </div>

            <input type="hidden" name="c_id" value="<?php echo $c_id; ?>">
            <button type="submit" class="w-100 btn btn-info" name="upd_confirm">Update Profile</button>
        </form>
    </div>

    <?php include('admin_footer.php'); ?>
</body>

</html>
