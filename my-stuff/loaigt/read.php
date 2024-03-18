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
echo "<th>Tên loại giải thưởng</th><th>Hệ số</th><th>Thời gian áp dụng</th><th></
th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
	if (isset($_GET['id'])) {
		if ($row['ma_loaigt'] == $_GET['id']) {
			echo '<tr><td colspan="5"><form action="'.$mystufflink.$foldername.'/update.php" method="POST">';
			echo '<table>';
			echo '<tr><td><input class="form-control" id="ten_loaigt" name="ten_loaigt" type="text" value="' . $row['ten_loaigt'] . '"></td>';
			echo '<td><input class="form-control" id="heso_loaigt" name="heso_loaigt" type="text"  value="' . $row['heso_loaigt'] . '"></td>';
			echo '<td><input class="form-control" id="thoigian_apdung" name="thoigian_apdung" type="date" value="' . $row['thoigian_apdung'] . '"></td>';

			echo '<td><input type="hidden" name="ma_loaigt" value="' . $row['ma_loaigt'] . '"><input type="submit" value="Save"></td>';
			echo '</tr>';
			echo '</form>';
			echo '</td></td>';
		}
	} else {
		echo "<tr>";
		echo "<td>" . $row['ten_loaigt'] . "</td>";
		echo "<td>" . $row['heso_loaigt'] . "</td>";
		echo "<td>" . $row['thoigian_apdung'] . "</td>";
		echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_loaigt"] . '">Sửa</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
		
	}
}
$conn->close();