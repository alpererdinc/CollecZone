<?php

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
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


    // E-posta kontrolü
    $email_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = $conn->query($email_check_query);

    if ($result->num_rows > 0) {
        // E-posta zaten kayıtlı
        echo "This email is already in use.";
    } else  {
        // Kayıt işlemi
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            $user_id = $conn->insert_id;

            session_start();
            $_SESSION['user_id'] = $user_id;

            echo "Registration successful!";
            header("Location: login.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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


    <link rel="stylesheet" href="CSS/log_style.css">
</head>

<body>
    <div class="main">
        <a href="index.php"><img src="colleczoneLogo.png" class="LoginLogo" alt=""></a>

        <h3>Hi,<br>Come join us and enrich your collection!<br>🥳</h3>

        <form action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Kayıt ol">
        </form>
        <p>Do you have an account?
            <a href="login.php" style="text-decoration: none;">
                Login
            </a>
        </p>
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
</body>

</html>