<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        include('../head.php');
        if ($_SESSION["utype"] != "ADMIN") {
            header("location: ../restricted.php");
            exit(1);
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <title>Order Detail | Hamro Pasal</title>
</head>

<body class="d-flex flex-column h-100 bg-light">
    <?php include('nav_header_admin.php'); ?>
<br><br><br>
    <div class="container my-4">
        <h2 class="text-primary my-3">Order Details</h2>
        <?php
            $orh_id = $_GET["orh_id"];
            $orh_query = "SELECT * FROM order_header WHERE orh_id = {$orh_id}";
            $orh_arr = $mysqli->query($orh_query)->fetch_array();
        ?>

        <!-- Order Status Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Order Status</h5>
            </div>
            <div class="card-body">
                <h5>
                    <?php
                        $status = $orh_arr["orh_orderstatus"];
                        $badge_classes = [
                            "VRFY" => "info text-dark",
                            "ACPT" => "secondary text-dark",
                            "PREP" => "warning text-dark",
                            "RDPK" => "primary text-white",
                            "FNSH" => "success text-white",
                            "CNCL" => "danger text-white"
                        ];
                        $status_labels = [
                            "VRFY" => "Verifying",
                            "ACPT" => "Accepted",
                            "PREP" => "Preparing",
                            "RDPK" => "Ready to Pick Up",
                            "FNSH" => "Completed",
                            "CNCL" => "Cancelled"
                        ];
                        echo "<span class='badge bg-{$badge_classes[$status]}'>{$status_labels[$status]}</span>";
                    ?>
                </h5>
                <ul class="list-unstyled mt-3">
                    <li><strong>Order ID:</strong> #<?php echo $orh_arr["t_id"]; ?></li>
                    <li>
                        <strong>From Shop:</strong>
                        <a href="admin_shop_detail.php?s_id=<?php echo $orh_arr['s_id']; ?>" class="text-decoration-none link-primary">
                            <?php
                                $shop_query = "SELECT s_name FROM shop WHERE s_id = {$orh_arr['s_id']}";
                                $shop_arr = $mysqli->query($shop_query)->fetch_array();
                                echo $shop_arr["s_name"];
                            ?>
                        </a>
                    </li>
                    <li>
                        <strong>Customer:</strong>
                        <a href="admin_customer_detail.php?c_id=<?php echo $orh_arr['c_id']; ?>" class="text-decoration-none link-primary">
                            <?php
                                $cust_query = "SELECT c_firstname, c_lastname FROM customer WHERE c_id = {$orh_arr['c_id']}";
                                $cust_arr = $mysqli->query($cust_query)->fetch_array();
                                echo $cust_arr["c_firstname"] . " " . $cust_arr["c_lastname"];
                            ?>
                        </a>
                    </li>
                    <li><strong>Placed On:</strong> <?php echo (new DateTime($orh_arr["orh_ordertime"]))->format("F j, Y, H:i"); ?></li>
                    <?php if ($orh_arr["orh_orderstatus"] == "FNSH") { ?>
                    <li><strong>Finished On:</strong> <?php echo (new DateTime($orh_arr["orh_finishedtime"]))->format("F j, Y, H:i"); ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <!-- Menu Items Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Ordered Items</h5>
            </div>
            <div class="card-body">
                <?php 
                    $ord_query = "SELECT f.f_id, f.f_name, f.f_pic, ord.ord_amount, ord.ord_buyprice, ord.ord_note
                                  FROM order_detail ord 
                                  INNER JOIN category f ON ord.f_id = f.f_id 
                                  WHERE ord.orh_id = {$orh_id}";
                    $ord_result = $mysqli->query($ord_query);
                ?>
                <div class="row">
                    <?php while ($ord_row = $ord_result->fetch_array()) { ?>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex">
                            <img src="<?php echo is_null($ord_row["f_pic"]) ? '../img/default.png' : "../img/{$ord_row['f_pic']}"; ?>" 
                                 class="img-thumbnail" 
                                 style="width: 100px; height: 100px; object-fit: cover;" 
                                 alt="<?php echo $ord_row["f_name"]; ?>">
                            <div class="ms-3">
                                <h6><?php echo $ord_row["f_name"]; ?> <span class="badge bg-secondary"><?php echo $ord_row["ord_amount"]; ?>x</span></h6>
                                <p class="mb-1">
                                    <strong>Total:</strong> <?php printf("%.2f NRP", $ord_row["ord_buyprice"] * $ord_row["ord_amount"]); ?><br>
                                    <small class="text-muted"><?php printf("%.2f NRP each", $ord_row["ord_buyprice"]); ?></small>
                                </p>
                                <?php if (!empty($ord_row["ord_note"])) { ?>
                                <p class="text-muted"><small><?php echo $ord_row["ord_note"]; ?></small></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Grand Total Section -->
        <div class="card mb-4">
            <div class="card-body text-end">
                <h4 class="mb-0">Grand Total: 
                    <strong>
                        <?php
                            $gt_query = "SELECT SUM(ord_amount * ord_buyprice) AS gt FROM order_detail WHERE orh_id = {$orh_id}";
                            $gt_arr = $mysqli->query($gt_query)->fetch_array();
                            printf("%.2f NRP", $gt_arr["gt"]);
                        ?>
                    </strong>
                </h4>
                <p class="list-item fw-light small">Pay by QR </p>
                                
                 
            </div>
        </div>
    </div>

    <?php include('admin_footer.php'); ?>
</body>
</html>
