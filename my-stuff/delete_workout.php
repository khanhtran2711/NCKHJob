<?php
include'../mydbfiletest.php';
global $wpdb;
include '../wp-load.php';

$user_now = get_current_user_id();
error_log("current user=".$user_now);

error_log("workout id = ".$_GET['id']);
$id = $_GET['id'];
$sql = "DELETE FROM `workout` where id=" . $id. " and user_id=" . $user_now;
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
header ("location: /NCKH/workout/");


?>