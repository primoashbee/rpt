<?php 


require '../vendor/autoload.php';
require '../config.php';
require '../required/functions.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
date_default_timezone_set('Asia/Manila');


$date = date('m-d-Y(h-i-s-A)', time());
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$inputFileName = '../required/templates/ofptemplate-temp.xlsx';
	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	$data = getReceiptViaPaymentID($id);

	$spreadsheet = $reader->load($inputFileName);
	$today = date("m/d/Y");
	$report = $spreadsheet->getSheet(0);
	$cell = $report->getCell('R12')->setValue($today);
	$cell = $report->getCell('G15')->setValue($data['firstname'].' '.$data['lastname']);
	$cell = $report->getCell('I16')->setValue($data['firstname'].' '.$data['lastname']);
	$cell = $report->getCell('K15')->setValue('₱'.number_format($data['amount'],2));
	$cell = $report->getCell('E21')->setValue($data['lot_number']);
	$cell = $report->getCell('G21')->setValue($data['pin_td']);
	$cell = $report->getCell('G21')->setValue($data['name'].'/'.$data['type']);
	$cell = $report->getCell('K21')->setValue(number_format($data['value']));
	$cell = $report->getCell('L21')->setValue($data['billing_year']);
	$cell = $report->getCell('N21')->setValue('₱'.number_format($data['amount'],2));
	$cell = $report->getCell('R21')->setValue('₱'.number_format($data['amount'],2));
	$cell = $report->getCell('R25')->setValue('₱'.number_format($data['amount'],2));


	$year = DateTime::createFromFormat('!m', $data['billing_month'])->format('F');
	$cell = $report->getCell('K25')->setValue('Computation pare for '.$year.' '.$data['billing_year']);
	$file ='Receipt.xlsx';
	
	$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
	$writer->save($file);

	if (file_exists($file)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="'.basename($file).'"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    readfile($file);
	    unlink($file) or die("Couldn't delete file");
	    exit;
	}
}
?>