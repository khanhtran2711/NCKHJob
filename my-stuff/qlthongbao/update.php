<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';
$pagename = home_url("/qlthongbao/");

// $user_now = get_current_user_id();
// error_log("current user=".$user_now);

// error_log("workout id = ".$_POST['id']);

$id = $_POST['id'];
$a = $_POST['noidung'];
$b =$_POST['link'];
$sql = "UPDATE `$tablename` SET `noidung`='$a',`link`='$b' WHERE `id`=" . $id;
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
header ("location: $pagename");


?>