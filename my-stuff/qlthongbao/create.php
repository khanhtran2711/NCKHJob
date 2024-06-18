<?php
include('../../mydbfile.php');

$a = $_POST['noidung'];
$b =$_POST['link'];
$c = $_POST['ngaydang'];


$sql = "INSERT INTO `thongbao`(`noidung`, `link`, `trangthai`, `ngaydang`) VALUES ('$a','$b',0,'$c')";


error_log($sql);
$conn->query($sql);
$conn->close();

?>