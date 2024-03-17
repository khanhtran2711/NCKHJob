<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';


$sql = "SELECT * FROM `realdev_users`";

$re = $conn->query($sql);

error_log('sql = ' . $sql);

$list = array();
	$rows = $re->num_rows;
 
	if($rows > 0){
		while($fetch = $re->fetch_assoc()){
			if(!user_can( $fetch['ID'], "manage_options" ))
			{
				$data['value'] = $fetch['user_email'];
			 
				array_push($list, $data);
			}
		}
	}
 
	echo json_encode($list,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
