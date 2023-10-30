<?php

echo "<script type='text/javascript'>
function nonalumniForm(){
	document.getElementById('rollno').style.display='none';
	document.getElementById('program').style.display='none';
	document.getElementById('branch').style.display='none';
	document.getElementById('joinyear').style.display='none';
	document.getElementById('endyear').style.display='none';
	document.getElementById('alumni').value='nonalumni';
	
}
function alumniForm(){
	document.getElementById('program').style.display='';
	document.getElementById('branch').style.display='';
	document.getElementById('rollno').style.display='';
	document.getElementById('joinyear').style.display='';
	document.getElementById('endyear').style.display='';
	
}
function foreignForm(){
	document.getElementById('pan_no').style.display='none';
	
}
function indianForm(){
	document.getElementById('pan_no').style.display='';
	
}
function displayAmtForm(){
	document.getElementById('amtdiv').style.display='';
}
function displayBoxes(){
	curr = document.getElementById('currency').value;
	if(curr=='INR'){
		document.getElementById('cur_inr').style.display='';
		document.getElementById('usa_inr').style.display='none';
		document.getElementById('eur_inr').style.display='none';
		document.getElementById('gbp_inr').style.display='none';
		document.getElementById('taxcheck').style.display='none';
		
	}
	if(curr=='USD' || curr=='AUD'){
		document.getElementById('taxcheck').style.display='';
		document.getElementById('usa_inr').style.display='';
		document.getElementById('cur_inr').style.display='none';
		document.getElementById('eur_inr').style.display='none';
		document.getElementById('gbp_inr').style.display='none';
	}
	if(curr=='EUR'){
		document.getElementById('taxcheck').style.display='';
		document.getElementById('usa_inr').style.display='none';
		document.getElementById('cur_inr').style.display='none';
		document.getElementById('eur_inr').style.display='';
		document.getElementById('gbp_inr').style.display='none';
	}
	if(curr=='GBP'){
		document.getElementById('usa_inr').style.display='none';
		document.getElementById('cur_inr').style.display='none';
		document.getElementById('eur_inr').style.display='none';
		document.getElementById('gbp_inr').style.display='';
		document.getElementById('taxcheck').style.display='';
		
	}
}

function openDiv(obj){
	obj1 = document.getElementById('chk_'+obj).checked;
	if(obj1==true)document.getElementById('div_'+obj).style.display='block';
	else document.getElementById('div_'+obj).style.display='none';
}

function closeDiv(obj){
	if(document.getElementById(obj).value==''){
		document.getElementById('div_'+obj).style.display='';
	}else {
		document.getElementById('div_'+obj).style.display='none';
	}
}

function checkForm(){
	alum = document.getElementById('alumni').value;
	jyear = document.getElementById('joinyear').value;
	givingAmt = document.getElementById('amt').value;
	givingFor = document.getElementById('giving_for').value;
	prog = document.getElementById('program').value;
	deg = document.getElementById('branch').value;

	if(alum=='alumni' && jyear==''){
		alert('Please fill Year of join');
		document.getElementById('joinyear').focus();
		return false;
	}
	if(alum=='alumni' && prog==''){
		alert('Please select Program');
		return false;
	}
	if(alum=='alumni' && deg==''){
		alert('Please select Stream');
		return false;
	}
	if(givingFor=='onetime' && givingAmt==''){
		alert('Please enter Amount');
		document.getElementById('amt').focus();
		return false;
	}
	
	infrachk = document.getElementById('chk_infra').checked;
	tuitionchk = document.getElementById('chk_tuition').checked;
	researchchk = document.getElementById('chk_others').checked;
	generalchk = document.getElementById('chk_allamt').checked;
	corpuschk = document.getElementById('chk_corpus').checked;
	if(infrachk==false && tuitionchk==false && researchchk==false && generalchk==false && corpuschk==false){
		alert('You have not allocated your contribution to a particular cause. If you wish to allocate, please choose one or more options below and enter the amount for it. If no allocations are made your contribution will go to the General Purpose Fund.');
		document.getElementById('allamt').focus();
		return false;
	}
	infraAmt = document.getElementById('infra').value;
	tuitionAmt = document.getElementById('tuition').value;
	researchAmt = document.getElementById('others').value;
	generalAmt = document.getElementById('allamt').value;
	corpusAmt = document.getElementById('corpus').value;
	totamt = infraAmt+tuitionAmt+researchAmt+generalAmt+corpusAmt;
	if(givingAmt>totamt){
		alert('Allocation amounts do not tally with total contribution');
		document.getElementById('amt').focus();
		return false;
	}
	return true;
	
}

