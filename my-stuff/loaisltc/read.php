<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';

$sql = "SELECT * FROM `$tablename`";

$re = $conn->query($sql);

error_log('sql = ' . $sql);
// webpage form starts here
echo "<tbody>";
echo "<thead>";
echo "<th>Tên đơn vị tính/ mức điểm/giờ chuẩn</th><th>Giờ chuẩn</th><th>Thời gian áp dụng</th><th></
th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
	if (isset($_GET['id'])) {
		if ($row['ma_loaisl'] == $_GET['id']) {
			echo '<tr><td colspan="5"><form action="'.$mystufflink.$foldername.'/update.php" method="POST">';
			echo '<table>';
			echo '<tr><td><input class="form-control" id="ten_loaisl" name="ten_loaisl" type="text" value="' . $row['ten_loaisl'] . '"></td>';
			echo '<td><input class="form-control" id="giatri_sl" name="giatri_sl" type="text"  value="' . $row['giatri_sl'] . '"></td>';
			echo '<td><input class="form-control" id="thoigian_apdung" name="thoigian_apdung" type="date" value="' . $row['thoigian_apdung'] . '"></td>';

			echo '<td><input type="hidden" name="ma_loaisl" value="' . $row['ma_loaisl'] . '"><input type="submit" value="Save"></td>';
			echo '</tr>';
			echo '</form>';
			echo '</td></td>';
		}
	} else {
		echo "<tr>";
		echo "<td>" . $row['ten_loaisl'] . "</td>";
		echo "<td>" . $row['giatri_sl'] . "</td>";
		echo "<td>" . $row['thoigian_apdung'] . "</td>";
		echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_loaisl"] . '">Sửa</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
		
	}
}
$conn->close();