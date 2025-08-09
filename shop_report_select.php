<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        if ($_SESSION["utype"] != "ADMIN") {
            header("location: ../restricted.php");
            exit(1);
        }
        include("../conn_db.php"); 
        include('../head.php');
        include("range_fn.php");
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <script type="text/javascript" src="../js/revenue_date_selection.js"></script>
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <title>Revenue Report | Hamro Pasal</title>
    <style>
        .card {
            border: none;
        }
        .card-body {
            padding: 2rem;
        }
        .form-check-label {
            font-size: 1rem;
        }
        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php'); ?>
    <br><br><br><br>
    <main class="container my-5">
        <div class="card shadow-lg rounded">
            <div class="card-body">
                <h2 class="text-center mb-4"><i class="bi bi-coin"></i> Revenue Report</h2>
                <p class="text-center text-muted mb-4">Select an option below to generate a sales and revenue report.</p>

                <form method="GET" action="shop_report_summary.php">
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rev_mode" id="rev_mode1" value="1" checked onclick="switch_disable(0)">
                            <label class="form-check-label" for="rev_mode1">Today (<?php echo date('F j, Y'); ?>)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rev_mode" id="rev_mode2" value="2" onclick="switch_disable(0)">
                            <label class="form-check-label" for="rev_mode2">Yesterday (<?php echo (new Datetime())->sub(new DateInterval("P1D"))->format('F j, Y'); ?>)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rev_mode" id="rev_mode3" value="3" onclick="switch_disable(0)">
                            <label class="form-check-label" for="rev_mode3">This Week (<?php echo "{$week_start} - {$week_end}"; ?>)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rev_mode" id="rev_mode4" value="4" onclick="switch_disable(0)">
                            <label class="form-check-label" for="rev_mode4">This Month (<?php echo "{$month_start} - {$month_end}"; ?>)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rev_mode" id="rev_mode5" value="5" onclick="switch_disable(1)">
                            <label class="form-check-label" for="rev_mode5">Specific Date Range</label>
                        </div>
                    </div>

                    <div class="row g-3 align-items-end mb-4">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" oninput="update_minrange()" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" disabled>
                        </div>
                    </div>

                    <button class="btn btn-info w-100" type="submit">Generate Report</button>
                </form>
            </div>
        </div>
    </main>

    <?php include('admin_footer.php') ?>
</body>

</html>
