<?php
include '../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';


$a = $_POST['ma_gtr'];
$b = $_POST['sothang'];
$c = $_POST['ma_nh'];
$id = $_POST['id'];
$sql = "UPDATE `CanBo_GiamTru` SET `ma_gtr`=$a,`thoigiannhan`=NOW(),`sothang`=$b,`ma_nh`=$c WHERE id=$id";
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
header ("location: ".home_url('/doigiamtru/'));


?>