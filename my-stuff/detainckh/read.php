<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';




	$user = get_current_user_id();
	$cbid = "SELECT `ma_cb`,`ma_khoa` FROM `Canbo` WHERE `user_id` = $user";
	error_log('sql = ' . $cbid);
	$re3 = $conn->query($cbid);
	$data3 = $re3->fetch_all(MYSQLI_ASSOC);
	$macb = $data3[0]['ma_cb'];


	$sql2 = "SELECT * FROM `DeTai_CanBo` as dt inner join `DeTai_NCKH` as dtnc on dt.ma_dtnckh=dtnc.ma_dtnckh where dt.macb=$macb";
	$re = $conn->query($sql2);
	$pagename = '/detaichitiet/';

	error_log('sql = ' . $sql2);
	// webpage form starts here
	echo "<tbody>";
	echo "<thead>";
	echo "<th>Tên đề tài NCKH</th><th>Bắt đầu</th><th>Kết thúc</th><th>Số lượng</th><th>Vị trí</th><th>Minh chứng</th><th>Trạng thái</th><th>Xem chi tiết</th>";
	echo "</thead>";
	while ($row = $re->fetch_assoc()) {

		echo "<tr>";
		echo "<td>" . $row['ten_dtnckh'] . "</td>";
		echo "<td>" . $row['nam_batdau'] . "</td>";
		echo "<td>" . $row['nam_kethuc'] . "</td>";
		echo "<td>" . $row['sluong_thamgia'] . "</td>";
		echo "<td>" . $row['ten_loaivt'] . "</td>";
		echo "<td><a href='" . $row['minhchung'] . "'>Xem</a></td>";
		echo "<td>" . (($row['trangthai'] == 0) ? 'Chưa duyệt' : 'Đã duyệt') . "</td>";
		echo '<td><a class="btn btn-info" href="' . home_url($pagename) . '?id=' . $row["ma_dtnckh"] . '">Xem</a></td>';
		// echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_dtnckh"] . '">Update</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
	}
	$conn->close();
