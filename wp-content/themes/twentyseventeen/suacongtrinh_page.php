<?php
include 'my-stuff/congtrinh/config.php';
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
 * Template name: SuaCongtrinh form Page
 */
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
}
$ma_detai = $_GET['id'];
$sql = "SELECT `ten_ctr`,`thoigian_hoanthanh`,`ten_tc_ky_nxb`,`sluong_thamgia`,`trangthai`,`minhchung`, loaisl.ma_loaisl, lctr.ma_loai, nh.namhoc FROM `CongTrinh_Khac` ct INNER JOIN `LoaiSL_TC` loaisl on loaisl.ma_loaisl = ct.ma_loaisltc INNER JOIN `LoaiCongTrinh_Khac` lctr on lctr.ma_loai = loaisl.ma_loaict INNER JOIN `NamHoc` nh ON ct.ma_nh = nh.ma_nh WHERE ct.ma_ctr =" . $ma_detai;

$re = $conn->query($sql);

error_log('sql = ' . $sql);
$data = $re->fetch_all(MYSQLI_ASSOC);
$url = "/congtrinhchitiet/?id=" . $ma_detai;
$sql3 = "SELECT `start`,`end` FROM `deadline`";
error_log('sql = ' . $sql3);
$re3 = $conn->query($sql3);
$data3 = $re3->fetch_all(MYSQLI_ASSOC);
$start = $data3[0]['start'];
$end = $data3[0]['end'];

if (!($data[0]['trangthai'] == 0 && $start <= date("Y-m-d") && $end >= date("Y-m-d") || current_user_can('administrator'))) {
    echo "<script>window.location.href = '" . home_url() . "';</script>";
}
if (isset($_POST['sua'])) {
    $a = $_POST['ten_ctr'];
    $b = $_POST['thoigian_hoanthanh'];
    $c = $_POST['ten_tc_ky_nxb'];
    $d = $_POST['sluong_thamgia'];
    $e = $_POST['ma_loaisltc'];
    $f = $_POST['ma_nh'];
    $g = $_POST['minhchung'];

    $sql3 =  "UPDATE `CongTrinh_Khac` set ten_ctr='" . $a . "', thoigian_hoanthanh='" . $b . "',
    ten_tc_ky_nxb='" . $c . "' , sluong_thamgia=" . $d . ",
    ma_loaisltc='" . $e . "', ma_nh='" . $f . "', minhchung='" . $g . "' where ma_ctr=" . $ma_detai;
    error_log('sql = ' . $sql3);
    $result = $conn->query($sql3);
    // $conn->close();

    echo "<script>window.location.href = '" . home_url($url) . "';</script>";
}

