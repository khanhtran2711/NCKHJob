<?php
include('../../mydbfile.php');
global $wpdb;
include '../../wp-load.php';
include 'config.php';

$a = $_POST['ten_ctr'];
$b = $_POST['thoigian_hoanthanh'];
$c = $_POST['ten_tc_ky_nxb'];
$d = $_POST['sluong_thamgia'];
$e = $_POST['ma_loaisltc'];
$f = $_POST['ma_nh'];
$g = $_POST['minhchung'];
$id = time() + rand( 30, 86400 * 3 );  

$sql = "INSERT INTO `$tablename`(`ten_ctr`, `thoigian_hoanthanh`, `ten_tc_ky_nxb`, `sluong_thamgia`, `ma_loaisltc`, `ma_nh`,`ma_ctr`, `trangthai`, `minhchung`) VALUES ('$a','$b','$c',$d,$e,$f,$id,0,'$g')";

if ($conn->query($sql) === TRUE) {
    $ma_cb = $_POST['user_id'];
    $sql2 = "INSERT INTO `CanBo_Ctr`(`ten_loaivt`, `ma_cb`, `ma_ctr`) VALUES ('TV chính',$ma_cb,$id)";
    error_log($sql2);
    $conn->query($sql2);
    $conn->close();
}
echo $id;

?>