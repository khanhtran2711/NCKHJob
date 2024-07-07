<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';

$sql = "SELECT cbcd.id,cbcd.ma_cd,cd.ten_cd,cd.dinhmuc,cbcd.thoigiannhan,cbcd.trangthaiduyet,cbcd.trangthaisudung FROM `CanBo_ChucDanh` as cbcd inner join `ChucDanh` as cd on cbcd.ma_cd = cd.ma_cd inner join `Canbo` as cb on cbcd.ma_cb=cb.ma_cb INNER JOIN `realdev_users` as u on u.ID=cb.user_id WHERE cb.user_id=".get_current_user_id()." order by cbcd.id DESC";

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
// webpage form starts here

echo "<tbody>";
if (isset($_GET['id'])) {
	echo "<thead>";
	echo "<th>Chức danh hiện tại</th><th>Thao tác</th>";
	echo "</thead>";
} else {
	echo "<thead>";
	echo "<th>Chức danh hiện tại</th><th>Thời gian áp dụng</th><th>Định mức</th><th>Trạng thái duyệt</th><th colspan='2' style='text-align:center'>Thao tác</th>";
	echo "</thead>";
}
?>
<style>
	 select, option{
    width: 250px;
}

 option {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
</style>
<?php
if ($re != false && $re->num_rows > 0) :
while ($row = $re->fetch_assoc()) {
	if (isset($_GET['id'])) {
		if ($row['id'] == $_GET['id']) {
			echo '<tr><td colspan="3"><form action="'.home_url().'/my-stuff/cbprofile/update-role.php" method="POST">';
			echo '<table><tr>';                   
			echo '<td style="width: 582px;"><select name="ma_cd" class="suagtr">
					<option value="0">Chọn loại chức danh</option>';
			$list_cd = "SELECT `ma_cd`, `ten_cd` FROM `ChucDanh`";
							
			$re1 = $conn->query($list_cd);
			error_log('sql = ' . $list_cd);
			while ($row1 = $re1->fetch_assoc()) :
				$flag = '';
				if ($row1['ma_cd'] == $row['ma_cd']) :
					$flag = 'selected';
				endif;
				echo '<option ' . $flag . ' value= "' . $row1['ma_cd'] . '">' . $row1['ten_cd'] . '</option>';
			endwhile;

			echo '</select></td>';
			echo '<td><input type="submit" value="Lưu" class="btn btn-primary"></td>';
			echo '<td><input type="hidden" name="id" value="' . $row['id'] . '"></td>';
			echo '</table></form>';
			echo '</td></tr>';
		}
	} else {
		echo "<tr>";
		echo "<td>" . $row['ten_cd'] . "</td>";
		echo "<td>" . $row['thoigiannhan'] . "</td>";
		echo "<td>" . $row['dinhmuc'] . "</td>";
		$duyet ='';
		$flag = false;
		if($row['trangthaiduyet']==0){
			$duyet='chưa duyệt';
			$flag = true;
		}else if($row['trangthaiduyet']==1){
			$duyet='đã duyệt';
		}else{
			$duyet = 'từ chối';
		}
		echo "<td>" . $duyet . "</td>";

		if($flag)
			echo '<td><a class="btn btn-info " href="' . home_url('/doichucdanh/') . '?id=' . $row['id'] . '">Sửa</a></td>';
		echo '<td><form method="POST" action="' . home_url() . '/my-stuff/cbprofile/delete-cd.php?id=' . $row['id'] . '" onsubmit="return confirmDesactiv()">
		<input type="submit" class="btn btn-danger" value="Xóa">
</form></td>';  
		echo "</tr>";
	}
}

else :
			echo "<tr>";
			echo "<td  colspan='6' class='text-center'><i>Không dữ liệu phù hợp</i></td>";
			echo "</tr>";

		endif;
		echo "</tbody>";
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

?>