function fillForm(typ){
	
	document.getElementById('name').value='Test';
	document.getElementById('lname').value='User';
	document.getElementById('rollno').value='20223456';
	document.getElementById('email').value='test@iiit.ac.in';
	document.getElementById('mobile').value='9999999999';
	document.getElementById('program').value='Others';
	document.getElementById('branch').value='others';
	document.getElementById('joinyear').value='2016';
	document.getElementById('endyear').value='2018';
	document.getElementById('amt').value='1000';
	document.getElementById('allamt').value='1000';
	document.getElementById('address').value='Lane1';
	document.getElementById('address2').value='Lane2';
	document.getElementById('city').value='Test City';
	document.getElementById('state').value='Test State';
	document.getElementById('country').value='Test Country';
	document.getElementById('zipcode').value='500019';
	document.getElementById('c3').value=document.getElementById('capcheck').value;
	
	
}
</script>
";
$currencyCombo = "<select required name='currency' id='currency' class='input-select' onchange='displayBoxes();'>
					<option value=''>--Select Currency *--</option>
					<option value='INR' selected>INR</option>
					<option value='USD'>USD</option>
					<option value='EUR'>EUR</option>
					<option value='AUD'>AUD</option>
					<option value='GBP'>GBP</option>
				</select>";
$program = "<select class='input-select' id='program' name='program'> 
				<option value='' selected='disabled selected'>Select Program *</option>
				<option value='btech' >B.Tech</option>
				<option value='dualdegree' >Dual Degree</option>
				<option value='btech_honors' >B.Tech Honors</option>
				<option value='MSbyResearch' >M S by Research</option>
				<option value='M_Sc' >M.Sc</option>
				<option value='M_Phil' >M.Phil</option>
				<option value='M_Tech' >M.Tech</option>
				<option value='Post_BSc' >Post B.Sc</option>
				<option value='PGDAAIT' >PGDAAIT</option>
				<option value='PhD' >PhD</option>
				<option value='Others' >Others</option>
			</select>";	

$stream = "<select class='input-select' id='branch' name='branch'> 
				<option value='' selected='disabled selected'>Select Stream *</option>
				<option value='cse' >CSE</option>
				<option value='ece' >ECE</option>
				<option value='csd' >CSD</option>
				<option value='ecd' >ECD</option>
				<option value='cnd' >CND</option>
				<option value='vlsi' >VLSI</option>
				<option value='case' >CASE</option>
				<option value='csis' >CSIS</option>
				<option value='cl' >CL</option>
				<option value='cld' >CLD</option>
				<option value='ehd' >EHD</option>
				<option value='bioinformatics' >Bioinformatics</option>
				<option value='cns' >CNS</option>
				<option value='itinbuild' >IT in Building Science</option>
				<option value='itinPower' >IT in Power Systems</option>
				<option value='spatial' >Spatial Informatics</option>
				<option value='cognitive' >Cognitive Science</option>
				<option value='exact_hu' >Exact Humanities</option>
				<option value='others' >Others</option>
			</select>";		

$countryCombo = getCountryList();

$recurringCombo = "<select name='recuring_gap' id='recuring_gap' class='input-select' style='display:none;'>
					<option value=''>--Select Frequency *--</option>
					<option value='monthly'>Monthly</option>
					<option value='quarterly'>Quarterly</option>
					<option value='yearly'>Yearly</option>
					<option value='others'>Others</option>
				</select>";	
