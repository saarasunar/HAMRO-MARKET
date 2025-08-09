<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        include('../head.php');
        if($_SESSION["utype"]!="ADMIN"){
            header("location: ../restricted.php");
            exit(1);
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/hamro-pasal.png">
    <link href="../css/main.css" rel="stylesheet">
    <title>Customer List | Hamro Pasal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100 bg-light">

    <?php include('nav_header_admin.php') ?>
<br><br><br><br>
    <div class="container mt-4 mb-4">
        <div class="d-flex align-items-center mb-4">
          
            <h1 class="h3 mb-0">Shop List</h1>
        </div>

        <!-- Notifications -->
        <?php if (isset($_GET["up_spf"])) { ?>
            <div class="alert <?php echo $_GET["up_spf"] == 1 ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show" role="alert">
                <i class="bi <?php echo $_GET["up_spf"] == 1 ? 'bi-check-circle' : 'bi-x-circle'; ?>"></i>
                <?php echo $_GET["up_spf"] == 1 ? 'Successfully updated shop profile.' : 'Failed to update shop profile.'; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php if (isset($_GET["del_shp"])) { ?>
            <div class="alert <?php echo $_GET["del_shp"] == 1 ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show" role="alert">
                <i class="bi <?php echo $_GET["del_shp"] == 1 ? 'bi-check-circle' : 'bi-x-circle'; ?>"></i>
                <?php echo $_GET["del_shp"] == 1 ? 'Successfully deleted shop profile.' : 'Failed to delete shop profile.'; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php if (isset($_GET["add_shp"])) { ?>
            <div class="alert <?php echo $_GET["add_shp"] == 1 ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show" role="alert">
                <i class="bi <?php echo $_GET["add_shp"] == 1 ? 'bi-check-circle' : 'bi-x-circle'; ?>"></i>
                <?php echo $_GET["add_shp"] == 1 ? 'Successfully added new shop.' : 'Failed to add new shop.'; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <!-- Search Form -->
        <div class="card shadow-sm p-4 mb-4">
            <form class="row g-3" method="GET" action="admin_shop_list.php">
                <div class="col-md-4">
                    <input type="text" class="form-control" id="username" name="un" placeholder="Username"
                        <?php if (isset($_GET["search"])) { ?> value="<?php echo $_GET["un"]; ?>" <?php } ?>>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="shopname" name="sn" placeholder="Shop Name"
                        <?php if (isset($_GET["search"])) { ?> value="<?php echo $_GET["sn"]; ?>" <?php } ?>>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                    <button type="submit" name="search" value="1" class="btn btn-success me-2">Search</button>
                    <button type="reset" class="btn btn-danger me-2"
                        onclick="javascript: window.location='admin_shop_list.php'">Clear</button>
                    <a href="admin_shop_add.php" class="btn btn-primary">Add New Shop</a>
                </div>
            </form>
        </div>

        <!-- Shop Table -->
        <?php
        if (!isset($_GET["search"])) {
            $search_query = "SELECT s_id,s_username,s_name,s_location,s_email,s_phoneno FROM shop;";
        } else {
            $search_un = $_GET["un"];
            $search_sn = $_GET["sn"];
            $search_query = "SELECT s_id,s_username,s_name,s_location,s_email,s_phoneno FROM shop
                WHERE s_username LIKE '%{$search_un}%' AND s_name LIKE '%{$search_sn}%';";
        }
        $search_result = $mysqli->query($search_query);
        $search_numrow = $search_result->num_rows;

        if ($search_numrow == 0) {
        ?>
            <div class="alert alert-danger text-center" role="alert">
                <i class="bi bi-exclamation-circle"></i> No shops found!
                <a href="admin_shop_list.php" class="alert-link">Clear Search</a>
            </div>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Shop Name</th>
                            <th>Location</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; while ($row = $search_result->fetch_array()) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row["s_username"]; ?></td>
                                <td><?php echo $row["s_name"]; ?></td>
                                <td><?php echo $row["s_location"]; ?></td>
                                <td><?php echo $row["s_email"]; ?><br><?php echo "(+91) " . $row["s_phoneno"]; ?></td>
                                <td>
                                    <a href="admin_shop_detail.php?s_id=<?php echo $row["s_id"] ?>" class="btn btn-sm btn-primary">View</a>
                                    <a href="admin_shop_edit.php?s_id=<?php echo $row["s_id"] ?>" class="btn btn-sm btn-outline-success">Edit</a>
                                    <a href="admin_shop_delete.php?s_id=<?php echo $row["s_id"] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php }
        $search_result->free_result();
        ?>
    </div>

    <?php include('admin_footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
