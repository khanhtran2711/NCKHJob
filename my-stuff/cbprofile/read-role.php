<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';

$sql2 = "SELECT ma_cb,user_id,vaitro_noibo,user_email FROM `Canbo` c INNER JOIN `realdev_users` usr on c.user_id=usr.ID WHERE `vaitro_noibo`=1;";
$re = $conn->query($sql2);

error_log('sql = ' . $sql2);
echo "<tbody>";
echo "<thead>";
echo "<th>Họ tên cán bộ</th><th>Email</th><th></th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {

	echo "<tr>";
	$user = new WP_User($row['user_id']);
		
	echo "<td>" . $user->last_name." ".$user->first_name . "</td>";
	echo "<td>" . $row['user_email'] . "</td>";
	// echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_dtnckh"] . '">Update</a></td>';
	echo '<td> <a class="btn btn-danger" href="'.home_url().'/my-stuff/cbprofile/delete-role.php?id=' . $row['ma_cb'] . '">Xóa</a></td>';
	echo "</tr>";
	echo "</tbody>";
}

$conn->close();
