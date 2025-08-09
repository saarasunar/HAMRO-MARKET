<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start();
    include ("conn_db.php");
    include ("head.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <title>Welcome | Hamro Pasal</title>
   
</head>

<body class="d-flex flex-column h-100">
    <?php include ('nav_header.php') ?>
    <br><br>
    <section id="hero">
        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with coupons & up to 70% off!</p>
        <a href="shop_list.php">
            <button>Shop Now</button>
        </a>
    </section>

    <section id="feature" class="section-p1">
    <h2>Our Features</h2>
    <div class="features-container">
        <div class="feature-box">
            <img src="img/features/f1.png" alt="Free Shipping" />
            <h6>Free Shipping</h6>
        </div>
        <div class="feature-box">
            <img src="img/features/f2.png" alt="Online Order" />
            <h6>Online Order</h6>
        </div>
        <div class="feature-box">
            <img src="img/features/f3.png" alt="Save Money" />
            <h6>Save Money</h6>
        </div>
        <div class="feature-box">
            <img src="img/features/f4.png" alt="Promotions" />
            <h6>Promotions</h6>
        </div>
        <div class="feature-box">
            <img src="img/features/f5.png" alt="Happy Sell" />
            <h6>Happy Sell</h6>
        </div>
        <div class="feature-box">
            <img src="img/features/f6.png" alt="24/7 Support" />
            <h6>24/7 Support</h6>
        </div>
    </div>
</section>

<style>
  

   #hero {
    background-image: url("img/hero4.png");
    height: 100vh;
    width: 100%;
    background-size: cover;
    background-position: Center;
    padding: 0 80px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    color: #e3e6f3;
    text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
}

#hero h4 {
    padding-bottom: 10px;
    font-size: 18px;
    font-weight: 400;
    text-transform: uppercase;
    letter-spacing: 1px;
}

#hero h2 {
    font-size: 48px;
    font-weight: 700;
    margin: 10px 0;
    line-height: 1.2;
}

#hero h1 {
    color: #088178;
    font-size: 56px;
    font-weight: 700;
    margin: 10px 0;
}

#hero p {
    font-size: 18px;
    margin-bottom: 30px;
}

