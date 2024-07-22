<?php
include 'my-stuff/chucdanh/config.php';
global $wpdb;
include 'wp-load.php';
include 'mydbfile.php';
/**
 * 
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 * Template name: quan ly role noibo (user-sub quanly) management Page
 */
if (!is_user_logged_in()) {
    wp_redirect( wp_login_url() );
}
$sql = "SELECT * FROM `realdev_users`";

$re = $conn->query($sql);

error_log('sql = ' . $sql);

$list = array();
	$rows = $re->num_rows;
 
	if($rows > 0){
		while($fetch = $re->fetch_assoc()){
			if(!user_can( $fetch['ID'], "manage_options" ))
			{
				
				array_push($list, $fetch['user_email']);
			}
		}
	}

get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">
       
        <main id="main" class="site-main">
            
            <div class="container">
                <h2 class="mt-3"><?=get_the_title() ?></h2>
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="qlrole">
                    <div class="form-body">
                        <div class="row">
                        <div class="form-floating mb-3 ui-widget">
                            <input class="form-control" id="email" name="email" type="text" />
                            <label for="tendetai">Tìm theo email của cán bộ</label>
                            <div class="invalid-feedback" data-sb-feedback="ghichu:required">Email is required.</div>
                        </div>
                            <?php
                            $url = home_url();
                            ?>
                                        <input type="hidden" id="homeurl" value="<?=$url?>">
                                        <input type="hidden" id="result" value='<?=json_encode($list,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);?>'>
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="btnAdd" id="btnAdd">Thêm</button>
                            </div>
                        </div>
                    </div>
                        </div>


                    </div>

                </form>
                <div class="container mt-3">
                    <h2>Danh sách các user (quyền quản lý khoa/bộ môn/phòng ban)</h2>
                    <p><?=get_the_content()?></p>
                    <table class="table table-striped" id="records">

                    </table>
                    <a href="<?=home_url()?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>
                </div>
            </div> <!--container-->

        </main><!-- #main -->


<?php
$jquery = get_theme_file_uri('/assets/js/jquery-3.7.0.js');
$jquery2 = get_theme_file_uri('/assets/js/jquery-ui.js');
$jquery3 = get_theme_file_uri('/assets/js/jquery-ui.css');
?>

<script src="<?= $jquery ?>"></script>
<link rel="stylesheet" href="<?= $jquery3 ?>">
    <script src="<?= $jquery2 ?>"></script>
    
<script>
    const currentUrl = window.location.hostname;
    let localURL = $("#homeurl").val();
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = "cbprofile";
    
    $("#qlrole").on("submit", function(event) {
        
        callCreate();
    });
    function callCreate() {
        let urlc = localURL+"/my-stuff/"+lastsegment+"/add-role.php";
        $.post(urlc, {
            email: $('#email').val()
            },
            function(data, status) {
                window.location.href = data;
            });
    }
    $(document).ready(function() {
        let availableTags1 = $( "#result" ).val();
   
        $( "#email" ).autocomplete({
            source: JSON.parse(availableTags1)
        });

        read();
    });
    function getReadUrl() {
        const params = new URLSearchParams(window.location.search);
        let urlr =  localURL + "/my-stuff/" + lastsegment + "/read-role.php";
        return urlr;
    }

    function read() {
        const url = getReadUrl();
        $.get(url, function(data) {
            document.getElementById("records").innerHTML = data;
        });
    }

</script>
<?php
get_footer();
