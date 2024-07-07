<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';

$pagename = home_url("/loaigt/");
// $user_now = get_current_user_id();
// error_log("current user=".$user_now);

// error_log("workout id = ".$_GET['id']);
$id = $_GET['id'];
$sql = "DELETE FROM `$tablename` WHERE `ma_loaigt` = " . $id;
// next line is for debugging, they appear in the php_error.log file
// comment it out before putting into production
error_log('sql = '.$sql);
$result = $conn->query($sql);
if (!$result) {
    if($conn->errno==1451){
        $conn->close();
        echo '<script>alert("Thất bại! Bạn không thể xóa do có dữ liệu liên quan");'; 
        echo "window.location.href = '$pagename' </script>";
    }
}else{
$conn->close();
header ("location: $pagename");
}

?>