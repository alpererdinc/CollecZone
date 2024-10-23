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

$sql = "SELECT orders.order_id, orders.order_date, orders.total_price, 
        GROUP_CONCAT(products.name SEPARATOR '|') as product_names, 
        GROUP_CONCAT(products.product_id SEPARATOR '|') as product_ids
        FROM orders 
        JOIN order_items ON orders.order_id = order_items.order_id
        JOIN products ON order_items.product_id = products.product_id
        WHERE orders.user_id = ?
        GROUP BY orders.order_id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$order_history = [];

while ($row = $result->fetch_assoc()) {
    $order_history[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="icon" type="image/x-icon" sizes="167x167" href="half-circle.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Order History</h2>
        <?php if (count($order_history) > 0): ?>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Products</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_history as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td><?php echo date("d/m/Y H:i", strtotime($order['order_date'])); ?></td>

                            <!-- Ürün isimlerini ve ID'lerini ayırıcıya göre link haline getirme -->
                            <td>
                                <?php
                                $product_names = explode("|", $order['product_names']);
                                $product_ids = explode("|", $order['product_ids']);
                                $product_links = [];

                                // Her bir ürünü kontrol edin
                                for ($i = 0; $i < count($product_names); $i++) {
                                    if (isset($product_ids[$i])) {  // Eğer ürün ID'si varsa
                                        $product_links[] = '<a href="product_detail.php?product_id=' . htmlspecialchars($product_ids[$i]) . '">' . htmlspecialchars($product_names[$i]) . '</a>';
                                    } else {
                                        // Ürün ID'si yoksa sadece ismini gösterin
                                        $product_links[] = htmlspecialchars($product_names[$i]);
                                    }
                                }

                                // Ürün linklerini virgülle ayırarak ekrana yazdırma
                                echo implode(", ", $product_links);
                                ?>
                            </td>

                            <td><?php echo htmlspecialchars($order['total_price']); ?> TL</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info text-center">
                No orders found.
            </div>
        <?php endif; ?>
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

        body {
            font-family: 'Roboto', sans-serif;
        }

        .container {
            max-width: 900px;
            margin-top: 50px;
            padding-top: 100px;
            padding-bottom: 50px;

        }

        h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
        }

        table {
            background-color: white;
            border: 2px solid black;
            box-shadow: 6px 6px 0 black;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        table:hover {
            box-shadow: 10px 10px 0 black;
            transform: translate(-2px, -2px);
        }

        table th,
        table td {
            font-size: 1.1rem;
            color: #333;
        }

        table th {
            background-color: #000 !important;
            color: white;
        }

        table td {
            vertical-align: middle;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 5px;
            transition: box-shadow 0.2s ease-in-out, transform 0.2s ease-in-out;
            box-shadow: 4px 4px 0 #000000;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0 #000000;
        }

        
        /* Toggle Switch Stil */
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
            z-index: 1500;

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

        /* Renkli Tema için böyle ayarladım */
        body.colored-theme {
            background-image: url(CSS/images/GreenGradi.jpg);
            color: #ffffff;
            transition: background-color 0.5s ease, background-image 0.5s ease, color 0.5s ease;

        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <script src="theme.js"></script>

</body>

</html>