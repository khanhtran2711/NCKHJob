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
    $sql = "DELETE FROM `CanBo_ChucDanh` WHERE `id`= " . $id;
        
    error_log('sql = '.$sql);
    
    $result = $conn->query($sql);
    $conn->close();

    header ("location: ".home_url("/doichucdanh/"));

}


?>