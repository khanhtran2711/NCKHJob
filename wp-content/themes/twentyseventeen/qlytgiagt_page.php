<?php
include 'my-stuff/giaithuong/config.php';
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
 * Template name: qlytgiagt_page management Page
 */
if (!is_user_logged_in()) {
    wp_redirect( wp_login_url() );
}
$sql = "SELECT * FROM `GiaiThuong` where trangthai = 0";

$re = $conn->query($sql);

error_log('sql = ' . $sql);

$list = array();
	$rows = $re->num_rows;
 
	if($rows > 0){
		while($fetch = $re->fetch_assoc()){
			array_push($list, $fetch['ten_gt']);
		}
	}

$user = get_current_user_id();
$cbid = "SELECT `ma_cb` FROM `Canbo` WHERE `user_id` = $user";
error_log('sql = ' . $cbid);
$re3 = $conn->query($cbid);
$data3 = $re3->fetch_all(MYSQLI_ASSOC);
$macb = $data3[0]['ma_cb'];
if(isset($_POST['doivitri'])){
    $a = $_POST['ten_gt'];
    $b = $_POST['ten_loaivt'];
    $sql3 = "SELECT `ma_gt` FROM `$tablename` WHERE `ten_gt` like '%".$a."%'";
    error_log('sql = '.$sql3);
    $result = $conn->query($sql3);
    if ($result->num_rows == 1) {
        $d = $result->fetch_all(MYSQLI_ASSOC);
        $ma_gt = $d[0]['ma_gt'];
        $sql4 = "SELECT * FROM `CanBo_GiaiThuong` WHERE `ma_gt` = '$ma_gt' and `ma_cb` = '$macb'";
        error_log('sql = ' . $sql4);
        $result = $conn->query($sql4);
        if($result->num_rows >= 1){
            echo '<script type="text/javascript">
                window.onload = function () { alert("Thêm thất bại! Thông tin giải thưởng đã có rồi!"); } 
                    </script>'; 
        }else{
        $vitri = "INSERT INTO `CanBo_GiaiThuong`(`ten_loaivt`, `ma_gt`, `ma_cb`) VALUES ('$b','$ma_gt','$macb')";
        error_log('sql = '.$vitri);
        $result = $conn->query($vitri);
        $conn->close();
        echo "<script>window.location.href = '".home_url('/qlgtcanhan/')."';</script>";
        }
    }
    else{
        echo '<script type="text/javascript">
       window.onload = function () { alert("Thêm thất bại, thầy/cô nên xem lại tên giải thưởng"); } 
            </script>'; 

    }
}
//giang vien nay chua cap nhat chuc danh và khoa-pb truc thuoc cua minh
get_header();

    ?>
    
    
    <div class="wrap">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

            <div class="container">
                <div class="mb-3"><?=get_the_content()?></div>
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="suavitri">
                    <div class="form-body">
                    <div class="row">
                        
                        <div class="form-floating mb-3 ui-widget">
                            <input class="form-control" id="ten_gt" name="ten_gt" type="text" />
                            <label for="ten_gt">Tên Giải thưởng</label>
                            <div class="invalid-feedback" data-sb-feedback="ten_gt:required">Tên Giải thưởng is required.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="ten_loaivt" name="ten_loaivt" aria-label="Khoa/phòng ban hiện tại">
                                <?php
                                    $list_vt = ['TV Chính','TV Tham Gia'];
                                    foreach ($list_vt as $vt):
                                ?>
                                    <option value="<?=$vt?>"><?=$vt?></option>
                                <?php
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
                    <a href="<?=home_url('/qlgtcanhan')?>" class="text-decoration-none btn btn-info">Trở về trang giải thưởng cá nhân</a>

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
    const lastsegment = "giaithuong";

    $(document).ready(function() {
        let availableTags1 = $( "#result" ).val();
   
        $( "#ten_gt" ).autocomplete({
            source: JSON.parse(availableTags1)
        });
    });
    
   
</script>
<?php
get_footer();
