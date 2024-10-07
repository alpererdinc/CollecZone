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
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarılı!";
        $_SESSION['username'] = $username; // Oturum değişkenini ayarla
        header("Location: login.php"); // Profil sayfasına yönlendir
        exit; // Yönlendirme sonrası kodu durdur
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <form action="register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html> -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" sizes="167x167" href="half-circle.png">
    <title>CollecZone Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <link rel="stylesheet" href="log_style.css"> <!-- CSS dosyasını dahil et -->
</head>

<body>
    <div class="main">
        <a href="index.html"><img src="colleczoneLogo.png" class="LoginLogo" alt=""></a>

        <h3>Merhaba,<br>Aramıza gel ve koleksiyonunu zenginleştir!<br>🥳</h3>

        <form action="register.php" method="POST">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="email">E-posta:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Kayıt ol">
        </form>
        <p>Kaydınız var mu?
                  <a href="login.php" style="text-decoration: none;">
                        Giriş yapın
                  </a>
            </p>
    </div>
</body>

</html>