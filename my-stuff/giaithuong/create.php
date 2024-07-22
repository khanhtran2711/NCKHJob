<?php
include('../../mydbfile.php');
global $wpdb;
include '../../wp-load.php';
include 'config.php';


$a = $_POST['ten_gt'];
$b = $_POST['thoigian_nhan'];
$d = $_POST['sluong_thamgia'];
$e = $_POST['ma_loaigt'];
$namhoc = $_POST['ma_nh'];
$querysql = "SELECT ma_nh FROM NamHoc where namhoc = '$namhoc'";
error_log($querysql);
$re = $conn->query($querysql);
$row = $re->fetch_row();
$f = $row[0];
$g = $_POST['minhchung'];
$i = $_POST['ten_loaivt'];
$id = time() + rand( 30, 86400 * 3 );  

$sql = "INSERT INTO `$tablename`(`ten_gt`, `ma_nh`, `ma_loaigt`, `trangthai`, `minhchung`,`ma_gt`,`thoigian_nhan`,`sluong_thamgia`) VALUES ('$a','$f','$e',0,'$g',$id,'$b',$d)";
error_log($sql);
if ($conn->query($sql) === TRUE) {
    $ma_cb = $_POST['user_id'];
    $sql2 = "INSERT INTO `CanBo_GiaiThuong`(`ma_gt`, `ma_cb`, `ten_loaivt`)VALUES ('$id',$ma_cb,'$i')";
   error_log($sql2); 
    $conn->query($sql2);
    $conn->close();
}
echo home_url('/qlgtcanhan/');

?>