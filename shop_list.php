<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start(); include("conn_db.php"); include('head.php');?>
    <meta charset="UTF-8">
     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <title>Shop categories | Hamro Pasal</title>
    <style>
        .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for scaling and shadow */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Default shadow */
}

.card:hover {
    transform: scale(1.05); /* Slightly increase the size on hover */
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3); /* Add a more prominent shadow */
}

/*shop*/
#page-header {
  background-image: url("img/banner/p1.jpg");
  width: 100%;
  height: 50vh; /* Increased height */
  background-size: cover;
  display: flex;
  justify-content: center;
  text-align: center;
  flex-direction: column;
  padding: 14px;
}

#page-header h2,
#page-header p {
  color: #ffbd27;
}


#pagination {
  text-align: center;
}

#pagination a {
  text-decoration: none;
  background-color: #088178;
  padding: 15px 20px;
  border-radius: 4px;
  color: #fff;
  font-weight: 600;
}

#pagination a i {
  font-size: 16px;
  font-weight: 600;
}

    </style>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header.php')?>
<br>
<section id="page-header">
    <h2>Premium Gaming</h2>
    <p>Save more with coupons & up to 70% off!</p>
</section>

    <div class="container p-5" id="recommended-shop">
        <h3 class="border-bottom pb-2"><i class="bi bi-shop align-top"></i> Avaliable Categories</h3>

        <!-- GRID SHOP SELECTION -->
        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-3">

        <?php
            $query = "SELECT s_id,s_name,s_pic,s_desc FROM shop";
            $result = $mysqli -> query($query);
            if($result -> num_rows > 0){
            while($row = $result -> fetch_array()){
        ?>
            <!-- GRID EACH SHOP -->
            <div class="col">
                <a href="<?php echo "shop_menu.php?s_id=".$row["s_id"]?>" class="text-decoration-none text-dark">
                    <div class="card rounded-25">
                        <img
                        <?php
                            if(is_null($row["s_pic"])){echo "src='img/default.png'";}
                            else{echo "src=\"img/{$row['s_pic']}\"";}
                        ?>
                        style="width:100%; height:180px; object-fit:fill; transition: filter 0.3s ease;" 
                        class="card-img-top rounded-25 img-fluid" alt="...">
                        <div class="card-body">
                            <h4 name="shop-name" class="card-title"><?php echo $row["s_name"]?></h4>     
                            <p name= "shop-description" class = "shop_description"><?php echo $row["s_desc"]?> </p>
                            <div class="text-end">
                                <a href="<?php echo "shop_menu.php?s_id=".$row["s_id"]?>" class="btn btn-sm btn-outline-dark">See More</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- END GRID EACH SHOP -->
        <?php }
        }else{
            ?>
            </div>
            <div class="row row-cols-1">
                    <div class="col pt-3 px-3 bg-danger text-white rounded text-center">
                        <i class="bi bi-x-circle-fill"></i>
                        <p class="ms-2 mt-2">No items currently avaliable for order!</p>
                    </div>
            </div>
            <?php
        }
            $result -> free_result();
        ?>
        </div>
        <!-- END GRID SHOP SELECTION -->

    </div>

    <?php include('footer.php')?>
</body>

</html>
