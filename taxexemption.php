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
						<h2 class='fs-title'>Donations in US Dollars<span style='float:right;'><img src='assets/fundraiser_logo.png' style='width:100px;'/></span> <br>requiring tax exemptions in USA</h2>
						<div class='inner-sc mb-4'>
							<div class='row' >
								<div class='col-md-12' style='float:left;'>
									<span>Dear <b>".$name.",</b> </span><br>
									<span><b>Please make your contribution of ".$amt." to :</b></span> <br><hr>
								</div>	
							</div>	
						</div>
						<div class='inner-sc mb-4'>
							<div class='row'>
								<div class='col-md-12' style='float:left;'>
									<span><b>Account Name:</b></span> <span>IIIT HYDERABAD ALUMNI FOUNDATION </span><br>
									<span><b>Account number:</b></span> <span style='color:#007bff;'>000000730967038</span>  <br>
									<span><b>Bank:</b></span> CHASE Business Checking Account<br>
									<span><b>Bank Address:</b></span> 215 Kirkland Ave, Kirkland, WA 98033<br>
									<div><span><b>Routing Number:</b></span> 325070760</div>
								</div>	
							</div>	
						</div>
						<div class='inner-sc mb-4'>
							<div class='row'>
								<div class='col-md-12' style='float:left;'>
									<span><hr>Please email your transaction details to <b>alumnifund@iiit.ac.in</b> once you have made your contribution. </span>
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
	Account Name: IIIT HYDERABAD ALUMNI FOUNDATION
	Account number: 000000730967038
	Bank: CHASE Business Checking Account
	Bank Address: 215 Kirkland Ave, Kirkland, WA 98033
	Routing Number: 325070760\n\n
	Please email your transaction details to alumnifund@iiit.ac.in once you have made your contribution.

	Thank you.";
	
if($data['email']!='')$email = $data['email'];
else $email = "lalitha.gutha@iiit.ac.in";
$cc = "alumnifund@iiit.ac.in";
	sendMail($email, "alumnifund@iiit.ac.in" ,$email, "Donation Information", $msg,$cc);
					
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