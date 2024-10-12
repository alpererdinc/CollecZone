<?php
session_start();
include 'db_connection.php'; // Veritabanı bağlantısı


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id']; // Kullanıcının ID'si

    // Favorilerden kaldırma veya ekleme işlemi
    $fav_sql = "SELECT * FROM favorites WHERE user_id = ? AND product_id = ?";
    $fav_stmt = $conn->prepare($fav_sql);
    $fav_stmt->bind_param("ii", $user_id, $product_id);
    $fav_stmt->execute();
    $fav_result = $fav_stmt->get_result();

    if ($fav_result->num_rows > 0) {
        // Eğer ürün zaten favorilerde ise, favorilerden çıkar
        $delete_sql = "DELETE FROM favorites WHERE user_id = ? AND product_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("ii", $user_id, $product_id);
        $delete_stmt->execute();
        $delete_stmt->close();
    } else {
        // Eğer ürün favorilerde değilse, favorilere ekle
        $insert_sql = "INSERT INTO favorites (user_id, product_id) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ii", $user_id, $product_id);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    // Favori ekleme/kaldırma işlemi tamamlandıktan sonra geri yönlendir
    header("Location: product_detail.php?product_id=" . $product_id); // Detay sayfasına geri yönlendirme
    exit();
} else {
    echo "Ürün ID'si belirtilmedi.";
}
$conn->close();
?>
