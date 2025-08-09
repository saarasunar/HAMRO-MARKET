<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <?php
    session_start();
    include ("../conn_db.php");
    include ('../head.php');
    if ($_SESSION["utype"] != "ADMIN") {
        header("location: ../restricted.php");
        exit(1);
    }
    ?>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/main1.css" rel="stylesheet">
    <title>Admin Dashboard | Hamro Pasal</title>



    <style>
        .hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
}

.card-title i {
    font-size: 1.5rem;
}

.card {
    border-width: 2px;
}

.card-body {
    padding: 1.5rem;
}

.card-text span {
    font-weight: bold;
}

.text-muted {
    font-size: 0.9rem;
}

.text-end button {
    transition: background-color 0.2s, color 0.2s;
}

.text-end button:hover {
    background-color: #000;
    color: #fff;
}

    </style>
</head>

<body class="d-flex flex-column">
    <?php include ('nav_header_admin.php') ?>

    <br><br><br>
    <body class="d-flex flex-column h-100">
    <div class="d-flex text-center text-white position-relative promo-banner-bg py-2" style="background: linear-gradient(135deg, #4caf50, #2c7bf8);">
    <div class="p-lg-2 mx-auto my-5">
        <h1 class="display-5 fw-normal">ADMIN DASHBOARD</h1>
        <p class="lead fw-normal">Hamro Pasal | Computer Accessories </p>
        <span class="xsmall-font text-muted"></span>
    </div>
</div>

<div class="container py-5" id="admin-dashboard">

    <div class="mt-5">
        
        <div class="d-flex justify-content-center flex-wrap align-items-start">
    <!-- Sales Pie Chart with Heading -->
    <div class="text-center m-3">
        <h3 class="mb-3">Shop Sales Distribution</h3>
        <div style="width: 400px; height: 300px;">
            <canvas id="salesPieChart"></canvas>
        </div>
    </div>

    <!-- Profit Bar Chart with Heading -->
    <div class="text-center m-3">
        <h3 class="mb-3">Profit Overview</h3>
        <div style="width: 600px; height: 300px;">
            <canvas id="profitBarChart"></canvas>
        </div>
    </div>
</div>
<br>

<!-- Dashboard Header -->
<h2 class="border-bottom pb-3 mb-4 fw-bold">
        <i class="bi bi-graph-up me-2"></i> System Status
    </h2>
    <!-- Admin Dashboard Grid -->
    <div class="row g-4">
        <!-- Customer Card -->
        <div class="col-12 col-md-6 col-lg-3">
            <a href="admin_customer_list.php" class="text-decoration-none">
                <div class="card border-danger shadow-sm h-100 rounded-4 hover-card">
                    <div class="card-body">
                        <h5 class="card-title text-danger fw-bold mb-3">
                            <i class="bi bi-person-fill me-2"></i>Customers
                        </h5>
                        <p class="card-text text-muted mb-4">
                            <span class="fs-4 fw-bold text-dark">
                                <?php
                                $cust_query = "SELECT COUNT(*) AS cnt FROM customer;";
                                $cust_arr = $mysqli->query($cust_query)->fetch_array();
                                echo $cust_arr["cnt"];
                                ?>
                            </span>
                            customer(s) in the system
                        </p>
                        <div class="text-end">
                            <button class="btn btn-outline-danger btn-sm px-3">View List</button>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Computer Accessories Shop Card -->
        <div class="col-12 col-md-6 col-lg-3">
            <a href="admin_shop_list.php" class="text-decoration-none">
                <div class="card border-success shadow-sm h-100 rounded-4 hover-card">
                    <div class="card-body">
                        <h5 class="card-title text-success fw-bold mb-3">
                            <i class="bi bi-shop me-2"></i>Computer Accessories Shops
                        </h5>
                        <p class="card-text text-muted mb-4">
                            <span class="fs-4 fw-bold text-dark">
                                <?php
                                $cust_query = "SELECT COUNT(*) AS cnt FROM shop;";
                                $cust_arr = $mysqli->query($cust_query)->fetch_array();
                                echo $cust_arr["cnt"];
                                ?>
                            </span>
                            Computer Accessories(s) in the system
                        </p>
                        <div class="text-end">
                            <button class="btn btn-outline-success btn-sm px-3">View List</button>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Product Card -->
        <div class="col-12 col-md-6 col-lg-3">
            <a href="admin_category_list.php" class="text-decoration-none">
                <div class="card border-primary shadow-sm h-100 rounded-4 hover-card">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold mb-3">
                            <i class="bi bi-card-list me-2"></i>Products
                        </h5>
                        <p class="card-text text-muted mb-4">
                            <span class="fs-4 fw-bold text-dark">
                                <?php
                                $cust_query = "SELECT COUNT(*) AS cnt FROM category;";
                                $cust_arr = $mysqli->query($cust_query)->fetch_array();
                                echo $cust_arr["cnt"];
                                ?>
                            </span>
                            Product(s) in the system
                        </p>
                        <div class="text-end">
                            <button class="btn btn-outline-primary btn-sm px-3">View List</button>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Order Card -->
        <div class="col-12 col-md-6 col-lg-3">
            <a href="admin_order_list.php" class="text-decoration-none">
                <div class="card border-warning shadow-sm h-100 rounded-4 hover-card">
                    <div class="card-body">
                        <h5 class="card-title text-warning fw-bold mb-3">
                            <i class="bi bi-cart-fill me-2"></i>Orders
                        </h5>
                        <p class="card-text text-muted mb-4">
                            <span class="fs-4 fw-bold text-dark">
                                <?php
                                $cust_query = "SELECT COUNT(*) AS cnt FROM order_header;";
                                $cust_arr = $mysqli->query($cust_query)->fetch_array();
                                echo $cust_arr["cnt"];
                                ?>
                            </span>
                            order(s) in the system
                        </p>
                        <div class="text-end">
                            <button class="btn btn-outline-warning btn-sm px-3">View List</button>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php
