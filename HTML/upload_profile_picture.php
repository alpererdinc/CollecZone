<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_user_id = $_SESSION['user_id']; 

if (isset($_FILES['profile_photo'])) {
    $file = $_FILES['profile_photo'];
    $upload_dir = "uploads/";

   
    $file_name = basename($file["name"]);
    $file_path = $upload_dir . $file_name;

    
    $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($file_type, $allowed_types)) {
      
        if (move_uploaded_file($file["tmp_name"], $file_path)) {
            
            $stmt = $conn->prepare("UPDATE users SET profile_photo=? WHERE user_id=?");
            $stmt->bind_param("si", $file_name, $current_user_id); 
            if ($stmt->execute() === TRUE) {
                echo "Profil fotoğrafı başarıyla yüklendi!";
                header("Location: profile.php"); 
                exit; 
            } else {
                echo "Hata: " . $conn->error;
            }
        } else {
            echo "Dosya yüklemesi başarısız oldu!";
        }
    } else {
        echo "Yalnızca JPG, JPEG, PNG ve GIF dosyaları yüklenebilir.";
    }
}

$conn->close();
?>
