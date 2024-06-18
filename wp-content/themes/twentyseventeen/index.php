<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */
include 'mydbfile.php';

global $wpdb;
include 'wp-load.php';
get_header(); ?>

<!-- <div class="wrap"> -->
	<div class="container">
	<?php 
	$current_user = wp_get_current_user();
	if (in_array('administrator', $current_user->roles)) {
		$tag = "admin";
	} elseif (in_array('subscriber', $current_user->roles)) {
		$tag = "staff";
	} else {
		// Perform actions for other roles
		
		echo "<script>
		window.location.href = 'dang-nhap/';
	</script>";
	}
	//narrow down your query with $args
$args = array('post_type'=>'page', 'tag'=>$tag, 'posts_per_page'=>15,'orderby' => 'menu_order','order'=>"ASC");

// The Query
$the_query = new WP_Query( $args );
  ?>
	</div>
				<div class="row">
						<!-- <div class="col-12 d-flex order-1 order-xxl-1">
                        <img src="./image/Header-nkch.jpg" style="background-size: cover;height: 333px;margin: 0px;">
                        </div> -->
					<?php if(current_user_can('administrator')):?>
						<div class="col-12 d-flex order-1 order-xxl-1">
							<img src="<?php echo get_template_directory_uri().'/assets/images/Header PX 1110 - 1110.jpg'; ?>" alt="" style="width:inherit;">
						</div>
					<?php else: ?>
					<div class="container p-5">
						<h2>Danh sách các thông báo</h2>
						<table class="table table-striped" id="records">
							<?php
							$sql = "SELECT * FROM `thongbao` WHERE `trangthai`=1 ORDER BY ngaydang DESC";
							echo "<tbody>";
							echo "<thead>";
							echo "<th>Nội dung</th><th>Link</th><th>Ngày đăng</th>";
							echo "</thead>";
							$re = $conn->query($sql);

							error_log('sql = ' . $sql);
							while ($row = $re->fetch_assoc()) {
								echo "<tr>";
								echo "<td>" . $row['noidung'] . "</td>";
								echo "<td><a href='" . $row['link'] . "' target='_blank'>Xem chi tiết</a></td>";
								echo "<td>" . date('d-m-Y',strtotime($row['ngaydang'])) . "</td>";
								echo "<td>";
								echo "</tr>";
							}
							echo "</tbody>";
							?>
						</table>
				
					</div>
					<?php endif;?>

					</div>



				</div>
	
	<!-- <div class="container">
        <div class="row">
			<?php
				// while ( $the_query->have_posts() ) :
				// 	$the_query->the_post();
			?>
            <div class="col-md-4 pe-2 py-2 items">
                <div class="card">
                    <div class="card-body d-flex justify-content-center align-items-center ">
                    <a href="<?=get_page_link()?>" class="text-decoration-none"><h5 class="card-title text-center"><?=get_the_title()?></h5></a>
                    </div>
                </div>
            </div>
			<?php

				// endwhile;
			?>
        </div>
    </div> -->
	<?php //get_sidebar(); ?>
<!-- </div> -->
<!-- .wrap -->
<?php
if(!current_user_can('administrator')):
get_footer();
endif;
