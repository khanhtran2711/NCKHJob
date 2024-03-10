<?php
include('../../mydbfile.php');
global $wpdb;
include '../../wp-load.php';
include 'config.php';
$a = $_POST['ten_loai'];


$sql = "INSERT INTO `$tablename` ( `ten_loai`) VALUES ('$a')";


error_log($sql);
$conn->query($sql);
$conn->close();

echo "add successful";

?>