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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<style>
    .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

.bg-image {
  /* The image used */
  background-image: url("https://qlvb.baclieu.gov.vn/qlvbdh/login/img/background.jpg");
  
  /* Add the blur effect */
  filter: blur(8px);
  -webkit-filter: blur(8px);
  
  /* Full height */
  height: 100%; 
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* Position text in the middle of the page/image */
.bg-text {
  /* background-color: rgb(0,0,0); Fallback color */
  background-color: rgba(0,0,0, 0.4);/*  Black w/opacity/see-through */
  color: white;
  font-weight: bold;
  border: 3px solid #f1f1f1;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: 100%;
  /* padding: 20px; */
  text-align: center;
}
input[type=email], input[type=number], input[type=password], input[type=search], input[type=tel], input[type=text], input[type=url], select, textarea {
            border: 1px solid #DDD;
			border-radius: 0.5rem;
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.07);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.07);
            background-color: #FFF;
            color: #333;
            -webkit-transition: .05s border-color ease-in-out;
            transition: .05s border-color ease-in-out;
            padding: 5px 10px;
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

		.login-username, .login-password{
			display: flex;
			flex-direction: column;
		}

</style>
<body>
    <div class="bg-image">
    </div>
<div class="bg-text">
<section class="vh-100">
      <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            
          <div class="col-md-8 col-lg-7 col-xl-6">
          <h4 class="my-5 display-6 fw-bold ls-tight">
            TRƯỜNG ĐẠI HỌC BẠC LIÊU <br />
            <span class="text-primary">HỆ QUẢN LÝ NCKH</span>
          </h4>  
          <img src="https://static.blu.edu.vn/images/1/GIOI%20THIEU/Gioithieu.jpg"
              class="img-fluid" alt="Phone image">
          </div>
          <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
			<div class="form">
					<?php
					$args = array(
						'redirect'       => site_url( $_SERVER['REQUEST_URI'] ),
						'form_id'        => 'dangnhap', //Để dành viết CSS
						'label_username' => __( 'Tên tài khoản' ),
						'label_password' => __( 'Mật khẩu' ),
						'label_remember' => __( 'Ghi nhớ' ),
						'label_log_in'   => __( 'Đăng nhập' ),
					);
					wp_login_form($args);
				?>
				<p class="mb-5 pb-lg-2">Bạn nên đọc trước hướng dẫn khi sử dụng - <a href="https://drive.google.com/file/d/12sDfhP2cnXg7Gh8SbxotiwbcocSDalr7/view" target="_blank" style="color: #fff;">Tài liệu HDSD</a></p>
				<div class="divider d-flex align-items-center my-4">
					<p class="text-center fw-bold mx-3 mb-0 text-muted">HOẶC</p>
				</div>
          <p class="mb-5 pb-lg-2" style="color: #fff;">Nếu chưa có tài khoản? <a href="<?php bloginfo('url'); ?>/dang-ky-thanh-vien" style="color: #fff;">Đăng ký tại đây</a></p>
			</div>
            
              
           
          </div>
        </div>
      </div>
    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>


