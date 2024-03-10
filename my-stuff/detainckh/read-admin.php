<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';


$sql = "SELECT * FROM `DeTai_NCKH`";

$re = $conn->query($sql);

error_log('sql = ' . $sql);
$pagename = '/detaichitiet/';
// webpage form starts here
echo "<tbody>";
echo "<thead>";
echo "<th>Tên đề tài NCKH</th><th>Bắt đầu</th><th>Kết thúc</th><th>Trạng thái</th><th>Xem chi tiết</th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row['ten_dtnckh'] . "</td>";
		echo "<td>" . $row['nam_batdau'] . "</td>";
		echo "<td>" . $row['nam_kethuc'] . "</td>";
		echo "<td>" . (($row['trangthai']==0)?'Chưa duyệt':'Đã duyệt') . "</td>";
		echo '<td><a class="btn btn-info" href="'.home_url($pagename).'?id=' . $row["ma_dtnckh"] . '">Xem</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
		
	
}
$conn->close();