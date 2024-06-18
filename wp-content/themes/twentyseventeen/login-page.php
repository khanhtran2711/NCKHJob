<?php
/*
 Template Name: Login Page
 */
// get_header();
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
  body,html{
    height: 100%;
    margin: 0;
  }
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
input[type=email],
  input[type=number],
  input[type=password],
  input[type=search],
  input[type=tel],
  input[type=text],
  input[type=url],
  select,
  textarea {
    border: 1px solid #DDD;
    border-radius: 0.5rem;
    -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.07);
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.07);
    background-color: #FFF;
    color: #333;
    -webkit-transition: .05s border-color ease-in-out;
    transition: .05s border-color ease-in-out;
    padding: 5px 10px;
    height: 48px;
  }

  input[type=submit] {
    background: #253dac;
    /* background-image: -webkit-linear-gradient(top, #51a818, #3d8010);
    background-image: -moz-linear-gradient(top, #51a818, #3d8010);
    background-image: -ms-linear-gradient(top, #51a818, #3d8010);
    background-image: -o-linear-gradient(top, #51a818, #3d8010);
    background-image: linear-gradient(to bottom, #042ea5, #4d5aaa); */
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    font-family: Arial;
    color: #ffffff;
    padding: 10px 20px 10px 20px;
    border: solid #325ca8 2px;
    text-decoration: none;
  }

  .login-username,
  .login-password {
    display: flex;
    flex-direction: column;
  }
  .bg-image{
    height: 100%;
    text-align: center;
  }
  .divider:after,
  .divider:before {
    content: "";
    flex: 1;
    height: 2px;
    background: red;
  }
</style>
<body>

<section class="bg-image"
  style="background-image: url('https://static.blu.edu.vn/images/1/GIOI%20THIEU/Gioithieu.jpg');background-position: right;">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Đăng nhập thành viên</h2>
              
              <div class="form">
              <?php
              $args = array(
                'redirect'       => site_url($_SERVER['REQUEST_URI']),
                'form_id'        => 'dangnhap', //Để dành viết CSS
                'label_username' => __('Tên tài khoản'),
                'label_password' => __('Mật khẩu'),
                'label_remember' => __('Ghi nhớ'),
                'label_log_in'   => __('Đăng nhập'),
              );
              wp_login_form($args);
              ?>
              <p class="mb-5 pb-lg-2">Bạn nên đọc trước hướng dẫn khi sử dụng - <a href="https://drive.google.com/file/d/12sDfhP2cnXg7Gh8SbxotiwbcocSDalr7/view" target="_blank" style="color: blue;text-decoration: none;">Tài liệu HDSD</a></p>
              <div class="divider align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0 text-muted">HOẶC</p>
              </div>
              <p class="mb-5 pb-lg-2">Nếu chưa có tài khoản? <a href="<?php bloginfo('url'); ?>/dang-ky-thanh-vien" style="color: blue;text-decoration: none;">Đăng ký tại đây</a></p>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>


