<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title><?php if(isset($title)) echo $title; else echo 'Dashboard - VAQRA';?></title>
	<!-- Favicon-->
	<link rel="icon" href="<?= base_url()?>assets/images/dw_favicon.png" type="image/x-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

	<!-- Bootstrap Core Css -->
	<!-- <link href="<?= base_url()?>assets/admin/plugins/bootstrap/css/bootstrap-4.4.1/dist/css/bootstrap.css" rel="stylesheet"> -->
	<link href="<?= base_url()?>assets/admin/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- Waves Effect Css -->
	<link href="<?= base_url()?>assets/admin/plugins/node-waves/waves.css" rel="stylesheet" />

	<!-- Animation Css -->
	<link href="<?= base_url()?>assets/admin/plugins/animate-css/animate.css" rel="stylesheet" />

	<!-- JQuery DataTable Css -->
	<link href="<?= base_url()?>assets/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

	<!-- Morris Chart Css-->
	<link href="<?= base_url()?>assets/admin/plugins/morrisjs/morris.css" rel="stylesheet" />
	
	<!-- Bootstrap Select Css -->
	<link href="<?= base_url()?>assets/admin/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

	<!-- Sweetalert Css -->
	<link href="<?= base_url()?>assets/admin/plugins/sweetalert/sweetalert.css" rel="stylesheet">

	<!-- Light Gallery Plugin Css -->
	<link href="<?= base_url()?>assets/admin/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">

	<!-- Custom Css -->
	<link href="<?= base_url()?>assets/admin/css/style.css" rel="stylesheet">

	<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
	<link href="<?= base_url()?>assets/admin/css/themes/all-themes.css" rel="stylesheet" />
</head>
<body class="theme-red">