<?php
session_start();

// Oturum kontrolü
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Kullanıcı giriş yapmamışsa yönlendir
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

$current_user_id = $_SESSION['user_id']; // user_id kullanımı

if (isset($_FILES['profile_picture'])) {
    $file = $_FILES['profile_picture'];
    $upload_dir = "uploads/";

    // Dosya adı ve konumunu belirle
    $file_name = basename($file["name"]);
    $file_path = $upload_dir . $file_name;

    // Dosya türü kontrolü
    $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($file_type, $allowed_types)) {
        // Dosyayı yükleme
        if (move_uploaded_file($file["tmp_name"], $file_path)) {
            // Veritabanına kaydet
            $stmt = $conn->prepare("UPDATE users SET profile_picture=? WHERE user_id=?");
            $stmt->bind_param("si", $file_name, $current_user_id); // user_id ile güncelle
            if ($stmt->execute() === TRUE) {
                echo "Profil fotoğrafı başarıyla yüklendi!";
                header("Location: profile.php"); // Profil sayfasına yönlendir
                exit; // Yönlendirme sonrası kodu durdur
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