// Query for total sales and profit
$salesQuery = "
    SELECT 
        shop.s_name AS shop_name, 
        COALESCE(SUM(payment.p_amount), 0) AS total_sales,
        COALESCE(SUM(payment.p_amount - (order_detail.ord_amount * order_detail.ord_buyprice)), 0) AS total_profit
    FROM shop
    LEFT JOIN order_header ON shop.s_id = order_header.s_id
    LEFT JOIN order_detail ON order_header.orh_id = order_detail.orh_id
    LEFT JOIN payment ON order_header.p_id = payment.p_id
    GROUP BY shop.s_name;
";


$result = $mysqli->query($salesQuery);

// Initialize arrays
$shopNames = [];
$shopSales = [];
$shopProfits = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Sanitize and store the data
        $shopNames[] = htmlspecialchars($row['shop_name'] ?? 'Unknown');
        $shopSales[] = (float)($row['total_sales'] ?? 0);
        $shopProfits[] = (float)($row['total_profit'] ?? 0);
    }
} else {
    // Display error if query fails
    echo "<p class='text-danger'>Failed to load chart data: " . htmlspecialchars($mysqli->error) . "</p>";
}

// Optional: Handle empty data gracefully
if (empty($shopNames)) {
    $shopNames = ['No Data'];
    $shopSales = [0];
    $shopProfits = [0];
}

?>



<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Custom Script to Render Charts -->
<script>
    // Pass PHP data to JavaScript
    const shopData = {
        names: <?php echo json_encode($shopNames); ?>,
        sales: <?php echo json_encode($shopSales); ?>,
        profits: <?php echo json_encode($shopProfits); ?>
    };

    // Render Pie Chart
    const salesPieCtx = document.getElementById('salesPieChart').getContext('2d');
    new Chart(salesPieCtx, {
        type: 'pie',
        data: {
            labels: shopData.names,
            datasets: [{
                data: shopData.sales,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF5722'],
                hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF5722']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Render Bar Chart
    const profitBarCtx = document.getElementById('profitBarChart').getContext('2d');
    new Chart(profitBarCtx, {
        type: 'bar',
        data: {
            labels: shopData.names,
            datasets: [{
                label: 'Profit',
                data: shopData.profits,
                backgroundColor: '#4CAF50',
                borderColor: '#388E3C',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { title: { display: true, text: 'Categories' } },
                y: { title: { display: true, text: 'Profit (in $)' }, beginAtZero: true }
            }
        }
    });
</script>


    
    <?php include ('admin_footer.php') ?>
</body>

</html>