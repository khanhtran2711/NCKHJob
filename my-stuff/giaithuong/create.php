<?php
include('../../mydbfile.php');
include ("./config.php");


$a = $_POST['ten_gt'];
$e = $_POST['ma_loaigt'];
$f = $_POST['ma_nh'];
$g = $_POST['minhchung'];
$id = time() + rand( 30, 86400 * 3 );  

$sql = "INSERT INTO `$tablename`(`ten_gt`, `ma_nh`, `ma_loaigt`, `trangthai`, `minhchung`,`ma_gt`) VALUES ('$a','$f','$e',0,'$g',$id)";

if ($conn->query($sql) === TRUE) {
    $ma_cb = $_POST['user_id'];
    $sql2 = "INSERT INTO `CanBo_GiaiThuong`(`ma_gt`, `ma_cb`, `thoigiannhan`)VALUES ('$id','$ma_cb',NOW())";
    error_log($sql2);
    $conn->query($sql2);
    $conn->close();
}
echo $id;

?>