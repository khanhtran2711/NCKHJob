<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';

// $user_now = get_current_user_id();
// error_log("current user=".$user_now);

// error_log("workout id = ".$_POST['id']);

$a = $_POST['ten_dtnckh'];
$b = $_POST['nam_batdau'];
$c = $_POST['nam_kethuc'];
$d = $_POST['sluong_thamgia'];
$e = $_POST['ma_cdt'];
$f = $_POST['ma_nh'];
$id = $_POST['ma_dt'];

$sql = "UPDATE `DeTai_NCKH` set ten_dtnckh='".$a."', nam_batdau='".$b."',
nam_kethuc='".$c."' , sluong_thamgia='".$d."',
ma_cdt='".$e."', ma_nh='".$f."' where ma_dtnckh=" . $id;
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();

$url = "/detaichitiet/?id=".$id;
$url1 = home_url($url);
echo $url1;


?>