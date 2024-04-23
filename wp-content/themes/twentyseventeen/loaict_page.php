<?php
include 'my-stuff/loaict/config.php';

global $wpdb;
include 'wp-load.php';
/**
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
 * Template name: LoaiChuongTrinh management Page
 */

get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">
       
        <main id="main" class="site-main">
            
            <div class="container">
            <div class="mb-3">Duyệt các công trình NCKH mới, vui lòng nhấp vào đây <a href="<?=home_url('/duyetcongtrinh/')?>" class="text-decoration-none btn btn-info">Duyệt công trình</a></div>
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="loaict">
                    <div class="form-body">
                        <div class="row">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ten_loai" name="ten_loai" type="text" placeholder="Tên loại công trình" data-sb-validations="required" />
                                <label for="ten_loai">Tên loại công trình</label>
                                <div class="invalid-feedback" data-sb-feedback="ten_loaigt:required">Tên công trình is required.</div>
                            </div>
                            

                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="xxx">Lưu</button>
                            </div>
                        </div>
                    </div>
                    <?php
                            $url = home_url();
                            ?>
                                        <input type="hidden" id="homeurl" value="<?=$url?>">
                </form>
                <div class="container mt-3">
                    <h2>Danh sách các loại công trình</h2>
                    <p><?=get_the_content()?></p>
                    <table class="table table-striped" id="records">

                    </table>
                    <a href="<?=home_url()?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>
                </div>
            </div> <!--container-->

        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .wrap -->

<?php
$jquery = get_theme_file_uri('/assets/js/jquery-3.7.0.js');
?>
<script src="<?= $jquery ?>"></script>
<script>
    const currentUrl = window.location.hostname;
    let localURL = $("#homeurl").val();
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = array[array.length-2];

    $("#loaict").on("submit", function(event) {
        
        callCreate();
    });

    $(document).ready(function() {

        read();


    });

    function callCreate() {
        let urlc = localURL+"/my-stuff/"+lastsegment+"/create.php";
        $.post(urlc, {
            ten_loai: $('#ten_loai').val()
            },
            function(data, status) {
                console.log(data);
            });
    }

    function getReadUrl() {
        const params = new URLSearchParams(window.location.search);
        let urlr = localURL+"/my-stuff/"+lastsegment+"/read.php";

        if (params.has('id')) {
            urlr += "?id=" + params.get('id');
        }

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
