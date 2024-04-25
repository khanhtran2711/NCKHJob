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
 * Template name: doikhoapb management Page
 */
$user = get_current_user_id();
$cbid = "SELECT `ma_cb`,`ma_khoa` FROM `Canbo` WHERE `user_id` = $user";
error_log('sql = ' . $cbid);
$re3 = $conn->query($cbid);
$data3 = $re3->fetch_all(MYSQLI_ASSOC);
$macb = $data3[0]['ma_cb'];
$makhoa = $data3[0]['ma_khoa'];
if(isset($_POST['doikhoabtn'])){
    $a = $_POST['ma_khoa'];
    $sql = "UPDATE `Canbo` SET `ma_khoa`='$a', `trangthaidoikhoa`=1 WHERE `ma_cb` = ".$macb;
    error_log('sql = '.$sql);
    $result = $conn->query($sql);
    echo "<script>window.location.href = '" . home_url('/doikhoa/') . "';</script>";
}

//giang vien nay chua cap nhat chuc danh và khoa-pb truc thuoc cua minh
get_header();

    ?>
    
    <div class="wrap">
    <div id="primary" class="content-area">
        

        <main id="main" class="site-main">

            <div class="container">
                
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="suakhoa">
                    <div class="form-body">
                    <div class="row">
                        <!-- <div class="form-floating mb-3">
                            <input class="form-control" id="ghichu" type="text" placeholder="Ghi chú" data-sb-validations="required" />
                            <label for="ghichu">Ghi chú</label>
                            <div class="invalid-feedback" data-sb-feedback="ghichu:required">Tên đề tài is required.</div>
                        </div> -->
                        
                        <div class="form-floating mb-3">
                            <select class="form-select" id="ma_khoa" name="ma_khoa" aria-label="Khoa/phòng ban hiện tại">
                                <?php
                                    $list_khoa = "SELECT `ma_khoa`, `ten_khoa` FROM `Khoa_PB`";
                                    error_log('sql = ' . $list_khoa);
                                    $re2 = $conn->query($list_khoa);
                                    while ($row = $re2->fetch_assoc()):
                                ?>
                                    <option value="<?=$row['ma_khoa']?>" <?=($row['ma_khoa']==$makhoa)?'selected':''?>><?=$row['ten_khoa']?></option>
                                <?php
                                    endwhile;
                                ?>
                            </select>
                            <label for="ma_khoa">Khoa/phòng ban hiện tại</label>
                        </div>
                        <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="doikhoabtn">Lưu</button>
                        
                    </div>
                    </div>
                    </div>
                </form>
                <div class="container">
                <a href="<?=home_url()?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>

                </div>
            </div>
        </main>
   

<?php
get_footer();
