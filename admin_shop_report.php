<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        include('../head.php');
        if($_SESSION["utype"]!="ADMIN"){
            header("location: ../restricted.php");
            exit(1);
        }
        include("range_fn.php");
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script type="text/javascript" src="../js/revenue_date_selection.js"></script>
    <title>Shop Revenue Report | Hamro Pasal</title>
</head>

<body class="d-flex flex-column h-100 bg-white">
    <?php include('nav_header_admin.php')?>

    <?php
        $s_id = $_GET["s_id"];
        $query = "SELECT s_name,s_location,s_phoneno,s_pic
        FROM shop WHERE s_id = {$s_id} LIMIT 0,1";
        $result = $mysqli -> query($query);
        $shop_row = $result -> fetch_array();
    ?>
<br><br><br><br>
    <div class="container px-5 py-4" id="shop-body">
        <div class="container row row-cols-6 row-cols-md-12 g-5 pt-4 mb-4" id="shop-header">
            <div class="rounded-25 col-6 col-md-4" id="shop-img" style="
                    background: url(
                        <?php
                            if(is_null($shop_row["s_pic"])){echo "'../img/default.png'";}
                            else{echo "'../img/{$shop_row['s_pic']}'";}
                        ?> 
                    ) center; height: 225px;
                    background-size: cover; background-repeat: no-repeat; object-fit:fill;
                    background-position: center;">
            </div>
            <div class="col-6 col-md-8">
                <h1 class="display-5 strong"><?php echo $shop_row["s_name"];?></h1>
                <ul class="list-unstyled">
                    
                    <li class=""><?php echo $shop_row["s_location"];?></li>
                    
                    <li class="">Telephone number: <?php echo "(+977) ".$shop_row["s_phoneno"];?></li>
                </ul>
                <a class="btn btn-sm btn-outline-secondary" href="admin_shop_pwd.php?s_id=<?php echo $s_id?>">
                    <i class="bi bi-key"></i>
                    Change password
                </a>
                <a class="btn btn-sm btn-primary mt-2 mt-md-0" href="admin_shop_edit.php?s_id=<?php echo $s_id?>">
                    <i class="bi bi-pencil-square"></i>
                    Update shop profile
                </a>
                <a class="btn btn-sm btn-danger mt-2 mt-md-0" href="admin_shop_delete.php?s_id=<?php echo $s_id?>">
                    <i class="bi bi-trash"></i>
                    Delete this shop
                </a>
            </div>
        </div>

        <?php
            // Revenue Summary Preparation Part
            // 1: Indicate Range
            // rev_mode: 1 Today / 2 Yesterday / 3 This Week / 4 Monthly / 5 Specific Period
            $s_id = $_GET["s_id"];
            $rev_mode = $_GET["rev_mode"];
            $today = date("Y-m-d");
            $yesterday = (new Datetime()) -> sub(new DateInterval("P1D")) -> format('Y-m-d');
            $weekrange = rangeWeek(date('Y-n-j'));
            $monthrange = rangeMonth(date('Y-n-j'));
            switch($rev_mode){
                case 1: $start_date = $today; 
                        $end_date = $today; 
                        break;
                case 2: $start_date = $yesterday; 
                        $end_date = $yesterday; 
                        break;
                case 3: $start_date = (new Datetime($weekrange["start"])) -> format('Y-m-d');
                        $end_date = (new Datetime($weekrange["end"])) -> format('Y-m-d');
                        break;
                case 4: $start_date = (new Datetime($monthrange["start"])) -> format('Y-m-d');
                        $end_date = (new Datetime($monthrange["end"])) -> format('Y-m-d');
                        break;
                case 5: 
                        if(isset($_GET["start_date"])&&(isset($_GET["end_date"]))){
                            $start_date = $_GET["start_date"];
                            $end_date = $_GET["end_date"];
                        }else{
                            header("location: shop_report_select.php"); exit(1);
                        }
                        break;
                default: header("location: shop_report_select.php"); exit(1);
            }
            $formatted_start = (new Datetime($start_date)) -> format('F j, Y');
            $formatted_end = (new Datetime($end_date)) -> format('F j, Y');
        ?>

        <div class="container">
            <h3 class="border-top pt-3 my-2">
                <a class="text-decoration-none link-secondary"
                    href="admin_shop_detail.php?s_id=<?php echo $s_id?>">Products</a>
                <span class="text-secondary">/</span>
                <a class="nav-item text-decoration-none link-secondary" href="admin_shop_order.php?s_id=<?php echo $s_id?>">Orders</a></span>
                <span class="text-secondary">/</span>
                <a class="nav-item text-decoration-none link-success"
                    href="admin_shop_revenue.php?s_id=<?php echo $s_id?>">Revenue</a></span>
            </h3>

            <div class="bg-light p-4 rounded-4 shadow-sm">
    <h3 class="display-6 text-primary mb-3">Revenue Report</h3>
    <h4 class="fw-light text-secondary mb-2">
        <?php 
        if ($formatted_start == $formatted_end) {
            echo "For {$formatted_start}";
        } else {
            echo "From {$formatted_start} to {$formatted_end}";
        }
        $f_id = 1;
        ?>
    </h4>
    <p class="fw-light text-muted">
        <span class="text-dark">Generated on:</span> 
        <?php echo date("F j, Y H:i"); ?>. 
        This report includes only <span class="text-success">finished orders</span>.
    </p>
