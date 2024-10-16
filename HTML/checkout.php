<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Sepet verilerini çek
$sql = "SELECT products.product_id, products.name, products.price, cart.quantity 
        FROM cart 
        JOIN products ON cart.product_id = products.product_id 
        WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
$total_price = 0;

while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $total_price += $row['price'] * $row['quantity'];
}

$stmt->close();

if (count($cart_items) > 0) {
    // Siparişi orders tablosuna ekle
    $sql = "INSERT INTO orders (user_id, total_price) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("id", $user_id, $total_price);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Sipariş içindeki ürünleri order_items tablosuna ekle
    foreach ($cart_items as $item) {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
        $stmt->execute();
        $stmt->close();
    }

    // Sepeti temizle
    $sql = "DELETE FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container text-center mt-5">
        <div class="alert alert-success" role="alert">
            <img src="CSS/images/dancingCat.gif" alt="dans" style="width:200px;height:300px;" class="img-fluid mb-3">
            <h4 class="alert-heading">Bedeliniz ödendi efenim!</h4>
            <p class="mb-0">Toplam tutar: <?php echo htmlspecialchars($total_price); ?> TL.</p>
            <p class="mb-0">Siparişiniz kaydedildi. En kısa zamanda kargolanacaktır.</p>
            <a href="index.php" class="btn btn-secondary mt-3">Ana Sayfaya dön</a>
        </div>
    </div>

    <footer class="text-center mt-5 py-3">
        <hr>
        <div class="social-icons">
            <a href="https://www.instagram.com/alperd.inc/" class="fa fa-instagram" target="_blank"></a>
            <a href="https://www.linkedin.com/in/alper-erdin%C3%A7-363b07252/" class="fa fa-linkedin" target="_blank"></a>
            <a href="https://www.youtube.com/@alpererdinc47" class="fa fa-youtube" target="_blank"></a>
        </div>
        <hr>
        <p class="copyRights">A website by <a href="https://www.instagram.com/alperd.inc/" target="_blank">Alper Erdinç</a></p>
        <p>All rights reserved. © 2024 CollecZone</p>
    </footer>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            padding-top: 100px;
        }

        .container {
            max-width: 600px;
        }

        .alert {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            box-shadow: 5px 5px 0 #333;
        }

        .img-fluid {
            box-shadow: 4px 4px 0 #000;
            margin-bottom: 20px;
        }

        .btn-secondary {
            background-color: #343a40;
            border: none;
            color: white;
            box-shadow: 4px 4px 0 #000;
            font-size: 1.1rem;
            padding: 10px 20px;
        }

        .btn-secondary:hover {
            background-color: #23272b;
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0 #000;
        }

        footer {
            background-color: #ffffff;
            padding: 10px 0;
        }

        .social-icons a {
            margin: 0 10px;
            font-size: 24px;
            color: #343a40;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #007bff;
        }

        .copyRights {
            font-size: 1rem;
            color: #333;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
