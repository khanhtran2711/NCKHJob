<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';
?>

<?php

if(isset($_GET['id'])){
    
    $id = $_GET['id'];
    // echo $id; 
    $sql = "DELETE FROM `DeTai_CanBo` WHERE `ma_dtnckh` = " . $id;
        
    error_log('sql = '.$sql);
    $result = $conn->query($sql);
    $sql = "DELETE FROM `DeTai_NCKH` WHERE `ma_dtnckh` = " . $id;
    
    error_log('sql = '.$sql);
    $result = $conn->query($sql);
    $conn->close();

    header ("location: ".home_url("/duyetdetai/"));

}


?>