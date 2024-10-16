<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme Bilgileri</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Ödeme Bilgilerinizi Giriniz</h2>
        <form action="process_payment.php" method="POST" class="needs-validation" novalidate>
            <div class="row">
                <!-- Kişisel Bilgiler -->
                <div class="col-md-6">
                    <h4 class="mb-3">Fatura Bilgileri</h4>
                    <div class="form-group">
                        <label for="firstName">Ad</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" required>
                        <div class="invalid-feedback">
                            Adınızı giriniz.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lastName">Soyad</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" required>
                        <div class="invalid-feedback">
                            Soyadınızı giriniz.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Adres</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                        <div class="invalid-feedback">
                            Fatura adresinizi giriniz.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city">Şehir</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                        <div class="invalid-feedback">
                            Şehrinizi giriniz.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="zip">Posta Kodu</label>
                        <input type="text" class="form-control" id="zip" name="zip" required>
                        <div class="invalid-feedback">
                            Posta kodunu giriniz.
                        </div>
                    </div>
                </div>

                <!-- Ödeme Bilgileri -->
                <div class="col-md-6">
                    <h4 class="mb-3">Ödeme Bilgileri</h4>
                    <div class="form-group">
                        <label for="cardName">Kart Üzerindeki İsim</label>
                        <input type="text" class="form-control" id="cardName" name="card_name" required>
                        <div class="invalid-feedback">
                            Kart üzerindeki ismi giriniz.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cardNumber">Kart Numarası</label>
                        <input type="text" class="form-control" id="cardNumber" name="card_number" required>
                        <div class="invalid-feedback">
                            Geçerli bir kart numarası giriniz.
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="expiration">Son Kullanma Tarihi</label>
                            <input type="text" class="form-control" id="expiration" name="expiration" placeholder="MM/YY" required>
                            <div class="invalid-feedback">
                                Son kullanma tarihini giriniz.
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cvv">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" required>
                            <div class="invalid-feedback">
                                CVV kodunu giriniz.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button href="checkout.php" class="btn btn-primary btn-lg btn-block" type="submit">Ödemeyi Tamamla</button>
            <a href="checkout.php">Tamamladım Say</a>

        </form>
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
        }

        .container {
            max-width: 800px;
        }

        .form-control {
            box-shadow: none;
            border-radius: 0;
        }

        .btn-primary {
            background-color: #343a40;
            border-color: #343a40;
            font-size: 1.2rem;
        }

        .btn-primary:hover {
            background-color: #23272b;
            border-color: #23272b;
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
    </style>


    <script src="theme.js"></script>


    <script>
        // Bootstrap form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>

</html>