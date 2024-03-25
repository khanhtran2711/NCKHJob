<?php
global $wpdb;
include '../wp-load.php';
require '../vendor/autoload.php';
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\Style\Fill;
// Path to your JSON file
$jsonFilePath = 'myfileqd.json';

// Read the JSON file contents
$jsonString = file_get_contents($jsonFilePath);

// Decode the JSON string into a PHP variable
$data = json_decode($jsonString, true); // The second parameter true is used to decode the JSON string into an associative array
// foreach ($data as $item) {
//     echo $item['macb'];
    // Path to your JSON file

// Get the filename from the path
// }
// // Check if decoding was successful
// if ($data === null) {
//     // JSON decoding failed
//     echo "Error decoding JSON file.";
// } else {
//     // JSON decoding successful
//     // You can now work with the $data variable, which contains the JSON data as a PHP array
//     var_dump($data); // Output the contents of the JSON file as a PHP array
// }
// echo $data[0]['namhoc'];

	$spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();

    $reader = IOFactory::createReader("Xlsx");
    $spreadsheet = $reader->load("../templateqd.xlsx");
    $sheet = $spreadsheet->getActiveSheet();

	
	$sheet->setCellValue("F4" ,$data[0]['namhoc']);


	$currentcontent = 7;
	$i=1;
	foreach ($data as $item) {
		$row = 'A'.($currentcontent);
		$sheet->insertNewRowBefore($currentcontent+1,1);
		$user = new WP_User($item['userid']);
		$sheet->setCellValue($row , $i++);
		$sheet->setCellValue('B'.$currentcontent ,$user->last_name);
		$sheet->setCellValue('C'.$currentcontent ,$user->first_name);
		$sheet->setCellValue('D'.$currentcontent ,$item['khoa']);
		$sheet->setCellValue('E'.$currentcontent ,$item['tendetai']);
		$sheet->setCellValue('F'.$currentcontent ,$item['loaict']);

		$sheet->setCellValue('G'.$currentcontent ,$item['cap']);
		$sheet->setCellValue('H'.$currentcontent ,date("d-m-Y",strtotime($item['ketthuc'])));
		$sheet->setCellValue('I'.$currentcontent ,$item['vitri']);
		
		$sheet->setCellValue('J'.$currentcontent ,$item['soluong']);
		$sheet->setCellValue('K'.$currentcontent ,$item['tinchi']);
		$sheet->setCellValue('L'.$currentcontent ,$item['quydoi']);


		++$currentcontent;
	}
	$sheet->removeRow($currentcontent,1);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="quydoi.xlsx"');
$file = IOFactory::createWriter($spreadsheet,'Xlsx');
$file->save('php://output');
?>