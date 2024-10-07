<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_user = $_SESSION['username'];

if (isset($_FILES['profile_picture'])) {
    $file = $_FILES['profile_picture'];
    $upload_dir = "uploads/";

    // Dosya adı ve konumunu belirle
    $file_name = basename($file["name"]);
    $file_path = $upload_dir . $file_name;

    // Dosyayı yükleme
    if (move_uploaded_file($file["tmp_name"], $file_path)) {
        // Veritabanına kaydet
        $sql = "UPDATE users SET profile_picture='$file_name' WHERE username='$current_user'";
        if ($conn->query($sql) === TRUE) {
            echo "Profile picture uploaded successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "File upload failed!";
    }
}

$conn->close();
?>
