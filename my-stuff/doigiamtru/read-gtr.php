<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

echo '<option value="0">Chọn loại giảm trừ</option>';
$manh = trim($_GET['manh']);
$sql = "SELECT * FROM `LoaiGiamTru` where manh = $manh";
$re = $conn->query($sql);
while ($row = $re->fetch_assoc()) {
	$timecheck = strtotime($row['thoigian_apdung']);
	
		echo '<option value="'.$row['ma_gtr'].'">'.$row['ten_gtr'].'</option>';
}
?>
<?php	
$conn->close();

?>