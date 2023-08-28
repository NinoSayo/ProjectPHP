<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="Assets/CSS/default.min.css">
    <link rel="stylesheet" href="Assets/CSS/alertify.min.css">
    <link rel="stylesheet" href="Assets/CSS/style2.css">
    <link rel="stylesheet" href="Assets/CSS/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/aos.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">
	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<link rel="stylesheet" href="js/jquery.range.css">
	<script src="js/jquery.range.js"></script>
	<script src="js/jquery.min.js"></script>
        <script>
		function filterProducts() {
			var price_range = $('#price_range').val();
			$.ajax({
				type: 'POST',
				url: 'fetchProducts.php',
				data: 'price_range=' + price_range,
				beforeSend: function() {
					$('.wrapper').css("opacity", ".5");
				},
				success: function(html) {
					$('#productContainer').html(html);
					$('.wrapper').css("opacity", "");
				}
			});
		}
	</script>
	<style>
		.pagination {
			display: flex;
			justify-content: center;
			align-items: center;
			margin-top: 20px;
		}

		.pagination a {
			color: #333;
			padding: 8px 16px;
			text-decoration: none;
			border: 1px solid #ddd;
			margin: 0 5px;
			transition: background-color 0.3s, color 0.3s;
		}

		.pagination a.active {
			background-color: #333;
			color: white;
		}

		.pagination a:hover {
			background-color: #f2f2f2;
		}
        a {
            text-decoration: none;
        }
    </style>
</head>
<!-- header -->
<body class="goto-here">
    <div class="py-1 bg-black">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <span class="text">+ 1235 2355 98</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <span class="text">youremail@email.com</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text">3-5 Business days delivery &amp; Free Returns</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->
    <?php include("navbar.php") ?>
    <body>