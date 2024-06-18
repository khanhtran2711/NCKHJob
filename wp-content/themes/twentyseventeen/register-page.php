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

// get_header();
include("./mydbfile.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nghiên cứu - Trường Đại học Bạc Liêu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
 .gradient-custom-3 {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgb(26 26 223 / 50%), rgb(111 198 240 / 50%));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgb(26 26 223 / 50%), rgb(111 198 240 / 50%));
}
.gradient-custom-4 {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
}
form{
  text-align: center;
}
#nut-dk{
  background-color: #253dac;
  color:white;
}
</style>
<body>

<section class="bg-image"
  style="background-image: url('https://static.blu.edu.vn/images/1/GIOI%20THIEU/Gioithieu.jpg');background-position: right;">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Đăng ký thành viên</h2>
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
              <?php if (is_user_logged_in()) {
                    $user_id = get_current_user_id();
                    $current_user = wp_get_current_user();
                    $profile_url = get_author_posts_url($user_id);
                    $edit_profile_url = get_edit_profile_url($user_id); ?>
                    <div class="da-dang-nhap">
                        Bạn đã đăng nhập với tài khoản <a href="<?php echo $profile_url ?>"><?php echo $current_user->display_name; ?></a> Hãy truy cập <a href="/wp-admin">Quản trị viên</a> hoặc <a href="<?php echo esc_url(wp_logout_url($current_url)); ?>">Đăng xuất tài khoản</a>
                    </div>
                <?php } else { 
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
                        $pattern = "/^[a-zA-Z]\w*(\@blu\.edu\.vn)$/i";
                        if ($email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $last_name == "") {
                            $err = 'Vui lòng không bỏ trống các thông tin!';
                        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $err = 'Địa chỉ email không hợp lệ!';
                        } else if (email_exists($email)) {
                            $err = 'Email đã tồn tại!';
                        } else if(preg_match($pattern, $email)!=1){
                            $err = 'Phải sử dụng email @blu.edu.vn!';
                        } 
                        else {

                            $user_id = wp_insert_user(array(
                                'first_name' => apply_filters('pre_user_first_name', $first_name),
                                'last_name' => apply_filters('pre_user_last_name', $last_name),
                                'user_pass' => apply_filters('pre_user_user_pass', $pwd1),
                                'user_login' => apply_filters('pre_user_user_login', $username),
                                'user_email' => apply_filters('pre_user_user_email', $email),
                                'role' => 'subscriber'
                            ));
                           

                            $sql = "INSERT INTO `Canbo`(`tendem`, `dienthoaiDD`, `user_id`,`ma_khoa`,`vaitro_noibo`,`trangthaidoikhoa`) VALUES ('$username','',$user_id,1,0,0)";
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
                    
                    <div id="message" class="" role="alert">
                        <?php
                        if (!empty($err)) :
                            echo '<p class="error alert alert-danger">' . $err . '';
                        endif;
                        ?>

                        <?php
                        if (!empty($success)) :
                            echo '<p class="error alert alert-success">' . $success . '';
                        endif;
                        ?>
                    </div>
                    <form method="post">

                <div class="form-outline mb-4">
                <label class="form-label" for="last_name">Họ và tên đệm của bạn</label>
                  <input type="text" name="last_name" id="last_name" class="form-control form-control-lg" />
                  
                </div>
                <div class="form-outline mb-4">
                <label class="form-label" for="first_name">Tên của bạn</label>
                  <input type="text" name="first_name" id="first_name" class="form-control form-control-lg" />
                  
                </div>

                <div class="form-outline mb-4">
                <label class="form-label" for="email">Email của bạn (sử dụng email @blu.edu.vn)</label>
                  <input type="email" id="email" name="email"  class="form-control form-control-lg" placeholder="xxx@blu.edu.vn" />
                 
                </div>
                <div class="form-outline mb-4">
                <label class="form-label" for="username">Tài khoản</label>
                  <input type="text" name="username" id="username" class="form-control form-control-lg" />
                  
                </div>

                <div class="form-outline mb-4">
                <label class="form-label" for="pwd1">Mật khẩu</label>
                  <input type="password" name="pwd1" id="pwd1" class="form-control form-control-lg" />
                  
                </div>

                <div class="form-outline mb-4">
                <label class="form-label" for="pwd2">Nhập lại mật khẩu</label>
                  <input type="password" name="pwd2" id="pwd2"  class="form-control form-control-lg" />
                  
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" name="btnregister" id="nut-dk" 
                    class="btn btn-block" style="padding: 10px 22px;">Đăng ký</button>
                    <input type="hidden" name="task" value="register" />
                </div>

                <p class="text-center text-muted mt-5 mb-0">Nếu bạn đã có tài khoản, hãy truy cập  <a href="<?= home_url('/dang-nhap/'); ?>"
                     style="color: blue;text-decoration: none;">Đăng nhập</a></p>

              </form>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


</body>
</html>