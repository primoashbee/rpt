<?php 


require '../vendor/autoload.php';
require '../config.php';
require '../required/functions.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
use Dompdf\Dompdf;
date_default_timezone_set('Asia/Manila');




$date = date('m-d-Y(h:i:sA)', time());

if(isset($_GET['id']) && isset($_GET['type'])){
	$id = $_GET['id'];
	$type = $_GET['type'];
	$data = getReceiptViaPaymentID($id);

	if($type=="excel"){
			$inputFileName = '../required/templates/ofptemplate-temp.xlsx';
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
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
			$cell = $report->getCell('K21')->setValue('₱'.number_format($data['value'],2));
			$cell = $report->getCell('L21')->setValue($data['billing_year']);
			$cell = $report->getCell('N21')->setValue('₱'.number_format($data['amount'],2));
			$cell = $report->getCell('R21')->setValue('₱'.number_format($data['amount'],2));
			$cell = $report->getCell('R25')->setValue('₱'.number_format($data['amount'],2));
			$cell = $report->getCell('R2')->setValue($data['checkout_id']);


			$year = DateTime::createFromFormat('!m', $data['billing_month'])->format('F');
			$cell = $report->getCell('K25')->setValue('Computation for '.$year.' '.$data['billing_year']);
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
	}elseif($type=="pdf"){
		$dompdf = new Dompdf();
		$dompdf->setPaper('A4','landscape');
		
		$content1 = '
				<html>
				<link rel="icon" href="favico.ico" />
				<link href="../assets/css/bootstrap.css" rel="stylesheet">
				<!--external css-->
				<link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

				<body>
				<div class="modal-body">
				          
				            <img src="../assets/img/left.png" alt="" class="img" style="margin:auto;max-width: 200px;max-height: 350px;float:right;position: block;top:100px;margin-left:-150px;margin-top:10px" >
				            
				             <img src="../assets/img/right.png" alt="" class="img " style="margin:auto;max-width: 200px;max-height: 200px;float: left;position: block;top:100px" >
				            <p align="center" style="font-size: 1.1em"> Republic of the Philippines </p>
				            <p align="center" style="font-size: 1.1em"> Province of Bataan </p>
				            <p align="center" style="font-size: 1.1em"> CITY OF BALANGA </p>
				            <p align="center" style="font-size: 1.1em"> CITY TREASURER\'S OFFICE </p>
				            <p align="center" style="font-size: 1.1em"> Tel. # (047) 237-3404 , (047) 237-0704 </p>
				            
				            
				            
				          <div class="clearfix"></div>
				          <br>
				            <p align="center"><b> PAYMENT RECEIPT</b></p>
				          <h3> Reference ID : <b> '.$data['checkout_id'].' </b></h3>
				         
				          <p style="font-size: 1.3em">Received from <b><i><span id="payer_name" class="fillable" style="text-decoration: underline">'.$data['firstname'].' '.$data['lastname'].'</span></i></b> this sum of (<b><i><span id="payment_amount" class="fillable" style="text-decoration: underline">P '.number_format($data['amount'],2).'</span></i></b> ) pesos in full or as installment payment of REAL PROPERTY TAX upon property declared to <b><i><span id="payer_name2" class="fillable" style="text-decoration: underline">'.$data['firstname'].' '.$data['lastname'].'</i></b>  as follows </p>
				          <section id="no-more-tables">
				                    <table class="table table-bordered table-striped table-condensed cf" id="tblList">
				                      <thead class="cf">
				                        <tr><th>Lot #</th>
				                        <th>PIN/TD</th>
				                        <th>Location/Class</th>
				                        <th>Value</th>
				                        <th>Year</th>
				                        <th>Due</th>
				                        <th>Penalty Discount</th>
				                        <th>Total</th>
				                      </tr></thead>
				                      <tbody>
				                      
				                      <tr>
				                        <td data-title="Lot Number"><span id="s_lot" class="fillable">'.$data['lot_number'].'</span></td>
				                        <td data-title="PIN/TD"><span id="s_pin_td" class="fillable">'.$data['pin_td'].'</span></td>
				                        <td data-title="Location/Class"><span id="s_loc_class" class="fillable">'.$data['name'].'/'.$data['type'].'</span></td>
				                        <td data-title="Value"><span id="s_value" class="fillable">P '.number_format($data['value'],2).'</span></td>
				                        <td data-title="Tax Year"><span id="s_tax_year" class="fillable">'.$data['billing_year'].'</span></td>
				                        <td data-title="Tax Due"><span id="s_tax_due" class="fillable">P '.number_format($data['amount'],2).'</span></td>
				                        <td data-title="Penaly Discount"><span id="s_penalty_discount" class="fillable"></span></td>
				                        <td data-title="Total"><span id="s_total" class="fillable">P '.number_format($data['amount'],2).'</span></td>
				                      </tr>

				                      <tr>
				                      	<td colspan="3" rowspan="3"><center>NOTE: Please Review the details of <br>your Order of Payment before<br>paying to the cashier</center>				
				                      	</td>
				                      	
				                      	<td></td>
				                      	<td></td>
				                      	<td></td>
				                      	<td><b>BASIC</b></td>
				                      	<td></td>
				                      </tr>
				                      <tr>
				                      	<td></td>
				                      	<td></td>
				                      	<td></td>
				                      	<td><b>SEF</b></td>
				                      	<td></td>

				                      </tr>				                      
				                      <tr>
				                      	<td></td>

				                      	<td style="background-color:yellow" colspan="2"><center><b><i>Computation for '.DateTime::createFromFormat('!m', $data['billing_month'])->format('F').' '.$data['billing_year'].'</i></b></center></td>
				                      	<td><b>TOTAL</b></td>
				                      	<td>P '.number_format($data['amount'],2).'</td>
				                      </tr>

				                      </tbody>
				                    </table>

				          <div class="col-xs-6 col-md-6 co-lg-6">
				          	<label> Received by:</label>
				          	<br><br><br>
				          	<h4 style="text-decoration: overline;font-weight:740">'.$data['firstname']. ' '.$data['lastname'].'</h4>
				          </div>
				          <div class="col-xs-6 col-md-6 co-lg-6">
				          	<label> Noted by:</label>
				          	<br><br><br>
				          	<h4 style="text-decoration: overline;font-weight:740">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
				          </div>

				          </section>
						<div class="clearfix"></div>
						<br>
						<div class="panel panel-default">
						  <div class="panel-heading" style="background-color:yellow;text-align: center;font-weight: 750">PLEASE FILL-UP ACCORDINGLY (FOR RECORD PURPOSES)</div>
						  <div class="panel-body">
				          <div class="col-xs-6 col-md-6 co-lg-6">
				          	<label> Contact Person:</label>
				          	<br><br><br>

				          	________________________________________________
				          	<p style="font-weight:740;"> FULL NAME </p>
				          </div>
				          <div class="col-xs-6 col-md-6 co-lg-6">
				          	<label> Relationship to the Owner:</label>
				          	<br><br><br>
				          	__________________________________________________
				          	<p style="font-weight:740"> (RELATION WITH THE OWNER)</p>
				          </div>
						  <div class="clearfix"></div>
				          <div class="col-xs-12 col-md-12 co-lg-12">
				          	<br>
				          	<p style="text-align: center">__________________________________________________________________________________________________</p>	
				          	<p style="font-weight:740;text-align: center">CURRENT COMPLETE ADDRESS</p>
				          </div>
				          <div class="col-xs-12 col-md-2 co-lg-2">
				          	<br><br><br>
				          	<h3><b>Contact No</b></h3>
				          </div>
				          <div class="clearfix""></div>
						  <div class="col-xs-12 col-md-2 co-lg-2">
				          </div>
				          <div class="col-xs-12 col-md-10 co-lg-10" style="margin-top:-60px">
				          	<br><br><br>
				          	<p style="font-weight: 740;text-align: left">LANDLINE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   : ______________________________________________</h4>
				          	<p style="font-weight: 740;text-align: left">CELLULAR PHONE : ______________________________________________</p>
				          	<p style="font-weight: 740;text-align: left">EMAIL ADDRESS    &nbsp;&nbsp;&nbsp;&nbsp;:______________________________________________</p>
				          </div>

						  	


						  </div>
						</div>
				</div> 
				<p> Paid on : <b> '.$data['created_at'].' </b></p>           
				<p> Printed at : '.$date.'</p>
				</body>
				</html>';

		$dompdf->loadHtml($content1);
		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
		$dompdf->stream();





	}
}


?>

				            
				            
				        