<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    include ("conn_db.php");
    include ('head.php');
    if (!isset($_GET["s_id"])) {
        header("location: restricted.php");
        exit(1);
    }
    ?>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <title>Shop Menu | Hamro Pasal</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include ('nav_header.php') ?>

    <?php
    $s_id = $_GET["s_id"];
    $query = "SELECT s_name,s_location,s_phoneno,s_pic,s_desc
        FROM shop WHERE s_id = {$s_id} LIMIT 0,1";
    $result = $mysqli->query($query);
    $shop_row = $result->fetch_array();
    ?>

    <br><br><br><br>

    <div class="container px-5 py-4" id="shop-body">
        <?php
        if (isset($_GET["atc"])) {
            if ($_GET["atc"] == 1) {
                ?>

                <!-- START SUCCESSFULLY ADD TO CART -->
                <div class="row row-cols-1 notibar pb-3">
                    <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                        <i class="bi bi-check-circle    "></i>
                        <span class="ms-2 mt-2">Add item to your cart successfully!</span>
                        <span class="me-2 float-end"><a class="text-decoration-none link-light"
                                href="shop_menu.php?s_id=<?php echo $s_id; ?>">X</a></span>
                    </div>
                </div>
                <!-- END SUCCESSFULLY ADD TO CART -->
            <?php } else { ?>
                <!-- START FAILED ADD TO CART -->
                <div class="row row-cols-1 notibar">
                    <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                        <i class="bi bi-x-circle-fill"></i><span class="ms-2 mt-2">Failed to add item to your cart.</span>
                        <span class="me-2 float-end"><a class="text-decoration-none link-light"
                                href="shop_menu.php?s_id=<?php echo $s_id; ?>">X</a></span>
                    </div>
                </div>
                <!-- END FAILED ADD TO CART -->
            <?php }
        } ?>
       <div class="mb-3 text-wrap" id="shop-header">
    <div class="shop-img-container rounded-25 mb-4" style="overflow: hidden; max-width: 600px; margin: 0 auto;">
        <div class="shop-img" 
            style="
                background: url(
                    <?php
                    if (is_null($shop_row["s_pic"])) {
                        echo "'img/default.png'";
                    } else {
                        echo "'img/{$shop_row['s_pic']}'";
                    }
                    ?>
                ); 
                height: 300px; 
                background-size: cover; 
                background-position: center; 
                transition: transform 0.5s ease, filter 0.5s ease;
            ">
        </div>
    </div>
    <h1 class="display-5 strong text-center"><?php echo $shop_row["s_name"]; ?></h1>
    <p class="display-10 text-center"><?php echo $shop_row["s_desc"]; ?> </p>
    <ul class="list-unstyled text-center">
        <li class="mb-2">
            <i class="bi bi-geo-alt-fill me-2"></i>
            <?php echo $shop_row["s_location"]; ?>
        </li>
        <li>
            <i class="bi bi-telephone-fill me-2"></i>
            Contact number: <?php echo "(+977) " . $shop_row["s_phoneno"]; ?>
        </li>
    </ul>
</div>

<style>
    /* Shop Image Hover Animation */
    .shop-img-container {
        position: relative;
        border-radius: 25px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .shop-img {
        transform: scale(1);
    }

    .shop-img-container:hover .shop-img {
        transform: scale(1.1); /* Zoom in */
        filter: brightness(0.9); /* Slightly darken */
    }

    /* Centered Text Styling */
    #shop-header h1 {
        font-weight: 700;
        margin-top: 15px;
    }

    #shop-header ul li {
        font-size: 18px;
        color: #555;
    }

    #shop-header ul li i {
        color: #007bff; /* Icon color */
    }
</style>
<!-- Add Search Bar -->
<form class="mb-3" method="GET" action="shop_menu.php">
    <input type="hidden" name="s_id" value="<?php echo $s_id; ?>">
    <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Search for products..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button class="btn btn-primary me-2" type="submit"><i class="bi bi-search"></i> Search</button>
        <a href="shop_menu.php?s_id=<?php echo $s_id; ?>" class="btn btn-outline-secondary">Clear</a>
    </div>
</form>
<br>
<!-- Product Grid -->
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 align-items-stretch mb-1">
    <?php
    // Check if a search query exists
    $search_query = isset($_GET['search']) ? trim($mysqli->real_escape_string($_GET['search'])) : '';
    
    // Update SQL query based on search
    $query = "SELECT * FROM category WHERE s_id = {$s_id}";
   if (!empty($search_query)) {
    $query .= " AND (f_name LIKE '%$search_query%' OR f_desc LIKE '%$search_query%')";
}
    $result = $mysqli->query($query);
    
    if ($result->num_rows > 0) {
        while ($category_row = $result->fetch_array()) {
            ?>
            <!-- GRID EACH MENU -->

            
            <div class="col">
                <div class="card rounded-25 menu-card mb-5" style="overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <a href="category.php?<?php echo "s_id=" . $category_row["s_id"] . "&f_id=" . $category_row["f_id"] ?>"
                        class="text-decoration-none text-dark">
                        <div class="card-img-top">
                            <img 
                                <?php
                                if (is_null($category_row["f_pic"])) {
                                    echo "src='img/default.png'";
                                } else {
                                    echo "src=\"img/{$category_row['f_pic']}\"";
                                }
                                ?>
                                style="width:100%; height:150px; object-fit:fill; transition: filter 0.3s ease;" 
                                class="img-fluid" 
                                alt="<?php echo $category_row["f_name"] ?>">
                        </div>
                        <div class="card-body">
    <h5 class="card-title fs-5"><?php echo $category_row["f_name"] ?></h5>
    <p class="card-text f-description">
        <?php echo $category_row["f_desc"]; ?>
    </p>
    <p class="card-text text-danger fw-bold">Rs. <?php echo $category_row["f_price"]; ?></p>
    <a href="category.php?<?php echo "s_id=" . $category_row["s_id"] . "&f_id=" . $category_row["f_id"]; ?>"
        class="btn btn-sm mt-3 btn-outline-primary rounded-25">
        <i class="bi bi-cart-plus"></i>
    </a>
</div>

                    </a>
                </div>
            </div>
            <?php
        }
    } else {
        // Display "Product not found" message
        echo "<div class='col-12 d-flex justify-content-center align-items-center' style='height: 200px;'>
                <p class='text-center text-danger'>No products found matching your search query.</p>
              </div>";
    }
    ?>
</div>

<!-- END GRID EACH MENU -->

<style>
   
   /* Cards with equal size */
.menu-card {
    display: flex; /* Flexbox for consistent layout */
    flex-direction: column; /* Aligns content vertically */
    justify-content: space-between; /* Evenly distributes space inside the card */
    height: 400px; /* Fixed height for all cards */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional for a modern look */
    border: 1px solid #ddd; /* Optional for clear boundaries */
}
.f-description {
    text-align: justify; /* Aligns text evenly on both sides */
    line-height: 1.5; /* Improves spacing between lines */
    font-size: 0.7rem; /* Adjusts font size for better readability */
    word-break: break-word; /* Prevents text overflow by breaking long words */
    margin-bottom: 10px; /* Adds space below the description */
}


    /* Hover Animation */
    .menu-card:hover {
        transform: scale(1.05); /* Slightly enlarge the card */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
    }

    .menu-card:hover img {
        filter: brightness(0.9); /* Darken image on hover */
    }
    .input-group {
    max-width: 600px;
    margin: 0 auto 20px;
}

</style>


        </div>
        <!-- END GRID SHOP SELECTION -->

    </div>
    <?php include ('footer.php') ?>
</body>

</html>