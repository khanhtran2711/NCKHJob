<?php

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
 * Template name: CanBo Registeration
 */
if (!is_user_logged_in()) {
    wp_redirect( wp_login_url() );
}
get_header(); 


?>
<div id="mess">

</div>
<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <div class="container">
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="canboForm">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="họ" type="text" placeholder="Họ" data-sb-validations="required" />
                        <label for="họ">Họ</label>
                        <div class="invalid-feedback" data-sb-feedback="họ:required">Họ is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="tenDệm" type="text" placeholder="Tên Đệm" data-sb-validations="required" />
                        <label for="tenDệm">Tên Đệm</label>
                        <div class="invalid-feedback" data-sb-feedback="tenDệm:required">Tên Đệm is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="ten" type="text" placeholder="Tên" data-sb-validations="required" />
                        <label for="ten">Tên</label>
                        <div class="invalid-feedback" data-sb-feedback="ten:required">Tên is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="diệnThoạiDd" type="text" placeholder="Điện thoại DD" data-sb-validations="" />
                        <label for="diệnThoạiDd">Điện thoại DD</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" type="email" placeholder="Email" data-sb-validations="required,email" />
                        <label for="email">Email</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">Email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email Email is not valid.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="mậtKhẩu" type="text" placeholder="Mật khẩu" data-sb-validations="required" />
                        <label for="mậtKhẩu">Mật khẩu</label>
                        <div class="invalid-feedback" data-sb-feedback="mậtKhẩu:required">Mật khẩu is required.</div>
                    </div>

                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-success  me-1 mb-1" name="workoutformbtn">Lưu</button>
                    </div>
                </form>
            </div> <!--container-->

        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .wrap -->

<?php
$jquery = get_theme_file_uri('/assets/js/jquery-3.7.0.js');
?>
<script src="<?= $jquery ?>"></script>
<script>
    $("#target").on("submit", function(event) {
        callCreate();
    });

    $(document).ready(function() {

        read();


    });

    function callCreate() {
        const url = "/NCKH/my-stuff/create_workout.php";
        $.post(url, {
                workoutdate: $('#workoutdate').val(),
                activity: $('#activity').val(),
                time_mins: $('#time_mins').val(),
                user_id: $('#user_id').val(),
            },
            function(data, status) {
                const alertmess = '<div class="auto-close alert alert-success" role="alert"> Đã thêm thành công</div>'
                // document.getElementById("mess").innerHTML = alertmess;
            });
    }

    function getReadUrl() {
        const params = new URLSearchParams(window.location.search);
        let url = "/NCKH/my-stuff/read_workout.php";

        if (params.has('id')) {
            url += "?id=" + params.get('id');
        }

        return url;
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
