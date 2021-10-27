<?php
/**
 * @var string $strFileName
 */
?>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="viewport"
		  content="width=device-width, initial-scale=1.0">
	<title>Welcome</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css"
		  rel="stylesheet"
		  integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF"
		  crossorigin="anonymous">
	<link rel="stylesheet"
		  href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css">
	<link rel="stylesheet"
		  href="<?= BASEPATH ?>/css/index.css">
	<link rel="stylesheet"
		  href="<?= BASEPATH ?>/css/main.css">
	<link rel="stylesheet"
		  href="<?= BASEPATH ?>/css/short.css">
	<link rel="stylesheet"
		  href="<?= BASEPATH ?>/css/login.css">
	<link rel="stylesheet"
		  href="<?= BASEPATH ?>/css/arbeitgeber.css">
	<link rel="stylesheet"
		  href="<?= BASEPATH ?>/css/quicksearch.css">
	<link rel="stylesheet"
		  href="<?= BASEPATH ?>/css/benutzerinterface.css">
	<link rel="stylesheet"
		  href="<?= BASEPATH ?>/css/jobs.css">
</head>
<body class="d-flex flex-column min-vh-100">
<!-- Navigation Bar & Logo -->
<div class="layout">
	<div class="header">
		<div class="container">
			<div class="logo">
				<a href="<?= BASEPATH ?>/">ReiseJobs.de</a><br>
			</div>
			<div class="topnav"
				 id="myTopnav">
				<a href="<?= BASEPATH ?>/"
				   class="<?php if($strFileName == "view/indexView.php"): ?>active<?php endif ?>">Startseite <i class="fa-thin fa-home"></i></a>
				<a href="<?= BASEPATH ?>/arbeitgeber"
				   class="<?php if($strFileName == "view/indexView.php"): ?>active<?php endif ?>">Arbeitgeber<i class="fa-thin fa-building"></i></a>
				<a href="<?= BASEPATH ?>/jobs"
				   class="<?php if($strFileName == "view/indexView.php"): ?>active<?php endif ?>">Jobs <i class="fa-light fa-users"></i></a>
				<a href="<?= BASEPATH ?>/kontakt"
				   class="<?php if($strFileName == "view/indexView.php"): ?>active<?php endif ?>">Kontakt <i class="fa-thin fa-address-card"></i></a>
                <?php if(isset($_SESSION["logged_in"])): ?>
					<a href="<?= BASEPATH ?>/login?logout=1"
					   class="<?php if($strFileName == "view/indexView.php"): ?>active<?php endif ?> rightbar">Logout <i class="fa-light fa-right-to-bracket"></i></a>
					<a href="<?= BASEPATH ?>/userinterface"
					   class="<?php if($strFileName == "view/indexView.php"): ?>active<?php endif ?> rightbar">Benutzerbereich <i class="fa-light fa-gear"></i></a>
                <?php endif;
                if(!isset($_SESSION["logged_in"])): ?>
					<a href="<?= BASEPATH ?>/login"
					   class="<?php if($strFileName == "view/indexView.php"): ?>active<?php endif ?> rightbar">Login <i class="fa-light fa-user"></i></a>

                <?php endif; ?>
				<a href="javascript:void(0);"
				   class="icon"
				   onclick="toggleNavbar()">
					<i class="fa fa-bars"></i>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- End of Navigation Bar & Logo -->
<?php
require "$strFileName";
?>
<!-- Footer-->
<div class="layout">
	<div class="footer mt-auto">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12 ta-ctr">
					<div class="">
						<a href="impressum">Impressum</a>
						<a href="datenschutz">Datenschutz</a>
						<a href="kontakt">Kontakt</a>
						<a href="login">Login</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= BASEPATH ?>/js/navbar.js"></script>
</body>
</html>