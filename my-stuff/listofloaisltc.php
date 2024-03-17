<?php
include '../mydbfile.php';

global $wpdb;
include '../wp-load.php';


$loaict = $_GET['id'];
$sql = "SELECT * FROM `LoaiSL_TC` WHERE `ma_loaict` = ".$loaict." and (YEAR(`thoigian_apdung`) = YEAR(NOW()) or thoigian_apdung >= DATE(str_to_date( concat( year( curdate( ) )-1 , '-', 9 , '-', 1 ) , '%Y-%m-%d' )));";

$re = $conn->query($sql);

error_log('sql = ' . $sql);

$list = array();
	$rows = $re->num_rows;
 
	if($rows > 0){
		while($fetch = $re->fetch_assoc()){
			echo "<option value='".$fetch['ma_loaisl']."'>".$fetch['ten_loaisl']."</option>";
		}
	}
    