#hero a button {
    background-image: url("img/button.png");
    background-color: transparent;
    color: #088178;
    border: none;
    padding: 14px 80px 14px 65px;
    background-repeat: no-repeat;
    background-position: center left;
    cursor: pointer;
    font-weight: 700;
    font-size: 15px;
    border-radius: 4px;
    transition: all 0.3s ease;
}



  #banner {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    background-image: url("img/banner/b31.jpg");
    width: 100%;
    height: 40vh;
    background-size: cover;
    background-position: center;
  }
  
  #banner h4 {
    color: #fff;
    font-size: 16px;
  }
  
  #banner h2 {
    color: #fff;
    font-size: 30px;
    padding: 10px 0;
  }
  
  #banner h2 span {
    color: #ef3636;
  }
  
  #banner button:hover {
    background: #088178;
    color: #fff;
  }
  
  #sm-banner {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
  }
  
  #sm-banner .banner-box {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    background-image: url("img/banner/b30.jpg");
    min-width: 720px;
    height: 50vh;
    background-size: cover;
    background-position: center;
    padding: 30px;
  }
  
  #sm-banner .banner-box2 {
    background-image: url("img/banner/b32.jpg");
  }
  
  #sm-banner h4 {
    color: #fff;
    font-size: 20px;
    font-weight: 300;
  }
  
  #sm-banner h2 {
    color: #fff;
    font-size: 28px;
    font-weight: 800;
  }
  
  #sm-banner span {
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    padding-bottom: 15px;
  }
  
  button.white {
    font-size: 13px;
    font-weight: 600;
    padding: 11px 18px;
    color: #fff;
    background-color: transparent;
    border-radius: 4px;
    cursor: pointer;
    border: 1px solid #fff;
    outline: none;
    transition: 0.2s;
  }
  
  #sm-banner .banner-box:hover button {
    background: #088178;
    border: 1px solid #088178;
  }
  
  #banner3 {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 0 80px;
  }
  
  #banner3 .banner-box {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    background-image: url("img/banner/b31.jpg");
    min-width: 30%;
    height: 30vh;
    background-size: cover;
    background-position: center;
    padding: 20px;
    margin-bottom: 20px;
  }
  
  #banner3 .banner-box2 {
    background-image: url("img/banner/p1.jpg");
  }
  
  #banner3 .banner-box3 {
    background-image: url("img/banner/b34.jpeg");
  }
  
  #banner3 h2 {
    color: #fff;
    font-weight: 900;
    font-size: 22px;
  }
  
  #banner3 h3 {
    color: #ec544e;
    font-weight: 800;
    font-size: 15px;
  }
  #feature {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
  }
    /* Features Section Styling */
    #feature {
        padding: 40px 20px;
        text-align: center;
        background-color: #f9f9f9;
    }

    #feature h2 {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    .features-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .feature-box {
        flex: 1 1 calc(33.33% - 20px);
        max-width: calc(33.33% - 20px);
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .feature-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .feature-box img {
        max-width: 80px;
        margin-bottom: 15px;
    }

    .feature-box h6 {
        font-size: 1.1rem;
        color: #555;
        margin: 0;
    }

    
           /* Header */
           #header {
            background-color: #333;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        #header .logo {
            width: 80px;
        }

        #navbar {
            display: flex;
            list-style: none;
            gap: 15px;
        }

        #navbar li a {
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        #navbar li a.active,
        #navbar li a:hover {
            color: #f9a825;
        }

        #mobile {
            display: none;
        }
        
    /* General Banner Styling */
    #banner, #sm-banner, #banner3 {
        padding: 40px 20px;
        text-align: center;
    }

    /* Section 1: Main Banner */
    #banner {
        background: linear-gradient(to right, #ff7e5f, #feb47b);
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 300px;
        border-radius: 12px;
    }

    #banner h4 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    #banner h2 {
        font-size: 2.5rem;
    }

    #banner span {
        color: #ffd700;
        font-weight: bold;
    }

    #banner .primary-btn {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 1rem;
        background: #333;
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    #banner .primary-btn:hover {
        background: #ffd700;
        color: #333;
    }
    /* General Section Styling */
    #sm-banner {
        margin: 30px auto;
        padding: 20px;
        background-color: #f7f7f7;
    }

    .banner-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    /* Banner Box Styling */
    .banner-box {
        flex: 1;
        max-width: 48%;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .banner-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    /* Text Content Styling */
    .banner-text h4 {
        font-size: 1.2rem;
        color: #ff6f61;
        margin-bottom: 10px;
    }

    .banner-text h2 {
        font-size: 1.6rem;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .banner-text span {
        font-size: 1rem;
        color: #666;
        margin-bottom: 15px;
        display: block;
    }

    /* Button Styling */
    .custom-btn {
        padding: 10px 20px;
        font-size: 0.95rem;
        color: #fff;
        background: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
        text-decoration: none;
    }

    .custom-btn:hover {
        background: #0056b3;
    }


    /* Section: Centered Grid Banners */
    #banner3 {
        margin: 30px 0;
        display: flex;
        justify-content: center;
    }

    #banner3 .banner-grid {
        display: flex;
        gap: 20px;
        justify-content: center;
    }

    #banner3 .banner-box {
        flex: 1;
        max-width: 300px;
        padding: 20px;
        background: #333;
        color: #fff;
        border-radius: 8px;
        text-align: center;
        transition: transform 0.3s, background 0.3s;
    }

    #banner3 .banner-box:hover {
        transform: scale(1.05);
        background: #ff6f61;
    }

    #banner3 h2 {
        font-size: 1.3rem;
        margin-bottom: 10px;
    }

    #banner3 h3 {
        font-size: 1rem;
        font-weight: bold;
        color: #ffd700;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        #sm-banner {
            flex-direction: column;
            align-items: center;
        }

        #banner3 .banner-grid {
            flex-direction: column;
            align-items: center;
        }
   
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .feature-box {
            flex: 1 1 calc(50% - 20px);
            max-width: calc(50% - 20px);
        }
    }

    @media (max-width: 480px) {
        .feature-box {
            flex: 1 1 100%;
            max-width: 100%;
        }
    }
</style>



<!-- banner 1: -->
<section id="banner" class="section-m1">
    <div class="banner-content">
        <h4>Summer Sale</h4>
        <h2>Up to <span>70% Off</span> - All CPUs & GPUs</h2>
        <a href="shop_list.php">
            <button class="primary-btn">Explore More</button>
        </a>
    </div>
</section>
<!-- banner 2: -->
<section id="sm-banner" class="section-p1">
    <div class="banner-row">
        <div class="banner-box">
            <div class="banner-text">
                <h4>Crazy Deals</h4>
                <h2>Buy a combo, get one accessory free</h2>
                <span>The best classic is on sale at HamroPasal</span>
                <a href="shop_list.php">
                    <button class="custom-btn">Learn More</button>
                </a>
            </div>
        </div>
        <div class="banner-box banner-box2">
            <div class="banner-text">
                <h4>Coming This Week</h4>
                <h2>Ragnar Sale</h2>
                <span>The best classic coming on sale at HamroPasal</span>
                <a href="shop_list.php">
                    <button class="custom-btn">Collection</button>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- banner 3 -->
<section id="banner3">
    <div class="banner-grid">
        <div class="banner-box">
            <h2>Excalibur Pack</h2>
            <h3>25% OFF</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>Raptor Pack</h2>
            <h3>30% OFF</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>Magneto Pack</h2>
            <h3>50% OFF</h3>
        </div>
    </div>
</section>

    <?php include ('footer.php') ?>

</body>

</html>