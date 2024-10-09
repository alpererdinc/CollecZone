<?php
session_start();
        
if (!isset($_SESSION['user_id'])) {
    // Kullanıcı giriş yapmamışsa giriş sayfasına yönlendir
    header("Location: login.php");
    exit;
}

// Giriş yapmış kullanıcıya ait user_id'yi al
$user_id = $_SESSION['user_id'];

$product_id = $_POST['product_id']; // Ensure this is set correctly

// Database connection
$mysqli = new mysqli("localhost", "root", "", "products_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Prepare and execute the statement
$stmt = $mysqli->prepare("INSERT INTO cart (user_id, product_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $product_id);

if (!$stmt->execute()) {
    die("Error executing query: " . $stmt->error);
}

header("Location: cart.php");
exit;


$stmt->close();
$mysqli->close();
?>
