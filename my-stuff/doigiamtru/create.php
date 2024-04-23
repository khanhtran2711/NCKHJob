<?php
include('../../mydbfile.php');
global $wpdb;
include '../../wp-load.php';
$a = $_POST['ma_gtr'];
$b = $_POST['uid'];
$c = $_POST['ma_nh'];
$d = $_POST['sothang'];


$sql = "INSERT INTO `CanBo_GiamTru`(`ma_cb`, `ma_gtr`, `thoigiannhan`, `trangthaiduyet`,`trangthaisudung`, `sothang`, `ma_nh`) VALUES ($b,$a,NOW(),0,0,$d,$c)";


error_log($sql);
$conn->query($sql);


$conn->close();

echo "add successful";

?>