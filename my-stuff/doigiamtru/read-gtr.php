<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

echo '<option value="0">Chọn loại giảm trừ</option>';
$manh = trim($_GET['manh']);
$sql = "SELECT * FROM `LoaiGiamTru` where manh = $manh";
$re = $conn->query($sql);
if ($re->num_rows >= 1) {
	while ($row = $re->fetch_assoc()) {
		$timecheck = strtotime($row['thoigian_apdung']);

		echo '<option value="' . $row['ma_gtr'] . '">' . $row['ten_gtr'] . '</option>';
	}
}else{
	$sql = "SELECT * FROM `LoaiGiamTru` cdt INNER JOIN `NamHoc` nh ON cdt.manh=nh.ma_nh where namhoc = (SELECT MAX(namhoc) FROM `LoaiGiamTru` cdt INNER JOIN `NamHoc` nh ON cdt.manh=nh.ma_nh) ORDER by namhoc DESC;";
	$re = $conn->query($sql);
	while ($row = $re->fetch_assoc()) {
		$timecheck = strtotime($row['thoigian_apdung']);

		echo '<option value="' . $row['ma_gtr'] . '">' . $row['ten_gtr'] . '</option>';
	}
}
?>
<?php
$conn->close();

?>