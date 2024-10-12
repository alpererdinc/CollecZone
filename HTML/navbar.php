<!DOCTYPE html>
<html lang="en">

<head>

  <style>
    #header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 80px;
      background: #ffffff;
      box-shadow: 0 2.6px 0px rgba(0, 0, 0, 1);
      
    }

    .logo {
      width: 200px;
    }

    #navbar {
      display: flex;
      align-items: center;
      justify-content: center;


    }

    #navbar li {
      list-style: none;
      padding: 0 20px;
    }

    #navbar li a {
      font-family: 'Segoe UI', sans-serif;
      text-decoration: none;
      font-size: 16px;
      font-weight: 600;
      color: #1a1a1a;
      transition: 0.3s ease;
    }

    #navbar li a:hover,
    #navbar li a.active {
      color: #FF5B5B;
    }

    .cartIcon {
      transition: 0.3s ease;
    }

    .cartIcon:hover {
      filter: invert(65%) sepia(57%) saturate(6822%) hue-rotate(330deg) brightness(110%) contrast(101%);
    }

    .search {
      width: 300px;
      position: relative;
      display: flex;
    }

    .searchTerm {
      width: calc(100% - 60px);
      border: 3px solid #000;
      border-right: none;
      padding: 5px;
      height: 36px;
      border-radius: 5px 0 0 5px;
      outline: none;
      color: #202529;
    }

    .searchButton {
      width: 40px;
      height: 36px;
      border: 2px solid #000;
      background: #000;
      color: #fff;
      border-radius: 0 5px 5px 0;
      cursor: pointer;
      font-size: 20px;
      transition: 0.3s ease;
      transform: translate(-5px, 1px);
    }

    .searchButton:hover {
      background: #FF5B5B;
    }

    /* Mobil Menü Butonu */
    #mobile-menu-icon {
      display: none;
      font-size: 30px;
      cursor: pointer;
    }


    .dropdown-menu {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 160px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .dropdown:hover .dropdown-menu {
      display: block;
    }

    /* Responsive Ayarlar */
    @media (max-width: 768px) {
      #navbar {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 80px;
        right: 0;
        background-color: white;
        width: 100%;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        z-index: 9999;

      }

      #navbar li {
        padding: 10px 0;
      }

      #mobile-menu-icon {
        display: block;
      }

      #navbar.active {
        display: flex;
      }
    }
  </style>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

  <section id="header">
    <a href="index.php"><img src="CSS/images/colleczoneLogo.png" class="logo" alt=""></a>
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div>
      <ul id="navbar">
        <li><a href="index.php">Ana Sayfa</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Kategoriler</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="prod_index.php">Tüm ürünler</a>
            <a class="dropdown-item" href="product_filter.php?category=music">Müzik</a>
            <a class="dropdown-item" href="product_filter.php?category=comics">Çizgi Roman</a>
          </div>
        </li>
        <li><a href="about.php">Hakkımızda</a></li>
        <li><a href="profile.php">Profilim</a></li>

        <li>
          <a href="cart.php">
            <?php
            include 'db_connection.php';

            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
            $cart_sql = "SELECT SUM(quantity) AS total_quantity FROM cart WHERE user_id = ?";
            $cart_stmt = $conn->prepare($cart_sql);
            $cart_stmt->bind_param("i", $user_id);
            $cart_stmt->execute();
            $cart_result = $cart_stmt->get_result();
            $cart_row = $cart_result->fetch_assoc();
            $total_quantity = $cart_row['total_quantity'] ?? 0;


            if ($total_quantity > 0) {
              echo '<img src="CSS/images/shopping-bag-FULL.png" class="cartIcon" id="cartIcon" alt="" width="22">';
            } else {
              echo '<img src="CSS/images/shopping-bag.png" class="cartIcon" id="cartIcon" alt="" width="28">';
            }


            $cart_stmt->close();
            ?>
          </a>
        </li>

        <li>
          <div class="search">
            <form action="search.php" method="GET">
              <input type="text" class="searchTerm" name="query" placeholder="Eksik parçanı bul..." required>
              <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
              </button>
            </form>
          </div>
        </li>

      </ul>
      <div id="mobile-menu-icon">
        <i class="fa fa-bars"></i>
      </div>
    </div>
  </section>


  <script src="mobile_menu.js" defer></script>
</body>

</html>