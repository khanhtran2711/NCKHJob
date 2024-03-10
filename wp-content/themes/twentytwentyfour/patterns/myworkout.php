<?php
/**
 * Title: My Workout Page
 * Slug: twentytwentyfour/page-newsletter-landing
 * Categories: call-to-action, page, featured
 * Keywords: starter
 * Block Types: core/post-content
 * Post Types: page, wp_template
 * Viewport width: 1100
 */
?>
 <div class="container">
        <form class="form form-vertical" method="POST" action="#"
        enctype="multipart/form-data"
        >
            <div class="form-body">
                <div class="row">
                <div class="col-12">
                        <div class="form-group">
                            <label for="workoutdate">Work out Date</label>
                            <input type="date" id="workoutdate" class="form-control"
                                name="workoutdate">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="activity">Activity</label>
                            <input type="text" id="activity" class="form-control"
                                name="activity"
                                value ="">
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label for="time_mins">Times in Min</label>
                            <input type="text" id="time_mins" class="form-control"
                                name="time_mins"
                                value ="">
                        </div>
                    </div>
                   
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-warning me-1 mb-1 rounded-pill" name="Add">Submit</button>
                    </div>
                </div>
            </div>
        </form>
                
        </div> <!--container-->
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"var:preset|spacing|50","left":"var:preset|spacing|50","top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}},"dimensions":{"minHeight":"100vh"}},"backgroundColor":"accent-3","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group alignfull has-accent-3-background-color has-background" style="min-height:100vh;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)">
   
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:image {"align":"center","width":"45px","height":"49px","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
		
		<!-- /wp:image -->

		<!-- wp:spacer {"height":"var:preset|spacing|10"} -->
		<div style="height:var(--wp--preset--spacing--10)" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"right":"0","left":"0"},"padding":{"right":"0","left":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}}},"textColor":"contrast","fontSize":"x-large"} -->
		<h2 class="wp-block-heading has-text-align-center has-contrast-color has-text-color has-link-color has-x-large-font-size" style="margin-right:0;margin-left:0;padding-right:0;padding-left:0"><?php echo esc_html_x( 'Subscribe to the newsletter and stay connected with our community', 'sample content for newsletter subscription', 'twentytwentyfour' ); ?></h2>
		<!-- /wp:heading -->
        
		<!-- wp:spacer {"height":"var:preset|spacing|10"} -->
		<div style="height:var(--wp--preset--spacing--10)" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->
        
		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button">
				<a class="wp-block-button__link wp-element-button"><?php echo esc_html_x( 'Sign up', 'Sample content for newsletter subscribe button', 'twentytwentyfour' ); ?></a>
			</div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
