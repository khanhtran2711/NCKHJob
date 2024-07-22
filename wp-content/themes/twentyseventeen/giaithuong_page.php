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
 * Template name: Giaithuong form Page
 */
if (!is_user_logged_in()) {
    wp_redirect( wp_login_url() );
}
$flagerror = false;
$user = get_current_user_id();
$cbid = "SELECT cbcd.`ma_cb`,`ma_cd` FROM `CanBo_ChucDanh` cbcd INNER JOIN `Canbo` cb ON cbcd.ma_cb=cb.ma_cb and cb.user_id = $user";
error_log('sql = ' . $cbid);
$re3 = $conn->query($cbid);
if ($re3->num_rows > 0) {
    $data3 = $re3->fetch_all(MYSQLI_ASSOC);
    $macb = $data3[0]['ma_cb'];
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
    <div class="modal" id="modalmess">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Thông báo!</h4>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Vì bạn là thành viên mới! 
                            <ul id="messlist">
                            </ul>
                            
                        </div>


                    </div>
                </div>
            </div>
            <?php
            
$cbid1 = "SELECT * FROM `CanBo_ChucDanh` cbcd INNER JOIN `Canbo` cb ON cbcd.ma_cb=cb.ma_cb and trangthaiduyet=1 and cb.user_id =  $user";
error_log('sql = ' . $cbid1);
$re31 = $conn->query($cbid1);
$messcd = '';
if ($re31->num_rows==0){
    $messcd = '<li>Hãy truy cập <a href='.home_url("/doichucdanh/").'> tại đây </a> để cập nhật chức danh hiện tại của bạn và đến khi được duyệt!</li>';
}
$cbid2 = "SELECT `ma_cb`,`trangthaidoikhoa` FROM `Canbo` cb WHERE cb.user_id = $user";
error_log('sql = ' . $cbid2);
$re32 = $conn->query($cbid2);
$messkhoa = '';
$data32 = $re32->fetch_all(MYSQLI_ASSOC);
if ($data32[0]['trangthaidoikhoa']==0){
    $messkhoa = '<li>Hãy truy cập <a href='.home_url("/doikhoa/").'> tại đây </a> để thay đổi khoa mặc định hiện tại của bạn!</li>';
}
if(strlen($messcd)>0 || strlen($messkhoa)>0){
    $flagerror=true;
    echo '<script>
    document.getElementById("messlist").innerHTML += "'.$messcd.'";
    document.getElementById("messlist").innerHTML += "'.$messkhoa.'";
                                    var myModal = new bootstrap.Modal(document.getElementById("modalmess"));
                                myModal.show();
                        </script>';
    // echo "<script>window.location.href = '" . home_url('/doichucdanh/') . "';</script>";
}
?>
        <main id="main" class="site-main">

            <?php

            if ($start <= date("Y-m-d") && $end >= date("Y-m-d") && !$flagerror) :
            ?>
                <div class="container">
                <div class="chuthich"></div>
                    <div class="mb-3">Nếu quý thầy/cô đã có thông tin giải thưởng tham gia, vui lòng nhấp vào đây <a href="<?= home_url('/qlytgiagt/') ?>" class="text-decoration-none btn btn-info">Thêm giảng viên hướng dẫn vào giải thưởng</a></div>
                    <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="giaithuong">
                        <div class="form-body">
                            <div class="row">
                            <div class=" chuthich"></div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="ten_gt" type="text" placeholder="Tên đề tài" data-sb-validations="required" />
                                    <label for="ten_gt">Tên giải thưởng</label>
                                    <div class="invalid-feedback" data-sb-feedback="ten_gt:required">Tên giải thưởng is required.</div>
                                </div>
                                <div class="chuthich"></div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="thoigian_nhan" type="Date" placeholder="Năm bắt đầu" data-sb-validations="required" />
                                        <label for="thoigian_nhan">Thời gian nhận</label>
                                        <div class="invalid-feedback" data-sb-feedback="thoigian_nhan:required">Thời gian nhận is required.</div>
                                    </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="sluong_thamgia" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" />
                                    <label for="sluong_thamgia">Số lượng tham gia</label>
                                    <div class="invalid-feedback" data-sb-feedback="sluong_thamgia:required">Số lượng tham gia is required.</div>
                                </div>
                                <div class=" chuthich"></div>
                                <p class="pb-lg-2 chuthich">Bạn nên đọc trước hướng dẫn khi chia sẻ minh chứng - <a href="https://drive.google.com/file/d/1JkSccTzhZimqYdFSu7SAbqyVlI7ScBmu/view" target="_blank" style="color: blue;text-decoration: none;">Tài liệu HDSD</a></p>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="minhchung" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" />
                                    <label for="minhchung">Minh chứng (dán liên kết từ google drive vào đây)</label>
                                    <div class="invalid-feedback" data-sb-feedback="minhchung:required">Minh chứng is required.</div>
                                </div>
                                <div class=" chuthich"></div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="ma_loaigt" aria-label="Cấp đề tài">
                                        <option value="0">Chọn loại giải thưởng</option>
                                    </select>
                                    <label for="ma_loaigt">Loại giải thưởng</label>
                                </div>
                                <div class="chuthich"></div>
                            <div class="form-floating mb-3">
                                    <input class="form-control" id="ma_nh" type="text" placeholder="Namhoc" data-sb-validations="required" />
                                    <label for="ma_nh">Năm học</label>
                                    <div class="invalid-feedback" data-sb-feedback="ma_nh:required">Năm học is required.</div>

                            </div>
                                <div class="chuthich"></div>
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
                        <?php
                            $url = home_url();
                            ?>
                                        <input type="hidden" id="homeurl" value="<?=$url?>">
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
    let localURL = $("#homeurl").val();
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
    $("#thoigian_nhan").on("change",function(event){
        checkDate();
        
           
       
        

    });
    $("#sluong_thamgia").on("change",function(event){
        let namhoc = $("#ma_nh").val();
        console.log(namhoc)
        $("#ma_loaigt").prop("disabled",false);
        readLoaiGT(namhoc);
    });

    function readLoaiGT(namhoc){
              const url = getReadUrlGT(namhoc);
                $.get(url, function(data) {
                    document.getElementById("ma_loaigt").innerHTML = data;
                    
                    // const ct = $('#ma_loaisltc option:selected').text();
                    // let a = "Tín chỉ";
                    // if(ct.toLowerCase()=== a.toLowerCase()){
                    //     $("#sotinchi").prop("readonly",false);
                    // }else{
                    //     $("#sotinchi").prop("readonly",true);
                    // }
                    //  console.log(ct);
                });   
        }
        function getReadUrlGT(namhoc){
            
            let urlr =  localURL + "/my-stuff/listofloaigt.php?&nh="+namhoc;
            // console.log(urlr);
            return urlr;
        }

    function checkDate(){
        if($("#thoigian_nhan").val()!= ""){
            
            let endDate = $("#thoigian_nhan").val();
            callCheckDate(endDate);
                
        }
    }

    function callCheckDate(date) {
        event.preventDefault();
        const url =  localURL + "/my-stuff/detainckh/read-admin.php/?ngayketthuc=" + date;
        $.get(url, function(data) {
            if (data != "nothing") {

                // console.log(data);
                // const alertmess = '<div class="auto-close alert alert-danger" role="alert"> Cảnh báo: ' + data + '</div>';
                $("#ma_nh").val(data);
                // $("#btnSubmit").attr('disabled', 'disabled');
            }
        });
    }
    function callCheck(ten) {
        const url =  localURL + "/my-stuff/" + lastsegment + "/read-admin.php/?ten=" + ten;
        $.get(url, function(data) {
            if (data != "nothing") {
                const alertmess = '<div class="auto-close alert alert-danger" role="alert"> Cảnh báo: ' + data + '</div>';
                document.getElementById("mess").innerHTML = alertmess
                $("#btnSubmit").attr('disabled', 'disabled');
            }
        });
    }

    $(document).ready(function() {

        $("#ma_nh").prop("readonly",true);
        $("#ma_loaigt").prop("disabled",true);

    });

    function callCreate() {
        let urlc =  localURL + "/my-stuff/" + lastsegment + "/create.php";
        $.post(urlc, {
                ten_gt: $('#ten_gt').val(),
                ma_loaigt: $('#ma_loaigt').val(),
                ma_nh: $('#ma_nh').val(),
                minhchung: $('#minhchung').val(),
                sluong_thamgia: $('#sluong_thamgia').val(),
                user_id: $("#user_id").val(),
                thoigian_nhan: $('#thoigian_nhan').val(),
            ten_loaivt: $('#ten_loaivt').val()
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
