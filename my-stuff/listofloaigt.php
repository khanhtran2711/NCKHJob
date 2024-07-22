<?php
include '../mydbfile.php';

global $wpdb;
include '../wp-load.php';


$namhoc = $_GET['nh'];
$sql = "SELECT * FROM `LoaiGiaiThuong` a INNER JOIN `NamHoc` nh ON a.manh=nh.ma_nh WHERE nh.namhoc = '$namhoc'";
$re = $conn->query($sql);

error_log('sql = ' . $sql);

	$rows = $re->num_rows;
 
	if($rows > 0){
		echo '<option selected value="0">Chọn loại giải thưởng</option>';
		while($fetch = $re->fetch_assoc()){
			
				echo "<option value='".$fetch['ma_loaigt']."'>".$fetch['ten_loaigt']."</option>";
			
			
		}
	}else{
		$sql = "SELECT * FROM `LoaiGiaiThuong` cdt INNER JOIN `NamHoc` nh ON cdt.manh=nh.ma_nh where namhoc = (SELECT MAX(namhoc) FROM `LoaiGiaiThuong` cdt INNER JOIN `NamHoc` nh ON cdt.manh=nh.ma_nh) ORDER by namhoc DESC;";
		$re = $conn->query($sql);

		error_log('sql = ' . $sql);
		echo '<option selected value="0">Chọn loại giải thưởng</option>';
		while($fetch = $re->fetch_assoc()){
			
				echo "<option value='".$fetch['ma_loaigt']."'>".$fetch['ten_loaigt']."</option>";
			
			
		}
	}
    