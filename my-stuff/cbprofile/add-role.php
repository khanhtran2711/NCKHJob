<?php
include('../../mydbfile.php');
global $wpdb;
include '../../wp-load.php';
$a = $_POST['email'];

$sql2 = "SELECT ma_cb FROM `Canbo` c INNER JOIN `realdev_users` usr on c.user_id=usr.ID WHERE `user_email`='$a'";

$re = $conn->query($sql2);
$row = $re->fetch_assoc();


$sql = "UPDATE `Canbo` SET `vaitro_noibo`= 1 WHERE `ma_cb`= " . $row['ma_cb'];
        
error_log('sql = '.$sql);

$result = $conn->query($sql);


$conn->close();

echo home_url('/qlrole/');

?>