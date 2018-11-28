<?php
    ob_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="product" content="Metro UI CSS Framework">
		<meta name="description" content="Simple responsive css framework">
		<meta name="author" content="Sergey S. Pimenov, Ukraine, Kiev">
		<meta name="keywords" content="js, css, metro, framework, windows 8, metro ui">

		<link href="css/metro-bootstrap.css" rel="stylesheet">
		<link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
		<link href="css/iconFont.css" rel="stylesheet">
		<link href="css/docs.css" rel="stylesheet">
		<link href="js/prettify/prettify.css" rel="stylesheet">
		<link href="css/DataTable.css" rel="stylesheet">

		<!-- Load JavaScript Libraries -->
		<script src="js/jquery/jquery.min.js"></script>
		<script src="js/jquery/jquery.widget.min.js"></script>
		<script src="js/jquery/jquery.mousewheel.js"></script>
		<script src="js/prettify/prettify.js"></script>
        <script src="js/DataTable.js"></script>

		<!-- Metro UI CSS JavaScript plugins -->
		<script src="js/load-metro.js"></script>

		<!-- Local JavaScript -->


		<title>Organizer Ministrantów by Kubas &copy;</title>

		<style>
		</style>
	</head>
	<body class="metro" style="background-color: #efeae3">
		<?php
			require("includes/core/sql.php");
			require("includes/core/user.php");
			require("header.php");
		?>
		<div class="container">
			<?php require("main.php"); ?>
		</div>

	</body>
</html>