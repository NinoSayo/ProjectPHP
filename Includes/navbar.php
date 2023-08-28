<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="index.php">Vouge Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>
    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active"><a id="homeLink" href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalog</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href="shop.php">Shop</a>
          </div>
        </li>
        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
        <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
        <?php if (isset($_SESSION['auth'])) {
        ?>
        <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-person-vcard-fill"></i></a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
          <a class="dropdown-item disabled" aria-disabled="true"><?= $_SESSION['auth_user']['username'] ?></a>
              <hr>
              <a class="dropdown-item" href="#">Regular link</a>
              <a class="dropdown-item" href="myOrder.php">Your order</a>
              <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </li>        <?php
        } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-black">
  <div class="container">
    <a class="navbar-brand" href="index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.php">Collection</a>
        </li>
        <?php if (isset($_SESSION['auth'])) {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="shoppingCart.php"><i class="bi bi-cart"></i></a>
          </li>
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-vcard-fill"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
              <li><a class="dropdown-item disabled" aria-disabled="true"><?= $_SESSION['auth_user']['username'] ?></a></li>
              <hr>
              <li><a class="dropdown-item" href="#">Regular link</a></li>
              <li><a class="dropdown-item" href="myOrder.php">Your order</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        <?php
        } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav> -->
<script>
  var currentPage = window.location.pathname;

  var navigationLink = {
    "homeLink": "/index.php",
    "collectionLink" : "/categories.php",
    "registerLink" : "/register.php",
    "loginLink" : "/login.php",
    "cartLink" : "/cart.php",
    "userLink" : "/listOrder.php"
  };

  for (var linkID in navigationLink) {
    if (currentPage.endsWith(navigationLink[linkID])) {
      document.getElementById(linkID).classList.add("active");
    }
  }
</script>
