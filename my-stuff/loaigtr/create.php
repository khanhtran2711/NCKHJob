<?php
include('../../mydbfile.php');
global $wpdb;
include '../../wp-load.php';
include 'config.php';
$a = $_POST['ten_gtr'];
$b = $_POST['mucgiam'];
$c = $_POST['thoigian_apdung'];


$sql = "INSERT INTO `$tablename` ( `ten_gtr`, `mucgiam`, `thoigian_apdung`) VALUES ('$a',$b,'$c')";


error_log($sql);
$conn->query($sql);
$conn->close();

echo "add successful";

?>