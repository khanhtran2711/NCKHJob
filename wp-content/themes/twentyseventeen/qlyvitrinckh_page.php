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
 * Template name: qlyvitrinckh management Page
 */
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
}
$user = get_current_user_id();
$cbid = "SELECT `ma_cb` FROM `Canbo` WHERE `user_id` = $user";
error_log('sql = ' . $cbid);
$re3 = $conn->query($cbid);
$data3 = $re3->fetch_all(MYSQLI_ASSOC);
$macb = $data3[0]['ma_cb'];
if (isset($_POST['doivitri'])) {
    $a = $_POST['tendetai'];
    $b = $_POST['ten_loaivt'];
    $sql3 = "SELECT `ma_dtnckh` FROM `DeTai_NCKH` WHERE `ten_dtnckh` = '" . $a . "'";
    error_log('sql = ' . $sql3);
    $result = $conn->query($sql3);

        if ($result->num_rows == 1) {
            $d = $result->fetch_all(MYSQLI_ASSOC);
            $ma_dtnckh = $d[0]['ma_dtnckh'];
            if($b=='TV Chính'){
                $sql5 = "SELECT * FROM `DeTai_CanBo` WHERE `ma_dtnckh` = '$ma_dtnckh' and `ten_loaivt` = 'TV Chính' ";
                error_log('sql = ' . $sql5);
                $result2 = $conn->query($sql5);
                if($result2->num_rows==1){
                    echo '<script type="text/javascript">
                    window.onload = function () { alert("Thêm thất bại! TV chính đã có rồi!"); } 
                        </script>';
                
                    
                }else{
                    $sql4 = "SELECT * FROM `DeTai_CanBo` WHERE `ma_dtnckh` = '$ma_dtnckh' and `macb` = '$macb'";
                    error_log('sql = ' . $sql4);
                    $result = $conn->query($sql4);



                    if ($result->num_rows >= 1) {

                        echo '<script type="text/javascript">
                    window.onload = function () { alert("Thêm thất bại! Thông tin đề tài đã có rồi!"); } 
                        </script>';
                        }
                        else {
                            $vitri = "INSERT INTO `DeTai_CanBo`(`ten_loaivt`, `macb`, `ma_dtnckh`) VALUES ('$b','$macb','$ma_dtnckh')";
                            error_log('sql = ' . $vitri);
                            $result = $conn->query($vitri);
                            $conn->close();
                            echo "<script>window.location.href = '" . home_url('/qldetaicanhan/') . "';</script>";
                        }
                }
            
            } else {
                $vitri = "INSERT INTO `DeTai_CanBo`(`ten_loaivt`, `macb`, `ma_dtnckh`) VALUES ('$b','$macb','$ma_dtnckh')";
                error_log('sql = ' . $vitri);
                $result = $conn->query($vitri);
                $conn->close();
                echo "<script>window.location.href = '" . home_url('/qldetaicanhan/') . "';</script>";
            }
        } else {
            echo '<script type="text/javascript">
       window.onload = function () { alert("Thêm thất bại, thầy/cô nên xem lại tên đề tài"); } 
            </script>';
        }
    
}

$sql = "SELECT * FROM `DeTai_NCKH` where trangthai = 0";

$re = $conn->query($sql);

error_log('sql = ' . $sql);

$list = array();
$rows = $re->num_rows;

if ($rows > 0) {
    while ($fetch = $re->fetch_assoc()) {
        $data['value'] = $fetch['ten_dtnckh'];
        array_push($list, $data);
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

                            <div class="form-floating mb-3 ui-widget">
                                <input class="form-control" id="tendetai" name="tendetai" type="text" />
                                <label for="tendetai">Tên Đề tài</label>
                                <div class="invalid-feedback" data-sb-feedback="ghichu:required">Tên đề tài is required.</div>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="ten_loaivt" name="ten_loaivt" aria-label="Khoa/phòng ban hiện tại">
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
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="doivitri">Lưu</button>

                            </div>
                        </div>
                    </div>
                    <a href="<?= home_url('/qldetaicanhan') ?>" class="text-decoration-none btn btn-info">Trở về trang cá nhân</a>
                    <?php
                    $url = home_url();
                    ?>
                    <input type="hidden" id="homeurl" value="<?= $url ?>">
                    <input type="hidden" id="result" value='<?= json_encode($list, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>'>
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

    $(document).ready(function() {
        let availableTags1 = $("#result").val();

        $("#tendetai").autocomplete({
            source: JSON.parse(availableTags1)
        });

        // read();

    });
</script>
<?php
get_footer();
