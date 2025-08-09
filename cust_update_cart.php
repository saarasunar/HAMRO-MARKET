<!DOCTYPE html>
<html lang="en">

<>
    <?php 
    session_start();
    if(!isset($_SESSION["cid"])){
        header("location: restricted.php");
        exit(1);
    }
    include("conn_db.php");
    if(isset($_POST["upd_item"])){
        $target_sid = $_POST["s_id"];
        $target_cid = $_SESSION["cid"];
        $target_fid = $_POST["f_id"];
        $amount = $_POST["amount"];
        $request = $_POST["request"];
        $cartupdate_query = "UPDATE cart SET ct_amount = {$amount}, ct_note = '{$request}' 
        WHERE c_id = {$target_cid} AND s_id = {$target_sid} AND f_id = {$target_fid}";
        $cartupdate_result = $mysqli->query($cartupdate_query);
        if($cartupdate_result){
            header("location: cust_cart.php?up_crt=1");
        }else{
            header("location: cust_cart.php?up_crt=0");
        }
        exit(1);
    }

    include('head.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <script type="text/javascript" src="js/input_number.js"></script>
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <title>Hamro Pasal</title>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        #main-content {
            flex-grow: 1; /* This pushes the footer down */
        }
    </style>

</head>

<body class="d-flex flex-column h-100">
    <?php 
        include('nav_header.php');
        $s_id = $_GET["s_id"];
        $f_id = $_GET["f_id"];
        $query = "SELECT * FROM category WHERE s_id = {$s_id} AND f_id = {$f_id} LIMIT 0,1";
        $result = $mysqli->query($query);
        $category_row = $result->fetch_array();
    ?>
<br><br><br>
    <div class="container my-4" id="shop-body">
        <div class="row row-cols-1 row-cols-md-2 g-4 align-items-center">
            <!-- category Image -->
            <div class="col">
                <img 
                    <?php
                        echo is_null($category_row["f_pic"]) 
                            ? "src='img/default.png'" 
                            : "src='img/{$category_row['f_pic']}'";
                    ?> 
                    class="img-fluid rounded-3 shadow" 
                    alt="<?php echo $category_row["f_name"]; ?>">
            </div>

            <!-- category Details -->
            <div class="col">
                <h1 class="fw-bold text-primary"><?php echo $category_row["f_name"]; ?></h1>
                <h3 class="text-success"><?php echo $category_row["f_price"]; ?> NRP</h3>

                <?php
                    $ci_query = "SELECT ct_amount, ct_note FROM cart WHERE c_id = {$_SESSION['cid']} AND f_id = {$f_id} AND s_id = {$s_id}";
                    $ci_arr = $mysqli->query($ci_query)->fetch_array();
                ?>

                <!-- Update Form -->
                <form class="mt-4" method="POST" action="cust_update_cart.php">
                    <div class="mb-3">
                        <!-- Amount Control -->
                        <label for="amount" class="form-label">Quantity:</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" title="Subtract amount" onclick="sub_amt('amount')">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="number" id="amount" name="amount" 
                                class="form-control text-center border-secondary" 
                                value="<?php echo $ci_arr["ct_amount"]; ?>" 
                                min="1" max="99">
                            <button class="btn btn-outline-secondary" type="button" title="Add amount" onclick="add_amt('amount')">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Additional Request -->
                    <div class="form-floating mb-3">
                        <input type="text" id="addrequest" name="request" 
                            class="form-control" 
                            value="<?php echo $ci_arr["ct_note"]; ?>" 
                            placeholder=" ">
                        <label for="addrequest">Additional Message (Optional)</label>
                        
                    </div>

                    <!-- Hidden Inputs -->
                    <input type="hidden" name="s_id" value="<?php echo $s_id; ?>">
                    <input type="hidden" name="f_id" value="<?php echo $f_id; ?>">

                    <!-- Buttons -->
                    <div class="d-grid gap-2 d-md-block">
                        <button type="submit" name="upd_item" value="upd" class="btn btn-success">
                            <i class="bi bi-cart"></i> Update Item
                        </button>
                        <button type="submit" name="rmv_item" value="rmv" formaction="remove_cart_item.php?rmv=1&s_id=<?php echo $s_id; ?>&f_id=<?php echo $f_id; ?>" class="btn btn-outline-danger">
                            <i class="bi bi-cart-x"></i> Remove Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
