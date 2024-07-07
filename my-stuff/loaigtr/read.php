<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';

$sql = "SELECT * FROM `$tablename`";

$current_page = isset($_GET['pg']) ? $_GET['pg'] : 1;
if(!isset($_GET['id'])){
	$limit = 10;
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
echo "<th>Tên loại giảm trừ</th><th>Mức giảm</th><th>Thời gian áp dụng</th><th></
th>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
	if (isset($_GET['id'])) {
		if ($row['ma_gtr'] == $_GET['id']) {
			echo '<tr><td colspan="5">';
			echo '<form action="'.home_url().'/my-stuff/loaigtr/update.php" method="POST"  onsubmit="return confirmSave()">';
			echo '<table>';
			echo '<tr><td><input class="form-control" id="ten_gtr" name="ten_gtr" type="text" value="' . $row['ten_gtr'] . '"></td>';
			echo '<td><input class="form-control" id="mucgiam" name="mucgiam" type="text"  value="' . $row['mucgiam'] . '"></td>';
			echo '<td><input class="form-control" id="thoigian_apdung" name="thoigian_apdung" type="date" value="' . $row['thoigian_apdung'] . '"></td>';

			echo '<td><input type="hidden" name="ma_gtr" value="' . $row['ma_gtr'] . '"><input type="submit"  value="Lưu" class="btn btn-primary"></td>';
			echo '</tr>';
			echo '</form>';
			echo '</td></td>';
		}
	} else {
		echo "<tr>";
		echo "<td>" . $row['ten_gtr'] . "</td>";
		echo "<td>" . $row['mucgiam'] . "</td>";
		echo "<td>" . $row['thoigian_apdung'] . "</td>";
		// echo '<td><a id="update" class="btn btn-info" href="'.home_url("/loaigtr/").'?id=' . $row["ma_gtr"] . '">Sửa</a></td>';
		echo '<td><a class="btn btn-info" href="'.home_url("/loaigtr/").'?id=' . $row["ma_gtr"] . '">Sửa</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.home_url() . '/my-stuff/loaigtr/delete.php?id=' . $row['ma_gtr'] . '">Xóa</a></td>';
		echo '<td><form method="POST" action="'.home_url().'/my-stuff/loaigtr/delete.php?id=' . $row['ma_gtr'] . '" onsubmit="return confirmDesactiv()">
				<input type="submit" class="btn btn-danger" value="Xóa">
		</form></td>';
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
						if((isset($_GET['nam']))) {
							$a = $_GET['nam'];
							$str.= "&nam=$a";
						}
						 if(isset($_GET['trangthai'])){
							$b = $_GET['trangthai'];
							$str.= "&trangthai=$b";
						}
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
						if((isset($_GET['nam']))) {
							$a = $_GET['nam'];
							$str.= "&nam=$a";
						}
						 if(isset($_GET['trangthai'])){
							$b = $_GET['trangthai'];
							$str.= "&trangthai=$b";
						}
						echo '<a href=?'.$str.'>'.$i.'</a> ';
						}
					}
	
					// nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
					if ($current_page < $total_page && $total_page > 1) {
						$str = 'pg=' . ($current_page + 1);
						if((isset($_GET['nam']))) {
							$a = $_GET['nam'];
							$str.= "&nam=$a";
						}
						 if(isset($_GET['trangthai'])){
							$b = $_GET['trangthai'];
							$str.= "&trangthai=$b";
						}
						echo '<a href=?'.$str.'>&raquo;</a> ';
					}
				endif;
				?>
			</div>
		</div>
	<?php
	
	}
	$conn->close();
	