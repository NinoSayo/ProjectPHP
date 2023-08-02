<div class="offcanvas offcanvas-start bg-black text-white fixed-top" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
            <ul class="navbar-nav">
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3">
                        CORE
                    </div>
                </li>
                <li>
                    <a href="index.php" class="nav-link px-3 active">
                        <span class="me-2">
                            <i class="bi bi-speedometer"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="my-4">
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3">
                        Interface
                    </div>
                </li>
                <li>
                <p class="gap-1">
                        <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseCategory" role="button" aria-expanded="false" aria-controls="collapseCategory">
                            <span class="me-2"><i class="bi bi-card-list"></i></span>
                            <span>Categories</span>
                            <span class="ms-auto right-icon"><i class="bi bi-chevron-down"></i></span>
                        </a>
                    <div class="collapse" id="collapseCategory">
                        <div>
                            <ul class="navbar-nav ps-3">
                                <li>
                                    <a href="category.php" class="nav-link px-3">
                                        <span>Category List</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="AddCategory.php" class="nav-link px-3">
                                        <span>Add Category</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <p class="gap-1">
                        <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseProduct" role="button" aria-expanded="false" aria-controls="collapseProduct">
                            <span class="me-2"><i class="bi bi-card-list"></i></span>
                            <span>Products</span>
                            <span class="ms-auto right-icon"><i class="bi bi-chevron-down"></i></span>
                        </a>
                    <div class="collapse" id="collapseProduct">
                        <div>
                            <ul class="navbar-nav ps-3">
                                <li>
                                    <a href="product.php" class="nav-link px-3">
                                        <span>Product List</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="AddProduct.php" class="nav-link px-3">
                                        <span>Add Product</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <li>
                    <a href="Order.php" class="nav-link px-3 ">
                        <span class="me-2"><i class="bi bi-cart-plus-fill"></i> Orders </span>
                    </a>
                </li>
                </li>
            </ul>
        </nav>
    </div>
</div>
