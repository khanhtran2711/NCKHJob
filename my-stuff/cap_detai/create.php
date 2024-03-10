<?php
include('../../mydbfile.php');

$a = $_POST['ten_cdt'];
$b = $_POST['giochuan'];
$c = $_POST['thoigian_apdung'];


$sql = "INSERT INTO `CapDeTai`( `ten_cdt`, `giochuan`, `thoigian_apdung`) VALUES ('$a','$b','$c')";


error_log($sql);
$conn->query($sql);
$conn->close();

echo "add successful";

?>