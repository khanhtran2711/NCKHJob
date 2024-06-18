<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Hệ thống quản lý nghiên cứu - Trường Đại học Bạc Liêu</title>

	<?php
	$jquery2 = get_theme_file_uri('/assets/js/bootstrap.bundle.min.js');
	?>
	<script src="<?= $jquery2 ?>"></script>
	<?php
	$jquery3 = get_theme_file_uri('/assets/js/app.js');
	?>
	<script src="<?= $jquery3 ?>"></script>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<style>
	.site-branding {
		display: none;
	}

	body {
		margin: 0;
		padding: 0;
	}

	div.dropdown-menu-end {
		width: -webkit-fill-available;
	}

	@media only screen and (max-width: 575px) {
		div.dropdown-menu-end {
			width: 10px;
		}
	}
</style>

<body <?php body_class(); ?>>

	<?php
	$home = home_url("/index.php");
	if (is_user_logged_in()) {
		if (current_user_can('administrator')) :
			include_once('menu-admin.php');
		else :
			include_once('menu-staff.php');
		endif;
	} else {
	?>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand" href="<?= $home ?>">
					<img src="https://blu.edu.vn/assets/img/logo.png" alt="">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
		</nav>
	<?php
	}
	?>
	<div class="main">
	<?php 
	if (((!is_home() || !is_front_page())&& current_user_can('administrator')) || !current_user_can('administrator')) :
		 ?>
			<div class="row">

				<div class="col-12 d-flex order-1 order-xxl-1">
					<img src="<?php echo get_template_directory_uri() . '/assets/images/Header PX 1400-120.jpg'; ?>" alt="" style="width:inherit;">
				</div>

			</div>
		<?php 
		endif 
		?>
		<nav class="navbar navbar-expand navbar-light navbar-bg">
			<a class="sidebar-toggle js-sidebar-toggle">
				<i class="hamburger align-self-center"></i>
			</a>

			<div class="navbar-collapse collapse">
				<ul class="navbar-nav navbar-align">
					<li class="nav-item dropdown">
						<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
							<i class="align-middle" data-feather="settings"></i>
						</a>

						<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
							<span class="text-dark">
								<?php
								$user_now = get_current_user_id();
								$user = new WP_User($user_now);
								$username = $user->last_name . " " . $user->first_name;
								?>
								Xin chào, <?= $username ?>
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-end" data-bs-popper="static">
							<a class="dropdown-item" href="<?= admin_url('profile.php') ?>"><i class="align-middle me-1" data-feather="user"></i> Cài đặt tài khoản</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?php echo wp_logout_url(home_url()); ?>"><i class="align-middle me-1" data-feather="log-out"></i> Đăng xuất</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>

		

		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content">
				<?php
				// wp_body_open(); 
				show_admin_bar(false);
				/* translators: Hidden accessibility text. */
				_e('Skip to content', 'twentyseventeen');
				?>
			</a>


			<!-- <div class="site-content-contain">
			<div id="content" class="site-content"> -->
			<main class="content p-0">
				<div class="container-fluid p-0">