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
						<h2 class='fs-title'>Thank You for your support<span style='float:right;'><img src='assets/fundraiser_logo.png' style='width:100px;'/></span></h2>
						
						<div class='inner-sc mb-4'>
							
							<div class='row'>
								<div class='col-md-12' style='float:left;'>
									<span>Dear <b>".$name."</b>,</span>
									<span><br><br>Your pledge of <b>".$data['currency']." ".$amt."</b> to support academic excellence and forward thinking innovation offers current and future generations of IIITH students a lasting gift. Your generous contribution will help create an enduring legacy. </span><br>
									<div><span><br>Please email alumnifund@iiit.ac.in with your transaction details when you have made your contribution.</span>  </div>
									<div><span><br>For more information on how to make you planned gift please contact</span>  </div>
									<span><br><b>Meenakshi Viswanathan</b></span> <br>
									<span>Resources and Development, CSR and Alumni Affairs</span> <br>
									<div><span>International Institute of Information Technology, Hyderabad</span> </div>
									<span><img src='email.png'>&nbsp;meenakshi.v@iiit.ac.in&nbsp;<img src='phone.png' style='width:14px;'>&nbsp;9866777958</span><br>
									<div><a href='https://www.iiit.ac.in' target='new'>https://www.iiit.ac.in</a> &nbsp;<a href='https://alumni.iiit.ac.in'>https://alumni.iiit.ac.in</a></span> </div><br>
									
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
$msg = "Dear ".$name.",\n\n Your pledge of <b>".$data['currency']." ".$amt."</b> to support academic excellence and forward thinking innovation offers current and future generations of IIITH students a lasting gift. Your generous contribution will help create an enduring legacy.\n
		\nPlease email alumnifund@iiit.ac.in with your transaction details when you have made your contribution.
		\nFor more information on how to make you planned gift please contact
		\nMeenakshi Viswanathan
		\nResources and Development, CSR and Alumni Affairs
		\nInternational Institute of Information Technology, Hyderabad
		\nmeenakshi.v@iiit.ac.in
		\n9866777958
		\nhttps://www.iiit.ac.in
		\nhttps://alumni.iiit.ac.in";
	if($data['email']!='')$email = $data['email'];
	else $email = "lalitha.gutha@iiit.ac.in";
	$cc = "alumnifund@iiit.ac.in";
	sendMail($email, "alumnifund@iiit.ac.in" ,$email, "Giving", $msg,$cc);
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