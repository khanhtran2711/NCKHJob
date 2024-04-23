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
echo "<th>Tên chức danh</th><th>Định mức</th><th>Thời gian áp dụng</th><th></
th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
	if (isset($_GET['id'])) {
		if ($row['ma_cd'] == $_GET['id']) {
			echo '<tr><td colspan="5"><form action="'.home_url().'/my-stuff/chucdanh/update.php" method="POST">';
			echo '<table>';
			echo '<tr><td><input class="form-control" id="ten_cd" name="ten_cd" type="text" value="' . $row['ten_cd'] . '"></td>';
			echo '<td><input class="form-control" id="dinhmuc" name="dinhmuc" type="text"  value="' . $row['dinhmuc'] . '"></td>';
			echo '<td><input class="form-control" id="thoigian_apdung" name="thoigian_apdung" type="date" value="' . $row['thoigian_apdung'] . '"></td>';

			echo '<td><input type="hidden" name="ma_cd" value="' . $row['ma_cd'] . '"><input type="submit"  value="Lưu" class="btn btn-primary"></td>';
			echo '</tr>';
			echo '</form>';
			echo '</td></td>';
		}
	} else {
		echo "<tr>";
		echo "<td>" . $row['ten_cd'] . "</td>";
		echo "<td>" . $row['dinhmuc'] . "</td>";
		echo "<td>" . $row['thoigian_apdung'] . "</td>";
		echo '<td><a class="btn btn-info" href="'.home_url("/chucdanh/").'?id=' . $row["ma_cd"] . '">Sửa</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
		
	}
}
$conn->close();