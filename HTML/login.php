<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            echo "Giriş başarılı! Hoş geldin, " . $_SESSION['username'] . "!";
            header("Location: index.html"); // Profil sayfasına yönlendir
            exit; // Yönlendirme sonrası kodu durdur
        } else {
            echo "Hatalı şifre.";
        }
    } else {
        echo "Böyle bir kullanıcı adı bulunamadı.";
    }
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
        <a href="index.html"><img src="colleczoneLogo.png" class="LoginLogo" alt=""></a>

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


</body>

</html>