<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';

$sort=$_GET['sort'];
$sql = "SELECT * FROM `$tablename` gt INNER JOIN `NamHoc` nh ON gt.manh=nh.ma_nh";

switch ($sort) {
	case 'ten':
		$sql.=" order by ten_loaigt";
		break;
	case 'dinhmuc':
		$sql.=" order by heso_loaigt";
		break;
	case 'thoigian':
		$sql.=" order by thoigian_apdung"; 
		break;
	case 'namhoc':
		$sql.=" order by manh"; 
		break;
 }
 if(isset($_GET['by'])){
	$sql.=" desc";
 }
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
if (isset($_GET['id'])) {
	echo "<th>Tên loại giải thưởng</th><th>Giờ chuẩn</th><th>Thời gian áp dụng</th><th></th>";
}else{
	echo "<th>Tên loại giải thưởng</th><th>Giờ chuẩn</th><th>Thời gian áp dụng</th><th>Năm học</th><th></th>";
}
echo "</thead>";
while ($row = $re->fetch_assoc()) {
	if (isset($_GET['id'])) {
		if ($row['ma_loaigt'] == $_GET['id']) {
			echo '<tr><td colspan="5"><form action="'.home_url().'/my-stuff/loaigt/update.php" method="POST" onsubmit="return confirmSave()">';
			echo '<table>';
			echo '<tr><td><input class="form-control" id="ten_loaigt" name="ten_loaigt" type="text" value="' . $row['ten_loaigt'] . '"></td>';
			echo '<td><input class="form-control" id="heso_loaigt" name="heso_loaigt" type="text"  value="' . $row['heso_loaigt'] . '"></td>';
			echo '<td><input class="form-control" id="thoigian_apdung" name="thoigian_apdung" type="date" value="' . $row['thoigian_apdung'] . '"></td>';

			echo '<td><input type="hidden" name="ma_loaigt" value="' . $row['ma_loaigt'] . '"><input type="submit"  value="Lưu" class="btn btn-primary"></td>';
			echo '</tr>';
			echo '</form>';
			echo '</td></td>';
		}
	} else {
		echo "<tr>";
		echo "<td>" . $row['ten_loaigt'] . "</td>";
		echo "<td>" . $row['heso_loaigt'] . "</td>";
		echo "<td>" . $row['thoigian_apdung'] . "</td>";
		echo "<td>" . $row['namhoc'] . "</td>";
		
		echo '<td><a class="btn btn-info" href="'.home_url("/loaigt/").'?id=' . $row["ma_loaigt"] . '">Sửa</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo '<td><form method="POST" action="'.home_url().'/my-stuff/loaigt/delete.php?id=' . $row['ma_loaigt'] . '" onsubmit="return confirmDesactiv()">
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
						if((isset($_GET['sort']))) {
							$a = $_GET['sort'];
							$str.= "&sort=$a";
						}
						 if(isset($_GET['by'])){
							$b = $_GET['by'];
							$str.= "&by=$b";
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
							if((isset($_GET['sort']))) {
								$a = $_GET['sort'];
								$str.= "&sort=$a";
							}
							 if(isset($_GET['by'])){
								$b = $_GET['by'];
								$str.= "&by=$b";
							}
						echo '<a href=?'.$str.'>'.$i.'</a> ';
						}
					}
	
					// nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
					if ($current_page < $total_page && $total_page > 1) {
						$str = 'pg=' . ($current_page + 1);
						if((isset($_GET['sort']))) {
							$a = $_GET['sort'];
							$str.= "&sort=$a";
						}
						 if(isset($_GET['by'])){
							$b = $_GET['by'];
							$str.= "&by=$b";
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
	