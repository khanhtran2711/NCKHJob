<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';


$sql = "SELECT * FROM `$tablename`";

$re = $conn->query($sql);

error_log('sql = ' . $sql);
$pagename = '/giaithuongchitiet/';
// webpage form starts here
echo "<tbody>";
echo "<thead>";
echo "<th>Tên giải thưởng</th><th>Trạng thái</th><th>Xem chi tiết</th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row['ten_gt'] . "</td>";
		echo "<td>" . (($row['trangthai']==0)?'Chưa duyệt':'Đã duyệt') . "</td>";
		echo '<td><a class="btn btn-info" href="'.home_url($pagename).'?id=' . $row["ma_gt"] . '">Xem</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
		
	
}
$conn->close();