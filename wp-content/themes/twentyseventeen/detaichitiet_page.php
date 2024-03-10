<?php
include 'my-stuff/detainckh/config.php';
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
 * Template name: detaichitiet form Page
 */
$ma_detai = $_GET['id'];
$sql = "SELECT `ten_dtnckh`, `nam_batdau`, `nam_kethuc`, `sluong_thamgia`, cdt.ten_cdt, nh.namhoc, `trangthai`,`minhchung` FROM `DeTai_NCKH` de INNER join `CapDeTai` cdt on de.ma_cdt=cdt.ma_cdt INNER JOIN `NamHoc` nh on de.ma_nh=nh.ma_nh  WHERE `ma_dtnckh` = ".$ma_detai;

$re = $conn->query($sql);

error_log('sql = ' . $sql);
$data = $re->fetch_all(MYSQLI_ASSOC);

// $user = new WP_User(15);
// echo $user->last_name;
// echo $user->first_name;
$sql2 = "SELECT dtcb.id as detaicbid, `ten_loaivt`, u.ID,u.user_email, k.ten_khoa FROM `DeTai_CanBo` dtcb INNER JOIN `Canbo` cb ON dtcb.macb=cb.ma_cb INNER JOIN `realdev_users` u on u.ID=cb.user_id INNER JOIN `Khoa_PB` k ON k.ma_khoa=cb.ma_khoa WHERE `ma_dtnckh` =".$ma_detai;
$re2 = $conn->query($sql2);
error_log('sql = ' . $sql2);
$url = "/detaichitiet/?id=".$ma_detai;
if(isset($_POST['duyet'])){
    if(isset($_POST['trangthai'])){
        $sql3 = "UPDATE `DeTai_NCKH` SET `trangthai`=1 WHERE `ma_dtnckh` = ".$ma_detai;
       
    }else{
        $sql3 = "UPDATE `DeTai_NCKH` SET `trangthai`=0 WHERE `ma_dtnckh` = ".$ma_detai;
    }
    error_log('sql = '.$sql3);
    $result = $conn->query($sql3);
    $conn->close();
    
    echo "<script>window.location.href = '".home_url($url)."';</script>";
}
if(isset($_POST['delBtn'])){
    $sql = "DELETE FROM `DeTai_CanBo` WHERE `id` = " . $_POST['cbdt_id'];
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
                    <h3 class="box-title mt-5">Thông tin chung đề tài
                    <?php
                               if($data[0]['trangthai']==0 || current_user_can('administrator')): 
                                $urlsua = '/suadetainckh/?id='.$ma_detai;
                            ?>
                    <a href="<?=home_url($urlsua)?>" class="text-decoration-none btn btn-info">Sửa</a>
                            <?php endif;?>
                    </h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-product">
                            <tbody>
                                <tr>
                                    <td>Tên</td>
                                <td><?=$data[0]['ten_dtnckh']?></td>
                                </tr>
                                <tr>
                                    <td>Năm bắt đầu</td>
                                    <td><?=$data[0]['nam_batdau']?></td>
                                </tr>
                                <tr>
                                    <td>Năm kết thúc</td>
                                   <td><?=$data[0]['nam_kethuc']?></td>
                                </tr>
                                <tr>
                                    <td>Số lượng tham gia</td>
                                    <td><?=$data[0]['sluong_thamgia']?></td>
                                </tr>
                                <tr>
                                    <td>Cấp đề tài</td>
                                    <td><?=$data[0]['ten_cdt']?></td>
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
                            <th>Vị trí</th>
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
                                echo "<td>" . $row['ten_loaivt'] . "</td>";
                                // echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_dtnckh"] . '">Update</a></td>';
                                if($data[0]['trangthai']==0 || current_user_can('administrator')):
                                    
                                    ?>
            <td> <form method="POST">
             <input type="hidden" name="cbdt_id" class="form-control" name="time_mins" value="<?=$row['detaicbid']?>"/>
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
                    <a href="<?=home_url("/duyetdetai/")?>" class="text-decoration-none btn btn-info">Trở về trang duyệt đề tài</a>
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
