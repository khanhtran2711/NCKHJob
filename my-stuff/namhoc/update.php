<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';
$pagename = home_url("/namhoc/");

// $user_now = get_current_user_id();
// error_log("current user=".$user_now);

// error_log("workout id = ".$_POST['id']);

$a = $_POST['namhoc'];
$sql = "UPDATE `NamHoc` set namhoc='".$a."' where ma_nh=" . $id;
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
header ("location: $pagename");


?>