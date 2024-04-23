<?php
include '../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';


$id = $_GET['id'];
$sql = "UPDATE `CanBo_GiamTru` SET trangthaiduyet=2, trangthaisudung=0 WHERE id=$id";
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
header ("location: ".home_url('/duyetgiamtru/'));


?>