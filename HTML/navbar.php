<!DOCTYPE html>
<html lang="en">

<head>

  <style>
    body {
      background-color: #FAF7F0;
    }

    a {
      color: #FF5B5B;
      text-decoration: none;
    }

    #header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
      transition: top 0.3s ease-in-out, box-shadow 0.2s ease-in-out;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 80px;
      background: #ffffff;
      box-shadow: 0 2.6px 0px rgba(0, 0, 0, 1);


    }

    #header:hover {
      box-shadow: 0 7px 0px rgba(0, 0, 0, 1);
    }

    .logo {
      width: 200px;
      filter: drop-shadow(0px 0px 0px #FF5B5B);
      transition: filter 0.1s ease-in-out, transform 0.1s ease-in-out;

    }

    .logo:hover {
      filter: drop-shadow(2px 2px 0px #FF5B5B);
      transform: translate(-1.5px, -1.5px);

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
      width: 250px;
      position: relative;
      display: flex;
    }

    .searchTerm {
      width: calc(100% - 50px);
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
      background: #000;
      color: #fff;
      border-radius: 0 5px 5px 0;
      cursor: pointer;
      font-size: 20px;
      transform: translate(-5px, 1px);
      border: 2.6px solid black;
      box-shadow: 1px 1px 0px rgba(0, 0, 0, 1);
      transition: box-shadow 0.25s ease-in-out, transform 0.25s ease-in-out;
    }

    .searchButton:hover {
      background: #FF5B5B;
      box-shadow: 4px 4px 0px rgba(0, 0, 0, 1);
      transform: translate(-6px, 0px);

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
      box-shadow: 4px 4px 0px #000;
      border: 2.1px solid black;
      top: 32px; 
    }

    .dropdown:hover .dropdown-menu {
      display: block;
    }

    .dropdown-item:active{
      background-color: #FF5B5B;
      color: #fff;
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



    .GoTopButton {
      position: fixed;
      right: 50px;
      bottom: 80px;
      z-index: 1000;

    }

    .circleButton3 {
      background-color: #000000;
      color: white;
      border: none;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      font-size: 24px;
      cursor: pointer;
      transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
      box-shadow: 0px 0px 0 #000000;
    }

    .circleButton3:hover {
      background-color: #FF5B5B;
      color: white;
      border: 2.6px solid black;
      transform: translate(-3px, -3px);
      box-shadow: 6px 6px 0 #000000;
    }




    
  </style>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

  <?php
  if (isset($_SESSION['user_id'])) { // Kullanıcının oturum açma durumu
    // Giriş yapmışsa "My Profile" yazdır
    $profileLinkText = "My Profile";
  } else {
    // Giriş yapmamışsa "Login" yazdır
    $profileLinkText = "Login / Sign up";
  }
  ?>



  <section id="header">
    <a href="index.php"><img src="CSS/images/colleczoneLogo.png" class="logo" alt=""></a>
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div>
      <ul id="navbar">
        <li><a href="index.php">Home</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Categories</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="prod_index.php">All Products</a>
            <a class="dropdown-item" href="product_filter.php?category=music">Music</a>
            <a class="dropdown-item" href="product_filter.php?category=comics">Comics</a>
          </div>
        </li>
        <li><a href="about.php">About</a></li>
        <li><a href="profile.php"><?php echo $profileLinkText; ?></a></li>

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
              <input type="text" class="searchTerm" name="query" placeholder="Find your missing piece..." required>
              <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
              </button>
            </form>
          </div>
        </li>

        <ul>
          <li>
            <label class="switch">
              <input type="checkbox" id="theme-toggle">
              <span class="slider"></span>
            </label>
          </li>
        </ul>

      </ul>
      <div id="mobile-menu-icon">
        <i class="fa fa-bars"></i>
      </div>
    </div>
  </section>


  <script src="mobile_menu.js" defer></script>


  <script>
    let lastScrollTop = 0;
    const header = document.getElementById("header");
    const scrollThreshold = 100; // 100px scroll sonrası navbar kaybolabilir

    window.addEventListener("scroll", function() {
      let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

      if (scrollTop > scrollThreshold) {
        // Aşağı kaydırma ve 100px üzerindeyse header kaybolur
        if (scrollTop > lastScrollTop) {
          header.style.top = "-100px";
        } else {
          // Yukarı kaydırma, header geri görünür
          header.style.top = "0";
        }
      } else {
        // 100px'in altında header yerinde kalsın
        header.style.top = "0";
      }

      lastScrollTop = scrollTop;
    });
  </script>


</body>

</html>