// captcha
$c1 = rand(1,99);				
$c2 = rand(1,99);
$c3 = $c1+$c2;				
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
				<form id='msform' method='post' name='msform' onSubmit='return checkForm();' action='success.php'>
					<fieldset>
					
						<h2 class='fs-title'>Donation - Details<span style='float:right;'><img src='assets/fundraiser_logo.png' style='width:100px;'/></span>
						</h2>
						<div class='inner-sc mb-4'>
							<p style='font-size:14px;color:#ec3131;'>Note : * fields are mandatory</p>
							<h3 class='fs-subtitle'>Are you an alumnus / alumna</h3>
							<div class='row'>
								<div class='col-md-6' style='float:left;'>
									<input type='radio' name='alumni' id='alumni' value='alumni' onclick='alumniForm();' class='input-check' checked>&nbsp;Yes
								</div>
								<div class='col-md-6'>
									<input type='radio' name='alumni' id='alumni' value='nonalumni' onclick='nonalumniForm();' class='input-check'>&nbsp;No
								</div>
							</div>	
						</div>
						<div class='inner-sc mb-4'>
							<h3 class='fs-subtitle'>Personal Details<hr></h3>
							<div class='row'>
								<div class='col-md-6'>
									<input type='text' name='name' id='name' placeholder='First Name *' value='' required/>
									<input type='text' name='email' id='email' placeholder='Email *' required/>
									".$program."
									<input type='text' name='rollno' id='rollno' value='' placeholder='Roll number or year of admission into IIIT-H' />
									<input type='text' name='dob' id='dob' placeholder='Date of Birth' onfocus=\"(this.type='date')\" title='Date of Birth'/>
									
								</div>
								<div class='col-md-6'>
									<input type='text' name='lname' id='lname' placeholder='Last Name *' required/>
									<input type='text' name='phoneno' id='phoneno' placeholder='Contact Number' />
									".$stream."
									<input type='text' name='joinyear' id='joinyear' placeholder='Year of Join *' />
									<input type='text' name='endyear' id='endyear' placeholder='Year of Graduation' />
									
									
								</div>
							</div>
						</div>
						<div class='inner-sc mb-4'>
							<h3 class='fs-subtitle'>Select Citizenship<hr></h3>
							<div class='row'>
								<div class='col-md-6'>
									<input type='radio' name='indianforeign' id='indianforeign' value='Indian' class='input-check' onclick='indianForm();' checked>&nbsp;Indian Citizen
								</div>
								<div class='col-md-6'>
									<input type='radio' name='indianforeign' id='indianforeign' value='Foreign' class='input-check' onclick='foreignForm();'>&nbsp;Foreign Citizen
								</div>
								<p style='font-size:14px;margin-left:20px;color:#67c4dc;'>Note *: Select the option 'Indian citizen' if you want to donate using debit card/credit card/net banking issued in India or else select the option 'Foreign citizen'</p>
																
							</div>	
						</div>
						<div class='inner-sc mb-4'>
							<h3 class='fs-subtitle'>Amount Details<hr></h3>
							<div class='row'>
								<div class='col-md-6'><label>Currency</label></div>
								<div class='col-md-6'>".$currencyCombo."</div>								
							</div>
							<div class='row' style='display:none;' id='taxcheck'>
								<p style='font-size:16px;margin-left:20px;color:#d7214e;'>
									Note *: All donations in Foreign currency directly to the IIITH FCRA SBI account will not be tax exempted.
									<br>
									For donations in USD requiring tax exemption you may choose to donate to the IIITHAF(USA) account.</p>
									<div class='col-md-6' style='float:left;'>
									<input type='radio' name='fcrasbi' id='fcrasbi' value='yes' class='input-check'>&nbsp;Donate directly to IIITH FCRA SBI Account
								</div>
								<div class='col-md-6'>
									<input type='radio' name='fcrasbi' id='fcrasbi' value='no' class='input-check'>&nbsp;Donate to IIITHAF(USA)<br>
								</div>	
							</div>
						</div>	
						<div class='inner-sc mb-4'>
							<div class='row'>
								<div class='col-md-12'>
									<p>Giving For</h3>
								</div>
							</div>
							<div class='row'>
								<div class='col-md-4' style='float:left;'>
									<input type='radio' name='giving_for' id='giving_for' value='onetime' class='input-check' checked onclick='document.getElementById(\"recuring_gap\").style.display=\"none\";document.getElementById(\"dlater\").style.display=\"none\"'>&nbsp;One Time Donation
								</div>
								<div class='col-md-4'>
									<input type='radio' name='giving_for' id='giving_for' value='recurring' class='input-check' onclick='document.getElementById(\"recuring_gap\").style.display=\"\";document.getElementById(\"dlater\").style.display=\"\"'>&nbsp;Recurring
									<p>".$recurringCombo."</p>
								</div>
								<div class='col-md-4'>
									<input type='radio' name='giving_for' id='giving_for' value='pledge' class='input-check' onclick='document.getElementById(\"recuring_gap\").style.display=\"none\";document.getElementById(\"dlater\").style.display=\"\"'>&nbsp;Planned Gift / Pledge
								</div>									
							</div>	
						</div>	
						<div class='inner-sc mb-4'>
							<!-- INR Boxes -->
							<div class='row' id='cur_inr'>
								<div class='col-md-12'><button name='fivethousand' id='fivethousand' value='5000' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"5000\"'>₹5000</button>
								<button name='tenthousand' id='tenthousand' value='10000' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"10000\"'>₹10000</button>
								<button name='lakh' id='lakh' value='100000' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"100000\"'>₹1Lakh</button>
								<button name='lakh2' id='lakh2' value='200000' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"200000\"'>₹2Lakhs</button>
								<button name='other' id='other' value='Other' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"\"'>₹Other</button>
								</div>
							</div>
							<!-- USA Boxes -->
							<div class='row' id='usa_inr' style='display:none;'>
								<div class='col-md-12'><button name='one' id='one' value='500' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"500\"'>$500</button>
								<button name='two' id='two' value='1000' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"1000\"'>$1000</button>
								<button name='three' id='three' value='1500' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"1500\"'>$1500</button>
								<button name='four' id='four' value='2000' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"2000\"'>$2000</button>
								<button name='other' id='other' value='Other' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"\"'>\$Other</button>
								</div>
							</div>
							<!-- EUR Boxes -->
							<div class='row' id='eur_inr' style='display:none;'>
								<div class='col-md-12'><button name='one' id='one' value='500' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"500\"'>€500</button>
								<button name='two' id='two' value='1000' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"1000\"'>€1000</button>
								<button name='three' id='three' value='1500' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"1500\"'>€1500</button>
								<button name='four' id='four' value='2000' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"2000\"'>€2000</button>
								<button name='other' id='other' value='Other' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"\"'>€Other</button>
								</div>
							</div>
							<!-- GBP Boxes -->
							<div class='row' id='gbp_inr' style='display:none;'>
								<div class='col-md-12'><button name='one' id='one' value='500' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"500\"'>£500</button>
								<button name='two' id='two' value='1000' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"1000\"'>£1000</button>
								<button name='three' id='three' value='1500' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"1500\"'>£1500</button>
								<button name='four' id='four' value='2000' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"2000\"'>£2000</button>
								<button name='other' id='other' value='Other' class='btn btn-info' onclick='document.getElementById(\"contribution\").style.display=\"\";document.getElementById(\"amt\").value=\"\"'>£Other</button>
								</div>
							</div>
							</div>
							<div class='inner-sc mb-4'>
							<div class='row' id='contribution' >
								<div class='col-md-6'><label>Amount</label></div>
								<div class='col-md-6'><input type='number' name='amt' id='amt' placeholder='Total Amount *' /></div>								
							</div>
						<div class='row' id='amtdiv' >
								<p style='font-size:14px;margin-left:20px;color:#ec3131;'>Your contribution will go towards the causes you have selected. You may choose more than one.<br>If there is no selection your contribution will go to the 'General Purpose Fund'.</p>
								<div class='col-md-6'><input type='checkbox' name='chk_infra' id='chk_infra' class='input-check' onclick='openDiv(\"infra\");'>&nbsp;Infrastructure</div>
								<div class='col-md-6'><input type='number' name='infra' id='infra' placeholder='Amount' onchange='closeDiv(\"infra\")'/>
									<div id='div_infra' style='display:none;font-size:14px;color:#ec3131;'>Please mention the Infrastructure Amount</div>
								</div>
								
								<div class='col-md-6'><input type='checkbox' name='chk_tuition' id='chk_tuition' class='input-check' onclick='openDiv(\"tuition\");'>&nbsp;Tuition Support</div>
								<div class='col-md-6'><input type='number' name='tuition' id='tuition' placeholder='Amount' onchange='closeDiv(\"tuition\")'/>	
								<div id='div_tuition' style='display:none;font-size:14px;color:#ec3131;'>Please mention the Tuition Support Amount</div>
								</div>
								
								<div class='col-md-6'><input type='checkbox' name='chk_others' id='chk_others' class='input-check' onclick='openDiv(\"others\");'>&nbsp;Research</div>
								<div class='col-md-6'><input type='text' name='others' id='others' placeholder='Amount' onchange='closeDiv(\"others\")'/>
									<div id='div_others' style='display:none;font-size:14px;color:#ec3131;'>Please mention the Research Amount</div>
								</div>
								
								<div class='col-md-6'><input type='checkbox' name='chk_allamt' id='chk_allamt' class='input-check' onclick='openDiv(\"allamt\");'>&nbsp;General Purpose Fund</div>
								<div class='col-md-6'><input type='text' name='allamt' id='allamt' placeholder='Amount' onchange='closeDiv(\"allamt\")'/>
									<div id='div_allamt' style='display:none;font-size:14px;color:#ec3131;'>Please mention the General Purpose Fund Amount</div>
								</div>								
								
								<div class='col-md-6'><input type='checkbox' name='chk_corpus' id='chk_corpus' class='input-check' onclick='openDiv(\"corpus\");'>&nbsp;Institute Corpus Fund</div>
								<div class='col-md-6'><input type='text' name='corpus' id='corpus' placeholder='Amount' onchange='closeDiv(\"corpus\")'/>
									<div id='div_corpus' style='display:none;font-size:14px;color:#ec3131;'>Please mention the Corpus Amount</div>
								</div>
								
								</div>
							</div>	
						
						<div class='inner-sc mb-4'>
							<h3 class='fs-subtitle'><hr></h3>
							<div class='row'>
								<div class='col-md-6' style='float:left;'>
									Organisation / Company you are with
								</div>	
								<div class='col-md-6' style='float:left;'>
									<input type='text' name='comp' id='comp' placeholder='Company Name' />
								</div>
							</div>	
						</div>
						<div class='inner-sc mb-4'>
							<div class='row'>
								<div class='col-md-12'>
									<p>Does your organisation/company participate in any match program. (Many employers sponsor matching gift programs and will match any charitable contributions made by their employees)</h3>
								</div>
							</div>
							<div class='row'>
								<div class='col-md-4' style='float:left;'>
									<input type='radio' name='orgn_match' id='orgn_match' value='Yes' class='input-check'>&nbsp;Yes
								</div>
								<div class='col-md-4'>
									<input type='radio' name='orgn_match' id='orgn_match' value='No' class='input-check'>&nbsp;No
								</div>
								<div class='col-md-4'>
									<input type='radio' name='orgn_match' id='orgn_match' value='NA' class='input-check'>&nbsp;Not Sure
								</div>									
							</div>	
						</div>
						<div class='inner-sc mb-4'>
							<div class='row'>
								<div class='col-md-6' style='float:left;'>
									Name of the matching gift partner<br><p style='font-size:14px;'>(e.g. Benevity/ YourCause/ Engage/ CyberGrants ...)</p>
								</div>	
								<div class='col-md-6' style='float:left;'>
									<input type='text' name='name_match' id='name_match' placeholder='' />
								</div>
							</div>	
							<div class='row'>
								<div class='col-md-12'>
									<p style='font-size:14px;color:#17a2b8;'>If the employer is eligible, request a matching gift form from the employer, and send a copy of  it completed and signed to alumnifund@iiit.ac.in</p>
								</div>
							</div>
						</div>
						
						<div class='inner-sc mb-4'>
							<h3 class='fs-subtitle'>Donate Anonymously<hr></h3>
							<div class='row'>
								<div class='col-md-12'>
									<p>It is our honor to recognise our donors and patrons in our fundraising raising reports, listings on our webpage and other appropriate forums. We also respect your need for privacy. If you wish your name  or your donation amount or both your name and amount to be anonymous, please choose from the options below. Your personal details will be known only to the institute and you will recieve the receipt and tax exemption as applicable.</p>								
								</div>
							</div>
							<div class='row'>
								<div class='col-md-12' style='float:left;'>
									<input type='radio' name='anonymous' id='anonymous' value='Silent Donor' class='input-check'>&nbsp;Silent Donor (Name and amount anonymous)
								</div>
								<div class='col-md-12'>
									<input type='radio' name='anonymous' id='anonymous' value='Anonymous Donor' class='input-check'>&nbsp;Anonymous Donor (Donor Name anonymous, amount will be listed)
								</div>
								<div class='col-md-12'>
									<input type='radio' name='anonymous' id='anonymous' value='Anonymous Amount' class='input-check'>&nbsp;Anonymous Amount (Donor Name will be listed, amount will be anonymous)
								</div>
							</div>
						</div>
						
						<div class='inner-sc mb-4'>
							<h3 class='fs-subtitle'>Please specify the address to where the receipt should be mailed<hr></h3>
							<div class='row'>
								<div class='col-md-6'>
									<input type='text' name='address1' id='address1' placeholder='Address Line-1 *' required/>
									<input type='text' name='city' id='city' placeholder='City' />
									<input type='text' name='zipcode' id='zipcode' placeholder='Pin code' />
									<input type='text' name='zip' id='zip' placeholder='Zip code' style='display:none;'/>
									<input type='text' name='pan_no' id='pan_no' placeholder='PAN Card No' />
									
									
								</div>
								<div class='col-md-6'>
									<input type='text' name='address2' id='address2' placeholder='Address Line-2'/>
									<input type='text' name='state' id='state' placeholder='State *' required/>
									<!--<input type='text' name='country' id='country' placeholder='Country *' required/>-->
									".$countryCombo."
								</div>
							</div>
						</div>
						<div class='inner-sc mb-4'>
							<h3 class='fs-subtitle'>CAPTCHA<hr></h3>
							<div class='row'>
								<div class='col-md-12'>
								<input type='text' readonly name='c1' id='c1' value='".$c1."' style='width:100px;background-color:#eee;'/> 
								<span>+</span> 
								<input type='text' readonly name='c2' id='c2' value='".$c2."' style='width:100px;background-color:#eee;'/>
								<span>=</span>
								<input type='text' name='c3' id='c3' value='' style='width:200px;'/>
								<input type='hidden' name='capcheck' id='capcheck' value='".$c3."'/>
								</div>
							</div>	
						</div>	
					
					<input type='submit' name='submit' class='submit action-button' value='Donate Now' />
					<input type='submit' name='submit' id='dlater' class='submit action-button' style='display:none;' value='Donate Later' />
					<!--<button class='btn btn-info' onclick='fillForm(\"Indian\");' >Test User(Fill)</button>-->
					
					</fieldset>
					
				</form>
				</div>
			</main>
		</body>
