<section id="header">
  <a href="index.php"><img src="CSS/images/colleczoneLogo.png" class="logo" alt=""></a>
  <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <div>
    <ul id="navbar">

      <li><a href="index.php">Ana Sayfa</a></li>
      <!-- Dropdown menü başlıyor -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          Kategoriler
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="prod_index.php">Plaklar</a>
          <a class="dropdown-item" href="#">Çizgi Romanlar</a>
          <a class="dropdown-item" href="#">Mumlar</a>
        </div>
      </li>
      <!-- Dropdown menü bitiyor -->
      <!-- Tema değiştirme butonu -->
      <li><a href="about.php">Hakkımızda</a></li>
      <li><a href="profile.php">Profilim</a></li>
      <li><a href="cart.php"><img src="CSS/images/shopping-bag.png" class="cartIcon" alt=""></a></li>
      <li>
        <div class="search">
          <input type="text" class="searchTerm" placeholder="Eksik parçanı bul...">
          <button type="submit" class="searchButton">
            <i class="fa fa-search"></i>
          </button>
      </li>


    </ul>
  </div>
</section>



<style>
  /* Toggle Switch Stil */
  


  .search {
    width: 300px;
    position: relative;
    display: flex;
  }

  .searchTerm {
    width: calc(100% - 40px);
    /* Arama düğmesine yer bırakmak için genişliği ayarlıyoruz */
    border: 3px solid #202529;
    border-right: none;
    padding: 5px;
    height: 36px;
    border-radius: 5px 0 0 5px;
    outline: none;
    color: #202529;
  }

  .searchTerm:focus {
    color: #202529;
  }

  .searchButton {
    width: 40px;
    height: 36px;
    border: 1px solid #202529;
    background: #202529;
    text-align: center;
    color: #fff;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
    transition: 0.3s ease;

  }

  .searchButton:hover {

    background: #ce3043;

  }




  /*Resize the wrap to see the search bar change!*/
  .wrap {
    width: 300px;
    /* Sabit genişlik ayarlandı */
    position: absolute;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  @media (max-width: 1024px) {
    .col-sm {
      flex: 1 1 calc(50% - 20px);
    }

    #header {
      flex-direction: column;
      padding: 10px 20px;
    }
  }

  @media (max-width: 768px) {
    .col-sm {
      flex: 1 1 100%;
    }

    .search {
      width: 100%;
    }
  }




  @keyframes mymove {
    0% {
      transform: translate(56%, -62%) rotate(0deg);
    }

    /* translate'i koruyarak rotate işlemini ekliyoruz */
    100% {
      transform: translate(56%, -62%) rotate(360deg);
    }

    /* tam dönüş yapacak */
  }



  @keyframes floatNotes {
    0% {
      transform: translate(230px, -90px) scale(1);
      opacity: 1;
    }

    100% {
      transform: translate(360px, -300px) scale(0.5);
      /* Sağ üst köşeye doğru gidecek ve küçülecek */
      opacity: 0;
      /* Giderek yok olacak */
    }
  }

  @media (min-width: 1025px) {
    .h-custom {
      height: 100vh !important;
    }
  }



  a {
    text-decoration: none;
    color: #ce3043;
  }

  a:hover {
    text-decoration: none;
    color: #ff7878;
  }




  footer {
    width: 100%;
    background-color: rgb(255, 255, 255);
    margin-left: auto;
    margin-right: auto;
    padding-left: 20px;
    padding-right: 20px;
    padding-top: 70px;
    padding-bottom: 20px;
    text-align: center;
    color: #1a1a1a;
  }

  .copyRights {
    text-align: center;
  }



  #header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 80px;
    background: #ffffff;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
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
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
    transition: 0.3s ease;
  }

  #navbar li a:hover {
    color: #ce3043;
  }

  #navbar li a:hover,
  #navbar li a.active {
    color: #ce3043;
  }

  .logo {
    width: 200px;
  }

  .cartIcon {

    width: 25px;
    transition: 0.3s ease;

  }

  .cartIcon:hover {
    filter: invert(24%) sepia(36%) saturate(4167%) hue-rotate(332deg) brightness(97%) contrast(93%);
  }
</style>