<?php
include('../../mydbfile.php');
global $wpdb;
include '../../wp-load.php';
$a = $_POST['ma_gtr'];
$b = $_POST['uid'];
$c = $_POST['thoigiannhan'];




$sql = "UPDATE `CanBo_GiamTru` SET `trangthai`=0 WHERE `ma_cb` = ".$b;

error_log($sql);
$conn->query($sql);

$sql = "INSERT INTO `CanBo_GiamTru`(`ma_cb`, `ma_gtr`, `thoigiannhan`, `trangthai`) VALUES ($b,$a,'$c',1)";


error_log($sql);
$conn->query($sql);


$conn->close();

echo "add successful";

?>