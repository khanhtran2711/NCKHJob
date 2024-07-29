<?php
include 'my-stuff/detainckh/config.php';
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
 * Template name: SuaDetaiNCKH form Page
 */
if (!is_user_logged_in()) {
    wp_redirect( wp_login_url() );
}
$ma_detai = $_GET['id'];
$sql = "SELECT cdt.`ma_cdt`, `ten_dtnckh`, `nam_batdau`, `nam_kethuc`, `sluong_thamgia`, cdt.ten_cdt, nh.namhoc, `trangthai`,`minhchung` FROM `DeTai_NCKH` de INNER join `CapDeTai` cdt on de.ma_cdt=cdt.ma_cdt INNER JOIN `NamHoc` nh on de.ma_nh=nh.ma_nh  WHERE `ma_dtnckh` = ".$ma_detai;

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
           
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="detainckh">
                <div id="mess"></div>
                    <div class="form-body">
                        <div class="row">
                        <div class="form-floating mb-3">
                        <input class="form-control" id="ten_dtnckh" type="text" placeholder="Tên đề tài" data-sb-validations="required" value="<?=$data[0]['ten_dtnckh']?>"/>
                        <label for="ten_dtnckh">Tên đề tài</label>
                        <div class="invalid-feedback" data-sb-feedback="ten_dtnckh:required">Tên đề tài is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="nam_batdau" type="Date" placeholder="Năm bắt đầu" data-sb-validations="required" value="<?=$data[0]['nam_batdau']?>" />
                        <label for="nam_batdau">Thời gian bắt đầu</label>
                        <div class="invalid-feedback" data-sb-feedback="nam_batdau:required">Thời gian bắt đầu is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="nam_kethuc" type="Date" placeholder="Năm kết thúc" data-sb-validations="required" value="<?=$data[0]['nam_kethuc']?>"/>
                        <label for="nam_kethuc">Thời gian kết thúc</label>
                        <div class="invalid-feedback" data-sb-feedback="nam_kethuc:required">Thời gian kết thúc is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="sluong_thamgia" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" value="<?=$data[0]['sluong_thamgia']?>"/>
                        <label for="sluong_thamgia">Số lượng tham gia</label>
                        <div class="invalid-feedback" data-sb-feedback="sluong_thamgia:required">Số lượng tham gia is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="minhchung" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" value="<?=$data[0]['minhchung']?>" />
                        <label for="minhchung">Minh chứng (dán liên kết từ google drive vào đây)</label>
                        <div class="invalid-feedback" data-sb-feedback="minhchung:required">Minh chứng is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="ma_cdt" aria-label="Cấp đề tài">
                            <option value="0">Chọn cấp đề tài</option>
                            <?php
                                $sql = "SELECT * FROM `CapDeTai`";

                                $re = $conn->query($sql);
                                while ($row = $re->fetch_assoc()):
                            ?>
                                <option value="<?=$row['ma_cdt']?>" <?=$data[0]['ma_cdt']==$row['ma_cdt']?'selected':''?>><?=$row['ten_cdt']?></option>
                            <?php
                                endwhile;
                            ?>
                        </select>
                        <label for="ma_cdt">Cấp đề tài</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="ma_nh" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" value="<?=$data[0]['namhoc']?>"/>
                        <label for="ma_nh">Năm học</label>
                        <div class="invalid-feedback" data-sb-feedback="ma_nh:required">Năm học is required.</div>
                        
                    </div>
                    <input type="hidden" id="ma_dt" class="form-control" name="time_mins" value="<?= $ma_detai ?>">
                    <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="workoutformbtn">Sửa</button>
                                <?php
                            $url = home_url();
                            ?>
                                        <input type="hidden" id="homeurl" value="<?=$url?>">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container mt-3">
                    
                    <div>
                    <?php
                    if( current_user_can('administrator')):
                    ?>
                      <a href="<?=home_url("/duyetdetai/")?>" class="text-decoration-none btn btn-info">Trở về trang duyệt đề tài</a>
                    <?php
                    
                        endif;
                        if( current_user_can('subscriber')):
                    ?>
                    <a href="<?=home_url("/qldetaicanhan/")?>" class="text-decoration-none btn btn-info">Trở về trang quản lý đề tài cá nhân</a>
                    <?php endif;?>
                            <a href="<?=home_url('/detaichitiet'). '?id=' . $ma_detai?>" class="text-decoration-none btn btn-info">Trở về trang sửa chi tiết</a>
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
    const lastsegment = "detainckh";

    $("#detainckh").on("submit", function(event) {
        event.preventDefault();
        let ma_dt = $('#ma_dt').val();
        callUpdate(ma_dt);
    });
    $("#ten_dtnckh").on("change", function(event) {
        if ($("#ten_dtnckh").val() != "") {
            event.preventDefault();
            $("#btnSubmit").removeAttr('Disabled');
            document.getElementById("mess").innerHTML = "";
            let tendt = $("#ten_dtnckh").val();
            callCheck(tendt);
        }
    });

    $("#nam_kethuc").on("change",function(event){
        checkDate();
        
    });
    
    $("#nam_batdau").on("change",function(event){
        checkDate();
    });

    function checkDate(){
        if($("#nam_kethuc").val()!= ""){
            event.preventDefault();
            let startDate = $("#nam_batdau").val();
            let endDate = $("#nam_kethuc").val();
            // console.log(callCheckDiffDate(startDate,endDate));
            if(callCheckDiffDate(startDate,endDate)){
                
                document.getElementById("mess").innerHTML = "";
                $("#btnSubmit").prop('disabled',false);
                callCheckDate(endDate);
                
                
            }else{
                const data = "Ngày bắt đầu phải nhỏ hơn ngày kết thúc";
                const alertmess = '<div class="auto-close alert alert-danger" role="alert"> Cảnh báo: ' + data + '</div>';
                document.getElementById("mess").innerHTML = alertmess;
                $("#btnSubmit").prop('disabled', true);

            }
                
        }
        
    }
    $("#sluong_thamgia").on("change",function(event){
        let namhoc = $("#ma_nh").val();
        // console.log(namhoc);
        $("#ma_cdt").prop("disabled",false);
        readLoaiCDT(namhoc);
        
    });

    $(document).ready(function() {

        $("#ma_nh").prop("readonly",true);
        $('#ma_cdt').prop("disabled",true);

    });

    function callUpdate(id) {
        let urlc =localURL + "/my-stuff/" + lastsegment + "/update.php";
        $.post(urlc, {
            ten_dtnckh: $('#ten_dtnckh').val(),
            nam_batdau: $('#nam_batdau').val(),
            nam_kethuc: $('#nam_kethuc').val(),
            sluong_thamgia: $('#sluong_thamgia').val(),
            ma_cdt: $('#ma_cdt').val(),
            ma_nh: $('#ma_nh').val(),
            minhchung: $('#minhchung').val(),
            ma_dt: id,
            },
            function(data, status) {
                window.location.href = data;
                
            });
    }
    function readLoaiCDT(namhoc){
              const url = getReadUrlCDT(namhoc);
                $.get(url, function(data) {
                    document.getElementById("ma_cdt").innerHTML = data;
                    
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
        function getReadUrlCDT(namhoc){
            // console.log(namhoc);
            let urlr =  localURL + "/my-stuff/listofloaicdt.php?&nh="+namhoc;
            // console.log(urlr);
            return urlr;
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
    function callCheckDiffDate(start, end){
        return new Date(start) < new Date(end);
    }
    function callCheckDate(date) {
        const url =  localURL + "/my-stuff/" + lastsegment + "/read-admin.php/?ngayketthuc=" + date;
        $.get(url, function(data) {
            if (data != "nothing") {

                // console.log(data); 
                // const alertmess = '<div class="auto-close alert alert-danger" role="alert"> Cảnh báo: ' + data + '</div>';
                $("#ma_nh").val(data);
                let namhoc = $("#ma_nh").val();
                console.log(namhoc);
                $("#ma_cdt").prop("disabled",false);
                readLoaiCDT(namhoc);
                // $("#btnSubmit").attr('disabled', 'disabled');
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
