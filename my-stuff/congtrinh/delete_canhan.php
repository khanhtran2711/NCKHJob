<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';

$user = get_current_user_id();
$cbid = "SELECT `ma_cb` FROM  `Canbo` cb WHERE user_id = $user";
error_log('sql = ' . $cbid);
$re3 = $conn->query($cbid);
if ($re3->num_rows > 0) {
    $data3 = $re3->fetch_all(MYSQLI_ASSOC);
    $macb = $data3[0]['ma_cb'];
    if(isset($_GET['id'])){
        
        $id = $_GET['id'];
        // echo $id; 
        $sql = "DELETE FROM `CanBo_Ctr` WHERE `ma_ctr` = $id and `ma_cb` = $macb";
            
        error_log('sql = '.$sql);
        $result = $conn->query($sql);
        
        $conn->close();

        header ("location: ".home_url("/qlctrcanhan/"));

    }
}


?>