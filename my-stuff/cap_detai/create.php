<?php
include('../../mydbfile.php');

$a = $_POST['ten_cdt'];
$b = $_POST['giochuan'];
$c = $_POST['thoigian_apdung'];
$d = $_POST['ma_nh'];

$sql = "INSERT INTO `CapDeTai`( `ten_cdt`, `giochuan`, `thoigian_apdung`, `manh` ) VALUES ('$a','$b','$c',$d)";


error_log($sql);
$conn->query($sql);
$conn->close();

echo "add successful";

?>