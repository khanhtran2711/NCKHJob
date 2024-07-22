<?php
include '../mydbfile.php';

global $wpdb;
include '../wp-load.php';


$loaict = $_GET['id'];
$namhoc = $_GET['nh'];
$sql = "SELECT * FROM `LoaiSL_TC` a INNER JOIN `NamHoc` nh ON a.manh=nh.ma_nh WHERE nh.namhoc = '$namhoc' and ma_loaict = $loaict;";
$re = $conn->query($sql);

error_log('sql = ' . $sql);

	$rows = $re->num_rows;
 
	if($rows > 0){
		echo '<option selected value="0">Chọn loại đơn vị/mức điểm/giờ chuẩn</option>';
		while($fetch = $re->fetch_assoc()){
			
				echo "<option value='".$fetch['ma_loaisl']."'>".$fetch['ten_loaisl']."</option>";
			
			
		}
	}else{
		$sql = "SELECT * FROM `LoaiSL_TC` cdt INNER JOIN `NamHoc` nh ON cdt.manh=nh.ma_nh where namhoc = (SELECT MAX(namhoc) FROM `	LoaiCongTrinh_Khac` cdt INNER JOIN `NamHoc` nh ON cdt.manh=nh.ma_nh) and ma_loaict = $loaict ORDER by namhoc DESC;";
		$re = $conn->query($sql);

		error_log('sql = ' . $sql);
		echo '<option selected value="0">Chọn loại đơn vị/mức điểm/giờ chuẩn</option>';
		while($fetch = $re->fetch_assoc()){
			
				echo "<option value='".$fetch['ma_loaisl']."'>".$fetch['ten_loaisl']."</option>";
			
			
		}
	}
    