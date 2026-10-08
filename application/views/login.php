<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= $this->fungsi->get_setting()->nama_usaha ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= base_url('assets2/') ?>images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets2/') ?>vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets2/') ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets2/') ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets2/') ?>vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets2/') ?>vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets2/') ?>vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets2/') ?>vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets2/') ?>vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets2/') ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets2/') ?>css/main.css">
	<!--===============================================================================================-->
	<style>
		/* Custom Black Theme */
		.login100-form-btn {
			background-color: #000000 !important;
			color: #ffffff !important;
			border-radius: 5px !important;
			transition: all 0.3s;
		}

		.login100-form-btn:hover {
			background-color: #333333 !important;
		}

		.login100-form-title {
			color: #000000 !important;
			font-weight: bold;
		}

		.wrap-login100 {
			background: rgba(255, 255, 255, 0.95) !important;
			border: 2px solid #000000 !important;
			border-radius: 10px !important;
			padding: 40px !important;
			box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5) !important;
			width: 100% !important;
			max-width: 450px !important;
			margin: 0 auto !important;
			text-align: center;
			box-sizing: border-box !important;
		}

		.wrap-input100 {
			width: 100% !important;
			box-sizing: border-box !important;
		}

		.input100 {
			border: 1px solid #ccc !important;
			border-radius: 5px !important;
			padding-left: 50px !important;
			padding-right: 15px !important;
			width: 100% !important;
			box-sizing: border-box !important;
		}

		.focus-input100 {
			color: #000000 !important;
		}

		.container-login100 {
			background-size: cover;
			background-position: center;
			display: flex !important;
			justify-content: center !important;
			align-items: center !important;
			min-height: 100vh !important;
		}
	</style>
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					<?php if (!empty($this->fungsi->get_setting()->logo)): ?>
						<img src="<?= base_url('uploads/' . $this->fungsi->get_setting()->logo) ?>" alt="Logo" style="height: 80px; object-fit: contain; margin-bottom: 20px;">
						<br>
					<?php endif; ?>
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" action="<?= site_url('auth/proses'); ?>" method="POST">

					<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username" style="margin-bottom: 20px;">
						<input class="input100" type="text" name="username" placeholder="Username" style="height: 50px; border-radius: 5px;">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-20" data-validate="Enter password" style="margin-bottom: 30px;">
						<input class="input100" type="password" name="password" placeholder="Password" style="height: 50px; border-radius: 5px;">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login" style="width: 100%; height: 50px; font-size: 18px; border-radius: 5px;">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="<?= base_url('assets2/') ?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('assets2/') ?>vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('assets2/') ?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url('assets2/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('assets2/') ?>vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('assets2/') ?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url('assets2/') ?>vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('assets2/') ?>vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('assets2/') ?>js/main.js"></script>

</body>

</html>