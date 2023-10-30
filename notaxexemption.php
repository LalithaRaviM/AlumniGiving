<?php
include('sqlinfo.php');
include('payment/mailCode.php');
$connection = connect_to_database();
$dataSQL = "select * from details where trackid='".$_REQUEST['trackno']."'";
$result = mysql_query($dataSQL, $connection);
while($ds=mysql_fetch_assoc($result)){	
	$data = $ds;
}
$name = $data['name']." ".$data['lastname'];
$amt  = $data['amt'];
if($data['anonymous_type']!=''){
	if($data['anonymous_type']=='Silent Donor'){
		$name = 'Anonymous';
		$amt  = 'Anonymous';
	}	
	if($data['anonymous_type']=='Anonymous Donor')$name = 'Anonymous';
	if($data['anonymous_type']=='Anonymous Amount')$amt  = 'Anonymous';
}
$form = "
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset='utf-8'>
			<meta content='width=device-width, initial-scale=1.0' name='viewport'>
			<meta http-equiv='Cache-Control' content='no-cache, no-store, must-revalidate' />
			<meta http-equiv='Pragma' content='no-cache' />
			<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
			<link href='assets/style.css' rel='stylesheet'>
		</head>
		<body>
			<header>
				<div class='container'>
					<div class='nav-section'>
						<img src='assets/IIIT-logo.png' />
						<h3 class='h3-sc'>Alumni Giving</h3>
					</div>
				</div>
			</header>
			<main>
				<div class='container'>
					<form id='msform' name='msform'>
					<fieldset>
						<h2 class='fs-title'>Donations in US Dollars & Foreign Currencies<span style='float:right;'><img src='assets/fundraiser_logo.png' style='width:100px;'/></span></h2>
						<div class='inner-sc mb-4'>
							<div class='row' >
								<div class='col-md-12' >
									<span>Dear <b>".$name.",</b> </span><br>
									<span><b>Please make your contributions:</b></span> <br>
								</div>	
							</div>	
						</div>
						
						<div class='inner-sc mb-4'>
							<h3 class='fs-subtitle' style='color:#007bff;'>Through cheque/draft payable to <hr></h3>
							<div class='row'>
								<div class='col-md-12' style='float:left;'>
									<span>INTERNATIONAL INSTITUTE OF INFORMATION TECHNOLOGY </span><br>
									<span><b>Postal Address:</b>
									<span>Alumni Affairs,</span>  <br>
									<span>Admin Block - 3rd Floor,</span><br>
									<span>International Institute of Information Technology Hyderabad,</span> <br>
									<span>Prof. C R Rao Road, Gachibowli,</span> <br>
									<div><span>Hyderabad 500 032,Telangana, INDIA</span></div>
								</div>	
							</div>	
						</div>
						
						<div class='inner-sc mb-4'>
							
							<div class='row'>
								<div class='col-md-12' style='float:left;'>
									<span><b>Phone:</b></span> <span>+91-40-6653 1000 </span><br>
									<span>Alumni Affairs:</span> <span>+91-040-6653-1777</span>  <br>
									<span><b>Email:</b></span> alumnifund@iiit.ac.in<br>
									<span>alumnifund@iiit.ac.in</span><br>
									 
								</div>	
							</div>	
						</div>
						
						<div class='inner-sc mb-4'>
							<h3 class='fs-subtitle' style='color:#007bff;'>Through Wire Transfer<hr></h3>
							<div class='row'>
								<div class='col-md-12' style='float:left;'>
									<span><b>Account Name:</b></span> <span>INTERNATIONAL INSTITUTE OF INFORMATION TECHNOLOGY </span><br>
									<span><b>Account number:</b></span> <span style='color:#007bff;'>40108515397</span>  <br>
									<span><b>Bank:</b></span> STATE BANK OF INDIA<br>
									<span><b>Bank Address:</b></span> FCRA Cell, 4th Floor, State Bank of India, <br>New Delhi Main Branch, 11 Sansad Marg, New Delhi- 110001<br>
									<span><b>Bank Email:</b></span> fcra.00691@sbi.co.in
								</div>	
							</div>	
													
							<div class='row'>
								<div class='col-md-12' style='float:left;'>
									<span><br><b>Branch Code:</b></span> <span>00691 </span><br>
									<span><b>IFS Code:</b></span> <span>SBIN0000691</span>  <br>
									<span><b>Swift Code:</b></span> SBININBB104<br>
									<span><b>IIITH FCRA Registration Number:</b></span> 010230920<br>
									 
								</div>	
							</div>	
						</div>
						
						<div class='inner-sc mb-4'>
							
							<div class='row'>
								<div class='col-md-12' style='float:left;'>
									<hr><p style='font-size:16px;color:#ec3131;'>
									Note *: Please ensure you choose the option for the amount to be transferred in the foreign currency so that our FCRA account receives it as foreign currency and not converted into INR. This will minimize the intermediary handling fees deducted.
									</p>								 
								</div>	
							</div>	
						</div>
						
						<div class='inner-sc mb-4'>
							<div class='row'>
								<div class='col-md-12' style='float:left;'>
									<span>Please email your transaction details to <b>alumnifund@iiit.ac.in</b> once you have made your contribution. </span>
									<span><br><br><center><b>Thank you.</b></center></span>
								</div>
							</div>
						</div>	
					</fieldset>	
					</form>
				</div>
			</main>
		</body>
</html>";

echo $form;
// sending above information as a mail to donor
$msg = "Dear ".$name.",\n\n Thank you for giving the donation.\n
	Please make your contributions:\n
	Through cheque/draft payable to : \n
	INTERNATIONAL INSTITUTE OF INFORMATION TECHNOLOGY
	Postal Address: Alumni Affairs,
	Admin Block - 3rd Floor,
	International Institute of Information Technology Hyderabad,
	Prof. C R Rao Road, Gachibowli,
	Hyderabad 500 032,Telangana, INDIA
	Phone: +91-40-6653 1000
	Alumni Affairs: +91-040-6653-1777
	Email: alumnifund@iiit.ac.in
	alumnifund@iiit.ac.in \n\n
	Through Wire Transfer : \n
	Account Name: INTERNATIONAL INSTITUTE OF INFORMATION TECHNOLOGY
	Account number: 40108515397
	Bank: STATE BANK OF INDIA
	Bank Address: FCRA Cell, 4th Floor, State Bank of India,
	New Delhi Main Branch, 11 Sansad Marg, New Delhi- 110001
	Bank Email: fcra.00691@sbi.co.in

	Branch Code: 00691
	IFS Code: SBIN0000691
	Swift Code: SBININBB104
	IIITH FCRA Registration Number: 010230920\n\n
	Please email your transaction details to alumnifund@iiit.ac.in once you have made your contribution.

	Thank you.";

if($data['email']!='')$email = $data['email'];
else $email = "lalitha.gutha@iiit.ac.in";
$cc = "alumnifund@iiit.ac.in";
sendMail($email, "alumnifund@iiit.ac.in" ,$email, "Donation Information", $msg);
					
function connect_to_database(){
	$con=mysql_connect("localhost","alumniadmin","mideapass");
	if ($con)
		mysql_select_db("alumnifund");
	else
	{
		echo "err ",mysql_error();
		exit();
	}
	return $con;
}

?>