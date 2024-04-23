<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';

// $user_now = get_current_user_id();
// error_log("current user=".$user_now);

// error_log("workout id = ".$_POST['id']);
$pagename = home_url("/loaigt/");
$a = $_POST['ten_loaigt'];
$b = $_POST['heso_loaigt'];
$c = $_POST['thoigian_apdung'];
$id = $_POST['ma_loaigt'];
$sql = "update `$tablename` set ten_loaigt='".$a."', heso_loaigt='".$b."',
thoigian_apdung='".$c."' where ma_loaigt=" . $id;
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
header ("location: $pagename");


?>