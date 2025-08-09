<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start();
    include ("conn_db.php");
    include ('head.php'); ?>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Customer Registration | Hamro Pasal</title>
</head>

<body class="d-flex flex-column">
<?php include ('nav_header.php') ?>
    <div class="container mt-5 d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%; border-radius: 15px;">
        <form method="POST" action="add_cust.php">
            <h2 class="text-center mb-4 fw-bold">
                <i class="bi bi-person-plus me-2"></i>Sign Up
            </h2>
            <!-- Username -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" placeholder="Username" name="username" minlength="5" maxlength="45" required>
                <label for="username">Username</label>
            </div>
          <!-- Password -->
<div class="form-floating mb-3 position-relative">
    <input type="password" class="form-control" id="pwd" placeholder="Password" name="pwd" minlength="8" maxlength="45" required>
    <label for="pwd">Password</label>
    <!-- Eye icon for toggling password visibility -->
    <span id="togglePwd" class="position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
        <i class="bi bi-eye"></i>
    </span>
</div>

<!-- Confirm Password -->
<div class="form-floating mb-3 position-relative">
    <input type="password" class="form-control" id="cfpwd" placeholder="Confirm Password" name="cfpwd" minlength="8" maxlength="45" required>
    <label for="cfpwd">Confirm Password</label>
    <!-- Eye icon for toggling confirm password visibility -->
    <span id="toggleCfpwd" class="position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
        <i class="bi bi-eye"></i>
    </span>
    <small id="passwordHelpBlock" class="form-text text-muted">Your password must be at least 8 characters long.</small>
</div>

            <!-- First Name -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" required>
                <label for="firstname">First Name</label>
            </div>
            <!-- Last Name -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" required>
                <label for="lastname">Last Name</label>
            </div>
            <!-- Email -->
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" required>
                <label for="email">E-mail</label>
            </div>
            <!-- Gender -->
            <div class="form-floating mb-3">
                <select class="form-select" id="gender" name="gender" required>
                    <option selected value="-">---</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
                <label for="gender">Your Gender</label>
            </div>
            
            <!-- Role -->
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="type" name="type" value="Student" readonly>
    <label for="type">Your Role</label>
</div>

            <!-- Terms and Conditions -->
            <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" id="tandc" name="tandc" required>
                <label class="form-check-label" for="tandc">I agree to the terms and conditions and the privacy policy</label>
            </div>
            <!-- Submit Button -->
            <button class="btn btn-info w-100" type="submit">Sign Up</button>
        </form>
    </div>
</div>
<br>
<script>
    // Toggle password visibility
    const togglePwd = document.getElementById('togglePwd');
    const passwordField = document.getElementById('pwd');
    const toggleCfpwd = document.getElementById('toggleCfpwd');
    const confirmPasswordField = document.getElementById('cfpwd');

    function toggleVisibility(toggleIcon, inputField) {
        const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
        inputField.setAttribute('type', type);
        toggleIcon.innerHTML = type === 'text' 
            ? '<i class="bi bi-eye-slash"></i>' 
            : '<i class="bi bi-eye"></i>';
    }

    togglePwd.addEventListener('click', function () {
        toggleVisibility(this, passwordField);
    });

    toggleCfpwd.addEventListener('click', function () {
        toggleVisibility(this, confirmPasswordField);
    });
</script>

    <?php include ('footer.php') ?>
</body>

</html>