<?php
include 'my-stuff/congtrinh/config.php';
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
 * Template name: Congtrinh form Page
 */
$user = get_current_user_id();
$cbid = "SELECT `ma_cb` FROM `Canbo` WHERE `user_id` = $user";
error_log('sql = ' . $cbid);
$re3 = $conn->query($cbid);
if($re3->num_rows>0){
    $data3 = $re3->fetch_all(MYSQLI_ASSOC);
    $macb = $data3[0]['ma_cb'];
}else{
    echo "<script>window.location.href = '".home_url('/cbprofile/')."';</script>";
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
           if($start <= date("Y-m-d") && $end >= date("Y-m-d")):
            ?>
            <div class="container">
            <div class="mb-3">Nếu quý thầy/cô đã có thông tin công trình tham gia, vui lòng nhấp vào đây <a href="<?=home_url('/qlyvitrictr/')?>" class="text-decoration-none btn btn-info">Điền vị trí cá nhân tham gia</a></div>
            <div id="mess" class="p-3"></div>
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="ctr">
                    <div class="form-body">
                        <div class="row">
                        <div class="form-floating mb-3">
                        <input class="form-control" id="ten_ctr" type="text" placeholder="Tên đề tài" data-sb-validations="required" />
                        <label for="ten_ctr">Tên công trình</label>
                        <div class="invalid-feedback" data-sb-feedback="ten_ctr:required">Tên công trình is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="thoigian_hoanthanh" type="Date" placeholder="Năm bắt đầu" data-sb-validations="required" />
                        <label for="thoigian_hoanthanh">Thời gian hoàn thành</label>
                        <div class="invalid-feedback" data-sb-feedback="thoigian_hoanthanh:required">Thời gian hoàn thành is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="ten_tc_ky_nxb" type="text" placeholder="Năm bắt đầu" data-sb-validations="required" />
                        <label for="ten_tc_ky_nxb">Tên tạp chí/kỷ yếu/ NXB</label>
                        <div class="invalid-feedback" data-sb-feedback="ten_tc_ky_nxb:required">Tên tạp chí/kỷ yếu/ NXB is required.</div>
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
                        <select class="form-select" id="ma_loaict" aria-label="LoaiCongTrinhKhac">
                            <option value="0">Chọn loại công trình</option>
                            <?php
                                $sql = "SELECT * FROM `LoaiCongTrinh_Khac`";

                                $re = $conn->query($sql);
                                while ($row = $re->fetch_assoc()):
                            ?>
                                <option value="<?=$row['ma_loai']?>"><?=$row['ten_loai']?></option>
                            <?php
                                endwhile;
                            ?>
                        </select>
                        <label for="ma_cdt">Loại Công Trình</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="ma_loaisltc" aria-label="ma_loaisltc">
                        <option value="0">Chọn loại đơn vị/mức điểm/giờ chuẩn</option>
                            
                        </select>
                        <label for="ma_loaisltc">Loại đơn vị tính/ mức điểm/giờ chuẩn</label>
                    </div>
                    <div class="form-floating mb-3">
                                <input class="form-control" id="sotinchi" type="text" placeholder="Số tín chỉ" data-sb-validations="required" value="1"/>
                                <label for="sotinchi">Số tín chỉ</label>
                                <div class="invalid-feedback" data-sb-feedback="sotinchi:required">Số tín chỉ is required.</div>
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
                    <h2>Thông tin công trình</h2>
                    <p>
                        <?php
                        if($end<date("Y-m-d") ):
                            echo "<p style='color:red'>Thời gian nhập thông tin đã hết hạn</p>";
                        endif;
                        ?>
                    </p>
                    
                    <div>
                            <a href="<?=home_url('/qlctrcanhan/')?>" class="text-decoration-none btn btn-info">Quản lý công trình NCKH cá nhân</a>
                            <a href="<?=home_url()?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>
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

    $("#ctr").on("submit", function(event) {
        event.preventDefault();
        callCreate();
    });
    $('#ma_loaict').on('change', function() {
            readLoaiSL( this.value );
            
    });
    $('#ma_loaisltc').on('change', function() {
        const ct = $('#ma_loaisltc option:selected').text();
            console.log(ct);
    });
    $(document).ready(function() {
        if($('#ma_loaict').val()>0){
            readLoaiSL( $('#ma_loaict').val());
            $("#sotinchi").prop("readonly",false);
        }
    });

        function readLoaiSL(param){
              const url = getReadUrlSL(param);
                $.get(url, function(data) {
                    document.getElementById("ma_loaisltc").innerHTML = data;
                    const ct = $('#ma_loaisltc option:selected').text();
                    let a = "Tín chỉ";
                    if(ct.toLowerCase()=== a.toLowerCase()){
                        $("#sotinchi").prop("readonly",false);
                    }else{
                        $("#sotinchi").prop("readonly",true);
                    }
                    //  console.log(ct);
                });   
        }
        function getReadUrlSL(param){
            let urlr = "http://" + localURL + "/my-stuff/listofloaisltc.php?id=" + param;
            // console.log(urlr);
            return urlr;
        }
    $("#ten_ctr").on("change",function(event){
        if($("#ten_ctr").val()!=""){
            event.preventDefault();
            $("#btnSubmit").removeAttr('Disabled');
            document.getElementById("mess").innerHTML = "";
            let tendt = $("#ten_ctr").val();
            callCheck(tendt);
        }
    });
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

    // $(document).ready(function() {

    //     read();


    // });

    function callCreate() {
        let urlc = "http://" + localURL + "/my-stuff/" + lastsegment + "/create.php";
        $.post(urlc, {
            ten_ctr: $('#ten_ctr').val(),
            thoigian_hoanthanh: $('#thoigian_hoanthanh').val(),
            ten_tc_ky_nxb: $('#ten_tc_ky_nxb').val(),
            sluong_thamgia: $('#sluong_thamgia').val(),
            ma_loaisltc: $('#ma_loaisltc').val(),
            ma_nh: $('#ma_nh').val(),
            minhchung: $('#minhchung').val(),
            sotinchi: $('#sotinchi').val(),
            user_id:$("#user_id").val()
            },
            function(data, status) {
                window.location.href = data;
                // const alertmess = '<div class="auto-close alert alert-success" role="alert"> Mã công trình là: '+data+'</div>';
                // document.getElementById("mess").innerHTML =alertmess;
                
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
