<?php session_start();
    include ("conn_db.php");
    include ("head.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hamro Pasal</title>
    <link rel="icon" type="image/png" href="img/hamro-pasal.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
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

        #navbar {
            display: flex;
            list-style: none;
            gap: 20px;
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

 /* Page Header */
 #page-header {
            height: 100vh;
            text-align: center;
            background: linear-gradient(to right, #ff8c00, #ff0040);
            padding: 2rem 1rem;
        }

        #page-header h2 {
            font-size: 2.5rem;
            color: #ff8c;
        }

        #page-header p {
            font-size: 1.2rem;
            color: #ff8c;
        }

        /* Contact Details */
        #contact-details {
            display: flex;
            flex-wrap: wrap;
            padding: 40px 20px;
            gap: 20px;
            background: white;
        }

        #contact-details .details {
            flex: 1 1 45%;
            max-width: 45%;
        }

        #contact-details .details li {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        #contact-details .details i {
            margin-right: 10px;
            color: #f9a825;
        }

        #contact-details .map {
            flex: 1 1 45%;
            max-width: 45%;
        }

        #contact-details .map iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Team Section */
        #form-details {
            padding: 40px 20px;
            display: flex;
            justify-content: space-around;
            background: #f4f4f4;
        }

        #form-details .team-member {
            text-align: center;
            width: 250px;
        }

        #form-details .team-member img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        #form-details .team-member p {
            font-size: 14px;
        }

        #form-details .team-member span {
            font-weight: bold;
        }


        /* Responsive */
        @media (max-width: 768px) {
            #contact-details {
                flex-direction: column;
            }

            #contact-details .details,
            #contact-details .map {
                max-width: 100%;
                flex: 1 1 100%;
            }

            #form-details {
                flex-direction: column;
                align-items: center;
            }

            #form-details .team-member {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <?php include ('nav_header.php') ?>
   <br><br><br>
    <section id="page-header">
        <h2>#GameTillTheEnd</h2>
        <p>Providing Premium Gaming Experience</p>
    </section>

    <section id="contact-details">
        <div class="details">
        <h1 style="font-size: 36px;">Contact Us</h1>
        <h3 style="font-size: 20px; color: black;">Head Office</h3>

            <li><i class="fas fa-map-marker-alt"></i> Kageshwori Manohara - 1 ,Gagalphedi</li>
            <li><i class="fas fa-envelope"></i> HamroPasal@example.com</li>
            <li><i class="fas fa-phone-alt"></i> +9789456123</li>
            <li><i class="fas fa-clock"></i> Sunday - Saturday: 9am - 5pm</li>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?..." loading="lazy"></iframe>
        </div>
    </section>

    <section id="form-details">
        <div class="team-member">
            <img src="img/people/a.jpeg" alt="Team Member">
            <p><span>Pasaley Dai</span><br>CEO<br>Email: Pasaley1@gmail.com</p>
        </div>
        <div class="team-member">
            <img src="img/people/b.jpeg" alt="Team Member">
            <p><span>Pasaley Vai</span><br>Marketing Manager<br>Email: Pasaley2@gmail.com</p>
        </div>
        <div class="team-member">
            <img src="img/people/c.jpeg" alt="Team Member">
            <p><span>Pasaley</span><br>Customer Service<br>Email: Pasaley3@gmail.com</p>
        </div>
    </section>

    <?php include ('footer.php') ?>
</script>

</body>

</html>

