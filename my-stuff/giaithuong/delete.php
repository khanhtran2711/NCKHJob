<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';

// $user_now = get_current_user_id();
// error_log("current user=".$user_now);

// error_log("workout id = ".$_GET['id']);
if(isset($_GET['id'])){
    
    $id = $_GET['id'];
    // echo $id; 
    $sql = "DELETE FROM `CanBo_GiaiThuong` WHERE `ma_gt` = " . $id;
        
    error_log('sql = '.$sql);
    $result = $conn->query($sql);
    $sql = "DELETE FROM `GiaiThuong` WHERE `ma_gt` = " . $id;
    
    error_log('sql = '.$sql);
    $result = $conn->query($sql);
    $conn->close();

    header ("location: ".home_url("/duyetgiaithuong/"));

}


?>