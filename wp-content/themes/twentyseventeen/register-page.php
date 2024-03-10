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
 * Template name: Register Form Page
 */

get_header();
include("./mydbfile.php");
?>
<style>
    body {
        padding: 0px;
    }

    .site-content {
        padding: 0px;
    }

    .dang-ky {
        margin-top: 150px;
        margin-bottom: 150px;
        width: 40%;
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto
    }

    .dang-dang-nhap {
        margin-top: 500px;
    }

    @media (max-width: 600px) {
        .dang-nhap {
            width: 90%
        }
    }

    .message {
        color: #333
    }

    #username,
    #email,
    #pwd1,
    #pwd2,
    #last_name,
    #first_name {
        width: 100%
    }

    #nut-dk {
        background: #444;
        color: #fff;
        border: none;
        padding: 10px
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="modal" id="modalmess">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Thành công!</h4>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Bạn đã đăng ký thành công! Hãy truy cập <a href="<?= home_url('/dang-nhap/') ?>">Đăng nhập</a>!
                        </div>


                    </div>
                </div>
            </div>
            <div class="dang-ky">
                <?php if (is_user_logged_in()) {
                    $user_id = get_current_user_id();
                    $current_user = wp_get_current_user();
                    $profile_url = get_author_posts_url($user_id);
                    $edit_profile_url = get_edit_profile_url($user_id); ?>
                    <div class="da-dang-nhap">
                        Bạn đã đăng nhập với tài khoản <a href="<?php echo $profile_url ?>"><?php echo $current_user->display_name; ?></a> Hãy truy cập <a href="/wp-admin">Quản trị viên</a> hoặc <a href="<?php echo esc_url(wp_logout_url($current_url)); ?>">Đăng xuất tài khoản</a>
                    </div>
                <?php } else { ?>
                    <div class="da-dang-nhap">
                        Nếu bạn đã có tài khoản, hãy truy cập <a href="<?= home_url('/dang-nhap/'); ?>">Đăng nhập</a>!
                    </div>
                    <?php
                    $err = '';
                    $success = '';

                    global $wpdb, $PasswordHash, $current_user, $user_ID;

                    if (isset($_POST['task']) && $_POST['task'] == 'register') {


                        $pwd1 = $wpdb->escape(trim($_POST['pwd1']));
                        $pwd2 = $wpdb->escape(trim($_POST['pwd2']));
                        $first_name = $wpdb->escape(trim($_POST['first_name']));
                        $last_name = $wpdb->escape(trim($_POST['last_name']));
                        $email = $wpdb->escape(trim($_POST['email']));
                        $username = $wpdb->escape(trim($_POST['username']));

                        if ($email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $last_name == "") {
                            $err = 'Vui lòng không bỏ trống các thông tin!';
                        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $err = 'Địa chỉ email không hợp lệ!';
                        } else if (email_exists($email)) {
                            $err = 'Email đã tồn tại!';
                        } else {

                            $user_id = wp_insert_user(array(
                                'first_name' => apply_filters('pre_user_first_name', $first_name),
                                'last_name' => apply_filters('pre_user_last_name', $last_name),
                                'user_pass' => apply_filters('pre_user_user_pass', $pwd1),
                                'user_login' => apply_filters('pre_user_user_login', $username),
                                'user_email' => apply_filters('pre_user_user_email', $email),
                                'role' => 'subscriber'
                            ));
                           

                            $sql = "INSERT INTO `Canbo`(`tendem`, `dienthoaiDD`, `user_id`,`ma_khoa`) VALUES ('$username','',$user_id,1)";
                            $conn->query($sql);
                            error_log($sql);
                            $conn->close();
                            
                            if (is_wp_error($user_id)) {
                                $err = 'Lỗi đăng ký tài khoản';
                            } else {

                                do_action('user_register', $user_id);
                                echo '<script>
                                        var myModal = new bootstrap.Modal(document.getElementById("modalmess"));
                                    myModal.show();
                            </script>';
                            }
                        }
                    }
                    ?>

                    <!-- <div class="modal-dialog modal-lg">...</div> -->
                    <!--display error/success message-->
                    <div id="message">
                        <?php
                        if (!empty($err)) :
                            echo '<p class="error">' . $err . '';
                        endif;
                        ?>

                        <?php
                        if (!empty($success)) :
                            echo '<p class="error">' . $success . '';
                        endif;
                        ?>
                    </div>
                    <form method="post">

                        <p><label>Họ của bạn</label></p>
                        <p><input type="text" value="" name="last_name" id="last_name" /></p>
                        <p><label>Tên đệm và Tên của bạn</label></p>
                        <p><input type="text" value="" name="first_name" id="first_name" /></p>
                        <p><label>Email của bạn</label></p>
                        <p><input type="text" value="" name="email" id="email" /></p>
                        <p><label>Tài khoản</label></p>
                        <p><input type="text" value="" name="username" id="username" /></p>
                        <p><label>Mật khẩu</label></p>
                        <p><input type="password" value="" name="pwd1" id="pwd1" /></p>
                        <p><label>Nhập lại mật khẩu</label></p>
                        <p><input type="password" value="" name="pwd2" id="pwd2" /></p>
                        <div class="message">
                            <p><?php if ($success != "") {
                                    echo $success;
                                } ?> <?php if ($err != "") {
                                            echo $err;
                                        } ?></p>
                        </div>
                        <button type="submit" name="btnregister" id="nut-dk" class="button">Đăng ký</button>
                        <input type="hidden" name="task" value="register" />
                    </form>
                <?php } ?>
            </div>

        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();



?>