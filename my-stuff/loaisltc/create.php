<?php
include('../../mydbfile.php');
global $wpdb;
include '../../wp-load.php';
include 'config.php';

$a = $_POST['ten_loaisl'];
$b = $_POST['giatri_sl'];
$c = $_POST['thoigian_apdung'];
$d = $_POST['ma_loaict'];
$e = $_POST['ma_nh'];
$sql = "INSERT INTO `$tablename` ( `ten_loaisl`, `giatri_sl`, `thoigian_apdung`,`ma_loaict`,`manh`) VALUES ('$a',$b,'$c','$d','$e')";


echo error_log($sql);
$conn->query($sql);
$conn->close();

echo "add successful";

?>