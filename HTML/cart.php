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

$sql = "SELECT products.product_id, products.name, products.price, cart.quantity FROM cart 
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
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h2>Sepetim</h2>
        <?php if (count($cart_items) > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Ürün Adı</th>
                        <th>Fiyat</th>
                        <th>Adet</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><?php echo htmlspecialchars($item['price']); ?> TL</td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td>
                                <form action="remove_from_cart.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                                    <button type="submit" class="btn btn-danger">Listeden Çıkar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h4>Toplam Fiyat: <?php echo htmlspecialchars($total_price); ?> TL</h4>
            <a href="checkout.php" class="btn btn-success">Satın Al</a>
            <a href="prod_index.php" class="btn btn-secondary">Alışverişe Dön</a>
        <?php else: ?>
            <p>Sepetinizde ürün bulunmamaktadır.</p>
            <a href="prod_index.php" class="btn btn-secondary">Alışverişe Dön</a>
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
        <p>Tüm hakları saklıdır. © 2024 CollecZone</p>
    </footer>

    <style>
        footer {
            color: black;
            width: 100%;
            background-color: rgb(255, 255, 255);

            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 1000px;
        }

        .copyRights {
            text-align: center;
        }


    </style>

<ul>
        <li>
            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider"></span>
            </label>
        </li>
    </ul>

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

/* Renkli Tema kısmı */
body.colored-theme {
  background-image: url(CSS/images/GreenGradi.jpg);
  color: #ffffff;
  transition: background-color 0.5s ease, background-image 0.5s ease, color 0.5s ease;
}

 </style>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>

</html>