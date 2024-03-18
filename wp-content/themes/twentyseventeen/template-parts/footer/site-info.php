<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

?>
<div class="site-info">
	<?php
	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
	}
	?>
	
		<?php
			/* translators: %s: WordPress */
		printf( __( '&copy; 2024 Trường Đại học Bạc Liêu, Hỗ trợ: 0291.6500.999 - Email: qlkh@blu.edu.vn', 'twentyseventeen' ), 'WordPress' );
		?>
</div><!-- .site-info -->
