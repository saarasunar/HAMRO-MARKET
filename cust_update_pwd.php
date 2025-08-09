<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        include("conn_db.php"); 

        if(!isset($_SESSION["cid"])){
            header("location: restricted.php");
            exit(1);
        }

        if(isset($_POST["rst_confirm"])){
            $oldpwd = $_POST["old_pwd"];
            $newpwd = $_POST["new_pwd"];
            $newcfpwd = $_POST["new_cfpwd"];
            if($newpwd != $newcfpwd){
                ?>
                    <script>
                        alert('Your new password does not match.\nPlease re-enter again.');
                        history.back();
                    </script>
                <?php
                exit(1);
            }else{
                $query = "SELECT c_pwd FROM customer WHERE c_id = {$_SESSION['cid']} LIMIT 1";
                $result = $mysqli -> query($query);
                $row = $result -> fetch_array();
                if($oldpwd == $row["c_pwd"]){
                    $query = "UPDATE customer SET c_pwd = '{$newpwd}' WHERE c_id = {$_SESSION['cid']}";
                    $result = $mysqli -> query($query);
                    if($result){
                        header("location: cust_profile.php?up_pwd=1");
                    }else{
                        header("location: cust_profile.php?up_pwd=0");
                    }
                }else{
                    ?>
                    <script>
                        alert('Your old password is incorrect.\nPlease try again.');
                        history.back();
                    </script>
                    <?php
                    exit(1);
                }
            }
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
            background-color: #f4f4f9;
        }

        .form-container {
            max-width: 500px;
            margin: auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background: #f8f9fa;
            padding: 15px;
            text-align: center;
            margin-top: auto;
            border-top: 1px solid #ddd;
        }

        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .form-control:focus {
            border-color: #495057;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <title>Update Password | Hamro Pasal</title>
</head>

<body>
    <!-- Navbar -->
    <?php include('nav_header.php')?>
<br><br><br>
    <!-- Password Update Form -->
    <div class="container mt-5">
        <div class="form-container">

            <form method="POST" action="cust_update_pwd.php" class="needs-validation" novalidate>
                <h2 class="text-center mb-4"><i class="bi bi-key me-2"></i>Update Password</h2>

            <!-- Old Password -->
<div class="form-floating mb-3 position-relative">
    <input type="password" class="form-control" id="old_pwd" name="old_pwd" placeholder="Old Password" minlength="8" maxlength="45" required>
    <label for="old_pwd">Old Password</label>
    <div class="invalid-feedback">Please enter your old password.</div>
    <span id="toggleOldPwd" class="position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
        <i class="bi bi-eye"></i>
    </span>
</div>

<!-- New Password -->
<div class="form-floating mb-3 position-relative">
    <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="New Password" minlength="8" maxlength="45" required>
    <label for="new_pwd">New Password</label>
    <div class="invalid-feedback">Please enter your new password.</div>
    <span id="toggleNewPwd" class="position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
        <i class="bi bi-eye"></i>
    </span>
</div>

<!-- Confirm New Password -->
<div class="form-floating mb-3 position-relative">
    <input type="password" class="form-control" id="new_cfpwd" name="new_cfpwd" placeholder="Confirm New Password" minlength="8" maxlength="45" required>
    <label for="new_cfpwd">Confirm New Password</label>
    <div class="form-text">Your password must be at least 8 characters long.</div>
    <span id="toggleNewCfpwd" class="position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
        <i class="bi bi-eye"></i>
    </span>
</div>


                <!-- Submit Button -->
                <button type="submit" name="rst_confirm" class="btn btn-warning w-100" onclick="return confirm('Do you want to update your password?');">
                    Update Password
                </button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php')?>

    <script>
    // Function to toggle password visibility
    function toggleVisibility(toggleIcon, inputField) {
        const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
        inputField.setAttribute('type', type);
        toggleIcon.innerHTML = type === 'text' 
            ? '<i class="bi bi-eye-slash"></i>' 
            : '<i class="bi bi-eye"></i>';
    }

    // Add event listeners for toggle icons
    document.getElementById('toggleOldPwd').addEventListener('click', function () {
        toggleVisibility(this, document.getElementById('old_pwd'));
    });
    document.getElementById('toggleNewPwd').addEventListener('click', function () {
        toggleVisibility(this, document.getElementById('new_pwd'));
    });
    document.getElementById('toggleNewCfpwd').addEventListener('click', function () {
        toggleVisibility(this, document.getElementById('new_cfpwd'));
    });
</script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Bootstrap Form Validation
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
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
