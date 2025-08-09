<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        include("conn_db.php"); 

        if (!isset($_SESSION["cid"])) {
            header("location: restricted.php");
            exit(1);
        }

        if (isset($_POST["upd_confirm"])) {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $gender = $_POST["gender"];
            $type = $_POST["type"];

            $query = "UPDATE customer 
                      SET c_firstname = '{$firstname}', 
                          c_lastname = '{$lastname}', 
                          c_email = '{$email}', 
                          c_gender = '{$gender}', 
                          c_type = '{$type}' 
                      WHERE c_id = {$_SESSION['cid']}";

            $result = $mysqli->query($query);
            if ($result) {
                $_SESSION["firstname"] = $firstname;
                $_SESSION["lastname"] = $lastname;
                header("location: cust_profile.php?up_prf=1");
            } else {
                header("location: cust_profile.php?up_prf=0");
            }
            exit(1);
        }

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
        }

        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        footer {
            background: #f8f9fa;
            padding: 10px;
            text-align: center;
            margin-top: auto;
            border-top: 1px solid #ddd;
        }
    </style>
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <title>Update Profile | Hamro Pasal</title>
</head>

<body>
    <!-- Navbar -->
    <?php include('nav_header.php') ?>
<br><br><br>
    <!-- Update Profile Form -->
    <div class="container mt-5">
        <div class="form-container">

            <?php 
                $query = "SELECT c_firstname, c_lastname, c_email, c_gender, c_type 
                          FROM customer 
                          WHERE c_id = {$_SESSION['cid']} LIMIT 1";
                $result = $mysqli->query($query);
                $row = $result->fetch_array();
            ?>

            <form method="POST" action="cust_update_profile.php" class="needs-validation" novalidate>
                <h2 class="text-center mb-4"><i class="bi bi-pencil-square"></i> Update Profile</h2>

                <!-- First Name -->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" 
                           value="<?php echo $row['c_firstname']; ?>" required>
                    <label for="firstname">First Name</label>
                    <div class="invalid-feedback">Please provide your first name.</div>
                </div>

                <!-- Last Name -->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" 
                           value="<?php echo $row['c_lastname']; ?>" required>
                    <label for="lastname">Last Name</label>
                    <div class="invalid-feedback">Please provide your last name.</div>
                </div>

                <!-- Email -->
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" 
                           value="<?php echo $row['c_email']; ?>" required>
                    <label for="email">Email</label>
                    <div class="invalid-feedback">Please provide a valid email address.</div>
                </div>

                <!-- Gender -->
                <div class="form-floating mb-3">
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="M" <?php if ($row['c_gender'] == 'M') echo 'selected'; ?>>Male</option>
                        <option value="F" <?php if ($row['c_gender'] == 'F') echo 'selected'; ?>>Female</option>
                    </select>
                    <label for="gender">Gender</label>
                    <div class="invalid-feedback">Please select your gender.</div>
                </div>

                <!-- Role -->
                <div class="form-floating mb-4">
                    <select class="form-select" id="type" name="type" required>
                        <option value="STD" <?php if ($row['c_type'] == 'STD') echo 'selected'; ?>>Student</option>
                    </select>
                    <label for="type">Role</label>
                    <div class="invalid-feedback">Please select your role.</div>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="upd_confirm" class="btn btn-warning w-100">Update Profile</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php')?>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Bootstrap Form Validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>
