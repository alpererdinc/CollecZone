<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" sizes="167x167" href="half-circle.png">

  <title>About CollecZone</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>

  <?php include 'navbar.php'; ?>

  <div class="about-section">
    <h1>About Us</h1>
    <p>A few sentences about what we do.</p>
    <p>CollecZone is a page where you can discover collectors' favorites,
      world-famous and now out-of-circulation products. This carefully
      compiled selection includes rare records and timeless pieces that
      left their mark on unforgettable periods in music history; cult
      and unique issues of comic book collections; exotic aromatic
      candles that you cannot easily find. Each product consists of
      valuable pieces that carry traces of the past and offer a special
      meaning to collectors. This rare collection has been brought
      together for music lovers and collectors, and each product tells
      its own story. Take the opportunity to hold historical and cultural
      heritage in your hands while embarking on a unique journey in the
      world of products that can be among your own pieces in our collection.

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
          <p>Comp. Eng. Student, 2D Animator</p>
          <p>ae.alpererdinc@gmail.com</p>
          <p><a href="https://taplink.cc/alpererdinc" target="_blank"><button class="button">Contact</button></p></a>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="card">
        <img src="robin.jpg" alt="Alper" style="width: 200px">
        <div class="container">
          <h2>Robin</h2>
          <p class="title">Mental Supporter, Co-founder</p>
          <p>Cat</p>
          <p></p>
          <p><a ><button id="meowButton" class="button">Maow</button></a></p>
          <div id="pawContainer"></div>
          <audio id="meowSound" src="CSS/images/meow.mp3"></audio>
        </div>
      </div>
    </div>
  </div>
  <style>
    body {
      margin: 0;
      padding-top: 100px;

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
      margin: 8px;
      padding: 10px;
      border: 2.6px solid black;
      box-shadow: 4px 4px 0px rgba(0, 0, 0, 1);
      transition: box-shadow 0.25s ease-in-out, transform 0.25s ease-in-out;
    }

    .card:hover {
      box-shadow: 12px 12px 0px rgba(0, 0, 0, 1);
      transform: translate(-3px, -3px);

    }

    .card img {
      object-fit: cover;
      border-radius: 30%;
      height: 200px;
      border: 2.6px solid black;
      box-shadow: 7px 7px 0px rgba(0, 0, 0, 1);
      margin-bottom: 20px;

    }

    .about-section {
      padding: 50px;
      text-align: center;
      background-color: #000;
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

      background-color: black;
      color: white;
      border: 2.6px solid black;
      border-radius: 7px;
      width: 300px;
      height: 50px;
      font-size: 20px;
      padding: 8px;
      cursor: pointer;
      transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
      box-shadow: 0px 0px 0 #000000;

    }

    .button:hover {

      background-color: #FF5B5B;
      color: #ffffff;
      border: 2.6px solid black;
      transform: translate(-3px, -3px);
      box-shadow: 8px 8px 0 #000000;
      text-decoration: none;

    }

    @media screen and (max-width: 650px) {
      .column {
        width: 100%;
        display: block;
      }
    }
  </style>



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

    /* Renkli Tema kısmı */
    body.colored-theme {
      background-image: url(CSS/images/GreenGradi.jpg);
      transition: background-color 0.5s ease, background-image 0.5s ease, color 0.5s ease;
    }

    html {
      overflow-x: hidden;
    }

    h2{
      color: #000;
    }
  </style>


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
      margin-top: 500px;
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


    <script src="cat.js"></script>
</body>

</html>