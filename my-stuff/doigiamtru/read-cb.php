<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';


$uid = $_GET['uid'];

$sql = "SELECT * FROM `CanBo_GiamTru` cb INNER JOIN `LoaiGiamTru` lgt on cb.ma_gtr=lgt.ma_gtr WHERE ma_cb=".$uid;

$re = $conn->query($sql);

error_log('sql = ' . $sql);
// webpage form starts here
echo "<tbody>";
echo "<thead>";
echo "<th>Tên loại giảm trừ</th><th>Thời gian nhận</th><th>Trạng thái</th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
	
		echo "<tr>";
		echo "<td>" . $row['ten_gtr'] . "</td>";
		echo "<td>" . $row['thoigiannhan'] . "</td>";
		echo "<td>" . $row['trangthai'] . "</td>";
		
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
	
	
}
$conn->close();