<script src="../Assets/JS/adminDashboard.js"></script>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark ">
    <div class="container-fluid">
        <!-- Offcanvas trigger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#offcanvasExample"></span>
        </button>
        <!-- Offcanvas trigger -->
        <a class="navbar-brand fw-bold text-uppercase me-auto" href="index.php">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex ms-auto" role="search">
            <nav class="header-nav ms-auto me-4">
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
              <input class="btn-check" id="btn-light-theme" type="radio" name="theme-switch" autocomplete="off" value="light" onchange="changeTheme('light')">
              <label class="btn btn-primary" for="btn-light-theme">
              <i class="bi bi-brightness-high"></i>
              </label>
              <input class="btn-check" id="btn-dark-theme" type="radio" name="theme-switch" autocomplete="off" value="dark" onchange="changeTheme('dark')">
              <label class="btn btn-primary" for="btn-dark-theme">
              <i class="bi bi-moon-stars"></i>              
            </label>
            </div>
          </nav>
                <div class="input-group my-3 my-lg-0 ">
                    <input type="text" class="form-control" placeholder="What are you looking for?" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                </div>
            </form>
            <ul class="navbar-nav mb-0 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                    <li><a class="dropdown-item disabled" aria-disabled="true"><?= $_SESSION['auth_user']['username']?></a></li>
                    <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
            </ul>
            </li>
        </div>
    </div>
</nav>