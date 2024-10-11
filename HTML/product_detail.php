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
</head>

<body>

    <?php
    include 'navbar.php';
    ?>


    <?php
    error_reporting(E_ERROR | E_PARSE); // Yalnızca hata ve parse hatalarını göster
    ?>



    <?php
    // Veritabanı bağlantısı
    include 'db_connection.php'; // Veritabanı bağlantısı olan dosya





    // URL'den gelen product_id'yi al
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];

        // Ürünün detaylarını veritabanından al
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id); // product_id'yi parametre olarak bağla
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Check if the product is already favorited by the user
            $user_id = $_SESSION['user_id']; // Assuming you have the user ID in the session
            $fav_sql = "SELECT * FROM favorites WHERE user_id = ? AND product_id = ?";
            $fav_stmt = $conn->prepare($fav_sql);
            $fav_stmt->bind_param("ii", $user_id, $product_id);
            $fav_stmt->execute();
            $fav_result = $fav_stmt->get_result();
            $is_favorited = $fav_result->num_rows > 0;


            // Ürün detaylarını göster
            echo "<div class='product-detail'>";
            echo "<img src='" . $row["image"] . "' alt='Ürün Resmi'>";
            echo "<div class='product-info'>"; // Ürün bilgileri için bir div oluşturuldu
            echo "<h2>" . $row["name"] . "</h2>";
            echo "<p class='price'>" . $row["price"] . " TL</p>";

    ?>
            <form action="add_favorite.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
                <button type="submit" class="btn btn-link">
                    <?php

                    if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];
                    } else {

                        echo "Favoriye eklemek için giriş yapmalısınız.";
                    }


                    ?>
                    <i class="fa fa-star <?php echo $is_favorited ? 'filled' : ''; ?>"></i>
                </button>
            </form>

    <?php
            echo "<p>" . $row["description"] . "</p>";

            // Sepete ekle butonu
            echo "<form action='add_cart.php' method='POST' class='d-inline'>"; // Form d-inline olarak ayarlandı
            echo "<input type='hidden' name='product_id' value='" . $row["product_id"] . "'>"; // Ürün ID'si
            echo "<button type='submit' class='btn btn-primary'>Sepete Ekle</button>";
            echo "</form>";
            echo "</div>"; // Ürün bilgileri divinin kapatılması

            echo "</div>";
        } else {
            echo "<p>Bu ürün bulunamadı.</p>";
        }

        $stmt->close();
        $fav_stmt->close();
    } else {
        echo "<p>Ürün ID'si belirtilmedi.</p>";
    }

    $conn->close();
    ?>

    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }

        .product-detail {
            display: flex;
            align-items: flex-start;
            /* Ürün fotoğrafı ve içerik üstten hizalanır */
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .product-detail img {
            width: 300px;
            /* Resim boyutu ayarlanıyor */
            border-radius: 10px;
            margin-right: 20px;
            /* Resim ile içerik arasındaki boşluk */
            object-fit: cover;
        }

        .product-info {
            /* Ürün bilgileri için yeni sınıf */
            display: flex;
            flex-direction: column;
            /* Alt alta dizilmesi için dikey düzenleme */
        }

        .product-detail h2 {
            font-size: 2rem;
            color: #333333;
            margin: 0 0 10px;
            /* Aşağıda boşluk bırakılır */
        }

        .product-detail .price {
            font-size: 1.5rem;
            color: #28a745;
            font-weight: bold;
            margin: 0 0 10px;
            /* Aşağıda boşluk bırakılır */
        }

        .product-detail p {
            font-size: 1.1rem;
            color: #666666;
            margin: 0 0 15px;
            /* Aşağıda boşluk bırakılır */
        }

        .product-detail form {
            margin-top: 10px;
            /* Form ile üst kısımlar arasında boşluk */
        }

        .product-detail button {
            padding: 10px 20px;
            font-size: 1.2rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .product-detail button:hover {
            background-color: #0056b3;
        }

        .fa-star {
            color: #ccc;
            /* Default empty star color */
        }

        .fa-star.filled {
            color: #FFD700;
            /* Filled star color */
        }

        footer {
            width: 100%;
            background-color: rgb(255, 255, 255);
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: auto;
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

</body>

</html>