<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>CollecZone</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="icon" type="image/x-icon" sizes="167x167" href="half-circle.png">
    <link rel="stylesheet" href="CSS/prod_style.css">
</head>

<body>

    <?php
    // Kullanıcı oturumu yoksa giriş sayfasına yönlendir

    ?>
    <?php include 'navbar.php'; ?>


    <form class="filter_form" method="GET" action="product_filter.php">
        <label for="category">Kategori Seç:</label>
        <select name="category" id="category">
            <option value="">Tüm ürünler</option>
            <option value="music">Müzik</option>
            <option value="comics">Çizgi Roman</option>
            <!-- Diğer kategoriler burada eklenebilir -->
        </select>
        <button type="submit">Filter</button>
    </form>


    <div class="container">
        <div class="row">
            <?php

            $host = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'products_db';


            $conn = new mysqli($host, $username, $password, $dbname);


            if ($conn->connect_error) {
                die("Bağlantı hatası: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-sm card'>";
                    // Ürün detay sayfasına link
                    echo "<a  href='product_detail.php?product_id=" . $row['product_id'] . "'>";

                    echo "<img src='" . $row["image"] . "' alt='Ürün Resmi'>";
                    echo "<h2 class='plakName'>" . $row["name"] . "</h2>";
                    echo "<p class='price'>Fiyat: " . $row["price"] . " TL</p>";
                    echo "<p>" . $row["description"] . "</p>";

                    echo "</a>"; // Linki kapat
                    echo "<form action='add_cart.php' method='POST'>";
                    echo "<input type='hidden' name='product_id' value='" . $row["product_id"] . "'>"; // Ürün ID'si
                    // echo "<input type='number' name='quantity' value='1' min='1' class='form-control mb-2'>"; 
                    echo "<button type='submit' class='btn btn-primary'>Sepete Ekle</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>Hiç ürün yok.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <div class="GoTopButton">
        <a href="#"><button class="circleButton3">
                &#x2191; <!-- Yukarı ok simgesi -->
            </button></a>
    </div>

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
        <p>Tüm hakları saklıdır. © 2024 CollecZone</p>
    </footer>

    <style>
        .filter_form {
            margin-bottom: 50px;
            margin-top: 50px;

            text-align: center;
        }

    </style>

    <ul>
        <li>
            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider"></span>
            </label>
        </li>
    </ul>

    <script src="theme.js"></script>
    <style>
        .switch {
            position: absolute;
            top: 23px;
            right: 20px;
            display: inline-block;
            width: 60px;
            height: 34px;

        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }


        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #FF5B5B;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }

        /* Renkli Tema */
        body.colored-theme {
            background-image: url(CSS/images/GreenGradi.jpg);
            transition: background-color 0.5s ease, background-image 0.5s ease, color 0.5s ease;

        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
</body>

</html>