</div>


            <h4 class="border-top fw-light pt-3 pb-2 mt-2">Overall Performance</h4>
<div class="row row-cols-1 row-cols-md-4 g-4">
    <!-- Card 1: Total Revenue -->
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3 text-primary">
                    <i class="bi bi-cash-stack fs-1"></i>
                </div>
                <h5 class="card-title">
                    <?php
                        $query = "SELECT SUM(ord.ord_amount*ord.ord_buyprice) AS rev FROM order_header orh INNER JOIN order_detail ord ON orh.orh_id = ord.orh_id
                        WHERE orh.s_id = {$s_id} AND orh_orderstatus = 'FNSH' AND (DATE(orh_finishedtime) BETWEEN DATE('{$start_date}') AND DATE('{$end_date}'));";
                        $result = $mysqli->query($query)->fetch_array();
                        $grandtotal = is_null($result["rev"]) ? 0 : $result["rev"];
                        printf("%.2f NRP", $grandtotal);
                    ?>
                </h5>
                <p class="card-text small text-muted">Total Revenue</p>
            </div>
        </div>
    </div>

    <!-- Card 2: Number of Orders -->
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3 text-success">
                    <i class="bi bi-bag-check fs-1"></i>
                </div>
                <h5 class="card-title">
                    <?php
                        $query = "SELECT COUNT(*) AS cnt FROM order_header orh 
                        WHERE orh.s_id = {$s_id} AND orh_orderstatus = 'FNSH' AND (DATE(orh_finishedtime) BETWEEN DATE('{$start_date}') AND DATE('{$end_date}'));";
                        $result = $mysqli->query($query)->fetch_array();
                        $num_order = is_null($result["cnt"]) ? 0 : $result["cnt"];
                        printf("%d Orders", $num_order);
                    ?>
                </h5>
                <p class="card-text small text-muted">Number of Orders</p>
            </div>
        </div>
    </div>

    <!-- Card 3: Number of Customers -->
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3 text-info">
                    <i class="bi bi-people fs-1"></i>
                </div>
                <h5 class="card-title">
                    <?php
                        $query = "SELECT COUNT(DISTINCT orh.c_id) AS cnt FROM order_header orh 
                        WHERE orh.s_id = {$s_id} AND orh_orderstatus = 'FNSH' AND (DATE(orh_finishedtime) BETWEEN DATE('{$start_date}') AND DATE('{$end_date}'));";
                        $result = $mysqli->query($query)->fetch_array();
                        echo is_null($result["cnt"]) ? "0 Customers" : $result["cnt"] . " Customers";
                    ?>
                </h5>
                <p class="card-text small text-muted">Number of Customers</p>
            </div>
        </div>
    </div>

    <!-- Card 4: Average Cost Per Order -->
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3 text-warning">
                    <i class="bi bi-graph-up-arrow fs-1"></i>
                </div>
                <h5 class="card-title">
                    <?php
                        echo $num_order == 0 ? "0.00 NRP" : sprintf("%.2f NRP", $grandtotal / $num_order);
                    ?>
                </h5>
                <p class="card-text small text-muted">Average Cost Per Order</p>
            </div>
        </div>
    </div>

    <!-- Card 5: Number of Products Sold -->
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3 text-secondary">
                    <i class="bi bi-box-seam fs-1"></i>
                </div>
                <h5 class="card-title">
                    <?php
                        $query = "SELECT SUM(ord.ord_amount) AS amt FROM order_header orh INNER JOIN order_detail ord ON orh.orh_id = ord.orh_id
                        WHERE orh.s_id = {$s_id} AND orh_orderstatus = 'FNSH' AND (DATE(orh_finishedtime) BETWEEN DATE('{$start_date}') AND DATE('{$end_date}'));";
                        $result = $mysqli->query($query)->fetch_array();
                        echo is_null($result["amt"]) ? "0 Products" : $result["amt"] . " Products";
                    ?>
                </h5>
                <p class="card-text small text-muted">Products Sold</p>
            </div>
        </div>
    </div>

    <!-- Card 6: Best-Selling Product -->
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3 text-danger">
                    <i class="bi bi-star-fill fs-1"></i>
                </div>
                <h5 class="card-title">
                    <?php
                        $query = "SELECT f.f_name, SUM(ord.ord_amount) AS amt FROM order_header orh INNER JOIN order_detail ord ON orh.orh_id = ord.orh_id INNER JOIN category f ON ord.f_id = f.f_id
                        WHERE orh.s_id = {$s_id} AND orh_orderstatus = 'FNSH' AND (DATE(orh_finishedtime) BETWEEN DATE('{$start_date}') AND DATE('{$end_date}')) ORDER BY amt DESC LIMIT 1;";
                        $result = $mysqli->query($query)->fetch_array();
                        echo is_null($result["f_name"]) ? "-" : $result["f_name"];
                    ?>
                </h5>
                <p class="card-text small text-muted">Best-Selling Product</p>
            </div>
        </div>
    </div>

    <!-- Card 7: Peak Ordering Hour -->
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3 text-info">
                    <i class="bi bi-clock-history fs-1"></i>
                </div>
                <h5 class="card-title">
                    <?php
                        $query = "SELECT HOUR(orh_ordertime) AS odh, COUNT(orh_id) AS cnt FROM order_header orh
                        WHERE s_id = {$s_id} AND orh_orderstatus = 'FNSH' AND (DATE(orh_finishedtime) BETWEEN DATE('{$start_date}') AND DATE('{$end_date}')) GROUP BY odh ORDER BY cnt DESC;";
                        $result = $mysqli->query($query);
                        $num_rows = $result->num_rows;
                        echo $num_rows == 0 ? "-" : $result->fetch_array()["odh"] . ":00 - " . $result->fetch_array()["odh"] . ":59";
                    ?>
                </h5>
                <p class="card-text small text-muted">Peak Ordering Hour</p>
            </div>
        </div>
    </div>

    <!-- Card 8: Peak Pick-Up Hour -->
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3 text-secondary">
                    <i class="bi bi-clock fs-1"></i>
                </div>
                <h5 class="card-title">
                    <?php
                        $query = "SELECT HOUR(orh_finishedtime) AS odh, COUNT(orh_id) AS cnt FROM order_header orh
                        WHERE s_id = {$s_id} AND orh_orderstatus = 'FNSH' AND (DATE(orh_finishedtime) BETWEEN DATE('{$start_date}') AND DATE('{$end_date}')) GROUP BY odh ORDER BY cnt DESC;";
                        $result = $mysqli->query($query);
                        $num_rows = $result->num_rows;
                        echo $num_rows == 0 ? "-" : $result->fetch_array()["odh"] . ":00 - " . $result->fetch_array()["odh"] . ":59";
                    ?>
                </h5>
                <p class="card-text small text-muted">Peak Pick-Up Hour</p>
            </div>
        </div>
    </div>
