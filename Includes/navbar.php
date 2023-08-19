<nav class="navbar navbar-expand-lg navbar-dark bg-black">
  <div class="container">
    <a class="navbar-brand" href="index.php">Shoestopia</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a id="homeLink" class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a id="collectionLink" class="nav-link" href="categories.php">Collection</a>
        </li>
        <?php if (isset($_SESSION['auth'])) {
          if($_SESSION['Role'] != 0){
        ?>
        <li class="nav-item">
            <a  class="nav-link" href="admin/index.php">Dashboard</i></a>
          </li>
          <?php }?>
          <li class="nav-item">
            <a id ="cartLink" class="nav-link" href="cart.php"><i class="bi bi-cart"></i></a>
          </li>
          <li class="nav-item dropdown ">
            <a id="userLink" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-vcard-fill"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
              <li><a class="dropdown-item disabled" aria-disabled="true"><?= $_SESSION['auth_user']['username']?></a></li>
              <hr>
              <li><a class="dropdown-item" href="#">Regular link</a></li>
              <li><a class="dropdown-item" href="listOrder.php">Your order</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        <?php
        } else { ?>
          <li class="nav-item">
            <a id="registerLink" class="nav-link" href="register.php">Register</a>
          </li>
          <li class="nav-item">
            <a id="loginLink" class="nav-link" href="login.php">Login</a>
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
    console.log("Link ID:", linkID);
    console.log("Navigation Link:", navigationLink[linkID]);
    console.log("Current Page:", currentPage);

    if (currentPage.endsWith(navigationLink[linkID])) {
      console.log("Matching Link Found!");
      document.getElementById(linkID).classList.add("active");
    }
  }
</script>
