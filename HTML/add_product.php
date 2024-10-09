<!-- add_product.php -->
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Ekle</title>
    <link rel="stylesheet" type="text/css" href="add_prod_style.css">
</head>
<body>
    <h1>Yeni Ürün Ekle</h1>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <label for="name">Ürün Adı:</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Fiyat:</label>
        <input type="number" id="price" name="price" required>

        <label for="description">Açıklama:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="image">Resim:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <input type="submit" value="Ürünü Ekle">
    </form>

    <?php
    // Form gönderildiğinde çalışacak kod
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Veritabanı bağlantısını yap
        include 'db_connection.php';

        // Formdan gelen verileri al
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        // Resmi yüklemek için klasör yolu
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // Veritabanına kaydet
        $sql = "INSERT INTO products (name, price, description, image) VALUES ('$name', '$price', '$description', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Yeni ürün başarıyla eklendi.</p>";
        } else {
            echo "<p style='color: red;'>Hata: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>

<form action="upload_csv.php" method="post" enctype="multipart/form-data">
    CSV Dosyanızı Seçin: <input type="file" name="file" id="file">
    <input type="submit" value="Yükle" name="submit">
</form>


</body>
</html>
