<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="index.php">Vouge Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>
    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active"><a id="homeLink" href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="shop.php" class="nav-link">Shop</a></li>
        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
        <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
        <?php if (isset($_SESSION['auth'])) {
        ?>
        <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
        <li class="nav-item"><a href="myOrder.php" class="nav-link">Order History</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
        <li class="nav-item"><a class="nav-link"><?= $_SESSION['auth_user']['username'] ?></a></li>
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
</nav>

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
