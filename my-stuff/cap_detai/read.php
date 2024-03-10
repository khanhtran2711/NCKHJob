<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';

$sql = "SELECT * FROM `CapDeTai`";

$re = $conn->query($sql);

error_log('sql = ' . $sql);
// webpage form starts here
echo "<tbody>";
echo "<thead>";
echo "<th>Tên Đề Tài</th><th>Giờ Chuẩn</th><th>Thời gian áp dụng</th><th>Update</
th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
	if (isset($_GET['id'])) {
		if ($row['ma_cdt'] == $_GET['id']) {
			echo '<tr><td colspan="5"><form action="'.$mystufflink.$foldername.'/update.php" method="POST">';
			echo '<table>';
			echo '<tr><td><input class="form-control" id="ten_cdt" name="ten_cdt" type="text" value="' . $row['ten_cdt'] . '"></td>';
			echo '<td><input class="form-control" id="giochuan" name="giochuan" type="text"  value="' . $row['giochuan'] . '"></td>';
			echo '<td><input class="form-control" id="thoigian_apdung" name="thoigian_apdung" type="date" value="' . $row['thoigian_apdung'] . '"></td>';

			echo '<td><input type="hidden" name="ma_cdt" value="' . $row['ma_cdt'] . '"><input type="submit" value="Save"></td>';
			echo '</tr>';
			echo '</form>';
			echo '</td></td>';
		}
	} else {
		echo "<tr>";
		echo "<td>" . $row['ten_cdt'] . "</td>";
		echo "<td>" . $row['giochuan'] . "</td>";
		echo "<td>" . $row['thoigian_apdung'] . "</td>";
		echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_cdt"] . '">Update</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
		
	}
}
$conn->close();