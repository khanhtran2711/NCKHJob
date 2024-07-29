<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';

// $user_now = get_current_user_id();
// error_log("current user=".$user_now);

// error_log("workout id = ".$_POST['id']);

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
$id = $_POST['ma_gt'];

$sql = "UPDATE `$tablename` set ten_gt='".$a."', minhchung='".$g."',
ma_loaigt='".$e."', ma_nh='".$f."', `sluong_thamgia`='$d',`thoigian_nhan`='$b' where ma_gt=" . $id;

// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();

$url = "/giaithuongchitiet/?id=".$id;
$url1 = home_url($url);
echo $url1;


?>