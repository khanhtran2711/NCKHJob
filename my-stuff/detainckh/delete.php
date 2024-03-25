<?php
include'../../mydbfile.php';
global $wpdb;
include '../../wp-load.php';
include 'config.php';
?>

<?php
// function prompt(){
//     echo ('<script>
//     var jsChoose = confirm("are you sure?");
    
//     document.getElementById("inputBoolean").value = jsChoose;
    
//     document.getElementById("myForm").submit();
//     </script>');
// }
// // $user_now = get_current_user_id();
// // error_log("current user=".$user_now);

// // error_log("workout id = ".$_GET['id']);

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