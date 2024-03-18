<?php
include('../../mydbfile.php');
include('config.php');

$a = $_POST['ten_khoa'];


$sql = "INSERT INTO `$tablename`( `ten_khoa`) VALUES ('$a')";


error_log($sql);
$conn->query($sql);
$conn->close();

echo "add successful";

?>