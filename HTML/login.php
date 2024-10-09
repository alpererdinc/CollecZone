<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcı adı ile user_id ve şifreyi seç
    $sql = "SELECT user_id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Şifreyi doğrula
        if (password_verify($password, $row['password'])) {
            session_start();
            // user_id'yi oturuma ekle
            $_SESSION['user_id'] = $row['user_id'];

            echo "Giriş başarılı! Hoş geldin!";
            header("Location: index.php"); // Ana sayfaya yönlendir
            exit;
        } else {
            echo "Hatalı şifre.";
        }
    } else {
        echo "Böyle bir kullanıcı adı bulunamadı.";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" sizes="167x167" href="half-circle.png">
    <title>CollecZone Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <link rel="stylesheet" href="log_style.css"> <!-- CSS dosyasını dahil et -->
</head>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html> -->

<body>




    <div class="main">
        <a href="index.php"><img src="colleczoneLogo.png" class="LoginLogo" alt=""></a>

        <h3>Tekrar hoş geldin koleksiyoner!<br>Yoksa colleczoner mi demeliydim?<br>😏</h3>
       
        <form action="login.php" method="POST">
                  <label for="username">
                        Kullanıcı Adı:
                  </label>
                  <input type="text" id="username" name="username" placeholder="Kullanıcı adınızı giriniz" required>

                  <label for="password">
                        Şifre:
                  </label>
                  <input type="password" id="password" name="password" placeholder="Şifrenizi giriniz" required>

                  <div class="wrap">
                        <button type="submit" onclick="solve()">
                              Giriş Yap
                        </button>
                  </div>
            </form>
            <p>Kaydınız yok mu?
                  <a href="register.php" style="text-decoration: none;">
                        Hesap oluşturun
                  </a>
            </p>
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
</body>

</html>