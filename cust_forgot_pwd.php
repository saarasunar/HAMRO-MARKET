<html lang="en">

<head>
    <?php session_start(); include("conn_db.php"); include('head.php');?>
    <meta charset="UTF-8">
     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <title>Forgot Password | Hamro Pasal</title>
</head>

<body class="d-flex flex-column h-100">
    <header class="navbar navbar-light fixed-top bg-dark shadow-sm mb-auto">
        <div class="container-fluid mx-4">
            <a href="index.php">
                <img src="img/hamro-pasal.png" width="80" class="me-2" alt="Hamro Pasal Logo">
            </a>
        </div>
    </header>

    <div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 15px;">
        <!-- Go Back Link -->
        <a class="nav nav-item text-decoration-none text-muted mb-3" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back 
        </a>

        <!-- Form -->
        <form method="POST" action="cust_reset_pwd.php">
            <!-- Header -->
            <h2 class="text-center mb-3 fw-bold text-primary">
                <i class="bi bi-key me-2"></i>Forgot Password?
            </h2>
            <p class="text-center text-muted mb-4">Enter your information below to reset your password.</p>

            <!-- Username Field -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="fp_username" placeholder="Username" name="fp_username" required>
                <label for="fp_username">Username</label>
            </div>

            <!-- Email Field -->
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="fp_email" placeholder="Email" name="fp_email" required>
                <label for="fp_email">Email</label>
            </div>

            <!-- Submit Button -->
            <button class="btn btn-info w-100" type="submit">Next</button>
        </form>
    </div>
</div>
<br>
<br>
<br><br><br><br>
    <?php include('footer.php')?>
</body>

</html>