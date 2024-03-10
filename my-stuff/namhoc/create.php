<?php
include('../../mydbfile.php');

$a = $_POST['namhoc'];


$sql = "INSERT INTO `NamHoc`(`namhoc`) VALUES ('$a')";


error_log($sql);
$conn->query($sql);
$conn->close();

echo "add successful";

?>