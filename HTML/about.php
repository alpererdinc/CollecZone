<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" sizes="167x167" href="half-circle.png">

  <title>CollecZone Hakkında</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>

  <?php include 'navbar.php'; ?>

  <div class="about-section">
    <h1>Hakkımızda</h1>
    <p>Some text about who we are and what we do.</p>
    <p>CollecZone, koleksiyonerlerin gözdesi olan, dünya çapında ün kazanmış ve artık tedavülden kalkmış ürünleri keşfedebileceğiniz bir sayfa. Özenle derlediğimiz bu seçkide, müzik tarihinin unutulmaz dönemlerine damgasını vuran nadir plaklar ve zamansız parçalar; çizgi roman külliyatının kült ve benzersiz sayıları; kolay kolay bulamayacağınız egzotik aromalı mumlar yer alıyor. Her bir ürün, geçmişin izlerini taşıyan ve koleksiyonerlere özel bir anlam sunan değerli parçalardan oluşur. Bu nadir koleksiyon, müzikseverler ve koleksiyon meraklıları için bir araya getirilmiştir ve her bir ürün, kendi hikayesini anlatır. Koleksiyonumuzda, kendi parçalarınızın arasına girebilecek ürünlerin dünyasında eşsiz bir yolculuğa çıkarken, tarihî ve kültürel mirası elinizde tutma fırsatını yakalayın.

    </p>
  </div>

  <h2 style="text-align:center">Our Team</h2>
  <div class="row">
    <div class="column">
      <div class="card">
        <img src="AePhoto.jpg" alt="Alper" style="width: 200px">
        <div class="container">
          <h2>Alper Erdinç</h2>
          <p class="title">CEO & Founder</p>
          <p>Some text that describes me lorem ipsum ipsum lorem.</p>
          <p>jane@example.com</p>
          <p><button class="button">Contact</button></p>
        </div>
      </div>
    </div>


  </div>
  <style>
    body {
      background-image: url("CSS/images/GreenGradi.jpg");
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
    }

    html {
      box-sizing: border-box;
    }

    *,
    *:before,
    *:after {
      box-sizing: inherit;
    }

    .column {
      float: left;
      width: 33.3%;
      margin-bottom: 16px;
      margin-left: 10px;
      margin-right: 10px;
      padding: 0 8px;
    }

    .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      margin: 8px;
      padding: 10px;
    }

    .about-section {
      padding: 50px;
      text-align: center;
      background-color: #ff7878;
      color: white;
    }

    .container {
      padding: 0 16px;
    }

    .container::after,
    .row::after {
      content: "";
      clear: both;
      display: table;
    }

    .title {
      color: #474e5d;
    }

    .button {
      border: none;
      outline: 0;
      display: inline-block;
      padding: 8px;
      color: white;
      background-color: #000;
      text-align: center;
      cursor: pointer;
      width: 100%;
    }

    .button:hover {
      background-color: #555;
    }

    @media screen and (max-width: 650px) {
      .column {
        width: 100%;
        display: block;
      }
    }
  </style>

<footer>
  <hr>
  <div class="rightstext">
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Add font awesome icons -->
    <a href="https://www.instagram.com/alperd.inc/" class="fa fa-instagram" target="_blank"></a>
    <a href="https://www.linkedin.com/in/alper-erdin%C3%A7-363b07252/" class="fa fa-linkedin" target="_blank"></a>
    <a href="https://www.youtube.com/@alpererdinc47" class="fa fa-youtube" target="_blank"></a>

    <p class="copyRights">A website by <a href="https://www.instagram.com/alperd.inc/" target="_blank">Alper
        Erdinç</a></p>
  </div>

</footer>

<style>
footer {
    width: 100%;
    background-color: rgb(255, 255, 255);
 
    text-align: center;
    position: relative;
    /* Konumlandırmayı yapabilmek için */
    bottom: 0;
    /* En alta sabitle */
    width: 100%;
    /* Tüm genişliği kapla */
    margin-top: auto;
    /* Üstten otomatik boşluk bırak */
  }

  .copyRights {
    text-align: center;
  }
</style>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
    integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
    crossorigin="anonymous"></script>
</body>

</html>