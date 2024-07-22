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
 * Template name: doivitri management Page
 */
if (!is_user_logged_in()) {
    wp_redirect( wp_login_url() );
}
if(isset($_POST['editBtn'])){
    $ma_detai = $_POST['cbdt_id'];
    $tencb = $_POST['tencb'];
    
    $macb = $_POST['macb'];
    $loainckh = $_POST['loainckh'];
    // $tendetai = '';
    if($loainckh == "detainckh"){
        $sql3 = "SELECT `ten_dtnckh` FROM `DeTai_NCKH` WHERE `ma_dtnckh` = $ma_detai";
        error_log('sql = ' . $sql3);
        $result = $conn->query($sql3);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $tendetai = $data[0]['ten_dtnckh'];
        $backpage = "/detaichitiet";
    }
    if($loainckh == "congtrinh"){
        $sql3 = "SELECT `ten_ctr` FROM `CongTrinh_Khac` WHERE `ma_ctr`= $ma_detai";
        error_log('sql = ' . $sql3);
        $result = $conn->query($sql3);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $tendetai = $data[0]['ten_ctr'];
        $backpage = "/congtrinhchitiet";
    }
    $tenvtr = $_POST['tenvtr'];
}
if (isset($_POST['doivitri'])) {
    $b = $_POST['ten_loaivt'];
    $ma_detai = $_POST['ma_detai'];
$loainckh = $_POST['loainckh'];
$macb = $_POST['macb'];
    if($loainckh == "detainckh"){
        $path = "detaichitiet";
        $redflag = false;
        if($b=="TV Chính"){
            $checkvtri = "SELECT * FROM `DeTai_CanBo` WHERE `ma_dtnckh` = $ma_detai and `ten_loaivt` = 'TV Chính';";
            $result = $conn->query($checkvtri);
            if($result->num_rows>0){
                $redflag = true;
            }
        }
        if($redflag==false || $b!="TV Chính") {
            $vitri = "UPDATE `DeTai_CanBo` SET `ten_loaivt`='$b' WHERE `ma_dtnckh`=$ma_detai and `macb` = $macb";
        }
        
    }
    if($loainckh == "congtrinh"){
        $path = "congtrinhchitiet";
        $redflag = false;
        if($b=="TV Chính"){
            $checkvtri = "SELECT * FROM `CanBo_Ctr` WHERE `ma_ctr` = $ma_detai and `ten_loaivt` = 'TV Chính';";
            $result = $conn->query($checkvtri);
            if($result->num_rows>0){
                $redflag = true;
            }
        }
        if($redflag==false || $b!="TV Chính") {
            $vitri = "UPDATE `CanBo_Ctr` SET `ten_loaivt`='$b' WHERE `ma_ctr`=$ma_detai and `ma_cb` = $macb";
        }
    }
    if($redflag == false){
        error_log('sql = ' . $vitri);
        $result = $conn->query($vitri);
        $conn->close();
    }
        
        echo "<script>window.location.href = '" . home_url('/'.$path.'/?id='.$ma_detai) . "';</script>";
   
}
$sql = "SELECT * FROM `realdev_users`";

$re = $conn->query($sql);

error_log('sql = ' . $sql);

$list = array();
	$rows = $re->num_rows;
 
	if($rows > 0){
		while($fetch = $re->fetch_assoc()){
			if(!user_can( $fetch['ID'], "manage_options" ))
			{
				
				array_push($list, $fetch['user_email']);
			}
		}
	}
//giang vien nay chua cap nhat chuc danh và khoa-pb truc thuoc cua minh
get_header();

?>


<div class="wrap">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

            <div class="container">
                <div class="mb-3"><?= get_the_content() ?></div>
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="suavitri">
                    <div class="form-body">
                        <div class="row">
                        <input type="hidden" name="ma_detai" class="form-control"  value="<?=$ma_detai?>"/>
                        <input type="hidden" class="form-control" name="loainckh" value="<?=$loainckh?>"/>
                        <input type="hidden" class="form-control" name="macb" value="<?=$macb?>"/>
                        <div class="form-floating mb-3 ui-widget">
                                <input class="form-control" id="tencb" name="tencb" type="text" readonly value="<?=$tencb?>" />
                                <label for="tendetai">Tên cán bộ</label>
                                <div class="invalid-feedback" data-sb-feedback="ghichu:required">Tên đề tài is required.</div>
                            </div>

                            <div class="form-floating mb-3 ui-widget">
                                <input class="form-control" id="tendetai" name="tendetai" type="text" readonly value="<?=$tendetai?>" />
                                <label for="tendetai">Tên Đề tài/Công trình/NCKH</label>
                                <div class="invalid-feedback" data-sb-feedback="ghichu:required">Tên đề tài is required.</div>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="ten_loaivt" name="ten_loaivt" aria-label="Khoa/phòng ban hiện tại">
                                    <?php
                                    $list_vt = ['TV Chính', 'TV Tham Gia'];
                                    foreach ($list_vt as $vt) :
                                        if($vt==$tenvtr):
                                    ?>
                                        <option selected value="<?= $vt ?>"><?= $vt ?></option>
                                    <?php
                                        else:
                                            ?>
                                            <option value="<?= $vt ?>"><?= $vt ?></option>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </select>
                                <label for="ten_loaivt">Vị trí tham gia trong đề tài</label>
                            </div>
                            <?php
                            $url = home_url();
                            ?>
                                        <input type="hidden" id="homeurl" value="<?=$url?>">
                                        <input type="hidden" id="result" value='<?=json_encode($list,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);?>'>
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="doivitri">Lưu</button>

                            </div>
                        </div>
                    </div>
                    <a href="<?= home_url($backpage). '?id=' . $ma_detai ?>" class="text-decoration-none btn btn-info">Trở về trang chi tiết</a>

                </form>
            </div>
        </main>
    </div>
</div>
<?php
$jquery = get_theme_file_uri('/assets/js/jquery-3.7.0.js');
?>
<script src="<?= $jquery ?>"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    const currentUrl = window.location.hostname;
    let localURL = $("#homeurl").val();
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = "detainckh";
    
</script>
<?php
get_footer();
