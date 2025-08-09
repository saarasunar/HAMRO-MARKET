<header class="navbar navbar-expand-md navbar-dark fixed-top bg-dark shadow-sm mb-auto">
    <style>
        /* General Styles for the Navbar */
        .navbar {
            font-size: 16px;
            padding: 0.75rem 1rem;
        }

        /* Navbar Link Styles */
        .nav-link {
            transition: all 0.3s ease;
        }

        /* Highlight Selected Page */
        .nav-link.active {
            color: #ffc107;
            font-weight: bold;
            background-color: #343a40; /* Slightly darker background for active link */
            border-radius: px;
        }

        /* Hover Effect for Links */
        .nav-link:hover {
            color: #ffc107;
            background-color: #495057;
            border-radius: 4px;
        }

        /* Logout Button */
        .logout-btn {
            background-color: #dc3545;
            color: #fff;
            transition: all 0.3s ease;
        }

        /* Hover Effect for Logout Button */
         .logout-btn:hover {
            background-color: #ff9; /* Lighter red for better visibility */
            color: #ff9;
            box-shadow: 0 0 10px rgba(255, 111, 97, 0.8);
        } 
        
    </style>
    <div class="container-fluid mx-4">
        <a href="admin_home.php">
            <img src="../img/hamro-pasal.png" width="80" class="me-2" alt="Hamro Pasal">
        </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link px-2 <?= basename($_SERVER['PHP_SELF']) == 'admin_home.php' ? 'active' : '' ?>"
                        href="admin_home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 <?= basename($_SERVER['PHP_SELF']) == 'admin_customer_list.php' ? 'active' : '' ?>"
                        href="admin_customer_list.php">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 <?= basename($_SERVER['PHP_SELF']) == 'admin_shop_list.php' ? 'active' : '' ?>"
                        href="admin_shop_list.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 <?= basename($_SERVER['PHP_SELF']) == 'admin_category_list.php' ? 'active' : '' ?>"
                        href="admin_category_list.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 <?= basename($_SERVER['PHP_SELF']) == 'admin_order_list.php' ? 'active' : '' ?>"
                        href="admin_order_list.php">Order</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php if (!isset($_SESSION['aid'])) { ?>
                    <a class="btn btn-outline-warning me-2" href="../cust_regist.php">Sign Up</a>
                    <a class="btn btn-info" href="../cust_login.php">Log In</a>
                <?php } else { ?>
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a href="admin_customer_detail.php?c_id=<?= $_SESSION['aid'] ?>"
                                class="nav-link px-2 text-light">
                                Welcome, <?= $_SESSION['firstname'] ?>
                                <i class="bi bi-person-circle"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="mx-2 mt-1 mt-md-0 btn logout-btn" href="../logout.php">Log Out</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</header>
