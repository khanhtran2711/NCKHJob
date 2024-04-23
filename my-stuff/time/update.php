<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';

$sql = "UPDATE `deadline` SET";
if ($_POST['tg_batdau']!="" && $_POST['tg_ketthuc']!="") {
    $a = $_POST['tg_batdau'];
    $b = $_POST['tg_ketthuc'];
    $sql .= " `start`='$a',`end`='$b'";
}else if($_POST['tg_ketthuc']!=""){
    $b = $_POST['tg_ketthuc'];
    $sql .= " `end`='$b'";
}else{
    $a = $_POST['tg_batdau'];
   
    $sql .= " `start`='$a'";
}
$sql .= " WHERE id = 1";
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
$conn->close();
// header ("location: ".home_url("/qltime/"));


?>