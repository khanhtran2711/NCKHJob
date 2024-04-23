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
 * Template name: congtrinhchitiet form Page
 */
$ma_detai = $_GET['id'];
$sql = "SELECT `ten_ctr`,`thoigian_hoanthanh`,`ten_tc_ky_nxb`,`sluong_thamgia`,`trangthai`,`minhchung`, loaisl.ten_loaisl, lctr.ten_loai,`sotinchi` FROM `CongTrinh_Khac` ct INNER JOIN `LoaiSL_TC` loaisl on loaisl.ma_loaisl = ct.ma_loaisltc INNER JOIN `LoaiCongTrinh_Khac` lctr on lctr.ma_loai = loaisl.ma_loaict WHERE ct.ma_ctr =".$ma_detai;

$re = $conn->query($sql);

error_log('sql = ' . $sql);
$data = $re->fetch_all(MYSQLI_ASSOC);

// $user = new WP_User(15);
// echo $user->last_name;
// echo $user->first_name;
$sql2 = "SELECT cbct.id as cbctid, `ten_loaivt`, u.ID,u.user_email, k.ten_khoa FROM `CanBo_Ctr` cbct INNER JOIN `Canbo` cb ON cbct.ma_cb=cb.ma_cb INNER JOIN `realdev_users` u on u.ID=cb.user_id INNER JOIN `Khoa_PB` k ON k.ma_khoa=cb.ma_khoa WHERE cbct.ma_ctr =".$ma_detai;
$re2 = $conn->query($sql2);
error_log('sql = ' . $sql2);

$url = "/congtrinhchitiet/?id=".$ma_detai;

if(isset($_POST['duyet'])){
    if(isset($_POST['trangthai'])){
        $sql3 = "UPDATE `CongTrinh_Khac` SET `trangthai`=1 WHERE `ma_ctr` = ".$ma_detai;
       
    }else{
        $sql3 = "UPDATE `CongTrinh_Khac` SET `trangthai`=0 WHERE `ma_ctr` = ".$ma_detai;
    }
    error_log('sql = '.$sql3);
    $result = $conn->query($sql3);
    $conn->close();
   
    echo "<script>window.location.href = '".home_url($url)."';</script>";
}

if(isset($_POST['delBtn'])){
    $sql = "DELETE FROM `CanBo_Ctr` WHERE `id` = " . $_POST['cbctid'];
    // next line is for debugging, they appear in the php_error.log file
    // comment it out before putting into production
    error_log('sql = '.$sql);
    $result = $conn->query($sql);
    $conn->close();
    echo "<script>window.location.href = '".home_url($url)."';</script>";
}
$sql3 = "SELECT `start`,`end` FROM `deadline`";
error_log('sql = ' . $sql3);
$re3 = $conn->query($sql3);
$data3 = $re3->fetch_all(MYSQLI_ASSOC);
$start = $data3[0]['start'];
$end = $data3[0]['end'];
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
<!-- `ten_ctr`,`thoigian_hoanthanh`,`ten_tc_ky_nxb`,`sluong_thamgia`,`trangthai`,`minhchung`, loaisl.ten_loaisl, lctr.ten_loai -->
        <div class="container mt-3">
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3 class="box-title mt-5">Thông tin chung công trình 

                    <?php
                             if($data[0]['trangthai']==0 && $start <= date("Y-m-d") && $end >= date("Y-m-d")|| 
                             current_user_can('administrator')):
                                $urlsua = '/suacongtrinh/?id='.$ma_detai;
                            ?>
                    <a href="<?=home_url($urlsua)?>" class="text-decoration-none btn btn-info">Sửa</a>
                            <?php 
                             endif;
                        ?>
                    </h3>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-product">
                            <tbody>
                                <tr>
                                    <td>Tên</td>
                                <td><?=$data[0]['ten_ctr']?></td>
                                </tr>
                                <tr>
                                    <td>Thời gian hoàn thành</td>
                                    <td><?=$data[0]['thoigian_hoanthanh']?></td>
                                </tr>
                                <tr>
                                    <td>Tên tạp chí/kỷ yếu/NXB</td>
                                   <td><?=$data[0]['ten_tc_ky_nxb']?></td>
                                </tr>
                                <tr>
                                    <td>Số lượng tham gia</td>
                                    <td><?=$data[0]['sluong_thamgia']?></td>
                                </tr>
                                <tr>
                                    <td>Loại công trình</td>
                                    <td><?=$data[0]['ten_loai']?></td>
                                </tr>
                                <tr>
                                    <td>Loại điểm/tín chỉ</td>
                                    <td><?=$data[0]['ten_loaisl']?></td>
                                </tr>
                                <tr>
                                    <td>Số tín chỉ</td>
                                    <td><?=$data[0]['sotinchi']?></td>
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
                               if(($data[0]['trangthai']==0 && $start <= date("Y-m-d") && $end >= date("Y-m-d")) || (current_user_can('administrator'))): 
                            ?>
                            <th>Sửa vị trí</th>
                          
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
                               
                               if(($data[0]['trangthai']==0 && $start <= date("Y-m-d") && $end >= date("Y-m-d")) || (current_user_can('administrator'))): 

                                    ?>
            <td>
                <form action="<?=home_url("/doivitri")?>" method="post">
                <input type="hidden" name="cbdt_id" class="form-control"  value="<?=$ma_detai?>"/>
                <input type="hidden" class="form-control" name="macb" value="<?=$row['cbctid']?>"/>
                <input type="hidden" class="form-control" name="tencb" value="<?=$user->last_name." ".$user->first_name?>"/>
                <input type="hidden" class="form-control" name="tenvtr" value="<?=$row['ten_loaivt']?>"/>
                <input type="hidden" class="form-control" name="loainckh" value="congtrinh"/>
                <input type="submit" value="Sửa"  name="editBtn" class="btn btn-secondary">
                </form>

            </td>
            <td> <form method="POST">
             <input type="hidden" name="cbctid" class="form-control" name="time_mins" value="<?=$row['cbctid']?>"/>
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
                    <a href="<?=home_url("/duyetcongtrinh/")?>" class="text-decoration-none btn btn-info">Trở về trang duyệt công trình</a>
                    <?php
                    
                        endif;
                        if( current_user_can('subscriber')):
                    ?>
                    <a href="<?=home_url("/qlctrcanhan/")?>" class="text-decoration-none btn btn-info">Trở về trang công trình cá nhân</a>

                    <?php endif;?>
                    <a href="<?=home_url()?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>

                </div> <!--container-->

        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
