<?php
include 'my-stuff/loaigtr/config.php';
include 'mydbfile.php';
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
 * Template name: doigiamtru management Page
 */
$user = get_current_user_id();
$cbid = "SELECT `ma_cb` FROM `Canbo` WHERE `user_id` = $user";
error_log('sql = ' . $cbid);
$re3 = $conn->query($cbid);
$data3 = $re3->fetch_all(MYSQLI_ASSOC);
$macb = $data3[0]['ma_cb'];
// if(isset($_POST['doichucdanh'])){
//     $a = $_POST['ma_cd'];
//     $sql = "INSERT INTO `CanBo_ChucDanh`(`ma_cb`, `ma_cd`, `thoigiannhan`) VALUES ('$macb','$a',NOW())";
//     error_log($sql);
//     $conn->query($sql);
//     echo "<script>window.location.href = '".home_url('/cbprofile/')."';</script>";
// }
get_header();

    ?>
   <div class="wrap">
    <div id="primary" class="content-area">
       
        <main id="main" class="site-main">
            
            <div class="container">
            
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="loaigtr">
                    <div class="form-body">
                        <div class="row">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="ma_gtr" aria-label="Loại giảm trừ">
                                    <?php
                                        $sql = "SELECT * FROM `LoaiGiamTru`";

                                        $re = $conn->query($sql);
                                        while ($row = $re->fetch_assoc()):
                                    ?>
                                        <option value="<?=$row['ma_gtr']?>"><?=$row['ten_gtr']?></option>
                                    <?php
                                        endwhile;
                                    ?>
                                </select>
                                <label for="ma_cdt">Tên loại giảm trừ</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="thoigiannhan" name="thoigiannhan" type="date" placeholder="Thời gian áp dụng" data-sb-validations="required" value="<?=date('Y-m-d')?>"/>
                                <label for="thoigiannhan">Thời gian nhận</label>
                                <div class="invalid-feedback" data-sb-feedback="thờiGianApDụng:required">Thời gian nhận is required.</div>
                            </div>
                            <?php
                            $url = home_url();
                            ?>
                                        <input type="hidden" id="homeurl" value="<?=$url?>">
                                        <input type="hidden" id="user_id" class="form-control" name="time_mins" value="<?= $macb ?>">
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="workoutformbtn">Lưu</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container mt-3">
                    <h2>Lịch sử giảm trừ</h2>
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
$url = home_url();
?>
<script src="<?= $jquery ?>"></script>
<script>
    const currentUrl = window.location.hostname;
    let localURL = $("#homeurl").val();
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = array[array.length - 2];


    $("#loaigtr").on("submit", function(event) {
        
        callCreate();
    });
    $(document).ready(function() {
        let userid = $("#user_id").val();
        read(userid);
        // let urlc = localURL+"/my-stuff/"+lastsegment+"/create.php";
        // console.log(urlc);


    });

    function callCreate() {
        let urlc = localURL+"/my-stuff/"+lastsegment+"/create.php";
        $.post(urlc, {
            ma_gtr: $('#ma_gtr').val(),
                uid: $('#user_id').val(),
                thoigiannhan:$('#thoigiannhan').val()
            },
            function(data, status) {
                console.log(data);
            });
    }

    function getReadUrl(uid) {
        const params = new URLSearchParams(window.location.search);
        let urlr = localURL+"/my-stuff/"+lastsegment+"/read-cb.php?uid="+ uid;
        

        return urlr;
    }

    function read(uid) {
        const url = getReadUrl(uid);
        $.get(url, function(data) {
            document.getElementById("records").innerHTML = data;
        });
    }
</script>

<?php
get_footer();
