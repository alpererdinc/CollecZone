<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" sizes="167x167" href="half-circle.png">

    <title>CollecZone</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allison&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Allison&family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="preload" href="CSS/style.css" as="style" onload="this.rel='stylesheet'">



</head>



<body>


    <?php




    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'products_db';

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }
    $sql = "SELECT product_id, name, image, description FROM products ORDER BY product_id DESC LIMIT 5";
    $result = $conn->query($sql);
    ?>

    <?php include 'navbar.php'; ?>





    <div class="upper_design">
        <div class="pre-blog">
            <h1 class="mainText">Expand</h1>
            <h1 class="mainText2">YOUR <a href="prod_index.php" class="gradient-text"><strong>COLLECT</strong></a>ION</h1>

        </div>

        <div class="wrap">
            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



        </div>
        <div class="RotatingVinyl">
            <img class="plakKolu" src="CSS/images/PLAKKOLU.svg" />
            <img class="plakOrtasi" src="CSS/images/TonPlakOrta.svg" />
            <img class="plakPhoto" src="CSS/images/Frame 30 (2).svg" />
            <img src="CSS/images/nota.png" alt="nota" class="nota">
        </div>
    </div>
    </div>

    <div class="expandButton">
        <a href="#Round"><button class="circleButton">
                &#x2193; <!-- Aşağı ok simgesi -->
            </button></a>
    </div>

    <div class="GoTopButton">
        <a href="#"><button class="circleButton3">
                &#x2191; <!-- Yukarı ok simgesi -->
            </button></a>
    </div>



    <div id="productCarousel" class="carousel slide" data-ride="carousel">
        <h2 class="newProdTitle">New Pieces</h2>
        <div class="carousel-inner">
            <?php
            $active = "active";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                <div class="carousel-item ' . $active . '">
                <a href="product_detail.php?product_id=' . $row['product_id'] . '" style="color: white; text-decoration: none;">
                    <img src="' . $row["image"] . '" class="d-block w-100" alt="' . $row["name"] . '">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>
                                ' . $row["name"] . '
                        </h5>
                        <p>' . $row["description"] . '</p>
                    </div>                            
                    </a>

                </div>';
                    $active = "";
                }
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>






    <div id="Round" class="bigRound">
        <p class="circleText">Collec<strong>Zone</strong> is a page where you can discover collectors' favorites,
            world-famous and now out-of-circulation products. This carefully
            compiled selection includes rare records and timeless pieces that
            left their mark on unforgettable periods in music history; cult
            and unique issues of comic book collections; exotic aromatic
            candles that you cannot easily find. Each product consists of
            valuable pieces that carry traces of the past and offer a special
            meaning to collectors. This rare collection has been brought
            together for music lovers and collectors, and each product tells
            its own story. Take the opportunity to hold historical and cultural
            heritage in your hands while embarking on a unique journey in the
            world of products that can be among your own pieces in our collection.</p>
        <div class="expandButton">
            <a href="#End"><button class="circleButton2">
                    &#x2193; <!-- Aşağı ok simgesi -->
                </button></a>
        </div>
    </div>

    <div id="End" class="bodyTextSpace"></div>
    <p class="bodyText"><a href="prod_index.php"><strong>Find</strong></a> your missing piece.</p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>


    <script src="https://kit.fontawesome.com/6cf8dab1a7.js" crossorigin="anonymous"></script>

    <script src="theme.js"></script>

</body>

<footer>
    <hr>
    <div class="rightstext">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <a href="https://www.instagram.com/alperd.inc/" class="fa fa-instagram" target="_blank"></a>
        <a href="https://www.linkedin.com/in/alper-erdin%C3%A7-363b07252/" class="fa fa-linkedin" target="_blank"></a>
        <a href="https://www.youtube.com/@alpererdinc47" class="fa fa-youtube" target="_blank"></a>

        <hr>
        <p class="copyRights">A website by <a href="https://www.instagram.com/alperd.inc/" target="_blank">Alper
                Erdinç</a></p>
        <p>All rights reserved. © 2024 CollecZone</p>
</footer>

<style>
    footer {
        width: 100%;
        background-color: rgb(255, 255, 255);

        text-align: center;
        position: relative;
        bottom: 0;
        width: 100%;
        margin-top: auto;
    }

    .copyRights {
        text-align: center;
    }
</style>

</html>