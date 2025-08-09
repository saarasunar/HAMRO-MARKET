<?php session_start();
    include ("conn_db.php");
    include ("head.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamro Pasal</title>
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            line-height: 1.6;
        }

        img {
            max-width: 100%;
            display: block;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        #header {
            background-color: #333;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #header .logo {
            width: 80px;
        }

        /* Page Header */
        #page-header {
            height: 100vh;
            text-align: center;
            background: linear-gradient(to right, #ff8c00, #ff0040);
            padding: 2rem 1rem;
        }

        #page-header h2 {
            color: #ff8c;
            font-size: 2.5rem;
        }

        #page-header p {
            color: #ff8c;
            font-size: 1.2rem;
        }

        /* About Section */
        #about-head {
            display: flex;
            gap: 2rem;
            padding: 2rem;
            align-items: center;
        }

        #about-head img {
            flex: 1;
            border-radius: 10px;
        }

        #about-head div {
            flex: 1;
        }

        #about-head h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #333;
        }

        #about-head .paragraph {
            font-size: 1rem;
            color: #666;
            line-height: 1.8;
        }

        .animated-banner {
            padding: 1rem;
            text-align: center;
            background-color: #eee;
            animation: slideIn 5s infinite linear;
        }

        @keyframes slideIn {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        /* Features Section */
        #feature {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            padding: 2rem;
            text-align: center;
        }

        .fe-box {
            background: #f9f9f9;
            padding: 1rem;
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .fe-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .fe-box img {
            height: 80px;
            margin-bottom: 1rem;
        }

       

        /* Responsive Design */
        @media (max-width: 768px) {
            #about-head {
                flex-direction: column;
                text-align: center;
            }

            #header {
                flex-direction: column;
            }

            #navbar {
                flex-direction: column;
                display: none;
            }

            #mobile {
                display: block;
            }
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <?php include ('nav_header.php') ?>
<br><br><br>

    <!-- Page Header -->
    <section id="page-header">
        <h2>#GameTillTheEnd</h2>
        <p>Providing Premium Gaming Peripherals</p>
    </section>

    <!-- About Section -->
    <section id="about-head">
        <img src="img/hamro-pasal.png" alt="About Us">
        <div>
            <h2>About Us</h2>
            <p class="paragraph">
                Hamro Pasal is an online store that offers a wide range of high-quality computer hardware products. Established in 2022, we are committed to providing our customers with the best shopping experience.
            </p>
            <div class="animated-banner">Game till you win!</div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="feature">
        <div class="fe-box">
            <img src="img/features/f1.png" alt="Free Shipping">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f2.png" alt="Online Order">
            <h6>Online Order</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f3.png" alt="Save Money">
            <h6>Save Money</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f4.png" alt="Promotions">
            <h6>Promotions</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f5.png" alt="Happy Sell">
            <h6>Happy Sell</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f6.png" alt="24/7 Support">
            <h6>24/7 Support</h6>
        </div>
    </section>

    <?php include ('footer.php') ?>
</body>

</html>


