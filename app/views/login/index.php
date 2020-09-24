<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(isset($title)) echo $title; else echo 'Vaqra Admin';?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url()?>assets/images/icons/dw_favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/main.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
	<style type="text/css">
		body *
		{
			font-family: 'Roboto', sans-serif;
		}
	</style>
<!--===============================================================================================-->
</head>
<body>
	<div class="container-fluid" style="/*background-image: url('<?= base_url()?>assets/images/login_background.png');*/height: 100%">
		<div class="row pt-5">
			<div class="col-md-2 mx-auto">
				<img class="img-fluid" src="<?= base_url()?>assets/images/dw_icon.png">
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-md-3 mt-3 mx-auto bg-white rounded p-5 card">
				<form class="login100-form validate-form flex-sb flex-w" method="POST" action="">
					<h4 class="text-center mx-auto mb-3">Admin Log In</h4>
					<?php
					if(isset($error))
						echo '<div class="alert alert-danger form-control" role="alert">'.$error.'</div>';
					elseif(isset($success))
						echo '<div class="alert alert-primary form-control" role="alert">'.$success.'</div>';
					?>
					<div class="wrap-input100 validate-input mt-3" data-validate = "Username is required">
						<input class="form-control" type="text" name="username" placeholder="Admin ID" >
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input mt-3" data-validate = "Password is required" placeholder="Admin ID">
						<input class="form-control" type="password" name="pass" placeholder="********" >
						<span class="focus-input100"></span>
					</div>

					<div class="mt-3 wrap-input100">
						<input type="submit" class="btn form-control text-center text-light " style="background: #dc1d1d;" name="sign_in_now" value="LOGIN"/>
					</div>
					<div class="mx-auto mt-3">
						<a href="<?= base_url()?>assets/#" class="txt2 bo1 m-l-5">Forgot password?</a>
					</div>

					<!-- <div class="w-full text-center p-t-55">
						<span class="txt2">
							Not a member?
						</span>

						<a href="<?= base_url()?>assets/#" class="txt2 bo1">
							Sign up now
						</a>
					</div> -->
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?= base_url()?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>assets/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url()?>assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>assets/js/main.js"></script>

</body>
</html>