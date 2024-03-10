<?php
include('../mydbfiletest.php');

$workoutdate = $_POST['workoutdate'];
$act = $_POST['activity'];
$time_mins = $_POST['time_mins'];
$user_id = $_POST['user_id'];


error_log("workoutdate=".$workoutdate);
error_log("activity=".$act);
error_log("time_mins=".$time_mins);
error_log("user_id=".$user_id);
$sql = "INSERT INTO `workout`(`user_id`, `workout_date`, `activity`, `time_mins`) VALUES ('$user_id','$workoutdate','$act','$time_mins')";


error_log($sql);
$conn->query($sql);
$conn->close();

echo "add successful";

?>