<?php
include('../../mydbfile.php');
include('config.php');

$a = $_POST['ten_cd'];
$b = $_POST['dinhmuc'];
$c = $_POST['thoigian_apdung'];
$d = $_POST['ma_nh'];


$sql = "INSERT INTO `$tablename`( `ten_cd`, `dinhmuc`, `thoigian_apdung`, `manh` ) VALUES ('$a','$b','$c',$d)";


error_log($sql);
$conn->query($sql);
$conn->close();

echo "add successful";

?>