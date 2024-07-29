<?php
include '../mydbfile.php';

global $wpdb;
include '../wp-load.php';



$namhoc = $_GET['nh'];
$sql = "SELECT loaictr.ma_loai, loaictr.ten_loai FROM `LoaiCongTrinh_Khac` loaictr INNER JOIN `LoaiSL_TC` loaisltc on loaictr.ma_loai=loaisltc.ma_loaict INNER JOIN `NamHoc` nh ON loaisltc.manh=nh.ma_nh WHERE nh.namhoc = '$namhoc';";

$re = $conn->query($sql);

error_log('sql = ' . $sql);

	$rows = $re->num_rows;
 
	if($rows > 0){
		echo '<option selected value="0">Chọn loại công trình</option>';
		while($fetch = $re->fetch_assoc()){
			
				echo "<option value='".$fetch['ma_loai']."'>".$fetch['ten_loai']."</option>";
			
			
		}
	}else{
		echo '<option selected value="0">Chọn loại công trình</option>';
	}
    