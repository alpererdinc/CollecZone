<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" sizes="167x167" href="half-circle.png">

    <title>CollecZone Profile</title>
    <link rel="stylesheet" href="CSS/profile_style.css">
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

       
            $sql = "SELECT * FROM users WHERE user_id='$user_id'";
            $result = $conn->query($sql);
            $user = $result->fetch_assoc();

            if (!$user) {
                echo "Kullanıcı bulunamadı.";
                exit; 
            }

            if ($user['profile_picture']) {
                echo "<img class='profile-pic' src='uploads/" . htmlspecialchars($user['profile_picture']) . "' alt='Profile Picture' />";
            }

            
            echo "<h1>Welcome, " . htmlspecialchars($user['username']) . "!</h1>";
            echo "<p><strong>E-mail:</strong> " . htmlspecialchars($user['email']) . "</p>";

           
            echo "<br><a class='profile_link' href='favorites.php'>My Favorites</a><br>";
            echo "<br><a class='profile_link' href='order_history.php'>Order History</a>";
            echo "<br><br><a class='profile_link' href='logout.php'>Logout</a>";
            echo "<br><br>";

            $conn->close();
            ?>
        </div>
    </div>

    <form class="pic_form" action="upload_profile_picture.php" method="POST" enctype="multipart/form-data">
        <label for="profile_picture">Add profile photo:</label>
        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
        <input type="submit" value="Upload">
    </form>




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
  background-color: #000000;
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


body.colored-theme {
  background-image: url(CSS/images/GreenGradi.jpg);
  transition: background-color 0.5s ease, background-image 0.5s ease, color 0.5s ease;

}


body{
  padding-top: 100px;

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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>

</html>