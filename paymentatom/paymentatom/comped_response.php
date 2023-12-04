<?php
session_start();
include_once '../dbconnect.php';
$requesttype ='';

//print_r($_POST);

//exit;

if(empty($_REQUEST['requesttype'])) $requesttype ='createresponse';

else $requesttype=$_REQUEST['requesttype'];

switch($requesttype) {

	case 'createresponse':
		createResponse($_POST, $_REQUEST);
		session_unset();
		session_destroy(); 
		break;
}

function createResponse( $post, $request ) {
	if(strtoupper($post['f_code'])=="OK"){ //success
		//$receiptno=postReceipt($post);
		recordPaymentHistory($post['amt'],$paymentStatus);
		showSuccessDetails( $post);
		//sendDetails($trackid ,$post, "Success");
	} else if(strtoupper($post['f_code'])=="" or strtoupper($post['f_code'])=="F" or strtoupper($post['f_code'])=="C"){ //fail
		if(strtoupper($post['f_code'])=="") $paymentStatus="Failed";
		if(strtoupper($post['f_code'])=="F") $paymentStatus="Failed";
		if(strtoupper($post['f_code'])=="C") $paymentStatus="Cancelled";
		recordPaymentHistory($post['amt'],$paymentStatus);
		showFailureDetails( $post );

		//sendDetails($post, "Failure");
	}
}

function recordPaymentHistory($amount,$status){ 

	####### check if the details already exist or not ###########
		
	//$count = getValueForPS( "select count(*) from paymenthistory where transactionid=".$_POST['mmp_txn']." " );
	//if( $count <= 0 ) {
		if( $amount=='')  {
			$amount = 0;
		}
		if(strtoupper($_POST['f_code'])=="OK") $status="Success"; 
		if(strtoupper($_POST['f_code'])=="") $status="Failure";
		if(strtoupper($_POST['f_code'])=="F") $status="Failure";
		if(strtoupper($_POST['f_code'])=="C") $status="Cancelled";
		
		$transactionid		= $_POST['mmp_txn'];
		$createdat			= date("Y-m-d H:i:s");
		$banktransactionid 	= $_POST['bank_txn'];
		$amount				= $_POST['amt'];
		$realizationamount 	= 0;
		$fcode				= $_POST['f_code'];
		$status				= $status;
		$address			= $_SERVER["REMOTE_ADDR"];
		$bankname			= $_POST['bank_name'];
		$clientcode			= $_POST['mer_txn'];
		$clientname			= $_POST['udf2'];
		$transactiondate	= date('Y-m-d');
		$description		= $_POST['desc'];

		//ds2insert($payHis,"paymenthistory");
		$query = "INSERT INTO paymenthistory(transactionid,createdat,banktransactionid,amount,realizationamount,fcode,status,address,bankname,clientcode,clientname,transactiondate,description) VALUES
		('$transactionid','$createdat','$banktransactionid','$amount','$realizationamount','$fcode','$status','$address','$bankname','$clientcode','$clientname','$transactiondate','$description')";
		// echo $query;
		$res = mysql_query($query);
	//}

}

function showFailureDetails( $paymentdetails ) {
	//track history
	styles();
	$html = "<div class='container'>
					<div class='row'>
						<div class='col-md-12'>
							<div class='card'>
							 <div class='fail_circle'><span class='glyphicon glyphicon-remove'></span></div>
							  <h2 style='color:red'>Transaction Fail</h2>
							  <p><b>Name :</b> ".$_SESSION['susername']."</p>
							  <p><b>Email :</b> ".$_SESSION['smail']."</p>
							  <p><b>Reference No :</b> ".$paymentdetails['mmp_txn']."</p>
							   <p><b>Transaction Date : </b> ".date('Y-m-d')."</p>
							   <p><b>Amount : </b> ".$_SESSION['samount']."</p>
							  <p><span style='color:red'>Note:</span> Your transaction details has been sent to your email.</p>
							  <div class='button_data'>
								<button id ='home_btn'  class='btn btn-primary center' >Thanks For Support</button>
							  </div>
							</div>
						</div>
					</div>
				</div>"; 
	echo $html;

}

