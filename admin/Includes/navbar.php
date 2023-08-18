<header class="header header-sticky mb-4">
        <div class="container-fluid">
          <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
          <i class="bi bi-list"></i>
          </button>
          <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
          </ul>
          <nav class="header-nav ms-auto me-4">
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
              <input class="btn-check" id="btn-light-theme" type="radio" name="theme-switch" autocomplete="off" value="light" onchange="changeTheme()">
              <label class="btn btn-primary" for="btn-light-theme">
              <i class="bi bi-brightness-high"></i>
              </label>
              <input class="btn-check" id="btn-dark-theme" type="radio" name="theme-switch" autocomplete="off" value="dark" onchange="changeTheme()">
              <label class="btn btn-primary" for="btn-dark-theme">
              <i class="bi bi-moon-stars"></i>              
            </label>
            </div>
          </nav>
          <ul class="header-nav me-3">
            <li class="nav-item dropdown d-md-down-none"><a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-bell"></i><span class="badge rounded-pill position-absolute top-0 end-0 bg-danger-gradient">5</span></a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0">
                <div class="dropdown-header bg-light dark:bg-white dark:bg-opacity-10"><strong>You have 5 notifications</strong></div><a class="dropdown-item" href="#">
                  Content Here
                </a>
              </div>
            </li>
            <li class="nav-item dropdown d-md-down-none"><a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-list-task"></i><span class="badge rounded-pill position-absolute top-0 end-0 bg-warning-gradient">5</span></a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0">
                <div class="dropdown-header bg-light dark:bg-white dark:bg-opacity-10"><strong>You have 5 pending tasks</strong></div><a class="dropdown-item d-block" href="#">
                    Task Here
                </a>
                  <a class="dropdown-item text-center border-top" href="#"><strong>View all tasks</strong></a>
              </div>
            </li>
            <li class="nav-item dropdown d-md-down-none"><a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-envelope"></i><span class="badge rounded-pill position-absolute top-0 end-0 bg-info-gradient">7</span></a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0">
                <div class="dropdown-header bg-light dark:bg-white dark:bg-opacity-10"><strong>You have 4 messages</strong></div><a class="dropdown-item" href="#">
                  <div class="message">
                    <div class="py-3 me-3 float-start">
                      <div class="avatar"><img class="avatar-img" src="../Assets/Images/images.png" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-medium-emphasis">John Doe</small><small class="text-medium-emphasis float-end mt-1">Just now</small></div>
                    <div class="text-truncate font-weight-bold"><span class="text-danger">!</span> Important message</div>
                    <div class="small text-medium-emphasis text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
                  </div>
                </a>
                </a><a class="dropdown-item text-center border-top" href="#"><strong>View all messages</strong></a>
              </div>
            </li>
          </ul>
          <ul class="header-nav me-4">
            <li class="nav-item dropdown d-flex align-items-center"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="dropdown-header bg-light py-2 dark:bg-white dark:bg-opacity-10">
                  <div class="fw-semibold">Settings</div>
                </div><a class="dropdown-item" href="#">
                <i class="bi bi-person-vcard-fill icon me-2"></i> Profile</a><a class="dropdown-item" href="#">
                <i class="bi bi-gear-fill icon me-2"></i> Settings</a>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="../logout.php">
                <i class="bi bi-box-arrow-left icon me-2"></i> Logout</a>
              </div>
            </li>
          </ul>
        </div>
        <div class="header-divider"></div>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Home</span>
              </li>
              <li class="breadcrumb-item active"><span>Dashboard</span></li>
            </ol>
          </nav>
        </div>
        <script src="../Assets/JS/adminDashboard.js"></script>
      </header>