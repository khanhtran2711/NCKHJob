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
echo "<th>Tên loại giảm trừ</th><th>Hệ số</th><th>Thời gian áp dụng</th><th>Update</
th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
	if (isset($_GET['id'])) {
		if ($row['ma_gtr'] == $_GET['id']) {
			echo '<tr><td colspan="5"><form action="'.$mystufflink.$foldername.'/update.php" method="POST">';
			echo '<table>';
			echo '<tr><td><input class="form-control" id="ten_gtr" name="ten_gtr" type="text" value="' . $row['ten_gtr'] . '"></td>';
			echo '<td><input class="form-control" id="mucgiam" name="mucgiam" type="text"  value="' . $row['mucgiam'] . '"></td>';
			echo '<td><input class="form-control" id="thoigian_apdung" name="thoigian_apdung" type="date" value="' . $row['thoigian_apdung'] . '"></td>';

			echo '<td><input type="hidden" name="ma_gtr" value="' . $row['ma_gtr'] . '"><input type="submit" value="Save"></td>';
			echo '</tr>';
			echo '</form>';
			echo '</td></td>';
		}
	} else {
		echo "<tr>";
		echo "<td>" . $row['ten_gtr'] . "</td>";
		echo "<td>" . $row['mucgiam'] . "</td>";
		echo "<td>" . $row['thoigian_apdung'] . "</td>";
		echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_gtr"] . '">Update</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
	}
	
}
$conn->close();