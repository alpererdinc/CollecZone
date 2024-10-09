<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sayfası</title>
    <link rel="stylesheet" href="profile_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>


    <div class="user-page">
        <?php
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit;
        }
        include 'navbar.php'; ?>
        <div class="user-info">
            <?php
            $user_id = $_SESSION['user_id'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "products_db";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Kullanıcı bilgilerini veritabanından al
            $sql = "SELECT * FROM users WHERE user_id='$user_id'";
            $result = $conn->query($sql);
            $user = $result->fetch_assoc();

            if (!$user) {
                echo "Kullanıcı bulunamadı.";
                exit; // Kullanıcı bulunamazsa kodu durdur
            }

            // Profil fotoğrafını göster
            if ($user['profile_picture']) {
                echo "<img class='profile-pic' src='uploads/" . htmlspecialchars($user['profile_picture']) . "' alt='Profile Picture' />";
            }

            // Profil bilgilerini görüntüle
            echo "<h1>Hoş geldin, " . htmlspecialchars($user['username']) . "!</h1>";
            echo "<p><strong>E-postan:</strong> " . htmlspecialchars($user['email']) . "</p>";

            // Favoriler ve sipariş geçmişi bağlantıları
            echo "<br><a class='profile_link' href='favorites.php'>Favorilerim</a><br>";
            echo "<br><a class='profile_link' href='order_history.php'>Sipariş Geçmişi</a>";
            echo "<br><br><a class='profile_link' href='logout.php'>Çıkış Yap</a>";
            echo "<br><br>";

            $conn->close();
            ?>
        </div>
    </div>

    <form action="upload_profile_picture.php" method="POST" enctype="multipart/form-data">
        <label for="profile_picture">Profil fotoğrafı ekle:</label>
        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
        <input type="submit" value="Yükle">
    </form>

    <!-- <br><a class="home-button" href="index.php">Ana Sayfaya Dön</a> -->

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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>

</html>