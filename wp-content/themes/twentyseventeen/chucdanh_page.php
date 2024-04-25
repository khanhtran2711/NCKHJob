<?php
include 'my-stuff/chucdanh/config.php';
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
 * Template name: Chuc danh management Page
 */

get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">
       
        <main id="main" class="site-main">
            
            <div class="container">
                <h2 class="mt-3"><?=get_the_title() ?></h2>
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="capdetai">
                    <div class="form-body">
                        <div class="row">
                        <div class="chuthich"></div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ten_cd" name="ten_cd" type="text" placeholder="Tên chức danh" data-sb-validations="required" />
                                <label for="tenCấpDềTai">Tên chức danh</label>
                                <div class="invalid-feedback" data-sb-feedback="tenCấpDềTai:required">Tên chức danh is required.</div>
                            </div>
                            <div class="chuthich"></div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="dinhmuc" name="dinhmuc" type="text" placeholder="Định mức" data-sb-validations="required" />
                                <label for="giờChuẩn">Định mức</label>
                                <div class="invalid-feedback" data-sb-feedback="giờChuẩn:required">Định mức is required.</div>
                            </div>
                            <div class="chuthich"></div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="thoigian_apdung" name="thoigian_apdung" type="date" placeholder="Thời gian áp dụng" data-sb-validations="required" value="<?=date('Y-m-d')?>"/>
                                <label for="thờiGianApDụng">Thời gian áp dụng</label>
                                <div class="invalid-feedback" data-sb-feedback="thờiGianApDụng:required">Thời gian áp dụng is required.</div>
                                <?php
                            $url = home_url();
                            ?>
                                        <input type="hidden" id="homeurl" value="<?=$url?>">
                            </div>
                            <!-- <input type="hidden" id="user_id" class="form-control" name="time_mins" value="<?= get_current_user_id(); ?>"> -->

                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="workoutformbtn">Lưu</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container mt-3">
                    <h2>Danh sách các loại chức danh</h2>
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
    // let localURL =currentUrl+'/'+folder;
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = array[array.length-2];

    $("#capdetai").on("submit", function(event) {
        
        callCreate();
    });

    $(document).ready(function() {

        read();


    });

    function callCreate() {
        let urlc = localURL+"/my-stuff/"+lastsegment+"/create.php";
        $.post(urlc, {
            ten_cd: $('#ten_cd').val(),
                dinhmuc: $('#dinhmuc').val(),
                thoigian_apdung:                    $('#thoigian_apdung').val()
            },
            function(data, status) {
                const alertmess = '<div class="auto-close alert alert-success" role="alert"> Đã thêm thành công</div>'
                // document.getElementById("mess").innerHTML = alertmess;
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
