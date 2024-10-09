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
    <link rel="stylesheet" href="prod_style.css">
</head>

<body>

    <?php
    // Kullanıcı oturumu yoksa giriş sayfasına yönlendir

    ?>
    <?php include 'navbar.php'; ?>


    <div class="container">
        <div class="row">
            <?php
            // Veritabanı bilgilerini tanımlayın
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'products_db';

            // Veritabanı bağlantısını oluşturun
            $conn = new mysqli($host, $username, $password, $dbname);

            // Bağlantıyı kontrol et
            if ($conn->connect_error) {
                die("Bağlantı hatası: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-sm card'>";
                    echo "<img src='" . $row["image"] . "' alt='Ürün Resmi'>";
                    echo "<h2 class='plakName'>" . $row["name"] . "</h2>";
                    echo "<p class='price'>Fiyat: " . $row["price"] . " TL</p>";
                    echo "<p>" . $row["description"] . "</p>";
                    echo "<form action='add_cart.php' method='POST'>";
                    echo "<input type='hidden' name='product_id' value='" . $row["product_id"] . "'>"; // Ürün ID'si
                    echo "<input type='number' name='quantity' value='1' min='1' class='form-control mb-2'>"; // Adet
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

    <footer>
        <hr>
        <div class="rightstext">
            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <!-- Add font awesome icons -->
            <a href="https://www.instagram.com/alperd.inc/" class="fa fa-instagram" target="_blank"></a>
            <a href="https://www.linkedin.com/in/alper-erdin%C3%A7-363b07252/" class="fa fa-linkedin" target="_blank"></a>
            <a href="https://www.youtube.com/@alpererdinc47" class="fa fa-youtube" target="_blank"></a>

            <p class="copyRights">A website by <a href="https://www.instagram.com/alperd.inc/" target="_blank">Alper
                    Erdinç</a></p>
        </div>

    </footer>

    <style>
        footer {
            width: 100%;
            background-color: rgb(255, 255, 255);

            text-align: center;
            position: relative;
            /* Konumlandırmayı yapabilmek için */
            bottom: 0;
            /* En alta sabitle */
            width: 100%;
            /* Tüm genişliği kapla */
            margin-top: auto;
            /* Üstten otomatik boşluk bırak */
        }

        .copyRights {
            text-align: center;
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