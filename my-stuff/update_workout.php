<?php
include'../mydbfiletest.php';
global $wpdb;
include '../wp-load.php';

$user_now = get_current_user_id();
error_log("current user=".$user_now);

error_log("workout id = ".$_POST['id']);

$workout_date = $_POST['workout_date'];
$activity = $_POST['activity'];
$time_mins = $_POST['time_mins'];
$id = $_POST['id'];
$sql = "update `workout` set workout_date='".$workout_date."', activity='".$activity."',
time_mins='".$time_mins."' where id=" . $id. " and user_id=" . $user_now;
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
header ("location: /NCKH/workout/");


?>