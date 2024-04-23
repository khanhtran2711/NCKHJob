<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.2
 */

?>

</main><!-- #content -->
<style>
#footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    line-height: 2;
    text-align: center;
    
    font-size: 30px;
    font-family: sans-serif;
    font-weight: bold;
   
}
#temp{
    height: 200px;
}
</style>
<div id="temp">

</div>
<footer id="footer">
	<div class="container-fluid p-0">
		<div class="row">

			<div class="col-12 d-flex order-1 order-xxl-1">
				<img src="<?php echo get_template_directory_uri() . '/assets/images/Foter _PX.jpg'; ?>" alt="" style="width:inherit;">
			</div>

		</div>
	</div>
</footer>
</div> <!-- end div main  -->
</div><!-- end div wrapper -->

<?php wp_footer(); ?>

</body>

</html>