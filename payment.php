<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    session_start(); 
    include("conn_db.php"); 
    include('head.php'); 
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #shop-body {
            flex-grow: 1;
        }

        .qr img {
            max-width :200px;
            max-height: 200px;
            object-fit: contain;
        }

        .form-floating label {
            font-size: 0.875rem;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .terms {
            font-size: 0.875rem;
        }
    </style>
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <title>Payment | Hamro Pasal</title>
</head>

<body>
    <!-- Header -->
    <header class="navbar navbar-light fixed-top bg-dark shadow-sm mb-auto">
        <div class="container-fluid mx-4">
            <a href="index.php">
                <img src="img/hamro-pasal.png" width="50" height ="50" class="me-2" alt="Hamro Pasal Logo">
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container px-5 py-4 mt-5" id="shop-body">
        <div class="row mb-4">
            <a class="nav nav-item text-decoration-none text-muted mb-2" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4 align-items-center">
            <!-- QR Code Section -->
            <div class="col qr">
                <img src="img/qr.jpeg" alt="QR Code" class="img-fluid rounded-3 shadow">
            </div>

            <!-- Payment Form Section -->
            <div class="col">
                <form method="POST" action="add_order.php" class="p-4 border rounded-3 shadow-sm bg-white">
                    <h2 class="mb-4 fw-bold text-center"><i class="bi bi-qr-code-scan"></i> Payment</h2>

                    <!-- Grand Total -->
                    <div class="mb-4 text-center">
                        <h4 class="fw-light">Grand Total</h4>
                        <h2 class="fw-bold text-success">
                            <?php
                            $gt_query = "SELECT SUM(ct.ct_amount*f.f_price) AS grandtotal 
                                        FROM cart ct 
                                        INNER JOIN category f 
                                        ON ct.f_id = f.f_id 
                                        WHERE ct.c_id = {$_SESSION['cid']} GROUP BY ct.c_id";
                            $gt_arr = $mysqli->query($gt_query)->fetch_array();
                            $order_cost = $gt_arr["grandtotal"];
                            printf("%.2f NRP", $order_cost);
                            ?>
                        </h2>
                    </div>

                    <!-- Name -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                        <label for="name">Name</label>
                    </div>

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" required>
                        <label for="email">E-mail</label>
                    </div>

                    <!-- Transaction ID -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="tid" placeholder="Transaction ID" name="tid" minlength="12" maxlength="45" required>
                        <label for="tid">Transaction ID</label>
                    </div>

                    <!-- Confirm Transaction ID -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="cftid" placeholder="Confirm Transaction ID" name="cftid" minlength="12" maxlength="45" required>
                        <label for="cftid">Confirm Transaction ID</label>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="tandc" name="tandc" required>
                        <label class="form-check-label terms" for="tandc">
                            I agree to the terms and conditions and the privacy policy.
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php')?>
</body>

</html>



