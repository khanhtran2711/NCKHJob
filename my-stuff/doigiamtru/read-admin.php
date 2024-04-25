<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

// include 'config.php';

$sql = "SELECT cbgtr.id,user_id, gtr.ten_gtr, thoigiannhan, sothang FROM `CanBo_GiamTru` cbgtr INNER join `Canbo` c ON c.ma_cb=cbgtr.ma_cb INNER JOIN `realdev_users` usr on c.user_id=usr.ID INNER JOIN `LoaiGiamTru` gtr ON gtr.ma_gtr=cbgtr.ma_gtr WHERE trangthaiduyet=0";

$current_page = isset($_GET['pg']) ? $_GET['pg'] : 1;
	$limit = 10;
	$re = $conn->query($sql);
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

// webpage form starts here
echo "<tbody>";
echo "<thead>";
echo "<th>Họ và tên</th><th>Loại giảm trừ</th><th>Số tháng</th><th>Thời gian nhận</th><th colspan='2' style='text-align: center'>Thao tác</th>";
echo "</thead>";
if ($re != false && $re->num_rows > 0) {
while ($row = $re->fetch_assoc()) {
	
		echo "<tr>";
		 $user = new WP_User($row['user_id']);
		
		echo "<td>" . $user->last_name." ".$user->first_name . "</td>";
		echo "<td>" . $row['ten_gtr'] . "</td>";
        echo "<td>" . $row['sothang'] . "</td>";
		echo "<td>" . $row['thoigiannhan'] . "</td>";
		echo '<td><a class="btn btn-info" href="' . home_url('/duyetgiamtru') . '?id=' . $row["id"] . '">Duyệt</a> </td>';
        echo '<td><form method="POST" action="' . home_url() . '/my-stuff/doigiamtru/update-admin.php?id=' . $row['id'] . '" onsubmit="return confirmRefuse()">
        <input type="submit" class="btn btn-danger" value="Không duyệt">
</form></td>';
		echo "</tr>";
		echo "</tbody>";
}
}else{
	echo "<tr>";
		
		echo "<td colspan='4' class='text-center'> Không có dữ liệu phù hợp </td>";
		echo "</tr>";
		echo "</tbody>";
}

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