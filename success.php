<?php
//error_reporting(E_ALL);
//ini_set('display_errors',1);
session_start();
include('sqlinfo.php');

extract($_GET,EXTR_OVERWRITE);
extract($_POST,EXTR_OVERWRITE);
extract($_COOKIE,EXTR_OVERWRITE);

// Tracking Number - 25 Charecter Length
$trackid  = "IIITH";                                    // IIITH Prefix
$trackid .= date("YmdHi");                              // 4 + 2 + 2 + 2 + 2 = 12 Digits
$trackid .= mt_rand(9999999, 99999999); // 8 Digits

if(isset($_POST[submit]))
{
	$name = $_POST['name'];
	$rollno = $_POST['rollno'];
	$email = $_POST['email'];
	$phoneno = $_POST['phoneno'];
	$program = $_POST['program'];
	$branch = $_POST['branch'];
	$countryfrom = $_POST['countryfrom'];
	$currency= $_POST['currency'];
	$amt= $_POST['amt'];
	$usedfor= $_POST['usedfor'];
	$donationmode= $_POST['donationmode'];
	$pan_no = $_POST['pan_no'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zipcode = $_POST['zipcode'];
	$country = $_POST['country'];
	
	$dob = $_POST['dob'];
	$lname = $_POST['lname'];
	$joinyear = $_POST['joinyear'];
	$gradyear = $_POST['endyear'];
	$compname = $_POST['comp'];
	$citizenship = $_POST['indianforeign'];
	$infraAmt = $_POST['infra'];
	$tuitionAmt = $_POST['tuition'];
	$researchAmt = $_POST['others'];
	$genpurposeAmt = $_POST['allamt'];
	$corpusAmt = $_POST['corpus'];
	$donationflag = $_POST['fcrasbi'];
	$donationdate = date('Y-m-d H:i:s');
	$donationtype = $_POST['alumni'];
	
	$matchprogram = $_POST['orgn_match'];
	$matchprogram_name = $_POST['name_match'];
	$donation_period = $_POST['giving_for'];
	$donation_time = $_POST['recuring_gap'];
	$donation_status = $_POST['submit'];
	
	$donation_anonymous  = $_POST['anonymous'];
	
	$ip = $_SERVER["REMOTE_ADDR"];
	
        // Tracking Number - 25 Charecter Length
        $trackid  = "IIITH";                                    // IIITH Prefix
        $trackid .= date("YmdHi");                              // 4 + 2 + 2 + 2 + 2 = 12 Digits
        $trackid .= mt_rand(9999999, 99999999); // 8 Digits

	
	$sql_qry = "insert into details(
	trackid,
	name,
	rollno,
	email,
	phoneno,
	program,
	branch,
	countryfrom,
	currency,
	amt,
	usedfor,
	donationmode,
	pan_no,
	address1,
	address2,
	city,
	state,
	zipcode,
	country,
	ipaddr,
	dob,
	lastname,
	joinyear,
	graduationyear,
	compname,
	citizenship,
	infraamount,
	tuitionamount,
	
	researchamount,
	generalamount,
	corpusamount,
	donationdate,
	donationflag,
	matchprogram,
	matchprogram_name,
	donation_period,
	donation_time,
	donationstatus,
	anonymous_type
	)
	values(
	'" . addslashes($trackid) . "', 
	'" . addslashes($name) . "', 
	'" . addslashes($rollno) . "', 
	'" . addslashes($email) . "', 
	'" . addslashes($phoneno) . "', 
	'" . addslashes($program) . "', 
	'" . addslashes($branch) . "', 
	'" . addslashes($countryfrom) . "', 
	'" . addslashes($currency) . "', 
	'" . addslashes($amt) . "', 
	'" . addslashes($usedfor) . "', 
	'" . addslashes($donationmode) . "', 
	'" . addslashes($pan_no) . "', 
	'" . addslashes($address1) . "', 
	'" . addslashes($address2) . "', 
	'" . addslashes($city) . "', 
	'" . addslashes($state) . "', 
	'" . addslashes($zipcode) . "', 
	'" . addslashes($country) . "', 
	'" . addslashes($ip) . "',
	'" . addslashes($dob) . "', 
	'" . addslashes($lname) . "', 
	'" . addslashes($joinyear) . "', 
	'" . addslashes($gradyear) . "', 
	'" . addslashes($compname) . "', 
	'" . addslashes($citizenship) . "', 
	'" . addslashes($infraAmt) . "', 
	'" . addslashes($tuitionAmt) . "', 
	'" . addslashes($researchAmt) . "', 
	'" . addslashes($genpurposeAmt) . "', 
	'" . addslashes($corpusAmt) . "', 
	'" . addslashes($donationdate) . "', 
	'" . addslashes($donationflag) . "',
	'" . addslashes($matchprogram) . "',
	'" . addslashes($matchprogram_name) . "',
	'" . addslashes($donation_period) . "',
	'" . addslashes($donation_time) . "',	
	'" . addslashes($donation_status) . "',	
	'" . addslashes($donation_anonymous) . "'	
	)"; 

	$sql_exe = mysql_query($sql_qry)or die("Couldnot execute the Query:" . mysql_error());
	$_SESSION['trackid']=$trackid;
}

	if($donation_status=='Donate Later'){
		$_SESSION['trackid']=$trackid;
		header("Location:donatelater.php?trackno=".$trackid);
		exit;
	}
	
	if($donationmode=="CreditCard" || $donationflag=='')
	{
		header("Location:payment/SendPerformREQ.php");
	}
	
	else if($donationmode=="WireTransfer" || $donationflag=='yes')
	{
        header("Location:notaxexemption.php?trackno=".$trackid);
        

	}
	else if($donationmode=="ByCheque" || $donationflag=='no')
	{
        header("Location:taxexemption.php?trackno=".$trackid);
        
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Alumni of IIIT-H</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>

</head>
<body id="main_body" >
	
	<img id="top" src="top.png" alt="">
	<div id="form_container">
	
		<h1><a>Alumni of IIIT-H</a></h1>
		<form id="form" class="appnitro"  method="post" action="payment/SendPerformREQ.php">
					<div class="form_description">
		<center>
			<h2>Alumni of IIIT-H</h2>
			<p>Online Payment Gateway</p>
		</center>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="name">Name </label>
		<div>
			<input id="name" name="name" class="element text medium" type="text" maxlength="255" value="<? print $name; ?>" readonly/> 
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="trackid">Track ID </label>
		<div>
			<input id="trackid" name="trackid" class="element text medium" type="text" maxlength="255" value="<? print $trackid; ?>" readonly/> 
		</div> 
		</li>	
		<li id="li_3" >
		<label class="description" for="amt">Amount </label>
		<div>
			<input id="amt" name="amt" class="element text medium" type="text" maxlength="255" value="<? print $amt; ?>" readonly/> 
		</div> 
		</li>
		<li id="li_3" >
		<div>
			<input id="currency" name="currency" class="element text medium" type="hidden" maxlength="255" value="<? print $currency; ?>"/> 
			<input id="rollno" name="rollno" class="element text medium" type="hidden" maxlength="255" value="<? print $rollno; ?>"/> 
			<input id="email" name="email" class="element text medium" type="hidden" maxlength="255" value="<? print $email; ?>"/> 
			<input id="phoneno" name="phoneno" class="element text medium" type="hidden" maxlength="255" value="<? print $phoneno; ?>"/> 
			<input id="program" name="program" class="element text medium" type="hidden" maxlength="255" value="<? print $program; ?>"/> 
			<input id="branch" name="branch" class="element text medium" type="hidden" maxlength="255" value="<? print $branch; ?>"/> 
		<input id="countryfrom" name="countyfrom" class="element text medium" type="hidden" maxlength="255" value="<? print $countryfrom; ?>"/> 
			<input id="pan_no" name="pan_no" class="element text medium" type="hidden" maxlength="255" value="<? print $pan_no; ?>"/> 
			<input id="address1" name="address1" class="element text medium" type="hidden" maxlength="255" value="<? print $address1; ?>"/> 
			<input id="address2" name="address2" class="element text medium" type="hidden" maxlength="255" value="<? print $address2; ?>"/> 
			<input id="city" name="city" class="element text medium" type="hidden" maxlength="255" value="<? print $city; ?>"/> 
			<input id="state" name="state" class="element text medium" type="hidden" maxlength="255" value="<? print $state; ?>"/> 
			<input id="zipcode" name="zipcode" class="element text medium" type="hidden" maxlength="255" value="<? print $zipcode; ?>"/> 
			<input id="country" name="country" class="element text medium" type="hidden" maxlength="255" value="<? print $country; ?>"/> 
		</div> 
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="291504" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Pay" />
		</li>
			</ul>
		</form>	
		<div id="footer">
		</div>
	</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>
	

