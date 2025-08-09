<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    session_start();
    if (!isset($_SESSION["cid"])) {
        header("location: restricted.php");
        exit(1);
    }
    include("conn_db.php");
    include('head.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
            color: #212529;
        }

        #cart-body {
            flex-grow: 1;
        }

        .profile-card {
            border: none;
            border-radius: 15px;
            padding: 30px;
            background: linear-gradient(to right, #ffffff, #f8f9fa);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .profile-card h4 {
            font-weight: bold;
            color: #495057;
        }

        .profile-card dl dt {
            font-weight: 600;
            color: #6c757d;
        }

        .profile-card dl dd {
            font-size: 1rem;
        }

        .btn {
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            color: #fff;
        }

        .notibar {
            border-radius: 5px;
            margin-bottom: 20px;
        }

        footer {
            background: #343a40;
            color: #fff;
            padding: 15px;
            text-align: center;
            border-top: 2px solid #007bff;
        }

        footer a {
            color: #007bff;
        }

        @media (max-width: 768px) {
            .profile-card {
                padding: 20px;
            }

            .btn {
                font-size: 0.9rem;
            }
        }
    </style>
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <title>My Profile | Hamro Pasal</title>
</head>

<body>
    <!-- Navbar -->
    <?php include('nav_header.php') ?>

    <!-- Main Content -->
    <div class="container px-4 py-5 mt-4" id="cart-body">
        <!-- Go Back Link -->
        <div class="row mb-4">
            <a class="nav-item text-decoration-none text-muted mb-2" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>
        </div>

        <!-- Notifications -->
        <?php 
        if (isset($_GET["up_pwd"])) {
            $message = $_GET["up_pwd"] == 1 
                ? "<i class='bi bi-check-circle me-2'></i> Successfully updated your password!" 
                : "<i class='bi bi-x-circle me-2'></i> Failed to update your password.";
            $alertType = $_GET["up_pwd"] == 1 ? "alert-success" : "alert-danger";
            echo "<div class='alert $alertType alert-dismissible fade show notibar' role='alert'>
                    $message
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }

        if (isset($_GET["up_prf"])) {
            $message = $_GET["up_prf"] == 1 
                ? "<i class='bi bi-check-circle me-2'></i> Successfully updated your profile!" 
                : "<i class='bi bi-x-circle me-2'></i> Failed to update your profile.";
            $alertType = $_GET["up_prf"] == 1 ? "alert-success" : "alert-danger";
            echo "<div class='alert $alertType alert-dismissible fade show notibar' role='alert'>
                    $message
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }
        ?>

      <!-- Profile Header -->
<div class="row mb-4 justify-content-center">
    <div class="col-auto text-center">
        <h2 class="display-6"><i class="bi bi-person-circle me-2"></i> My Profile</h2>
    </div>
</div>

<!-- Profile Actions -->
<div class="row mb-4 justify-content-center">
    <div class="col-auto text-center">
        <a class="btn btn-outline-info me-2" href="cust_update_pwd.php">
            <i class="bi bi-key"></i> Change Password
        </a>
        <a class="btn btn-danger" href="cust_update_profile.php">
            <i class="bi bi-pencil-square"></i> Update My Profile
        </a>
    </div>
</div>


        <!-- Customer Information -->
        <?php
        $query = "SELECT c_username, c_firstname, c_lastname, c_email, c_gender, c_type 
                  FROM customer WHERE c_id = {$_SESSION['cid']} LIMIT 1";
        $result = $mysqli->query($query);
        $row = $result->fetch_array();
        ?>
        <div class="row">
            <div class="col-md-8 mx-auto profile-card">
                <h4 class="text-center mb-4">Profile Information</h4>
                <dl class="row">
                    <dt class="col-sm-4">Username</dt>
                    <dd class="col-sm-8"><?php echo $row["c_username"]; ?></dd>

                    <dt class="col-sm-4">Name</dt>
                    <dd class="col-sm-8"><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]; ?></dd>

                    <dt class="col-sm-4">Gender</dt>
                    <dd class="col-sm-8"><?php echo $row["c_gender"] == "M" ? "Male" : "Female"; ?></dd>

                    <dt class="col-sm-4">Role</dt>
                    <dd class="col-sm-8"><?php echo $row["c_type"] == "STD" ? "Student" : "Other"; ?></dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8"><?php echo $row["c_email"]; ?></dd>
                </dl>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php')?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
