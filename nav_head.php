<header class="navbar navbar-expand-md navbar-light bg-black fixed-top shadow-sm mb-auto">
  <style>
    .nav-link {
      transition: background-color 0.3s ease, color 0.3s ease;
      color: #fff;
    }

    .nav-link:hover {
      color: #ffbd27; /* Text color on hover */
    }

    .nav-link.active {
      background-color: #088; /* Highlight background color for active page */
      color: #fff; /* Text color for active page */
      font-weight: bold;
    }
  </style>
  <div class="container-fluid mx-4">
    <a class="navbar-brand" href="index.php">
      <img src="../img/hamro-pasal.png" width="80" class="me-2" alt="Hamro Pasal">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link px-2 <?= basename($_SERVER['PHP_SELF']) == '../index.php' ? 'active' : '' ?>" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-2 <?= basename($_SERVER['PHP_SELF']) == '../shop_list.php' ? 'active' : '' ?>" href="../shop_list.php">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-2 <?= basename($_SERVER['PHP_SELF']) == '../about.php' ? 'active' : '' ?>" href="../about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-2 <?= basename($_SERVER['PHP_SELF']) == '../contact.php' ? 'active' : '' ?>" href="../contact.php">Contact</a>
        </li>
      </ul>
      <div class="d-flex ms-auto">
        <?php if (!isset($_SESSION['cid'])) { ?>
          <a href="../cust_regist.php" class="btn btn-warning me-2">Sign Up</a>
          <a href="../cust_login.php" class="btn btn-info">Log In</a>
        <?php } ?>
      </div>
    </div>
  </div>
</header>
