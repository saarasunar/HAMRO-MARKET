<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        if($_SESSION["utype"] != "ADMIN") {
            header("location: ../restricted.php");
            exit(1);
        }
        if (isset($_POST["upd_confirm"])) {
            $orh_id = intval($_POST["orh_id"]); 
            $status = $_POST["os"];
            $fnsh_date = ($status == 'FNSH') ? date('Y-m-d\TH:i:s') : null;
        
            $mysqli->begin_transaction(); // Start transaction
        
            // Update order status
            $stmt = $mysqli->prepare("
                UPDATE order_header 
                SET orh_orderstatus = ?, orh_finishedtime = ? 
                WHERE orh_id = ?
            ");
            $stmt->bind_param("ssi", $status, $fnsh_date, $orh_id);
            $result = $stmt->execute();
            $stmt->close();
        
            if ($result && $status == 'FNSH') {
                // Update product quantity
                $stmt = $mysqli->prepare("
                    UPDATE category 
                    INNER JOIN order_detail ON category.f_id = order_detail.f_id
                    SET category.f_qty = category.f_qty - order_detail.ord_amount
                    WHERE order_detail.orh_id = ?
                ");
                $stmt->bind_param("i", $orh_id);
                $result = $stmt->execute();
                $stmt->close();
            }
        
            if ($result) {
                $mysqli->commit(); // Commit transaction
                header("location: admin_order_list.php?up_ods=1");
            } else {
                $mysqli->rollback(); // Rollback on failure
                header("location: admin_order_list.php?up_ods=0");
            }
            exit(1);
        }        
        
        include('../head.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <title>Update Order Status | Hamro Pasal</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php'); ?>
    <br><br><br><br>
    <div class="container mt-5">

        <?php 
            $orh_id = $_GET["orh_id"];
            $query = "
            SELECT 
                orh.orh_ordertime, 
                c.c_firstname, 
                c.c_lastname, 
                orh.orh_orderstatus, 
                p.p_amount, 
                s.s_name,
                od.ord_amount,
                cat.f_name
            FROM 
                order_header orh
            INNER JOIN 
                customer c ON orh.c_id = c.c_id
            INNER JOIN 
                payment p ON p.p_id = orh.p_id
            INNER JOIN 
                shop s ON orh.s_id = s.s_id
            INNER JOIN 
                order_detail od ON orh.orh_id = od.orh_id
            INNER JOIN 
                category cat ON od.f_id = cat.f_id
            WHERE 
                orh.orh_id = {$orh_id};
        ";        
            $result = $mysqli->query($query);
            $row = $result->fetch_array();
        ?>
<br>
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Update Order Status</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="admin_order_update.php">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="customername" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customername" value="<?php echo $row["c_firstname"] . " " . $row["c_lastname"]; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="shopname" class="form-label">Shop Name</label>
                            <input type="text" class="form-control" id="shopname" value="<?php echo $row["s_name"]; ?>" disabled>
                        </div>
                    </div>
                    <div class="mb-3">
    <label for="productname" class="form-label">Product Name</label>
    <input type="text" class="form-control" id="productname" value="<?php echo $row["f_name"]; ?>" disabled>
</div>
<div class="mb-3">
    <label for="orderedquantity" class="form-label">Ordered Quantity</label>
    <input type="text" class="form-control" id="orderedquantity" value="<?php echo $row["ord_amount"]; ?>" disabled>
</div>

                    <div class="mb-3">
                        <label for="ordercost" class="form-label">Order Cost</label>
                        <input type="text" class="form-control" id="ordercost" value="<?php echo $row["p_amount"] . " NRP"; ?>" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="orderstatus" class="form-label">Order Status</label>
                        <select class="form-select" id="orderstatus" name="os">
                            <option value="" selected disabled>Select Order Status</option>
                            <option value="VRFY" <?php if ($row["orh_orderstatus"] == "VRFY") echo "selected"; ?>>VRFY | Verifying</option>
                            <option value="ACPT" <?php if ($row["orh_orderstatus"] == "ACPT") echo "selected"; ?>>ACPT | Accepted</option>
                            <option value="PREP" <?php if ($row["orh_orderstatus"] == "PREP") echo "selected"; ?>>PREP | Preparing</option>
                            <option value="RDPK" <?php if ($row["orh_orderstatus"] == "RDPK") echo "selected"; ?>>RDPK | Ready for Pickup</option>
                            <option value="FNSH" <?php if ($row["orh_orderstatus"] == "FNSH") echo "selected"; ?>>FNSH | Finished</option>
                            <option value="CNCL" <?php if ($row["orh_orderstatus"] == "CNCL") echo "selected"; ?>>CNCL | Cancelled</option>
                        </select>
                    </div>
                    <input type="hidden" name="orh_id" value="<?php echo $orh_id; ?>">
                    <button type="submit" name="upd_confirm" class="btn btn-success w-100" 
    <?php if ($row["orh_orderstatus"] == "FNSH") echo "disabled"; ?>>
    <i class="bi bi-check-circle me-2"></i>Update Order Status
</button>

                </form>
            </div>
        </div>
    </div>

    <?php include('admin_footer.php'); ?>
</body>

</html>
