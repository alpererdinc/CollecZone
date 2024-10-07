<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sayfası</title>
    <link rel="stylesheet" href="profile_style.css">
    <link rel="stylesheet" href="CSS/style.css">

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
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="user-info">
        <?php
        session_start();

        // Kullanıcı oturumu yoksa giriş sayfasına yönlendir
        if (!isset($_SESSION['username'])) {
            header("Location: login.php");
            exit;
        }

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "users_db";

        // Veritabanı bağlantısı
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Oturum açan kullanıcının bilgilerini veritabanından al
        $current_user = $_SESSION['username'];
        $sql = "SELECT * FROM users WHERE username='$current_user'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();

        // Profil bilgilerini görüntüle
        echo "<h1>Hoş geldin, " . $user['username'] . "!</h1>";
        echo "<p>E-postan: " . $user['email'] . "</p>";

        // Profil fotoğrafını göster
        if ($user['profile_picture']) {
            echo "<img src='uploads/" . $user['profile_picture'] . "' alt='Profile Picture' />";
        }

        // Favoriler ve sipariş geçmişi bağlantıları
        echo "<br><a href='favorites.php'>Favorilerim</a><br>";
        echo "<br><a href='order_history.php'>Sipariş Geçmişi</a>";
        echo "<br><br><a href='logout.php'>Çıkış Yap</a>";
        echo "<br><br>";

        $conn->close();
        ?>
    </div>

    <form action="upload_profile_picture.php" method="POST" enctype="multipart/form-data">
        <label for="profile_picture">Profil fotoğrafı ekle:</label>
        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
        <input type="submit" value="Yükle">
    </form>





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
</body>

</html>