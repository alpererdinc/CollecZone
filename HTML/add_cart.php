<?php
session_start();
        
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


$user_id = $_SESSION['user_id'];

$product_id = $_POST['product_id']; 

$mysqli = new mysqli("localhost", "root", "", "products_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

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
