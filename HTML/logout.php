<?php
session_start();

// Oturum verilerini temizle
session_unset(); // Tüm oturum değişkenlerini siler
session_destroy(); // Oturumu yok eder

// Kullanıcıyı giriş sayfasına yönlendir
header("Location: login.php");
exit;
?>
