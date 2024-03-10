<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';

// $user_now = get_current_user_id();
// error_log("current user=".$user_now);

// error_log("workout id = ".$_POST['id']);

$a = $_POST['ten_gt'];
$e = $_POST['ma_loaigt'];
$f = $_POST['ma_nh'];
$g = $_POST['minhchung'];
$id = $_POST['ma_gt'];

$sql = "UPDATE `$tablename` set ten_gt='".$a."', minhchung='".$g."',
ma_loaigt='".$e."', ma_nh='".$f."' where ma_gt=" . $id;
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();

$url = "/giaithuongchitiet/?id=".$id;
$url1 = home_url($url);
echo $url1;


?>