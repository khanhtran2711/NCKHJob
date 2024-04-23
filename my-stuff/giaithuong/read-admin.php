<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';


$sql = "SELECT * FROM `$tablename`";

if (isset($_GET['ten'])) {
	$ten = strtolower(trim($_GET['ten']));
	$sql .= " where ten_gt = '".$ten."'";
	$re = $conn->query($sql);

	error_log('sql = ' . $sql);
	if($re->num_rows>0)
		echo "Giải thưởng có thể đã được nhập thông tin rồi. Quý thầy/cô nên kiểm tra lại với các thành viên trong nhóm";
	else echo "nothing";
} else {
	if (isset($_GET['trangthai'])) {
		$a = $_GET['trangthai'];
		$sql .= " where trangthai = $a";
	}
	$current_page = isset($_GET['pg']) ? $_GET['pg'] : 1;
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
$pagename = '/giaithuongchitiet/';
// webpage form starts here
echo "<tbody>";
echo "<thead>";
echo "<th>Tên giải thưởng</th><th>Trạng thái</th><th>Xem chi tiết</th><th>Xóa</th>";
echo "</thead>";
if ($re != false && $re->num_rows > 0) :
while ($row = $re->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row['ten_gt'] . "</td>";
		echo "<td>" . (($row['trangthai']==0)?'Chưa duyệt':'Đã duyệt') . "</td>";
		echo '<td><a class="btn btn-info" href="'.home_url($pagename).'?id=' . $row["ma_gt"] . '">Xem</a></td>';
		echo '<td><form method="POST" action="'.$mystufflink.'giaithuong/delete.php?id=' . $row['ma_gt'] . '" onsubmit="return confirmDesactiv()">
				<input type="submit" class="btn btn-danger" value="Xóa">
		</form></td>';
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


$conn->close();
}