</html>";

echo $form;

function getCountryList(){
	$countryCombo = "<select class='input-select' id='country' name='country' required> 
			<option value='' selected='disabled selected'>Select Country *</option>
			<option value='Afghanistan' >Afghanistan</option>
			<option value='Albania' >Albania</option>
			<option value='Algeria' >Algeria</option>
			<option value='Andorra' >Andorra</option>
			<option value='Antigua and Barbuda' >Antigua and Barbuda</option>
			<option value='Argentina' >Argentina</option>
			<option value='Armenia' >Armenia</option>
			<option value='Australia' >Australia</option>
			<option value='Austria' >Austria</option>
			<option value='Azerbaijan' >Azerbaijan</option>
			<option value='Bahamas' >Bahamas</option>
			<option value='Bahrain' >Bahrain</option>
			<option value='Bangladesh' >Bangladesh</option>
			<option value='Barbados' >Barbados</option>
			<option value='Belarus' >Belarus</option>
			<option value='Belgium' >Belgium</option>
			<option value='Belize' >Belize</option>
			<option value='Benin' >Benin</option>
			<option value='Bhutan' >Bhutan</option>
			<option value='Bolivia' >Bolivia</option>
			<option value='Bosnia and Herzegovina' >Bosnia and Herzegovina</option>
			<option value='Botswana' >Botswana</option>
			<option value='Brazil' >Brazil</option>
			<option value='Brunei' >Brunei</option>
			<option value='Bulgaria' >Bulgaria</option>
			<option value='Burkina Faso' >Burkina Faso</option>
			<option value='Burundi' >Burundi</option>
			<option value='Cambodia' >Cambodia</option>
			<option value='Cameroon' >Cameroon</option>
			<option value='Canada' >Canada</option>
			<option value='Cape Verde' >Cape Verde</option>
			<option value='Central African Republic' >Central African Republic</option>
			<option value='Chad' >Chad</option>
			<option value='Chile' >Chile</option>
			<option value='China' >China</option>
			<option value='Colombia' >Colombia</option>
			<option value='Comoros' >Comoros</option>
			<option value='Congo' >Congo</option>
			<option value='Costa Rica' >Costa Rica</option>
			<option value='Côte d'Ivoire' >Côte d'Ivoire</option>
			<option value='Croatia' >Croatia</option>
			<option value='Cuba' >Cuba</option>
			<option value='Cyprus' >Cyprus</option>
			<option value='Czech Republic' >Czech Republic</option>
			<option value='Denmark' >Denmark</option>
			<option value='Djibouti' >Djibouti</option>
			<option value='Dominica' >Dominica</option>
			<option value='Dominican Republic' >Dominican Republic</option>
			<option value='East Timor' >East Timor</option>
			<option value='Ecuador' >Ecuador</option>
			<option value='Egypt' >Egypt</option>
			<option value='El Salvador' >El Salvador</option>
			<option value='Equatorial Guinea' >Equatorial Guinea</option>
			<option value='Eritrea' >Eritrea</option>
			<option value='Estonia' >Estonia</option>
			<option value='Ethiopia' >Ethiopia</option>
			<option value='Fiji' >Fiji</option>
			<option value='Finland' >Finland</option>
			<option value='France' >France</option>
			<option value='Gabon' >Gabon</option>
			<option value='Gambia' >Gambia</option>
			<option value='Georgia' >Georgia</option>
			<option value='Germany' >Germany</option>
			<option value='Ghana' >Ghana</option>
			<option value='Greece' >Greece</option>
			<option value='Grenada' >Grenada</option>
			<option value='Guatemala' >Guatemala</option>
			<option value='Guinea' >Guinea</option>
			<option value='Guinea-Bissau' >Guinea-Bissau</option>
			<option value='Guyana' >Guyana</option>
			<option value='Haiti' >Haiti</option>
			<option value='Honduras' >Honduras</option>
			<option value='Hong Kong' >Hong Kong</option>
			<option value='Hungary' >Hungary</option>
			<option value='Iceland' >Iceland</option>
			<option value='India' >India</option>
			<option value='Indonesia' >Indonesia</option>
			<option value='Iran' >Iran</option>
			<option value='Iraq' >Iraq</option>
			<option value='Ireland' >Ireland</option>
			<option value='Israel' >Israel</option>
			<option value='Italy' >Italy</option>
			<option value='Jamaica' >Jamaica</option>
			<option value='Japan' >Japan</option>
			<option value='Jordan' >Jordan</option>
			<option value='Kazakhstan' >Kazakhstan</option>
			<option value='Kenya' >Kenya</option>
			<option value='Kiribati' >Kiribati</option>
			<option value='North Korea' >North Korea</option>
			<option value='South Korea' >South Korea</option>
			<option value='Kuwait' >Kuwait</option>
			<option value='Kyrgyzstan' >Kyrgyzstan</option>
			<option value='Laos' >Laos</option>
			<option value='Latvia' >Latvia</option>
			<option value='Lebanon' >Lebanon</option>
			<option value='Lesotho' >Lesotho</option>
			<option value='Liberia' >Liberia</option>
			<option value='Libya' >Libya</option>
			<option value='Liechtenstein' >Liechtenstein</option>
			<option value='Lithuania' >Lithuania</option>
			<option value='Luxembourg' >Luxembourg</option>
			<option value='Macedonia' >Macedonia</option>
			<option value='Madagascar' >Madagascar</option>
			<option value='Malawi' >Malawi</option>
			<option value='Malaysia' >Malaysia</option>
			<option value='Maldives' >Maldives</option>
			<option value='Mali' >Mali</option>
			<option value='Malta' >Malta</option>
			<option value='Marshall Islands' >Marshall Islands</option>
			<option value='Mauritania' >Mauritania</option>
			<option value='Mauritius' >Mauritius</option>
			<option value='Mexico' >Mexico</option>
			<option value='Micronesia' >Micronesia</option>
			<option value='Moldova' >Moldova</option>
			<option value='Monaco' >Monaco</option>
			<option value='Mongolia' >Mongolia</option>
			<option value='Montenegro' >Montenegro</option>
			<option value='Morocco' >Morocco</option>
			<option value='Mozambique' >Mozambique</option>
			<option value='Myanmar' >Myanmar</option>
			<option value='Namibia' >Namibia</option>
			<option value='Nauru' >Nauru</option>
			<option value='Nepal' >Nepal</option>
			<option value='Netherlands' >Netherlands</option>
			<option value='New Zealand' >New Zealand</option>
			<option value='Nicaragua' >Nicaragua</option>
			<option value='Niger' >Niger</option>
			<option value='Nigeria' >Nigeria</option>
			<option value='Norway' >Norway</option>
			<option value='Oman' >Oman</option>
			<option value='Pakistan' >Pakistan</option>
			<option value='Palau' >Palau</option>
			<option value='Panama' >Panama</option>
			<option value='Papua New Guinea' >Papua New Guinea</option>
			<option value='Paraguay' >Paraguay</option>
			<option value='Peru' >Peru</option>
			<option value='Philippines' >Philippines</option>
			<option value='Poland' >Poland</option>
			<option value='Portugal' >Portugal</option>
			<option value='Puerto Rico' >Puerto Rico</option>
			<option value='Qatar' >Qatar</option>
			<option value='Romania' >Romania</option>
			<option value='Russia' >Russia</option>
			<option value='Rwanda' >Rwanda</option>
			<option value='Saint Kitts and Nevis' >Saint Kitts and Nevis</option>
			<option value='Saint Lucia' >Saint Lucia</option>
			<option value='Saint Vincent and the Grenadines' >Saint Vincent and the Grenadines</option>
			<option value='Samoa' >Samoa</option>
			<option value='San Marino' >San Marino</option>
			<option value='Sao Tome and Principe' >Sao Tome and Principe</option>
			<option value='Saudi Arabia' >Saudi Arabia</option>
			<option value='Senegal' >Senegal</option>
			<option value='Serbia and Montenegro' >Serbia and Montenegro</option>
			<option value='Seychelles' >Seychelles</option>
			<option value='Sierra Leone' >Sierra Leone</option>
			<option value='Singapore' >Singapore</option>
			<option value='Slovakia' >Slovakia</option>
			<option value='Slovenia' >Slovenia</option>
			<option value='Solomon Islands' >Solomon Islands</option>
			<option value='Somalia' >Somalia</option>
			<option value='South Africa' >South Africa</option>
			<option value='Spain' >Spain</option>
			<option value='Sri Lanka' >Sri Lanka</option>
			<option value='Sudan' >Sudan</option>
			<option value='Suriname' >Suriname</option>
			<option value='Swaziland' >Swaziland</option>
			<option value='Sweden' >Sweden</option>
			<option value='Switzerland' >Switzerland</option>
			<option value='Syria' >Syria</option>
			<option value='Taiwan' >Taiwan</option>
			<option value='Tajikistan' >Tajikistan</option>
			<option value='Tanzania' >Tanzania</option>
			<option value='Thailand' >Thailand</option>
			<option value='Togo' >Togo</option>
			<option value='Tonga' >Tonga</option>
			<option value='Trinidad and Tobago' >Trinidad and Tobago</option>
			<option value='Tunisia' >Tunisia</option>
			<option value='Turkey' >Turkey</option>
			<option value='Turkmenistan' >Turkmenistan</option>
			<option value='Tuvalu' >Tuvalu</option>
			<option value='Uganda' >Uganda</option>
			<option value='Ukraine' >Ukraine</option>
			<option value='United Arab Emirates' >United Arab Emirates</option>
			<option value='United Kingdom' >United Kingdom</option>
			<option value='United States' >United States</option>
			<option value='Uruguay' >Uruguay</option>
			<option value='Uzbekistan' >Uzbekistan</option>
			<option value='Vanuatu' >Vanuatu</option>
			<option value='Vatican City' >Vatican City</option>
			<option value='Venezuela' >Venezuela</option>
			<option value='Vietnam' >Vietnam</option>
			<option value='Yemen' >Yemen</option>
			<option value='Zambia' >Zambia</option>
			<option value='Zimbabwe' >Zimbabwe</option>
	</select>					
";		

return $countryCombo;
	
}

?>