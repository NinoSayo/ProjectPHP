<?php
include("Includes/loader.php");
include("Functions/userFunction.php");
include("Includes/header.php");
include("Database/Connect.php");

$blogsPerPage = 3;

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$startIndex = ($currentPage - 1) * $blogsPerPage;
$blog = getBlogLimited($startIndex, $blogsPerPage);
?>


<body>
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Blog</span></p>
					<h1 class="mb-0 bread">Blog</h1>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section ftco-degree-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-lg-last ftco-animate">
					<div class="row">
					<?php
					foreach ($blog as $p) {
					?>
						<div class="col-md-12 d-flex ftco-animate">
							<div class="blog-entry align-self-stretch d-md-flex">
							<a href="blog-single.php?id=<?= $p['blog_id'] ?>" class="block-20" style="background-image: url('Assets/<?= $p['image'] ?>');">
								</a>
								<div class="text d-block pl-md-4">
									<div class="meta mb-3">
										<div><a href="#">Đăng bởi Admin</a></div>
										<div><a href="#">, Vào lúc <?= $p['created_at'] ?></a></div>
										<!-- <div><a href="" class="meta-chat"><span class="icon-chat"></span> 3</a></div> -->
									</div>
									<h2 class="heading"><a href="blog-single.php?id=<?= $p['blog_id'] ?>"></a><?= $p['title'] ?></h2>
									<p><?php echo substr(strip_tags($p['content']), 0, 140) ?> ...v...v...</p>
									<p><a href="blog-single.php?id=<?= $p['blog_id'] ?>" class="btn btn-primary py-2 px-3">Read more</a></p>
								</div>
							</div>
						</div>
						<?php
					}
					?>
					</div>
					<div class="row mt-2">
					<div class="col">
    <div class="block-27">
        <ul>
            <!-- Generate pagination links -->
            <?php
            $totalPages = ceil(countBlogs() / $blogsPerPage);
            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = ($i == $currentPage) ? "active" : "";
                echo '<li class="' . $activeClass . '"><a href="?page=' . $i . '">' . $i . '</a></li>';
            }
            ?>
        </ul>
    </div>
</div>
					</div>
				</div>
				<div class="col-lg-4 sidebar ftco-animate">
				<div class="sidebar-box ftco-animate">
    <h3 class="heading">Recent Blog</h3>
    
    <?php
    
    $recentBlogs = getRecentBlogs();

    foreach ($recentBlogs as $blog) {
    ?>
    <div class="block-21 mb-4 d-flex">
        <a class="blog-img mr-4" style="background-image: url('Assets/<?= $blog['image'] ?>');"></a>
        <div class="text">
            <h3 class="heading-1"><a href="blog-single.php?id=<?= $blog['blog_id']; ?>"><?= $blog['title']; ?></a></h3>
            <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> <?= $blog['created_at']; ?></a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    
</div>

					<div class="sidebar-box ftco-animate">
						<h3 class="heading">Tag Cloud</h3>
						<div class="tagcloud">
							<a href="#" class="tag-cloud-link">shop</a>
							<a href="#" class="tag-cloud-link">products</a>
							<a href="#" class="tag-cloud-link">shirt</a>
							<a href="#" class="tag-cloud-link">jeans</a>
							<a href="#" class="tag-cloud-link">shoes</a>
							<a href="#" class="tag-cloud-link">dress</a>
							<a href="#" class="tag-cloud-link">coats</a>
							<a href="#" class="tag-cloud-link">jumpsuits</a>
						</div>
					</div>

					<div class="sidebar-box ftco-animate">
						<h3 class="heading">Paragraph</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
					</div>
				</div>

			</div>
		</div>
	</section>
</body>

</html>

<?php
include("Includes/js.php");
include("Includes/footer.php")
?>