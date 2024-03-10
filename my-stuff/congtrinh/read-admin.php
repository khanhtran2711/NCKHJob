<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';


$sql = "SELECT * FROM `$tablename`";

$re = $conn->query($sql);

error_log('sql = ' . $sql);
$pagename = '/congtrinhchitiet/';
// webpage form starts here
echo "<tbody>";
echo "<thead>";
echo "<th>Tên công trình NCKH</th><th>Hoàn thành</th><th>Tên kỷ yếu</th><th>Trạng thái</th><th>Xem chi tiết</th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row['ten_ctr'] . "</td>";
		echo "<td>" . $row['thoigian_hoanthanh'] . "</td>";
		echo "<td>" . $row['ten_tc_ky_nxb'] . "</td>";
		echo "<td>" . (($row['trangthai']==0)?'Chưa duyệt':'Đã duyệt') . "</td>";
		echo '<td><a class="btn btn-info" href="'.home_url($pagename).'?id=' . $row["ma_ctr"] . '">Xem</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
		
	
}
$conn->close();