<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start();
        include("conn_db.php");
        include('head.php');
        if(!(isset($_GET["s_id"]) || isset($_GET["f_id"]))){
            header("location: restricted.php");
            exit(1);
        }
        if(!isset($_SESSION["cid"])){
            header("location: cust_login.php");
            exit(1);
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="js/input_number.js"></script>
    <script type="text/javascript">
        function changeshopcf() {
            return window.confirm("Do you want to change the shop?\nDon't worry, we will do it for you automatically.");
        }
    </script>
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <title>Hamro Pasal</title>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #shop-body {
            flex: 1; /* Allows the content area to stretch and take available space */
            display: flex;
            justify-content: center; /* Centers content horizontally */
            align-items: center; /* Centers content vertically */
        }

        .footer {
            text-align: center;
            padding: 0.5 rem 0;

        }
    </style>
</head>

<body class="bg-light">
    <?php 
        include('nav_header.php');
        $s_id = $_GET["s_id"];
        $f_id = $_GET["f_id"];
        $query = "SELECT f.* FROM category f INNER JOIN shop s ON f.s_id = s.s_id WHERE f.s_id = {$s_id} AND f.f_id = {$f_id} LIMIT 0,1";
        $result = $mysqli -> query($query);
        $category_row = $result -> fetch_array();
    ?>
<br><br>
<?php
    // Check the available stock
    $available_stock = $category_row["f_qty"];
?>

<div class="container my-5" id="shop-body">
    <div class="row">
        <!-- Product Image Section -->
        <div class="col-md-6 mb-4">
            <img 
                <?php
                    if (is_null($category_row["f_pic"])) {
                        echo "src='img/default.png'";
                    } else {
                        echo "src=\"img/{$category_row['f_pic']}\"";
                    }
                ?> 
                class="img-fluid rounded-4 shadow" 
                alt="<?php echo $category_row["f_name"] ?>">
        </div>

        <!-- Product Details Section -->
        <div class="col-md-6">
            <h1 class="fw-bold text-primary"><?php echo $category_row["f_name"] ?></h1>
            <p class="text-muted"><?php echo $category_row["f_desc"] ?></p>
            <h3 class="text-danger fw-bold mb-4">NRP <?php echo $category_row["f_price"] ?></h3>

            <?php if ($available_stock > 0): ?>
                <?php
    // Get the available stock from the database
    $available_stock = $category_row["f_qty"];
?>
             <form method="POST" action="add_item.php">
    <div class="input-group mb-3">
        <button id="sub_btn" class="btn btn-outline-secondary" type="button" onclick="sub_amt('amount')" disabled>
            <i class="bi bi-dash-lg"></i>
        </button>
        <input 
            type="number" 
            class="form-control text-center" 
            id="amount" 
            name="amount" 
            value="1" 
            min="1" 
            max="<?php echo $available_stock; ?>" 
            required 
            oninput="updateQuantityButtons(<?php echo $available_stock; ?>)">
        <button id="add_btn" class="btn btn-outline-secondary" type="button" onclick="add_amt('amount')">
            <i class="bi bi-plus-lg"></i>
        </button>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control" id="addrequest" name="request" placeholder=" "></textarea>
        <label for="addrequest">Additional Message (Optional)</label>
    </div>

    <input type="hidden" name="s_id" value="<?php echo $s_id ?>">
    <input type="hidden" name="f_id" value="<?php echo $f_id ?>">

    <button class="btn btn-primary w-100" type="submit" name="addtocart">
        <i class="bi bi-cart-plus"></i> Add to Cart
    </button>
</form>



            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    This product is currently out of stock.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if (isset($_GET["error"]) && $_GET["error"] == "out_of_stock"): ?>
    <div class="alert alert-danger" role="alert">
        The quantity requested exceeds the available stock or the product is out of stock.
    </div>
<?php endif; ?>

    <?php $result->free_result(); ?>

    <footer class="footer mt-auto">
        <?php include('footer.php'); ?>
    </footer>

    <script type="text/javascript">
    // Function to check the quantity and enable/disable the buttons
    function updateQuantityButtons(maxQty) {
        var qty = document.getElementById('amount').value;

        // Disable '+' button if quantity exceeds available stock
        if (qty >= maxQty) {
            document.getElementById('add_btn').disabled = true;
        } else {
            document.getElementById('add_btn').disabled = false;
        }

        // Enable the '-' button (no restriction on decreasing quantity)
        if (qty > 1) {
            document.getElementById('sub_btn').disabled = false;
        } else {
            document.getElementById('sub_btn').disabled = true;
        }
    }

    // Function to increase quantity
    function add_amt(id) {
        var qtyInput = document.getElementById(id);
        var qty = parseInt(qtyInput.value);

        // Increase quantity by 1
        if (qty < parseInt(qtyInput.max)) {
            qtyInput.value = qty + 1;
            updateQuantityButtons(qtyInput.max);
        }
    }

    // Function to decrease quantity
    function sub_amt(id) {
        var qtyInput = document.getElementById(id);
        var qty = parseInt(qtyInput.value);

        // Decrease quantity by 1
        if (qty > 1) {
            qtyInput.value = qty - 1;
            updateQuantityButtons(qtyInput.max);
        }
    }

    // Set initial state when the page loads
    window.onload = function() {
        var maxQty = <?php echo $available_stock; ?>; // Get the available stock from PHP
        updateQuantityButtons(maxQty);
    }
</script>

</body>

</html>
