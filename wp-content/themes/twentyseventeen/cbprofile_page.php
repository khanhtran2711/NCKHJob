<?php
include 'my-stuff/cbprofile/config.php';
include './mydbfile.php';
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
 * Template name: thongtinchuyenmon management Page
 */
$user = get_current_user_id();
$sql = "SELECT * FROM `CanBo_ChucDanh` as cbcd INNER JOIN `Canbo` as cb ON cb.ma_cb = cbcd.ma_cb WHERE cb.user_id = $user";
error_log('sql = ' . $sql);
$re = $conn->query($sql);
$data = $re->fetch_all(MYSQLI_ASSOC);
$cbid = "SELECT `ma_cb` FROM `Canbo` WHERE `user_id` = $user";
error_log('sql = ' . $cbid);
$re3 = $conn->query($cbid);
$data3 = $re3->fetch_all(MYSQLI_ASSOC);
$macb = $data3[0]['ma_cb'];

//giang vien nay chua cap nhat chuc danh và khoa-pb truc thuoc cua minh
get_header();

?>
<div class="wrap">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

            <div class="container">

                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="themmoi">
                    <div class="form-body">
                        <div class="row">
                            <!-- <div class="form-floating mb-3">
                            <input class="form-control" id="ghichu" type="text" placeholder="Ghi chú" data-sb-validations="required" />
                            <label for="ghichu">Ghi chú</label>
                            <div class="invalid-feedback" data-sb-feedback="ghichu:required">Tên đề tài is required.</div>
                        </div> -->
                            <?php
                            if ($re->num_rows == 0) {

                            ?>
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="ma_cd" aria-label="Chức danh hiện tại">
                                        <?php
                                        $list_cd = "SELECT `ma_cd`, `ten_cd` FROM `ChucDanh`";
                                        error_log('sql = ' . $list_cd);
                                        $re1 = $conn->query($list_cd);
                                        while ($row = $re1->fetch_assoc()) :
                                        ?>
                                            <option value="<?= $row['ma_cd'] ?>"><?= $row['ten_cd'] ?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                    <label for="ma_cdt">Chức danh hiện tại</label>
                                </div>
                                <?php

                                ?>
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="ma_khoa" aria-label="Khoa/phòng ban hiện tại">
                                        <?php
                                        $list_khoa = "SELECT `ma_khoa`, `ten_khoa` FROM `Khoa_PB`";
                                        error_log('sql = ' . $list_khoa);
                                        $re2 = $conn->query($list_khoa);
                                        while ($row = $re2->fetch_assoc()) :
                                        ?>
                                            <option value="<?= $row['ma_khoa'] ?>"><?= $row['ten_khoa'] ?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                    <label for="ma_khoa">Khoa/phòng ban hiện tại</label>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-success  me-1 mb-1" name="cbprofilebtn">Submit</button>
                                </div>
                        </div>
                    <?php } else {

                                
                    ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 pe-2 py-2 items">
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-center align-items-center ">
                                            <a href="<?= home_url('/doichucdanh/') ?>" class="text-decoration-none">
                                                <h5 class="card-title text-center">Thay đổi chức danh</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 pe-2 py-2 items">
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-center align-items-center ">
                                            <a href="<?= home_url('/doikhoa/') ?>" class="text-decoration-none">
                                                <h5 class="card-title text-center">Sửa thông tin về khoa</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 pe-2 py-2 items">
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-center align-items-center ">
                                            <a href="<?= admin_url( 'profile.php') ?>" class="text-decoration-none">
                                                <h5 class="card-title text-center">Sửa thông tin cá nhân</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <input type="hidden" id="user_id" class="form-control" name="time_mins" value="<?= $macb ?>">

                    </div>
            </div>
    </div>
    </form>
    <form action="">

    </form>
    <div class="container mt-3">
        <h2>Thông tin hiện tại</h2>

        <table class="table table-striped" id="records">

        </table>
        <a href="<?= home_url() ?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>
    </div>

</div>
</main>
</div>
</div>
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

    $("#themmoi").on("submit", function(event) {
        event.preventDefault();
        callCreate();
    });

    $(document).ready(function() {

        read();


    });

    function callCreate() {
        let urlc = "http://" + localURL + "/my-stuff/" + lastsegment + "/create.php";
        let dataf = {};
        if ($('#elementId').length > 0) {

            dataf = {
                ma_cd: $('#ma_cd').val(),
                ma_khoa: $('#ma_khoa').val(),
                ma_cb: $("#user_id").val()
            };
        } else {
            dataf = {
                ma_cd: $('#ma_cd').val(),
                ma_cb: $("#user_id").val()
            }
        }
        $.post(urlc, dataf,
            function(data, status) {

                console.log(data);

            });
    }

    function getReadUrl() {
        const params = new URLSearchParams(window.location.search);
        let urlr = "http://" + localURL + "/my-stuff/" + lastsegment + "/read.php";

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
