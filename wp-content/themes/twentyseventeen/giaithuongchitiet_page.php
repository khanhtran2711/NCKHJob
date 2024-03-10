<?php
include 'my-stuff/giaithuong/config.php';
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
 * Template name: giaithuongchitiet form Page
 */
$ma_detai = $_GET['id'];
$sql = "SELECT `ten_gt`, lgt.ten_loaigt, nh.namhoc, `trangthai`,`minhchung` FROM `GiaiThuong` gt INNER JOIN `LoaiGiaiThuong` lgt on lgt.ma_loaigt=gt.ma_loaigt INNER JOIN `NamHoc` nh on gt.ma_nh=nh.ma_nh  WHERE `ma_gt`=".$ma_detai;

$re = $conn->query($sql);

error_log('sql = ' . $sql);
$data = $re->fetch_all(MYSQLI_ASSOC);

// $user = new WP_User(15);
// echo $user->last_name;
// echo $user->first_name;
$sql2 = "SELECT gt.id as gtid, u.ID,u.user_email, k.ten_khoa FROM `CanBo_GiaiThuong` gt INNER JOIN `Canbo` cb ON gt.ma_cb=cb.ma_cb INNER JOIN `realdev_users` u on u.ID=cb.user_id INNER JOIN `Khoa_PB` k ON k.ma_khoa=cb.ma_khoa WHERE `ma_gt`=".$ma_detai;
$re2 = $conn->query($sql2);
error_log('sql = ' . $sql2);
$url = "/giaithuongchitiet/?id=".$ma_detai;
if(isset($_POST['duyet'])){
    if(isset($_POST['trangthai'])){
        $sql3 = "UPDATE `GiaiThuong` SET `trangthai`=1 WHERE `ma_gt` = ".$ma_detai;
       
    }else{
        $sql3 = "UPDATE `GiaiThuong` SET `trangthai`=0 WHERE `ma_gt` = ".$ma_detai;
    }
    error_log('sql = '.$sql3);
    $result = $conn->query($sql3);
    $conn->close();
    
    echo "<script>window.location.href = '".home_url($url)."';</script>";
}

if(isset($_POST['delBtn'])){
    $sql = "DELETE FROM `CanBo_GiaiThuong` WHERE `id` = " . $_POST['gtid'];
    // next line is for debugging, they appear in the php_error.log file
    // comment it out before putting into production
    error_log('sql = '.$sql);
    $result = $conn->query($sql);
    $conn->close();
    echo "<script>window.location.href = '".home_url($url)."';</script>";
}
get_header(); ?>
<style>
    body,.site-main,.site-content{
        padding:0px;
        margin:0px;
    }
</style>

<div class="wrap">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

        <div class="container mt-3">
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3 class="box-title mt-5">Thông tin chung giải thưởng 
                        <?php
                               if($data[0]['trangthai']==0 || current_user_can('administrator')): 
                                $urlsua = '/suagiaithuong/?id='.$ma_detai;
                            ?>
                    <a href="<?=home_url($urlsua)?>" class="text-decoration-none btn btn-info">Sửa</a>
                            <?php endif;?></h3>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-product">
                            <tbody>
                                <tr>
                                    <td>Tên</td>
                                <td><?=$data[0]['ten_gt']?></td>
                                </tr>
                                <tr>
                                    <td>Tên loại giải thưởng</td>
                                    <td><?=$data[0]['ten_loaigt']?></td>
                                </tr>
                                <tr>
                                    <td>Năm học</td>
                                    <td><?=$data[0]['namhoc']?></td>
                                </tr>
                                <tr>
                                    <td>Minh Chứng</td>
                                    <td><a href="<?=$data[0]['minhchung']?>" target="_new">Xem tại đây</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="container mt-3">
                   
                    <table class="table table-striped" id="records">
                    <tbody>
                        <thead>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Khoa</th>
                            <?php
                               if($data[0]['trangthai']==0 || current_user_can('administrator')): 
                            ?>
                            <th>Xóa</th>
                            <?php endif;?>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $re2->fetch_assoc()) {
                                $user = new WP_User($row['ID']);
                                echo "<tr>";
                                echo "<td>" . $user->last_name." ".$user->first_name . "</td>";
                                echo "<td>" . $row['user_email'] . "</td>";
                                echo "<td>" . $row['ten_khoa'] . "</td>";
                                // echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_dtnckh"] . '">Update</a></td>';
                                // echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
                                if($data[0]['trangthai']==0 || current_user_can('administrator')):
                                    
                                    ?>
            <td> <form method="POST">
             <input type="hidden" name="gtid" class="form-control" name="time_mins" value="<?=$row['gtid']?>"/>
             <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete?')" name="delBtn" class="btn btn-danger">
             </form>     </td>                  
                                    <?php
                                // echo '<td><button class="btn btn-danger" id="del'.$row['detaicbid'].'" >Delete</button>';
                                //  echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'/deletecbdt.php?id=' . $row['detaicbid'] . '">Delete</a></td>';
                                endif;
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </tbody>
                    </table>
                    <?php
                    if( current_user_can('administrator')):
                ?>
                    <form method="POST" class="form form-vertical">
                        <div class="mb-3">
                            <label class="form-label d-block">Trạng thái</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="trangthai" type="checkbox" name="trangthai" value="duyet" <?=$data[0]['trangthai']==1?"checked":""?>/>
                                <label class="form-check-label" for="trangthai">Duyệt đề tài</label>
                            </div>
                            <button type="submit" class="btn btn-success  me-1 mb-1" name="duyet">Lưu</button>
                        </div>
                        
                    </form>
                    <a href="<?=home_url("/duyetgiaithuong/")?>" class="text-decoration-none btn btn-info">Trở về trang duyệt giải thưởng</a>
                    <?php
                    
                        endif;
                        if( current_user_can('subscriber')):
                    ?>
                    <a href="<?=home_url("/qldetaicanhan/")?>" class="text-decoration-none btn btn-info">Trở về trang quản lý đề tài cá nhân</a>

                    <?php endif;?>
                    <a href="<?=home_url()?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>

                </div> <!--container-->

        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
