<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

?>
<div class="site-branding">
	<div class="wrap">

		<?php
		if (!is_page(89) ) :
			?>
		<div class="site-branding-text">
			
			<h2>
				<a href="<?=get_page_link()?>">
					<?php
						echo get_the_title();
					?>
				</a>
			</h2>
		</div>
		<?php endif;?>
	</div><!-- .wrap -->
</div><!-- .site-branding -->
