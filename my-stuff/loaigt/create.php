<?php
include('../../mydbfile.php');
global $wpdb;
include '../../wp-load.php';
include 'config.php';
$a = $_POST['ten_loaigt'];
$b = $_POST['heso_loaigt'];
$c = $_POST['thoigian_apdung'];
$d = $_POST['ma_nh'];

$sql = "INSERT INTO `$tablename` ( `ten_loaigt`, `heso_loaigt`, `thoigian_apdung`,`manh` ) VALUES ('$a','$b','$c',$d)";

error_log($sql);
$conn->query($sql);
$conn->close();

echo "add successful";

?>