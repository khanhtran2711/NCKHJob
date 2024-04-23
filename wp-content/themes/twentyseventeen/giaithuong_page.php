<?php
include 'my-stuff/giaithuong/config.php';
include 'mydbfile.php';
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
 * Template name: Giaithuong form Page
 */
$user = get_current_user_id();
$cbid = "SELECT `ma_cb` FROM `Canbo` WHERE `user_id` = $user";
error_log('sql = ' . $cbid);
$re3 = $conn->query($cbid);
if ($re3->num_rows > 0) {
    $data3 = $re3->fetch_all(MYSQLI_ASSOC);
    $macb = $data3[0]['ma_cb'];
} else {
    echo "<script>window.location.href = '" . home_url('/cbprofile/') . "';</script>";
}
$sql3 = "SELECT `start`,`end` FROM `deadline`";
error_log('sql = ' . $sql3);
$re3 = $conn->query($sql3);
$data3 = $re3->fetch_all(MYSQLI_ASSOC);
$start = $data3[0]['start'];
$end = $data3[0]['end'];
get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

            <?php

            if ($start <= date("Y-m-d") && $end >= date("Y-m-d")) :
            ?>
                <div class="container">
                    <div class="mb-3">Nếu quý thầy/cô đã có thông tin giải thưởng tham gia, vui lòng nhấp vào đây <a href="<?= home_url('/qlytgiagt/') ?>" class="text-decoration-none btn btn-info">Thêm giảng viên hướng dẫn vào giải thưởng</a></div>
                    <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="giaithuong">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="ten_gt" type="text" placeholder="Tên đề tài" data-sb-validations="required" />
                                    <label for="ten_gt">Tên giải thưởng</label>
                                    <div class="invalid-feedback" data-sb-feedback="ten_gt:required">Tên giải thưởng is required.</div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input class="form-control" id="minhchung" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" />
                                    <label for="minhchung">Minh chứng (dán liên kết từ google drive vào đây)</label>
                                    <div class="invalid-feedback" data-sb-feedback="minhchung:required">Minh chứng is required.</div>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="ma_loaigt" aria-label="Cấp đề tài">
                                        <?php
                                        $sql = "SELECT * FROM `LoaiGiaiThuong`";

                                        $re = $conn->query($sql);
                                        while ($row = $re->fetch_assoc()) :
                                        ?>
                                            <option value="<?= $row['ma_loaigt'] ?>"><?= $row['ten_loaigt'] ?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                    <label for="ma_loaigt">Loại giải thưởng</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <select class="form-select" id="ma_nh" aria-label="Năm học">
                                        <?php
                                        $sql = "SELECT * FROM `NamHoc`";

                                        $re = $conn->query($sql);
                                        while ($row = $re->fetch_assoc()) :
                                        ?>
                                            <option value="<?= $row['ma_nh'] ?>"><?= $row['namhoc'] ?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                    <label for="ma_nh">Năm học</label>

                                </div>
                                <input type="hidden" id="user_id" class="form-control" name="time_mins" value="<?= $macb ?>">
                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-success  me-1 mb-1" name="workoutformbtn" id="btnSubmit">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div> <!--container-->
            <?php
            endif;
            ?>
            <div class="container mt-3">
                <h2>Thông tin giải thưởng</h2>
                <p>
                    <?php
                    if ($end < date("Y-m-d")) :
                        echo "<p style='color:red'>Thời gian nhập thông tin đã hết hạn</p>";
                    endif;
                    ?>
                </p>
                <div id="mess"></div>
                <div>
                    <a href="<?= home_url('/qlgtcanhan/') ?>" class="text-decoration-none btn btn-info">Quản lý giải thưởng NCKH cá nhân</a>
                    <a href="<?= home_url() ?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>
                </div>
            </div>

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
    let localURL = currentUrl + '/' + folder;
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = array[array.length - 2];

    $("#giaithuong").on("submit", function(event) {
        event.preventDefault();
        callCreate();
    });

    $("#ten_gt").on("change", function(event) {
        if ($("#ten_gt").val() != "") {
            event.preventDefault();
            $("#btnSubmit").removeAttr('Disabled');
            document.getElementById("mess").innerHTML = "";
            let tendt = $("#ten_gt").val();
            callCheck(tendt);
        }
    });

    function callCheck(ten) {
        const url = "http://" + localURL + "/my-stuff/" + lastsegment + "/read-admin.php/?ten=" + ten;
        $.get(url, function(data) {
            if (data != "nothing") {
                const alertmess = '<div class="auto-close alert alert-danger" role="alert"> Cảnh báo: ' + data + '</div>';
                document.getElementById("mess").innerHTML = alertmess
                $("#btnSubmit").attr('disabled', 'disabled');
            }
        });
    }

    // $(document).ready(function() {

    //     read();


    // });

    function callCreate() {
        let urlc = "http://" + localURL + "/my-stuff/" + lastsegment + "/create.php";
        $.post(urlc, {
                ten_gt: $('#ten_gt').val(),
                ma_loaigt: $('#ma_loaigt').val(),
                ma_nh: $('#ma_nh').val(),
                minhchung: $('#minhchung').val(),
                user_id: $("#user_id").val()
            },
            function(data, status) {

                // const alertmess = '<div class="auto-close alert alert-success" role="alert"> Mã giải thưởng là: ' + data + '</div>';
                // document.getElementById("mess").innerHTML = alertmess;
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
