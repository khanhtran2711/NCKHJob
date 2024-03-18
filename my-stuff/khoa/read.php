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
echo "<th>Tên Khoa/ Phòng Ban</th><th></th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
	if (isset($_GET['id'])) {
		if ($row['ma_khoa'] == $_GET['id']) {
			echo '<tr><td colspan="5"><form action="'.$mystufflink.$foldername.'/update.php" method="POST">';
			echo '<table>';
			echo '<tr><td><input class="form-control" id="ten_khoa" name="ten_khoa" type="text" value="' . $row['ten_khoa'] . '"></td>';
			
			echo '<td><input type="hidden" name="ma_khoa" value="' . $row['ma_khoa'] . '"><input type="submit" value="Save"></td>';
			echo '</tr>';
			echo '</form>';
			echo '</td></td>';
		}
	} else {
		echo "<tr>";
		echo "<td>" . $row['ten_khoa'] . "</td>";
		echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_khoa"] . '">Sửa</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
		
	}
}
$conn->close();