function showSuccessDetails($paymentdetails ) {
	styles();
	$html = "<div class='container'>
				<div class='row'>
					<div class='col-md-12'>
						<div class='card'>
							<div class='success_circle'><span class='glyphicon glyphicon-ok'></span></div>
							  <h2 style='color:green'>Success</h2>
							  <p><b>Name :</b> ".$paymentdetails['udf5']."</p>
							  <p><b>Email :</b> ".$paymentdetails['udf2']."</p>
							  <p><b>Reference No :</b> ".$paymentdetails['mmp_txn']."</p>
							  <p><b>Transaction Date : </b> ".date('Y-m-d')."</p>
							  <p><b>Amount : </b> ".$paymentdetails['amt']."</p>
							  <p><span style='color:red'>Note:</span> Your transaction details has been sent to your email.</p>
							  <div class='button_data'>
							  <button id ='home_btn'  class='btn btn-primary center' >Thanks For Support</button>
							  </div>
							</div>
						</div>
					</div>
				</div>";
				
			echo $html;

}

function styles() {

	echo "<link href='../bootstrap/css/bootstrap.min.css' rel='stylesheet'>

	   <link href='res/placements/font-awesome/font-awesome.min.css' rel='stylesheet' type='text/css'> ";

	  echo "<script>

		function getIndexPage() {

		 var link = $('a').attr('href');

			window.location='index.php';
		};

	</script>";

	echo "<style>.card {

			  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);

			  max-width: 300px;

			  margin: auto;

			  text-align: center;

			  font-family: arial;

			}

			.container {

				margin-top:30px;

			}

			@media print {

				#printbtn {

					display :  none;

				}

			}

			.btn-primary {

				width: 100%

			}

			p {

				margin: 1px 0 0px;

			}

			.title {

			  color: grey;

			  font-size: 18px;

			}

			a {

			  text-decoration: none;

			  font-size: 22px;

			  color: black;

			}

			.success_circle {

				top: 5px;

				color: white;

				background-color: #3b5998;

				width: 80px;

				height: 80px;

				border-radius: 50%;

				line-height: 18px;

				font-size: 10px;

				text-align: center;

				margin-left: 110px;

			}

			.fail_circle {

				top: 5px;

				color: white;

				background-color: #c62f0f;

				width: 80px;

				height: 80px;

				border-radius: 50%;

				line-height: 18px;

				font-size: 10px;

				text-align: center;

				margin-left: 110px;

			}

			.glyphicon {

				font-size: 40px;

				color: #fff;

				margin: 20px;

			}

			</style>";

			echo "<script>

				function myFunction() {

					  window.print();

					}

			</script>";

}
/*

function createPDF($content){

	$mpdf = new mPDF();

	$mpdf->WriteHTML($content);

	$mpdf->Output('doc.pdf', 'F');

	$pdf = $mpdf->output("","S");

	return $pdf;

}

function sendDetails($receiptno, $paymentdetails, $paymentStatus ) {

	

	$frommail = "convocation@iiit.ac.in";

	$tomail =$paymentdetails['udf2'];
	if(empty($tomail)){
		$tomail=$_SESSION['smail'];
	}

	$subject = "Convocation Registration Fee";

	$narration="Towards payment for Convocation Registration";

	$message="

	Hi, 

	<br/>

	Please check below your acknowledgement receipt. 	

	<br/>

	Note: Please contact Academics office for any further information.

	<br/>



.";

	$html = "<!DOCTYPE html>

<html>

<head>

</head>

<body style='font-family:arial;padding:0px;'><br><br>

<div style='border: 1px solid;'>

<table align=center cellspacing=10 cellpadding=0 width=100% border=0>

	<tr>

		<td width='19%'><img src='https://images.shiksha.com/mediadata/images/1571920801phpDEQFI7.jpeg' alt='IIIT-H' width='100' height='100'></td>	

		<td colspan=3 nowrap align=center ><p style='font-size:13px;text-align:center'>

              <b style='font-size:18px'>International Institute of Information Technology, Hyderabad</b><br>Gachibowli, Hyderabad, Telangana, India - 500032</p></td>

</tr>

	<tr valign=top >

		<td width='100%' style='padding:5px;font-size:18px;' colspan=4>

			<p align='center'><u><b>RECEIPT</b></u></td></tr>

		<tr>

		<td valign=top colspan=4  height='71'>

			<table  width=100% cellspacing=0  border=1  style='border-right:0px solid #000;border-left:0px solid #000'>

			<tr><td style='font-size:13px;padding:5px;border-right:1px solid #000'>Receipt No and Date </td><td style='font-size:13px;padding:5px'> ".$receiptno." and ".date('d-m-Y')."</td></tr> 

			<tr><td width='188' style='font-size:13px;padding:5px;border-right:1px solid #000'>Received with thanks from</td><td align=left style='font-size:13px;padding:5px'>".$paymentdetails['udf5']."</td></tr>

			<tr><td width='188' style='font-size:13px;padding:5px;border-right:1px solid #000'>The Sum of </td><td align=left style='font-size:13px;padding:5px'>".$paymentdetails['amt']."/- only</td></tr>

			<tr><td width='188' style='font-size:13px;padding:5px;border-right:1px solid #000'>By </td><td align=left style='font-size:13px;padding:5px'>	Payment Gateway</td></tr>	<tr><td width='188' style='font-size:13px;padding:5px;border-right:1px solid #000;vertical-align:middle'>Remarks </td><td align=center style='font-size:13px;text-align:justiy'>

				<p align='left' >Chq / DD No:<b> ".$paymentdetails['mmp_txn']."</b>, Dt.<b>".date('d-m-Y')." </b>,<b> ".$paymentdetails['bank_name'].",</b> ".$paymentdetails['udf4'].", ".$narration."</td></tr>
			
			<tr><td width='90%' colspan='2'style='font-size:13px;padding:4px;border:1px solid #000'>
		
		</td>
		</tr>
			</table>
		
		</td>

	</tr>

	<tr valign=top style='font-size:13px;'>

		

			<table width=100%  hieght=25>

				<tr><td style='font-size:13px;' nowrap align=right> <p> </p>

					 <p>**Computer generated receipt</td></tr>

				</table>

	</tr>

</table></div><br><br>

</body>

</html>



";

	// $attachment= createPDF($html);

	$message .= $html;

	// echo $frommail.' '.$tomail.' '.$subject.' '.$message;

	sendMailIiit($frommail,$tomail,$subject,$message);

	// echo sendMailIWithAttachment($frommail,$tomail,$subject,$message,$attachment);

}

function sendMailIWithAttachment($from,$to,$subject,$message,$attachment='',$cc="",$Bcc=""){

		ini_set("include_path",".:/../usr/share/pear/");

		include_once ("/usr/share/pear/mime.php");

		echo "in email sending";

		$recipients = $to;

		$headers['From']    = $from;

		// $headers .= "Cc: ".$cc."\r\n";

        // $headers .= "Bcc: ".$Bcc."\r\n";

		$headers['Bcc']      = $Bcc;

		$headers['Cc']      = $cc;

		$headers['To']      = $to;

		$headers['Subject'] = $subject;

		// $headers['Cc'] = $from;

		$params['host'] = 'neelgiri.iiit.ac.in';

		$headers['MIME-Version']  = '1.0';

		$headers['Content-type']  = 'text/html';

		$headers['charset']  = 'iso-8859-1';

		

		$content = chunk_split(base64_encode($attachment));

		$mime = new Mail_mime();



		$mime->setTXTBody($text);

		$mime->setHTMLBody($html);



		$mime->addAttachment($content,'application/pdf');



		$body = $mime->get();

		$headers = $mime->headers($headers);

		

		// Create the mail object using the Mail::factory method

		$mail_object =& Mail::factory('smtp', $params) or print "Can create mail factory";

		$val=$mail_object->send($recipients, $headers, $message) or print "Cannot send mail";

		return $val;

}

function postReceipt($paymentpostdata){

		$trackid = $paymentpostdata['mmp_txn']; 

		$amount = $paymentpostdata['amt'];

		$name = $paymentpostdata['udf5'];

		$email=$paymentpostdata['udf2'];

		$narration="Being the amount received towards the Convocation registration fee.";

		$branch = "INSTITUTE";

		if(!empty($paymentpostdata)){

			$todate = date('Y-m-d');

			$dsDoc = getValueForPS("select * from pw_begend where stdate<='".$todate."' and enddate>='".$todate."'  and doctype=? and bucode=? and voupostingacc=?","sss","Bank Receipt","INSTITUTE","State Bank of India - 52081085019");

			// printr($dsDoc);

			$docseries = $dsDoc['docseries'];

			$docNo = getNewDocNumber($dsDoc['docseries'],1);

			$accCode="Convocation Expenses";

			// echo $docNo;

			$d1=DMY2YMD($_REQUEST['date']);			

			$accDs = getValueFor("select * from accountsmaster where accountsmastercode='".$accCode."'");

			// printr($accDs);

			

			 $entityDetails =getValueForPS("select regno4,currentyear,currentsem,sem_acadyear,sem_semester,curr_acadyear,curr_semester from pw_entity where entitycode='".$paymentpostdata['applicationid']."'");	

			

			$vouDs['accountsmastercode'] 	= $accDs['accountsmastercode'];

			$vouDs['accountname'] 			= $accDs['accountname'];

			$vouDs['accountschedules'] 		= $accDs['accountschedules'];

			$vouDs['bsschedules'] 			= $accDs['bsschedules'];

			$vouDs['accountgroups'] 		= $accDs['accountgroups'];

			$vouDs['entitycode'] 			= $paymentpostdata['applicationid'];

			$vouDs['entityname'] 			= $name; 

			$vouDs['degreecode'] 		= $entityDetails['regno4']; 

			$vouDs['semester'] 			= $entityDetails['currentsem'];

			$vouDs['acadyear'] 		    = $entityDetails['currentyear']; 

			$vouDs['paidto'] 			= $name;

			$vouDs['documentno'] 			= $docNo;

			$vouDs['documentdate'] 			= date('Y-m-d');

			//if(strtotime(date('Y-m-d'))>strtotime($dsDoc['enddate'])) $vouDs['documentdate'] = $dsDoc['enddate'];

			

			$vouDs['subacccode'] = $email;

			$vouDs['subaccname'] = $name; 

			

			$vouDs['refno'] 				= $paymentpostdata['mer_txn'];

			$vouDs['refdt'] 				= date('Y-m-d');

			$vouDs['docseries'] 			= $dsDoc['docseries'];

			$vouDs['doctype'] 				= $dsDoc['doctype'];

			$vouDs['bucode'] 				= $branch;

			$vouDs['buname'] 				= $branch;

			$vouDs['docstatus'] 			= "Posted";

			$vouDs['status'] 				= "Posted";

			$vouDs['debit'] 				= 0.00;

			$vouDs['debitfc'] 				= 0.00;

			$vouDs['credit'] 				= $paymentpostdata['amt'];

			$vouDs['creditfc'] 				= $paymentpostdata['amt'];

			$vouDs['remarks'] 				= $narration;

			$vouDs['currency'] 				= "INR";

			$vouDs['exrate'] 				= 1;

			$vouDs['abbr'] 					= $abbr;

			$vouDs['instrument'] = "Payment Gateway";

			$vouDs['bankname'] 				= $paymentpostdata['bank_name'];

			// $vouDs['bankaccountno'] 		= $ds['bankaccno'];

			$vouDs['chqno'] 				=  $paymentpostdata['mmp_txn'];

			$vouDs['chqdt'] 				= date('Y-m-d');

			// printr($vouDs);

			if($paymentpostdata['amt']>0){

				ds2insert($vouDs,"vouchers");

				// echo "created voacher";

			}

			

			// BAnk or Cash Record Inserting

			

			$accDs = getValueFor("select * from accountsmaster where accountsmastercode='".$dsDoc['voupostingacc']."'");

			$vouDs['accountsmastercode'] 	= $accDs['accountsmastercode'];

			$vouDs['accountname'] 			= $accDs['accountname'];

			$vouDs['accountschedules'] 		= $accDs['accountschedules'];

			$vouDs['bsschedules'] 			= $accDs['bsschedules'];

			$vouDs['accountgroups'] 		= $accDs['accountgroups'];

			$vouDs['debit'] 				= $paymentpostdata['amt'];

			$vouDs['debitfc'] 				= $paymentpostdata['amt'];

			$vouDs['credit'] 	= 0.00;

			$vouDs['creditfc'] 	= 0.00;

			if($paymentpostdata['amt']>0){

				ds2insert($vouDs,"vouchers");

				// echo "created voacher";

			}

			// $message.=  "".$ds['receipttype']." Receipt-".$docNo." Inserted in ".$branch;

			//$updateDS = "update reileffund set status='Paid', posteddate='".date('Y-m-d')."',voucher='".$docNo."', transactionid='".$paymentpostdata['mmp_txn']."', remarks='".$narration."' where donorid='".$_SESSION['donorid']."';";

			//PW_execute($updateDS);

			

			recordPaymentHistory($amount,$vouDs);

			return $docNo;

		}

		

	}
*/

?>
