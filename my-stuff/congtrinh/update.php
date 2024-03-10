<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';

// $user_now = get_current_user_id();
// error_log("current user=".$user_now);

// error_log("workout id = ".$_POST['id']);

$a = $_POST['ten_ctr'];
$b = $_POST['thoigian_hoanthanh'];
$c = $_POST['ten_tc_ky_nxb'];
$d = $_POST['sluong_thamgia'];
$e = $_POST['ma_loaisltc'];
$f = $_POST['ma_nh'];
$g = $_POST['minhchung'];
$id = $_POST['ma_ctr'];

$sql = "UPDATE `CongTrinh_Khac` set ten_ctr='".$a."', thoigian_hoanthanh='".$b."',
ten_tc_ky_nxb='".$c."' , sluong_thamgia=".$d.",
ma_loaisltc='".$e."', ma_nh='".$f."', minhchung='".$g."' where ma_ctr=" . $id;
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
header ("location: $pagename");


?>