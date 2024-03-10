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
$user = get_current_user_id();
$cbid = "SELECT `ma_cb` FROM `Canbo` WHERE `user_id` = $user";
error_log('sql = ' . $cbid);
$re3 = $conn->query($cbid);
$data3 = $re3->fetch_all(MYSQLI_ASSOC);
$macb = $data3[0]['ma_cb'];
if(isset($_POST['doivitri'])){
    $a = $_POST['ten_gt'];
    $sql3 = "SELECT `ma_gt` FROM `$tablename` WHERE `ten_gt` like '%".$a."%'";
    error_log('sql = '.$sql3);
    $result = $conn->query($sql3);
    $d = $result->fetch_all(MYSQLI_ASSOC);
    $ma_gt = $d[0]['ma_gt'];
    $vitri = "INSERT INTO `CanBo_GiaiThuong`(`ma_gt`, `ma_cb`, `thoigiannhan`) VALUES ('$ma_gt','$macb',NOW())";
    error_log('sql = '.$vitri);
    $result = $conn->query($vitri);
    $conn->close();
    echo "<script>window.location.href = '".home_url('/qlgtcanhan/')."';</script>";
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
                            <input class="form-control" id="ten_gt" name="tendetai" type="text" />
                            <label for="ten_gt">Tên Giải thưởng</label>
                            <div class="invalid-feedback" data-sb-feedback="ten_gt:required">Tên Giải thưởng is required.</div>
                        </div>
                        
                        
                        <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="doivitri">Submit</button>
                        
                    </div>
                    </div>
                    </div>
                    <a href="<?=home_url()?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>

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
    const folder = "NCKH";
    let localURL = currentUrl + '/' + folder;
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = "giaithuong";
    let urlr = "http://" + localURL + "/my-stuff/" + lastsegment + "/listdetai.php";
    $(document).ready(function() {
        $( "#ten_gt" ).autocomplete({
            source: urlr
        });
    });
    
   
</script>
<?php
get_footer();
