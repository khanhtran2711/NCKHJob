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
 * Template name: SuaCongtrinh form Page
 */
if(!current_user_can('administrator')){
    echo "<script>window.location.href = '".home_url()."';</script>";
}
$ma_detai = $_GET['id'];
$sql = "SELECT `ten_ctr`,`thoigian_hoanthanh`,`ten_tc_ky_nxb`,`sluong_thamgia`,`trangthai`,`minhchung`, loaisl.ma_loaisl, lctr.ma_loai, nh.namhoc FROM `CongTrinh_Khac` ct INNER JOIN `LoaiSL_TC` loaisl on loaisl.ma_loaisl = ct.ma_loaisltc INNER JOIN `LoaiCongTrinh_Khac` lctr on lctr.ma_loai = loaisl.ma_loaict INNER JOIN `NamHoc` nh ON ct.ma_nh = nh.ma_nh WHERE ct.ma_ctr =".$ma_detai;

$re = $conn->query($sql);

error_log('sql = ' . $sql);
$data = $re->fetch_all(MYSQLI_ASSOC);
$url = "/congtrinhchitiet/?id=".$ma_detai;

if(isset($_POST['sua'])){
    $a = $_POST['ten_ctr'];
$b = $_POST['thoigian_hoanthanh'];
$c = $_POST['ten_tc_ky_nxb'];
$d = $_POST['sluong_thamgia'];
$e = $_POST['ma_loaisltc'];
$f = $_POST['ma_nh'];
$g = $_POST['minhchung'];

    $sql3 =  "UPDATE `CongTrinh_Khac` set ten_ctr='".$a."', thoigian_hoanthanh='".$b."',
    ten_tc_ky_nxb='".$c."' , sluong_thamgia=".$d.",
    ma_loaisltc='".$e."', ma_nh='".$f."', minhchung='".$g."' where ma_ctr=".$ma_detai;
    error_log('sql = '.$sql3);
    $result = $conn->query($sql3);
    // $conn->close();
   
    echo "<script>window.location.href = '".home_url($url)."';</script>";
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
                        <input class="form-control" id="ten_ctr" name="ten_ctr" type="text" placeholder="Tên đề tài" data-sb-validations="required" value="<?=$data[0]['ten_ctr']?>"/>
                        <label for="ten_ctr">Tên công trình</label>
                        <div class="invalid-feedback" data-sb-feedback="ten_ctr:required">Tên công trình is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="thoigian_hoanthanh" name="thoigian_hoanthanh" type="Date" placeholder="Năm bắt đầu" data-sb-validations="required" value="<?=$data[0]['thoigian_hoanthanh']?>" />
                        <label for="thoigian_hoanthanh">Thời gian hoàn thành</label>
                        <div class="invalid-feedback" data-sb-feedback="thoigian_hoanthanh:required">Thời gian hoàn thành is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="ten_tc_ky_nxb" name="ten_tc_ky_nxb" type="text" placeholder="Năm bắt đầu" data-sb-validations="required" value="<?=$data[0]['ten_tc_ky_nxb']?>" />
                        <label for="ten_tc_ky_nxb">Tên tạp chí/kỷ yếu/ NXB</label>
                        <div class="invalid-feedback" data-sb-feedback="ten_tc_ky_nxb:required">Tên tạp chí/kỷ yếu/ NXB is required.</div>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input class="form-control" id="sluong_thamgia" name="sluong_thamgia" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" value="<?=$data[0]['sluong_thamgia']?>"/>
                        <label for="sluong_thamgia">Số lượng tham gia</label>
                        <div class="invalid-feedback" data-sb-feedback="sluong_thamgia:required">Số lượng tham gia is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="minhchung" name="minhchung" type="text" placeholder="Số lượng tham gia" data-sb-validations="required" value="<?=$data[0]['minhchung']?>" />
                        <label for="minhchung">Minh chứng (dán liên kết từ google drive vào đây)</label>
                        <div class="invalid-feedback" data-sb-feedback="minhchung:required">Minh chứng is required.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="ma_loaict" name="ma_loaict" aria-label="LoaiCongTrinhKhac">
                            <?php
                                $sql = "SELECT * FROM `LoaiCongTrinh_Khac`";

                                $re = $conn->query($sql);
                                while ($row = $re->fetch_assoc()):
                            ?>
                                <option value="<?=$row['ma_loai']?>" <?=$data[0]['ma_loai']==$row['ma_loai']?'selected':''?>><?=$row['ten_loai']?></option>
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
                                while ($row = $re12->fetch_assoc()):
                                    
                            ?>
                                <option value="<?=$row['ma_loaisl']?>" <?=$data[0]['ma_loaisl']==$row['ma_loaisl']?'selected':''?>><?=$row['ten_loaisl']?></option>
                            <?php
                                endwhile;
                            ?>
                        </select>
                        <label for="ma_loaisltc">Loại tên đơn vị tính/ mức điểm/giờ chuẩn</label>
                    </div>
                    <div class="form-floating mb-3">
                                <input class="form-control" id="sotinchi" type="text" placeholder="Số tín chỉ" data-sb-validations="required" value="1"/>
                                <label for="sotinchi">Số tín chỉ</label>
                                <div class="invalid-feedback" data-sb-feedback="sotinchi:required">Số tín chỉ is required.</div>
                            </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="ma_nh" name="ma_nh" aria-label="Năm học">
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
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container mt-3">
                    <div>
                            <a href="<?=home_url('/qlctrcanhan/')?>" class="text-decoration-none btn btn-info">Quản lý công trình NCKH cá nhân</a>
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

    $('#ma_loaict').on('change', function() {
            readLoaiSL( this.value );
        });
    $(document).ready(function() {
        // const mact = $("#ma_loaict").val();
        // readLoaiSL(mact);
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
                });   
        }
        function getReadUrlSL(param){
            let urlr = "http://" + localURL + "/my-stuff/listofloaisltc.php?id=" + param;
            console.log(urlr);
            return urlr;
        }
</script>
<?php
get_footer();
