<?php
include '../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';


$a = $_POST['ma_cd'];
$id = $_POST['id'];
$sql = "UPDATE `CanBo_ChucDanh` SET `ma_cd`=$a,`thoigiannhan`=NOW() WHERE id=$id";
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
header ("location: ".home_url('/doichucdanh/'));


?>