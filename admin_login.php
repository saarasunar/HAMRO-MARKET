<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start();
    include("../conn_db.php");
    include('../head.php'); ?>
    <meta charset="UTF-8">

    <link href="../css/login.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <title>Admin Log In | Hamro Pasal</title>
</head>

<body class="d-flex flex-column h-100">
<?php include ('nav_head.php') ?>
<br><br><br><br>

    <!-- Main Content -->
    <main class="flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 15px;">
            <form method="POST" action="check_admin_login.php">
                <h2 class="text-center mb-4 fw-bold text-dark">
                    <i class="bi bi-door-open me-2"></i>Admin Log In
                </h2>
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

                <button class="btn btn-info w-100 mb-3" type="submit">Log In</button>
                
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-2 d-flex justify-content-between align-items-center flex-shrink-0">
        <p class="mb-0 text-center flex-grow-1">
            &copy; <span id="year"></span> Hamro Pasal | Developed by
            <a href="https://sakarc.com.np/" target="_blank" class="text-decoration-none text-primary">Sakar Chaulagain</a>
        </p>
        <a href="tel:+1234567890" class="text-white text-decoration-none d-flex align-items-center">
            <img src="https://img.icons8.com/ios-filled/24/ffffff/phone.png" alt="Call Icon" class="me-1"> Call Us
        </a>
    </footer>

    <script>
        // Automatically set the current year
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>

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

</body>

</html>
