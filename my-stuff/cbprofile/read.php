<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';

$sql2 = "SELECT kpb.ten_khoa FROM `Khoa_PB` kpb inner join `Canbo` as cb on kpb.ma_khoa=cb.ma_khoa WHERE cb.user_id=".get_current_user_id();
		$re2 = $conn->query($sql2);

		error_log('sql = ' . $sql2);
		echo '<table class="table table-striped" id="records">';
		echo "<tbody>";
		echo "<thead>";
		echo "<th>Khoa-PB trực thuộc</th>";
		echo "</thead>";
		
		while ($row = $re2->fetch_assoc()) {
		echo "<tr>";
				echo "<td>" . $row['ten_khoa'] . "</td>";
				// echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_cdt"] . '">Update</a></td>';
				// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
				echo "</tr>";
		}
				echo "</tbody>";
				echo "</table>";



$sql = "SELECT cd.ten_cd,cbcd.thoigiannhan FROM `CanBo_ChucDanh` as cbcd inner join `ChucDanh` as cd on cbcd.ma_cd = cd.ma_cd inner join `Canbo` as cb on cbcd.ma_cb=cb.ma_cb INNER JOIN `realdev_users` as u on u.ID=cb.user_id WHERE cb.user_id=".get_current_user_id();

$re = $conn->query($sql);

error_log('sql = ' . $sql);
// webpage form starts here
echo "<tbody>";
echo "<thead>";
echo "<th>Chức danh hiện tại</th><th>Thời gian áp dụng</th>";
echo "</thead>";

while ($row = $re->fetch_assoc()) {
echo "<tr>";
		echo "<td>" . $row['ten_cd'] . "</td>";
		echo "<td>" . $row['thoigiannhan'] . "</td>";
		// echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_cdt"] . '">Update</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
}
		echo "</tbody>";


		
$conn->close();