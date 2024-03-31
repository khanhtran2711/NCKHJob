<?php
include 'my-stuff/detainckh/config.php';
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
 * Template name: DetaiNCKH form Page
 */
$user = get_current_user_id();
$cbid = "SELECT `ma_cb`,`ma_khoa` FROM `Canbo` WHERE `user_id` = $user";
error_log('sql = ' . $cbid);
$re3 = $conn->query($cbid);
if($re3->num_rows>0){
    $data3 = $re3->fetch_all(MYSQLI_ASSOC);
    $macb = $data3[0]['ma_cb'];
}else{
    echo "<script>window.location.href = '".home_url('/cbprofile/')."';</script>";
}
get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

            <div class="container">
            <div class="mb-3">Nếu quý thầy/cô đã có thông tin đề tài tham gia, vui lòng nhấp vào đây <a href="<?=home_url('/qlyvitrinckh/')?>" class="text-decoration-none btn btn-info">Điền vị trí cá nhân tham gia</a></div>
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="detainckh">
                    <div class="form-body">
                        <div class="row">
                        <div class="form-floating mb-3">
                        <input class="form-control" id="ten_dtnckh" type="text" placeholder="Tên đề tài" data-sb-validations="required" />
                        <label for="ten_dtnckh">Tên đề tài</label>
                        <div class="invalid-feedback" data-sb-feedback="ten_dtnckh:required">Tên đề tài is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="nam_batdau" type="Date" placeholder="Năm bắt đầu" data-sb-validations="required" />
                        <label for="nam_batdau">Năm bắt đầu</label>
                        <div class="invalid-feedback" data-sb-feedback="nam_batdau:required">Năm bắt đầu is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="nam_kethuc" type="Date" placeholder="Năm kết thúc" data-sb-validations="required" />
                        <label for="nam_kethuc">Năm kết thúc</label>
                        <div class="invalid-feedback" data-sb-feedback="nam_kethuc:required">Năm kết thúc is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="sluong_thamgia" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" />
                        <label for="sluong_thamgia">Số lượng tham gia</label>
                        <div class="invalid-feedback" data-sb-feedback="sluong_thamgia:required">Số lượng tham gia is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="minhchung" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" />
                        <label for="minhchung">Minh chứng (dán liên kết từ google drive vào đây)</label>
                        <div class="invalid-feedback" data-sb-feedback="minhchung:required">Minh chứng is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="ma_cdt" aria-label="Cấp đề tài">
                            <?php
                                $sql = "SELECT * FROM `CapDeTai`";

                                $re = $conn->query($sql);
                                while ($row = $re->fetch_assoc()):
                            ?>
                                <option value="<?=$row['ma_cdt']?>"><?=$row['ten_cdt']?></option>
                            <?php
                                endwhile;
                            ?>
                        </select>
                        <label for="ma_cdt">Cấp đề tài</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="ma_nh" aria-label="Năm học">
                        <?php
                                $sql = "SELECT * FROM `NamHoc`";

                                $re = $conn->query($sql);
                                while ($row = $re->fetch_assoc()):
                            ?>
                                <option value="<?=$row['ma_nh']?>"><?=$row['namhoc']?></option>
                            <?php
                                endwhile;
                            ?>
                        </select>
                        <label for="ma_nh">Năm học</label>
                        
                    </div>
                    <div class="form-floating mb-3">
                                <select class="form-select" id="ten_loaivt" name="ten_loaivt" aria-label="Vị trí tham gia">
                                    <?php
                                    $list_vt = ['TV Chính', 'TV Tham Gia'];
                                    foreach ($list_vt as $vt) :
                                    ?>
                                        <option value="<?= $vt ?>"><?= $vt ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <label for="ten_loaivt">Vị trí tham gia trong đề tài</label>
                            </div>
                    <input type="hidden" id="user_id" class="form-control" name="time_mins" value="<?= $macb ?>">
                    <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="workoutformbtn" id="btnSubmit">Lưu</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container mt-3">
                    <h2>Thông tin về mã đề tài sau khi nhập thành công</h2>
                    <p><?= get_the_content() ?></p>
                    <div id="mess"></div>
                    <div>
                            <a href="<?=home_url('/qldetaicanhan/')?>" class="text-decoration-none btn btn-info">Quản lý đề tài NCKH cá nhân</a>
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
    const folder = "NCKH";
    let localURL = currentUrl + '/' + folder;
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = array[array.length - 2];

    $("#detainckh").on("submit", function(event) {
        event.preventDefault();
        callCreate();
    });

    $("#sluong_thamgia").on("click",function(event){
        event.preventDefault();
        $("#btnSubmit").removeAttr('Disabled');
        document.getElementById("mess").innerHTML = "";
        let tendt = $("#ten_dtnckh").val();
        callCheck(tendt);
    });

    // $(document).ready(function() {

    //     read();


    // });
    
    function callCreate() {
        let urlc = "http://" + localURL + "/my-stuff/" + lastsegment + "/create.php";
        $.post(urlc, {
            ten_dtnckh: $('#ten_dtnckh').val(),
            nam_batdau: $('#nam_batdau').val(),
            nam_kethuc: $('#nam_kethuc').val(),
            sluong_thamgia: $('#sluong_thamgia').val(),
            ma_cdt: $('#ma_cdt').val(),
            ma_nh: $('#ma_nh').val(),
            minhchung: $('#minhchung').val(),
            ten_loaivt: $('#ten_loaivt').val(),
            user_id:$("#user_id").val()
            },
            function(data, status) {
                // console.log(data);
                window.location.href = data;

            });
    }

    function callCheck(ten) {
        const url = "http://" + localURL + "/my-stuff/" + lastsegment + "/read-admin.php/?ten="+ten;
        $.get(url, function(data) {
            if(data!="nothing"){
                const alertmess = '<div class="auto-close alert alert-danger" role="alert"> Cảnh báo: '+data+'</div>';
                document.getElementById("mess").innerHTML =alertmess
                $("#btnSubmit").attr('disabled', 'disabled');
            }
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
