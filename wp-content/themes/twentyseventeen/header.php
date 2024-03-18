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
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php
	$jquery2 = get_theme_file_uri('/assets/js/bootstrap.bundle.min.js');
	?>
	<script src="<?= $jquery2 ?>"></script>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->

	<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
	 		
<?php if ( is_user_logged_in() ) { ?>
	<style>
	body {
		margin: 0;
		padding: 0;
	}
</style>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="index.php">
				<img src="https://blu.edu.vn/assets/img/logo.png" alt="">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<?php
							$user_now = get_current_user_id();
							$user = new WP_User($user_now);
							$username = $user->last_name." ".$user->first_name;
							?>
							Xin chào, <?=$username?>
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown1" style="width: -webkit-fill-available;">
							<li><a class="dropdown-item" href="/NCKH/wp-admin/profile.php">Sửa thông tin</a></li>
							<li><a class="dropdown-item" href="<?php echo wp_logout_url( home_url() ); ?>">Đăng xuất</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<?php
}
	// wp_body_open(); 
	show_admin_bar(false);
	?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content">
			<?php
			/* translators: Hidden accessibility text. */
			_e('Skip to content', 'twentyseventeen');
			?>
		</a>
		<?php
		if (!(is_page(89) || is_page(105))) :

		?>
			<header id="masthead" class="site-header">

				<?php
				if (!is_page())
					get_template_part('template-parts/header/header', 'image');
				else {
					get_template_part('template-parts/header/page', 'image');
				}
				?>

				<?php if (has_nav_menu('top')) : ?>
					<div class="navigation-top">
						<div class="wrap">
							<?php get_template_part('template-parts/navigation/navigation', 'top'); ?>
						</div><!-- .wrap -->
					</div><!-- .navigation-top -->
				<?php endif; ?>

			</header><!-- #masthead -->

		<?php
		endif;
		/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	 */
		if ((is_single() || (is_page() && !twentyseventeen_is_frontpage())) && has_post_thumbnail(get_queried_object_id())) :
			echo '<div class="single-featured-image-header">';
			echo get_the_post_thumbnail(get_queried_object_id(), 'twentyseventeen-featured-image');
			echo '</div><!-- .single-featured-image-header -->';
		endif;
		?>

		<div class="site-content-contain">
			<div id="content" class="site-content">