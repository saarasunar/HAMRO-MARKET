<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    session_start();
    include("conn_db.php");
    include("head.php"); 
    ?>
    <meta charset="UTF-8">
    <link href="css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <title>Log In | Hamro Pasal</title>
    <style>
        /* Custom styles for the login page */
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #4caf50, #2c7bf8);
            color: #333;
        }

        header {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-signin {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            font-weight: bold;
            text-align: center;
            color: #4caf50;
        }

        .form-floating input {
            border-radius: 10px;
            border: 1px solid #ccc;
        }

        .form-floating label {
            color: #777;
        }

        .btn-success {
            border-radius: 10px;
            padding: 10px 20px;
        }

        .form-signin a {
            display: block;
            text-align: center;
            font-size: 0.9rem;
            margin: 10px 0;
            color: #555;
        }

        .form-signin a:hover {
            text-decoration: underline;
            color: #007bff;
        }

    </style>
</head>

<body>
    <!-- Header -->
    <?php include ('nav_header.php') ?>

    <!-- Login Form -->
    <div class="container form-signin mt-auto">
        <form method="POST" action="check_login.php" class="form-floating">
            <h2 class="mt-4 mb-4"><i class="bi bi-door-open me-2"></i>Log In</h2>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-3 position-relative">
    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pwd" required>
    <label for="floatingPassword">Password</label>
    <!-- Eye icon for toggling password visibility -->
    <span id="togglePassword" class="position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
        <i class="bi bi-eye"></i>
    </span>
</div>

            <button class="w-100 btn btn-info mb-3" type="submit">Log In</button>
            <a class="text-muted small" href="cust_forgot_pwd.php">
                <i class="bi bi-key me-2"></i>Forgot your password?
            </a>
            <a class="text-muted small" href="cust_regist.php">
                <i class="bi bi-person-plus me-2"></i>Create your new account
            </a>
        </form>
    </div>
    <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('floatingPassword');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.innerHTML = type === 'text' 
            ? '<i class="bi bi-eye-slash"></i>' 
            : '<i class="bi bi-eye"></i>';
    });

    togglePassword.addEventListener('dblclick', function () {
        passwordField.setAttribute('type', 'password');
        this.innerHTML = '<i class="bi bi-eye"></i>';
    });
</script>

    <!-- Footer -->
    <?php include('footer.php'); ?>
</body>

</html>
