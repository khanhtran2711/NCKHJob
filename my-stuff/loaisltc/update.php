<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';

// $user_now = get_current_user_id();
// error_log("current user=".$user_now);

// error_log("workout id = ".$_POST['id']);

$a = $_POST['ten_loaisl'];

$b = $_POST['giatri_sl'];
$c = $_POST['thoigian_apdung'];
$id = $_POST['ma_loaisl'];
$d = $_POST['ma_loaict'];
$sql = "update `$tablename` set ten_loaisl='".$a."', giatri_sl='".$b."',
thoigian_apdung='".$c."' where ma_loaisl=" . $id;
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
header ("location: $pagename");


?>