get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

            <div class="container">

                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="ctr">
                    <div class="form-body">
                        <div class="row">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ten_ctr" name="ten_ctr" type="text" placeholder="Tên đề tài" data-sb-validations="required" value="<?= $data[0]['ten_ctr'] ?>" />
                                <label for="ten_ctr">Tên công trình</label>
                                <div class="invalid-feedback" data-sb-feedback="ten_ctr:required">Tên công trình is required.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="thoigian_hoanthanh" name="thoigian_hoanthanh" type="Date" placeholder="Năm bắt đầu" data-sb-validations="required" value="<?= $data[0]['thoigian_hoanthanh'] ?>" />
                                <label for="thoigian_hoanthanh">Thời gian hoàn thành</label>
                                <div class="invalid-feedback" data-sb-feedback="thoigian_hoanthanh:required">Thời gian hoàn thành is required.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ten_tc_ky_nxb" name="ten_tc_ky_nxb" type="text" placeholder="Năm bắt đầu" data-sb-validations="required" value="<?= $data[0]['ten_tc_ky_nxb'] ?>" />
                                <label for="ten_tc_ky_nxb">Tên tạp chí/kỷ yếu/ NXB</label>
                                <div class="invalid-feedback" data-sb-feedback="ten_tc_ky_nxb:required">Tên tạp chí/kỷ yếu/ NXB is required.</div>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="sluong_thamgia" name="sluong_thamgia" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" value="<?= $data[0]['sluong_thamgia'] ?>" />
                                <label for="sluong_thamgia">Số lượng tham gia</label>
                                <div class="invalid-feedback" data-sb-feedback="sluong_thamgia:required">Số lượng tham gia is required.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="minhchung" name="minhchung" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" value="<?= $data[0]['minhchung'] ?>" />
                                <label for="minhchung">Minh chứng (dán liên kết từ google drive vào đây)</label>
                                <div class="invalid-feedback" data-sb-feedback="minhchung:required">Minh chứng is required.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="ma_loaict" name="ma_loaict" aria-label="LoaiCongTrinhKhac">
                                    <?php
                                    $sql = "SELECT * FROM `LoaiCongTrinh_Khac`";

                                    $re = $conn->query($sql);
                                    while ($row = $re->fetch_assoc()) :
                                    ?>
                                        <option value="<?= $row['ma_loai'] ?>" <?= $data[0]['ma_loai'] == $row['ma_loai'] ? 'selected' : '' ?>><?= $row['ten_loai'] ?></option>
                                    <?php
                                    endwhile;
                                    ?>
                                </select>
                                <label for="ma_cdt">Loại Công Trình</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="ma_loaisltc" name="ma_loaisltc" aria-label="ma_loaisltc">
                                    <?php
                                    $dd = $data[0]['ma_loai'];
                                    $sql12 = "SELECT * FROM `LoaiSL_TC` WHERE `ma_loaict` = $dd and (YEAR(`thoigian_apdung`) = YEAR(NOW()) or thoigian_apdung >= DATE(str_to_date( concat( year( curdate( ) )-1 , '-', 9 , '-', 1 ) , '%Y-%m-%d' )));";

                                    $re12 = $conn->query($sql12);
                                    while ($row = $re12->fetch_assoc()) :

                                    ?>
                                        <option value="<?= $row['ma_loaisl'] ?>" <?= $data[0]['ma_loaisl'] == $row['ma_loaisl'] ? 'selected' : '' ?>><?= $row['ten_loaisl'] ?></option>
                                    <?php
                                    endwhile;
                                    ?>
                                </select>
                                <label for="ma_loaisltc">Loại tên đơn vị tính/ mức điểm/giờ chuẩn</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="sotinchi" type="text" placeholder="Số tín chỉ" data-sb-validations="required" value="1" />
                                <label for="sotinchi">Số tín chỉ</label>
                                <div class="invalid-feedback" data-sb-feedback="sotinchi:required">Số tín chỉ is required.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ma_nh" type="text" placeholder="Năm học" data-sb-validations="required" required value="<?= $data[0]['namhoc'] ?>" />
                                <label for="ma_nh">Năm học</label>
                                <div class="invalid-feedback" data-sb-feedback="ma_nh:required">Năm học is required.</div>


                            </div>

                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="sua">Sửa</button>
                            </div>
                        </div>
                    </div>
                    <?php
                    $url = home_url();
                    ?>
                    <input type="hidden" id="ma_ctr" class="form-control" name="time_mins" value="<?= $ma_detai ?>">
                    <input type="hidden" id="homeurl" value="<?= $url ?>">
                </form>
                <div class="container mt-3">
                    <div>
                    <?php
                    if( current_user_can('administrator')):
                ?>
                <a href="<?=home_url("/duyetcongtrinh/")?>" class="text-decoration-none btn btn-info">Trở về trang duyệt công trình</a>
                <?php
                
                    endif;
                    if( current_user_can('subscriber')):
                ?>
                <a href="<?=home_url("/qlctrcanhan/")?>" class="text-decoration-none btn btn-info">Trở về trang công trình cá nhân</a>

                <?php endif;?>
                        <a href="<?= home_url('/congtrinhchitiet') . '?id=' . $ma_detai ?>" class="text-decoration-none btn btn-info">Trở về trang sửa chi tiết</a>
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
    const lastsegment = "congtrinh";

    $("#ctr").on("submit", function(event) {
        event.preventDefault();
        let ma_ctr = $('#ma_ctr').val();
        callUpdate(ma_ctr);
        
    });

    function callUpdate(id) {
        let urlc = localURL + "/my-stuff/" + lastsegment + "/update.php";
        $.post(urlc, {
                ten_ctr: $('#ten_ctr').val(),
                thoigian_hoanthanh: $('#thoigian_hoanthanh').val(),
                ten_tc_ky_nxb: $('#ten_tc_ky_nxb').val(),
                sluong_thamgia: $('#sluong_thamgia').val(),
                ma_loaisltc: $('#ma_loaisltc').val(),
                ma_nh: $('#ma_nh').val(),
                minhchung: $('#minhchung').val(),
                sotinchi: $('#sotinchi').val(),
                user_id: $("#user_id").val(),
                ten_loaivt: $('#ten_loaivt').val(),
                ma_ctr: id,
            },
            function(data, status) {
                window.location.href = data;
                // const alertmess = '<div class="auto-close alert alert-success" role="alert"> Mã công trình là: '+data+'</div>';
                // document.getElementById("mess").innerHTML =alertmess;

            });
    }


    // $('#ma_loaict').on('change', function() {
    //         readLoaiSL( this.value );
    //     });
    $('#ma_loaict').on('change', function() {
        if ($("#ma_nh").val() != "") {
            readLoaiSL(this.value, $("#ma_nh").val());
            // console.log($("#ma_loaict option:selected").text() == "Giáo trình");
            if ($("#ma_loaict option:selected").text() == "Giáo trình" || $("#ma_loaict option:selected").text() == "Biên dịch tài liệu nước ngoài, Tài liệu tham khảo") {
                $("#sotinchi").prop("readonly", false);
            } else {
                $("#sotinchi").prop("readonly", true);
                $("#sotinchi").val("1");
            }
        } else {
            $("#thoigian_hoanthanh").focus();
        }

    });
    $('#ma_loaisltc').on('change', function() {
        const ct = $('#ma_loaisltc option:selected').text();
        // console.log(ct);
    });
    $("#thoigian_hoanthanh").on("change", function(event) {
        checkDate();
    });

    function checkDate() {
        if ($("#thoigian_hoanthanh").val() != "") {
            event.preventDefault();
            let endDate = $("#thoigian_hoanthanh").val();
            callCheckDate(endDate);


        }
    }

    function callCheckDate(date) {
        const url = localURL + "/my-stuff/detainckh/read-admin.php/?ngayketthuc=" + date;
        $.get(url, function(data) {
            if (data != "nothing") {

                // console.log(data);
                // const alertmess = '<div class="auto-close alert alert-danger" role="alert"> Cảnh báo: ' + data + '</div>';
                $("#ma_nh").val(data);
                let namhoc = $("#ma_nh").val();
                console.log(namhoc);
                $('#ma_loaict').prop("disabled",false);
                $("#ma_loaisltc").prop("disabled", false);
                readLoaiCTR(namhoc);
                // $("#btnSubmit").attr('disabled', 'disabled');
            }
        });
    }
    $(document).ready(function() {
        // const mact = $("#ma_loaict").val();
        // readLoaiSL(mact);
        // if ($('#ma_loaict').val() > 0) {
        //     readLoaiSL($('#ma_loaict').val(),$('#ma_nh').val());

        // }
        $("#ma_nh").prop("disabled", true);
        $('#ma_loaict').prop("disabled", true);
        $("#ma_loaisltc").prop("disabled", true);
    });

    function readLoaiSL(param,namhoc){
              const url = getReadUrlSL(param,namhoc);
                $.get(url, function(data) {
                    document.getElementById("ma_loaisltc").innerHTML = data;
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
    function getReadUrlSL(param,namhoc){
        let urlr =  localURL + "/my-stuff/listofloaisltc.php?id=" + param+"&nh="+namhoc;
        // console.log(urlr);
        return urlr;
    }
    function readLoaiCTR(namhoc){
            const url = getReadUrlCTR(namhoc);
            $.get(url, function(data) {
                document.getElementById("ma_loaict").innerHTML = data;
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
    function getReadUrlCTR(namhoc){
        let urlr =  localURL + "/my-stuff/listofloaictr.php?nh="+namhoc;
        // console.log(urlr);
        return urlr;
    }
</script>
<?php
get_footer();
