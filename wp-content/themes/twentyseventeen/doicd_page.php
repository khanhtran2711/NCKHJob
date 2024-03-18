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
 * Template name: doichucdanh management Page
 */
$user = get_current_user_id();
$cbid = "SELECT `ma_cb` FROM `Canbo` WHERE `user_id` = $user";
error_log('sql = ' . $cbid);
$re3 = $conn->query($cbid);
$data3 = $re3->fetch_all(MYSQLI_ASSOC);
$macb = $data3[0]['ma_cb'];
if(isset($_POST['doichucdanh'])){
    $a = $_POST['ma_cd'];
    $sql = "INSERT INTO `CanBo_ChucDanh`(`ma_cb`, `ma_cd`, `thoigiannhan`) VALUES ('$macb','$a',NOW())";
    error_log($sql);
    $conn->query($sql);
    echo "<script>window.location.href = '".home_url('/cbprofile/')."';</script>";
}
get_header();

    ?>
    <div class="wrap">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

            <div class="container">
                
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="themchucdanh">
                    <div class="form-body">
                    <div class="row">
                        <!-- <div class="form-floating mb-3">
                            <input class="form-control" id="ghichu" type="text" placeholder="Ghi chú" data-sb-validations="required" />
                            <label for="ghichu">Ghi chú</label>
                            <div class="invalid-feedback" data-sb-feedback="ghichu:required">Tên đề tài is required.</div>
                        </div> -->
                       
                        <div class="form-floating mb-3">
                            <select class="form-select" id="ma_cd" name="ma_cd" aria-label="Chức danh hiện tại">
                                <?php
                                    $list_cd = "SELECT `ma_cd`, `ten_cd` FROM `ChucDanh`";
                                    error_log('sql = ' . $list_cd);
                                    $re1 = $conn->query($list_cd);
                                    while ($row = $re1->fetch_assoc()):
                                ?>
                                    <option value="<?=$row['ma_cd']?>"><?=$row['ten_cd']?></option>
                                <?php
                                    endwhile;
                                ?>
                            </select>
                            <label for="ma_cdt">Chức danh hiện tại</label>
                        </div>
                        
                        <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="doichucdanh">Lưu</button>
                            </div>
                        </div>
                        
                    </div>
                    </div>
                    </div>
                </form>
                <div class="container">
                <a href="<?=home_url()?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>

                </div>
               
            </div>
        </main>
    </div>
    </div>
   

<?php
get_footer();
