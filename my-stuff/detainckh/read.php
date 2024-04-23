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


	$sql = "SELECT * FROM `DeTai_CanBo` as dt inner join `DeTai_NCKH` as dtnc on dt.ma_dtnckh=dtnc.ma_dtnckh where dt.macb=$macb";
	$current_page = isset($_GET['pg']) ? $_GET['pg'] : 1;
	$limit = 10;
	$re = $conn->query($sql);
	error_log('sql = ' . $sql);
	$sql2 = "SELECT `start`,`end` FROM `deadline`";
error_log('sql2 = ' . $sql2);
$re2 = $conn->query($sql2);
$data2 = $re2->fetch_all(MYSQLI_ASSOC);
$start = $data2[0]['start'];
$end = $data2[0]['end'];

	$total_records = $re->num_rows;
	$total_page = ceil($total_records / $limit);

	// Giới hạn current_page trong khoảng 1 đến total_page
	if ($current_page > $total_page) {
		$current_page = $total_page;
	} else if ($current_page < 1) {
		$current_page = 1;
	}

	// Tìm Start
	$start = ($current_page - 1) * $limit;

	$sql .= " limit $start, $limit";
	$re = $conn->query($sql);

	error_log('sql = ' . $sql);
	$pagename = '/detaichitiet/';

	// webpage form starts here
	echo "<tbody>";
	echo "<thead>";
	echo "<th>Tên đề tài NCKH</th><th>Bắt đầu</th><th>Kết thúc</th><th>Số lượng</th><th>Vị trí</th><th>Minh chứng</th><th>Trạng thái</th><th>Thao tác</th><th></th>";
	echo "</thead>";
	if ($re != false && $re->num_rows > 0) :
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
		if($row['trangthai'] == 0 && $start <= date("Y/m/d") && $end >= date("Y/m/d")){
			echo '<td><form method="POST" action="'.home_url().'/my-stuff/detainckh/delete.php?id=' . $row['ma_dtnckh'] . '" onsubmit="return confirmDesactiv()">
			<input type="submit" class="btn btn-danger" value="Xóa">
	</form></td>';
		}
		
		// echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_dtnckh"] . '">Update</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
	}
	else :
		echo "<tr>";
		echo "<td  colspan='6' class='text-center'><i>Không dữ liệu phù hợp</i></td>";
		echo "</tr>";
		echo "</tbody>";
	endif;
	?>
	<style>
		.center {
			text-align: center;
		}

		.pagination {
			display: inline-block;
		}

		.pagination a {
			color: black;
			float: left;
			padding: 8px 16px;
			text-decoration: none;
			transition: background-color .3s;
			border: 1px solid #ddd;
			margin: 0 4px;
		}

		.pagination a.active {
			background-color: #4CAF50;
			color: white;
			border: 1px solid #4CAF50;
		}
	</style>
	<div class="center">
		<div class="pagination">
			<?php
			// PHẦN HIỂN THỊ PHÂN TRANG
			// BƯỚC 7: HIỂN THỊ PHÂN TRANG
			if ($re) :
				// nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
				if ($current_page > 1 && $total_page > 1) {
					
					$str = 'pg=' . ($current_page - 1);
					
					echo '<a href=?'.$str.'>&laquo;</a> ';

				}

				// Lặp khoảng giữa
				for ($i = 1; $i <= $total_page; $i++) {
					// Nếu là trang hiện tại thì hiển thị thẻ span
					// ngược lại hiển thị thẻ a
					if ($i == $current_page) {
						
						echo '<a href="#" class="active">' . $i . '</a>';
					} else {
						
						$str = 'pg=' . $i;
					
					echo '<a href=?'.$str.'>'.$i.'</a> ';
					}
				}

				// nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
				if ($current_page < $total_page && $total_page > 1) {
					$str = 'pg=' . ($current_page + 1);
					
					echo '<a href=?'.$str.'>&raquo;</a> ';
				}
			endif;
			?>
		</div>
	</div>
<?php

	$conn->close();
