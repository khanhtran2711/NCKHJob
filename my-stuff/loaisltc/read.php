<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';

$sql = "SELECT * FROM `LoaiSL_TC` lsl INNER JOIN `LoaiCongTrinh_Khac` lct on lct.ma_loai = lsl.ma_loaict ";

$current_page = isset($_GET['pg']) ? $_GET['pg'] : 1;
if(!isset($_GET['id'])){
	$limit = 5;
	$re = $conn->query($sql);
	error_log('sql = ' . $sql);

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
}else{
	$re = $conn->query($sql);

	error_log('sql = ' . $sql);
}
// webpage form starts here
echo "<tbody>";
echo "<thead>";
echo "<th>Tên đơn vị tính/ mức điểm/giờ chuẩn</th><th>Giờ chuẩn</th><th>Thời gian áp dụng</th><th>Tên loại công trình</th><th></th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
	if (isset($_GET['id'])) {
		if ($row['ma_loaisl'] == $_GET['id']) {
			echo '<tr><td colspan="5"><form action="'.home_url().'/my-stuff/loaisltc/update.php" method="POST">';
			echo '<table>';
			echo '<tr><td><input class="form-control" id="ten_loaisl" name="ten_loaisl" type="text" value="' . $row['ten_loaisl'] . '"></td>';
			echo '<td><input class="form-control" id="giatri_sl" name="giatri_sl" type="text"  value="' . $row['giatri_sl'] . '"></td>';
			echo '<td><input class="form-control" id="thoigian_apdung" name="thoigian_apdung" type="date" value="' . $row['thoigian_apdung'] . '"></td>';
			

			echo '<td><input type="hidden" name="ma_loaisl" value="' . $row['ma_loaisl'] . '"><input type="submit" value="Lưu" class="btn btn-primary"></td>';
			echo '</tr>';
			echo '</form>';
			echo '</td></td>';
		}
	} else {
		echo "<tr>";
		echo "<td>" . $row['ten_loaisl'] . "</td>";
		echo "<td>" . $row['giatri_sl'] . "</td>";
		echo "<td>" . $row['thoigian_apdung'] . "</td>";
		echo "<td>" . $row['ten_loai'] . "</td>";
		echo '<td><a class="btn btn-info" href="'.home_url("/loaisltc/").'?id=' . $row["ma_loaisl"] . '">Sửa</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
		
	}
}
if(!isset($_GET['id'])){
?>
<style>
	.center {
		text-align: center;
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
}
$conn->close();