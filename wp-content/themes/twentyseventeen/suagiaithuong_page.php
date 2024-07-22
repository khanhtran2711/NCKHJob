<?php
include 'my-stuff/giaithuong/config.php';
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
 * Template name: SuaGiaithuong form Page
 */
if (!is_user_logged_in()) {
    wp_redirect( wp_login_url() );
}
$ma_detai = $_GET['id'];
$sql = "SELECT `ten_gt`, lgt.ten_loaigt, nh.namhoc, `trangthai`,`minhchung`,`sluong_thamgia` FROM `GiaiThuong` gt INNER JOIN `LoaiGiaiThuong` lgt on lgt.ma_loaigt=gt.ma_loaigt INNER JOIN `NamHoc` nh on gt.ma_nh=nh.ma_nh  WHERE `ma_gt`=".$ma_detai;

$re = $conn->query($sql);

error_log('sql = ' . $sql);
$data = $re->fetch_all(MYSQLI_ASSOC);


$sql3 = "SELECT `start`,`end` FROM `deadline`";
error_log('sql = ' . $sql3);
$re3 = $conn->query($sql3);
$data3 = $re3->fetch_all(MYSQLI_ASSOC);
$start = $data3[0]['start'];
$end = $data3[0]['end'];

if(!($data[0]['trangthai']==0 && $start <= date("Y-m-d") && $end >= date("Y-m-d") || current_user_can('administrator'))){
    echo "<script>window.location.href = '".home_url()."';</script>";
}
get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

            <div class="container">
            
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="giaithuong">
                    <div class="form-body">
                        <div class="row">
                        <div class="form-floating mb-3">
                        <input class="form-control" id="ten_gt" type="text" placeholder="Tên đề tài" data-sb-validations="required" value="<?=$data[0]['ten_gt']?>"/>
                        <label for="ten_gt">Tên giải thưởng</label>
                        <div class="invalid-feedback" data-sb-feedback="ten_gt:required">Tên giải thưởng is required.</div>
                    </div>
                   
                    <div class="form-floating mb-3">
                        <input class="form-control" id="minhchung" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" value="<?=$data[0]['minhchung']?>"/>
                        <label for="minhchung">Minh chứng (dán liên kết từ google drive vào đây)</label>
                        <div class="invalid-feedback" data-sb-feedback="minhchung:required">Minh chứng is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="ma_loaigt" aria-label="Cấp đề tài">
                            <?php
                                $sql = "SELECT * FROM `LoaiGiaiThuong`";

                                $re = $conn->query($sql);
                                while ($row = $re->fetch_assoc()):
                            ?>
                                <option value="<?=$row['ma_loaigt']?>" <?=$data[0]['ten_loaigt']==$row['ten_loaigt']?'selected':''?>><?=$row['ten_loaigt']?></option>
                            <?php
                                endwhile;
                            ?>
                        </select>
                        <label for="ma_loaigt">Loại giải thưởng</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="sluong_thamgia" name="sluong_thamgia" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" value="<?=$data[0]['sluong_thamgia']?>"/>
                        <label for="sluong_thamgia">Số lượng tham gia</label>
                        <div class="invalid-feedback" data-sb-feedback="sluong_thamgia:required">Số lượng tham gia is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="ma_nh" aria-label="Năm học">
                        <?php
                                $sql = "SELECT * FROM `NamHoc`";

                                $re = $conn->query($sql);
                                while ($row = $re->fetch_assoc()):
                            ?>
                                <option value="<?=$row['ma_nh']?>" <?=$data[0]['namhoc']==$row['namhoc']?'selected':''?>><?=$row['namhoc']?></option>
                            <?php
                                endwhile;
                            ?>
                        </select>
                        <label for="ma_nh">Năm học</label>
                        
                    </div>
                    <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="sua">Sửa</button>
                                <input type="hidden" id="ma_gt" class="form-control" name="time_mins" value="<?= $ma_detai ?>">
                            </div>
                        </div>
                    </div>
                    <?php
                            $url = home_url();
                            ?>
                                        <input type="hidden" id="homeurl" value="<?=$url?>">      </form>
                <div class="container mt-3">
                    
                    <div>
                            <a href="<?=home_url('/qlgtcanhan/')?>" class="text-decoration-none btn btn-info">Quản lý giải thưởng NCKH cá nhân</a>
                            <a href="<?=home_url()?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>
                    </div>
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
    const lastsegment = "giaithuong";

    $("#giaithuong").on("submit", function(event) {
        event.preventDefault();
        let ma_gt = $('#ma_gt').val();
        callUpdate(ma_gt);
    });

    // $(document).ready(function() {

    //     read();


    // });

    function callUpdate(id) {
        let urlc = localURL + "/my-stuff/" + lastsegment + "/update.php";
        $.post(urlc, {
            ten_gt: $('#ten_gt').val(),
            ma_loaigt: $('#ma_loaigt').val(),
            ma_nh: $('#ma_nh').val(),
            minhchung: $('#minhchung').val(),
            sluong_thamgia: $('#sluong_thamgia').val(),
            ma_gt: id,
            },
            function(data, status) {
                window.location.href = data;
                
            });
    }

    // function getReadUrl() {
    //     const params = new URLSearchParams(window.location.search);
    //     let urlr = "http://" + localURL + "/my-stuff/" + lastsegment + "/read.php";

    //     if (params.has('id')) {
    //         urlr += "?id=" + params.get('id');
    //     }

    //     return urlr;
    // }

    // function read() {
    //     const url = getReadUrl();
    //     $.get(url, function(data) {
    //         document.getElementById("records").innerHTML = data;
    //     });
    // }
</script>
<?php
get_footer();
