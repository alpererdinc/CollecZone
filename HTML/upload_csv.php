<?php

if (isset($_POST['submit'])) {
    
    $file = $_FILES['file'];

  
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Dosya yüklenirken bir hata oluştu.");
    }

    // Dosya tipi kontrolü (sadece CSV)
    $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
    if ($fileType !== 'csv') {
        die("Yüklenen dosya bir CSV dosyası olmalıdır.");
    }

  
    $uploadDir = 'uploads/';
    $filePath = $uploadDir . basename($file['name']);
    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        die("Dosya yüklenemedi.");
    }

    if (($handle = fopen($filePath, "r")) !== FALSE) {
        
        fgetcsv($handle);

      
        $conn = new mysqli("localhost", "root", "", "products_db");

       
        if ($conn->connect_error) {
            die("Bağlantı başarısız: " . $conn->connect_error);
        }

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $product_id = $data[0];         
            $name = $conn->real_escape_string($data[1]); 
            $price = $data[2];              
            $description = $conn->real_escape_string($data[3]); 
            $image = $data[4];               
            $category = $data[5];             

            
            $query = "INSERT INTO products (product_id, name, price, description, image, category) 
                      VALUES ('$product_id', '$name', '$price', '$description', '$image', '$category')
                      ON DUPLICATE KEY UPDATE
                      name='$name', price='$price', description='$description', image='$image', category='$category'";

           
            if ($conn->query($query) !== TRUE) {
                echo "Hata: " . $query . "<br>" . $conn->error;
            }
        }

        fclose($handle);
        $conn->close();
    }
}
?>
