<?php

if (isset($_POST['submit'])) {
    // Yüklenen dosyanın bilgilerini al
    $file = $_FILES['file'];

    // Hata kontrolü
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Dosya yüklenirken bir hata oluştu.");
    }

    // Dosya tipi kontrolü (sadece CSV)
    $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
    if ($fileType !== 'csv') {
        die("Yüklenen dosya bir CSV dosyası olmalıdır.");
    }

    // Dosyayı geçici bir dizine taşı
    $uploadDir = 'uploads/';
    $filePath = $uploadDir . basename($file['name']);
    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        die("Dosya yüklenemedi.");
    }

    if (($handle = fopen($filePath, "r")) !== FALSE) {
        // CSV dosyasının başlık satırını atla
        fgetcsv($handle);

        // Veritabanı bağlantısı
        $conn = new mysqli("localhost", "root", "", "products_db");

        // Bağlantıyı kontrol et
        if ($conn->connect_error) {
            die("Bağlantı başarısız: " . $conn->connect_error);
        }

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $product_id = $data[0];          // Ürün ID
            $name = $conn->real_escape_string($data[1]); // Ürün Adı
            $price = $data[2];                // Fiyat
            $description = $conn->real_escape_string($data[3]); // Açıklama
            $image = $data[4];                // Görsel (dosya yolu)
            $category = $data[5];             // Kategori

            // SQL sorgusu
            $query = "INSERT INTO products (product_id, name, price, description, image, category) 
                      VALUES ('$product_id', '$name', '$price', '$description', '$image', '$category')
                      ON DUPLICATE KEY UPDATE
                      name='$name', price='$price', description='$description', image='$image', category='$category'";

            // Sorguyu çalıştır
            if ($conn->query($query) !== TRUE) {
                echo "Hata: " . $query . "<br>" . $conn->error;
            }
        }

        fclose($handle);
        $conn->close(); // Veritabanı bağlantısını kapat
    }
}
?>
