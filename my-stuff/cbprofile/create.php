<?php
include('../../mydbfile.php');
global $wpdb;
include '../../wp-load.php';
$a = $_POST['ma_cd'];

$ma_cb = $_POST['ma_cb'];

$sql = "INSERT INTO `CanBo_ChucDanh`(`ma_cb`, `ma_cd`, `thoigiannhan`) VALUES ('$ma_cb','$a',NOW())";
error_log($sql);
$conn->query($sql);
if(isset($_POST['ma_khoa'])){
    $b = $_POST['ma_khoa'];
    $sql1 = "UPDATE `Canbo` SET `ma_khoa`= $b WHERE `ma_cb` = $ma_cb";
    error_log($sql1);
    $conn->query($sql1);
}



$conn->close();

echo home_url('/cbprofile/');

?>