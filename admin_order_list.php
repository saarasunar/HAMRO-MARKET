<!DOCTYPE html>
<html lang="en" class="h-100">

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
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <link href="../css/main.css" rel="stylesheet">
    <title>Order List | Hamro Pasal</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php'); ?>
<br><br><br><br>
    <div class="container mt-4" id="admin-dashboard">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="display-6 text-primary">Order List</h2>
        </div>

        <!-- Notifications -->
        <?php if (isset($_GET["up_ods"])): ?>
            <div class="alert alert-<?php echo ($_GET["up_ods"] == 1) ? 'success' : 'danger'; ?> d-flex align-items-center" role="alert">
                <i class="bi bi-<?php echo ($_GET["up_ods"] == 1) ? 'check-circle' : 'x-circle'; ?> me-2"></i>
                <div>
                    <?php echo ($_GET["up_ods"] == 1) ? 'Successfully updated order status.' : 'Failed to update order status.'; ?>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Search Filters -->
        <form class="bg-light p-3 rounded-4 mb-4" method="GET" action="admin_order_list.php">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="c_id" class="form-label">Customer Name</label>
                    <select class="form-select" id="c_id" name="c_id">
                        <option value="" selected>All Customers</option>
                        <?php
                            $customers = $mysqli->query("SELECT DISTINCT c.c_id, CONCAT(c.c_firstname, ' ', c.c_lastname) AS customer_name FROM customer c;");
                            while ($customer = $customers->fetch_assoc()) {
                                echo "<option value='{$customer['c_id']}'>{$customer['customer_name']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="utype" class="form-label">Customer Type</label>
                    <select class="form-select" id="utype" name="ut">
                        <option value="" selected>All Types</option>
                        <option value="CUS">Regular_Customer</option>
                        <option value="ADM">Admin</option>
                        
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="s_id" class="form-label">Shop Name</label>
                    <select class="form-select" id="s_id" name="s_id">
                        <option value="" selected>All Shops</option>
                        <?php
                            $shops = $mysqli->query("SELECT DISTINCT s_id, s_name FROM shop;");
                            while ($shop = $shops->fetch_assoc()) {
                                echo "<option value='{$shop['s_id']}'>{$shop['s_name']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="orderstatus" class="form-label">Order Status</label>
                    <select class="form-select" id="orderstatus" name="os">
                        <option value="" selected>All Status</option>
                        <option value="VRFY">Verifying</option>
                        <option value="ACPT">Accepted</option>
                        <option value="PREP">Preparing</option>
                        <option value="RDPK">Ready for Pick-Up</option>
                        <option value="FNSH">Completed</option>
                        <option value="CNCL">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-auto">
                    <button type="submit" name="search" class="btn btn-primary">
                        <i class="bi bi-search"></i> Search
                    </button>
                    <button type="reset" class="btn btn-danger" onclick="window.location.href='admin_order_list.php'">
                        <i class="bi bi-x-circle"></i> Clear
                    </button>
                </div>
            </div>
        </form>

        <!-- Order Table -->
        <?php
            $query = "SELECT orh.orh_id, orh.t_id, orh.orh_orderstatus, orh.orh_ordertime, 
                             CONCAT(c.c_firstname, ' ', c.c_lastname) AS customer_name, s.s_name, p.p_amount 
                      FROM order_header orh
                      INNER JOIN customer c ON orh.c_id = c.c_id
                      INNER JOIN shop s ON orh.s_id = s.s_id
                      INNER JOIN payment p ON p.p_id = orh.p_id
                      ORDER BY orh.orh_ordertime DESC;";
            $result = $mysqli->query($query);
        ?>
        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Transaction ID</th>
                            <th>Shop Name</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Customer</th>
                            <th>Cost</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; while ($order = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $order["t_id"]; ?></td>
                                <td><?php echo $order["s_name"]; ?></td>
                                <td>
                                    <span class="badge bg-<?php 
                                        switch($order["orh_orderstatus"]) {
                                            case "VRFY": echo "info"; break;
                                            case "ACPT": echo "secondary"; break;
                                            case "PREP": echo "warning"; break;
                                            case "RDPK": echo "primary"; break;
                                            case "FNSH": echo "success"; break;
                                            case "CNCL": echo "danger"; break;
                                        } ?>">
                                        <?php echo $order["orh_orderstatus"]; ?>
                                    </span>
                                </td>
                                <td><?php echo (new DateTime($order["orh_ordertime"]))->format("F j, Y H:i"); ?></td>
                                <td><?php echo $order["customer_name"]; ?></td>
                                <td><?php echo "{$order['p_amount']} NRP"; ?></td>
                                <td>
                                    <a href="admin_order_detail.php?orh_id=<?php echo $order['orh_id']; ?>" class="btn btn-primary btn-sm">View</a>
                                    <a href="admin_order_update.php?orh_id=<?php echo $order['orh_id']; ?>" class="btn btn-outline-success btn-sm">Update</a>
                                    <a href="admin_order_delete.php?orh_id=<?php echo $order['orh_id']; ?>" class="btn btn-outline-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                No orders found. Please refine your search.
            </div>
        <?php endif; ?>
    </div>

    <?php include('admin_footer.php'); ?>
</body>
</html>
