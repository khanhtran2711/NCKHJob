<?php
include('../../mydbfile.php');
global $wpdb;
include '../../wp-load.php';
$a = $_POST['ten_dtnckh'];
$b = $_POST['nam_batdau'];
$c = $_POST['nam_kethuc'];
$d = $_POST['sluong_thamgia'];
$e = $_POST['ma_cdt'];
$namhoc = $_POST['ma_nh'];
$querysql = "SELECT ma_nh FROM NamHoc where namhoc = '$namhoc'";
error_log($querysql);
$re = $conn->query($querysql);
$row = $re->fetch_row();
$f = $row[0]; 
$g = $_POST['minhchung'];
$h = $_POST['ten_loaivt'];
$id = time() + rand( 30, 86400 * 3 );  

$sql = "INSERT INTO `DeTai_NCKH`(`ten_dtnckh`, `nam_batdau`, `nam_kethuc`, `sluong_thamgia`, `ma_cdt`, `ma_nh`,`ma_dtnckh`,`trangthai`,`minhchung`) VALUES ('$a','$b','$c',$d,$e,$f,$id,0,'$g')";
error_log($sql);
if ($conn->query($sql) == TRUE) {
    $ma_cb = $_POST['user_id'];
    $sql2 = "INSERT INTO `DeTai_CanBo`(`ten_loaivt`, `macb`, `ma_dtnckh`) VALUES ('$h',$ma_cb,$id)";
    error_log($sql2);
    $conn->query($sql2);
    $conn->close();
}

echo home_url('/qldetaicanhan/');
// echo $id;

?>