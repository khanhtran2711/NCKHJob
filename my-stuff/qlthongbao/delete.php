<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';


$pagename = home_url("/qlthongbao/");
// $user_now = get_current_user_id();
// error_log("current user=".$user_now);

// error_log("workout id = ".$_GET['id']);
$id = $_GET['id'];
$sql = "DELETE FROM `$tablename` WHERE `id` = " . $id;
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
header ("location: $pagename");


?>