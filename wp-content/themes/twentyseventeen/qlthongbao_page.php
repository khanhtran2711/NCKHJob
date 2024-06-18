<?php
include 'my-stuff/cap_detai/config.php';
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
 * Template name: quanly thongbao management Page
 */

get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">
       
        <main id="main" class="site-main">
        <h2 class="mt-3"><?=get_the_title() ?></h2>
            <div class="container">
                <div class="chuthich"></div>
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="qlthongbao">
                    <div class="form-body">
                        <div class="row">
                        <div class="chuthich"></div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="noidung" name="noidung" type="text" placeholder="noidung" data-sb-validations="required" />
                                <label for="noidung">Nội dung thông báo</label>
                                <div class="invalid-feedback" data-sb-feedback="noidung:required">Tên cấp đề tài is required.</div>
                            </div>
                            <div class="chuthich"></div>
                                <p class="pb-lg-2 chuthich">Bạn nên đọc trước hướng dẫn khi chia sẻ link thông báo - <a href="https://drive.google.com/file/d/1JkSccTzhZimqYdFSu7SAbqyVlI7ScBmu/view" target="_blank" style="color: blue;text-decoration: none;">Tài liệu HDSD</a></p>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="link" type="text" placeholder="link" data-sb-validations="required" />
                                    <label for="link">Link thông báo (dán liên kết từ google drive vào đây)</label>
                                    <div class="invalid-feedback" data-sb-feedback="link:required">Minh chứng is required.</div>
                                </div>
                            <div class="chuthich"></div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ngaydang" name="ngaydang" type="date" placeholder="ngaydang" data-sb-validations="required" value="<?=date('Y-m-d')?>"/>
                                <label for="ngaydang">Ngày đăng</label>
                                <div class="invalid-feedback" data-sb-feedback="ngaydang:required">Thời gian áp dụng is required.</div>
                            </div>
                            <!-- <input type="hidden" id="user_id" class="form-control" name="time_mins" value="<?= get_current_user_id(); ?>"> -->

                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="workoutformbtn">Lưu</button>
                                <?php
                            $url = home_url();
                            ?>
                                        <input type="hidden" id="homeurl" value="<?=$url?>">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container mt-3">
                    <h2>Danh sách các thông báo</h2>
                    <p><?=get_the_content()?></p>
                    <div class='chuthich'>Đổi trạng thái: khi bấm <strong>Hiện</strong>, thông báo đó sẽ được hiển thị ở trang chủ của các cán bộ; và ngược lại</div>
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
    const folder = "NCKH";
    let localURL = $("#homeurl").val();
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = array[array.length-2];
    function confirmDesactiv()
    {
    return confirm("bạn có muốn xóa không?")
    }
    $("#qlthongbao").on("submit", function(event) {
        
        callCreate();
    });

    $(document).ready(function() {

        read();


    });

    function callCreate() {
        let urlc = localURL+"/my-stuff/"+lastsegment+"/create.php";
        $.post(urlc, {
                noidung: $('#noidung').val(),
                link: $('#link').val(),
                ngaydang:$('#ngaydang').val()
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
