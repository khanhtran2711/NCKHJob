<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include 'config.php';

$sql = "SELECT * FROM `$tablename`";

$re = $conn->query($sql);
$data = $re->fetch_all(MYSQLI_ASSOC);
error_log('sql = ' . $sql);
// webpage form starts here
echo "<tbody>";
echo " <tr>
<th>Ngày bắt đầu (7:00 AM):</th>
<td>".date('d-m-Y',strtotime($data[0]['start']))."</td>
</tr>
<tr>
<th>Ngày kết thúc (11:59 PM):</th>
<td>".date('d-m-Y',strtotime($data[0]['end']))."</td>
</tr>";
echo "</tbody>";
$conn->close();