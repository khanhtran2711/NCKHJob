<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';

$pagename = home_url("/congtrinh/");

// $user_now = get_current_user_id();
// error_log("current user=".$user_now);

// error_log("workout id = ".$_POST['id']);

$a = $_POST['ten_ctr'];
$b = $_POST['thoigian_hoanthanh'];
$c = $_POST['ten_tc_ky_nxb'];
$d = $_POST['sluong_thamgia'];
$e = $_POST['ma_loaisltc'];
$namhoc = $_POST['ma_nh'];
$querysql = "SELECT ma_nh FROM NamHoc where namhoc = '$namhoc'";
error_log($querysql);
$re = $conn->query($querysql);
$row = $re->fetch_row();
$f = $row[0];
$g = $_POST['minhchung'];
$h = $_POST['sotinchi'];
$id = $_POST['ma_ctr'];

$sql = "UPDATE `CongTrinh_Khac` set ten_ctr='".$a."', thoigian_hoanthanh='".$b."',
ten_tc_ky_nxb='".$c."' , sluong_thamgia=".$d.",
ma_loaisltc='".$e."', ma_nh='".$f."', minhchung='".$g."',sotinchi= $h  where ma_ctr=" . $id;
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
// header ("location: $pagename");
$url = "/congtrinhchitiet/?id=".$id;
$url1 = home_url($url);
echo $url1;

?>