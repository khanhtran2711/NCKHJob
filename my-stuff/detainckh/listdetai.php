<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';


$sql = "SELECT * FROM `DeTai_NCKH`";

$re = $conn->query($sql);

error_log('sql = ' . $sql);

$list = array();
	$rows = $re->num_rows;
 
	if($rows > 0){
		while($fetch = $re->fetch_assoc()){
			$data['value'] = $fetch['ten_dtnckh']; 
			array_push($list, $data);
		}
	}
 
	echo json_encode($list,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