</div>

<h4 class="border-top fw-light pt-3 mt-2">Shop Performance</h4>
<?php
    $query = "SELECT f.f_name,f.f_price,SUM(ord.ord_amount) AS amount,SUM(ord.ord_amount*ord.ord_buyprice) AS subtotal 
    FROM order_header orh 
    INNER JOIN order_detail ord ON orh.orh_id = ord.orh_id 
    INNER JOIN category f ON ord.f_id = f.f_id
    WHERE orh.s_id = {$s_id} AND orh_orderstatus = 'FNSH' 
    AND (DATE(orh_finishedtime) BETWEEN DATE('{$start_date}') AND DATE('{$end_date}'))
    GROUP BY ord.f_id 
    ORDER BY amount DESC;";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;

    if ($num_rows > 0) {
?>
<div class="table-responsive shadow rounded-4 bg-white">
    <table class="table table-striped table-hover table-bordered align-middle caption-top">
        <caption class="fs-5 text-primary">
            <?php echo $num_rows; ?> Products
        </caption>
        <thead class="table-light text-center">
            <tr>
                <th scope="col">Rank</th>
                <th scope="col">Product Name</th>
                <th scope="col">Current Price</th>
                <th scope="col">Amount Sold</th>
                <th scope="col">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; while ($row = $result->fetch_array()) { ?>
            <tr>
                <td class="text-center"><?php echo $i++; ?></td>
                <td><?php echo $row["f_name"]; ?></td>
                <td class="text-end"><?php echo number_format($row["f_price"], 2) . " NRP"; ?></td>
                <td class="text-center"><?php echo $row["amount"] . " Products"; ?></td>
                <td class="text-end text-success"><?php echo number_format($row["subtotal"], 2) . " NRP"; ?></td>
            </tr>
            <?php } ?>
            <tr class="fw-bold table-info">
                <td colspan="4" class="text-end">Grand Total</td>
                <td class="text-end text-primary">
                    <?php printf("%.2f NRP", $grandtotal); ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php } else { ?>
<p class="fw-light text-muted">No records available for the selected period.</p>
<?php } ?>


            </div>
        </div>
    </div>
    <?php include('admin_footer.php')?>
</body>

</html>