<style>
	a[title] {
  position: relative;
}

a[title]:after {
  content: attr(title);
  display: inline-block;
  padding: 0.2em 0.6em; 
  white-space: nowrap; 
  background-color: #555;
  color: #fff;
  font-style: normal;
  font-family: sans-serif;
  font-size: 0.8em;
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translate(-50%, -1em);
  z-index: 1;
}
</style>
<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';

$sql = "SELECT * FROM `$tablename` ORDER BY ngaydang DESC";

$re = $conn->query($sql);

error_log('sql = ' . $sql);
// webpage form starts here
if (!isset($_GET['id'])) {
echo "<tbody>";
echo "<thead>";
echo "<th>Nội dung</th><th>Link</th><th>Ngày đăng</th><th>Đổi Trạng thái</th><th colspan='2' style='text-align:center'>Thao tác</th>";
echo "</thead>";
}

while ($row = $re->fetch_assoc()) {
	if (isset($_GET['id'])) {
		if ($row['id'] == $_GET['id']) {
			echo '<tbody>';
			echo '<tr><td><form action="'.home_url().'/my-stuff/qlthongbao/update.php" method="POST">';
			echo '<table>';
			echo '<tr>';
			echo '<th>Nội dung</th>';
			echo '<td><input class="form-control" id="noidung" name="noidung" type="text" value="' . $row['noidung'] . '"></td></tr>';
			echo '<tr>';
			echo '<th>Link thông báo</th>';
			echo '<td><input class="form-control" id="link" name="link" type="text" value="' . $row['link'] . '"></td>';
			echo '</tr>';
			
			echo '<tr ><td colspan="2" style="text-align:center"><input type="hidden" name="id" value="' . $row['id'] . '"><button type="submit" class="btn btn-success">Lưu</button> <a href="'.home_url('/qlthongbao/').'" class="text-decoration-none btn btn-info">Trở về trang quản lý thông báo</a></td>';
			echo '</tr>';
			
		echo "</table></form></td></tr></tbody>";
		}
	} else {
		
		
		echo "<tr>";
		echo "<td>" . $row['noidung'] . "</td>";
		echo "<td><a href='" . $row['link'] . "' target='_blank'>Xem chi tiết</a></td>";
		echo "<td>" . date('d-m-Y',strtotime($row['ngaydang'])) . "</td>";
		echo "<td>";
		if($row['trangthai']==0){
			echo '<a class="btn btn-primary" href="'.home_url().'/my-stuff/qlthongbao/update-tt.php?tt=0&&id=' . $row["id"] . '">Hiện</a>';
		}else{
			echo '<a class="btn btn-secondary" href="'.home_url().'/my-stuff/qlthongbao/update-tt.php?tt=1&&id=' . $row["id"] . '">Ẩn</a>';
		}
		echo "</td>";
		echo '<td><a class="btn btn-info" href="'.home_url("/qlthongbao/").'?id=' . $row["id"] . '">Sửa</a></td>';
		echo '<td><form method="POST" action="'.home_url().'/my-stuff/qlthongbao/delete.php?id=' . $row["id"] . '" onsubmit="return confirmDesactiv()">
			<input type="submit" class="btn btn-danger" value="Xóa">
	</form></td>';
		echo "</tr>";
		echo "</tbody>";
		
	}
}

$conn->close();