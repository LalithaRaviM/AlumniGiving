<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Colors of Success</TITLE>
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<META name="GENERATOR" content="IBM WebSphere Studio">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
<link href='../assets/style.css' rel='stylesheet'>
</HEAD>
<BODY>

<?php
include('../sqlinfo.php');

$txmessage = isset($_GET['message']) ? $_GET['message'] : '';
$txmeid= isset($_GET['ME_TX_ID']) ? $_GET['ME_TX_ID'] : '';

$query4 = "select * from response_values where trackid ='$txmeid'";
$result4 = mysql_query($query4);
if (!$result4) {
    die('Invalid query: ' . mysql_error());
} 

$row = mysql_fetch_assoc($result4);

$query5 = "select * from details where trackid ='$txmeid'";
$result5 = mysql_query($query5);
if (!$result5) {
    die('Invalid query: ' . mysql_error());
} 

$data = mysql_fetch_assoc($result5);
?>

<header>
	<div class='container'>
		<div class='nav-section'>
			<img src='../assets/IIIT-logo.png' />
			<h3 class='h3-sc'></h3>
		</div>
	</div>
</header>
<br><br>
<TABLE align=center border=1  bordercolor=black style='margin-left:550px;'><tr><td style='padding:20px;'>
<TABLE align=center border=0  bordercolor=black ><tr><td>
	<TR>
		<TD colspan="2" align="center">
			<FONT size="4"><B> Transaction Details  </B></FONT>
		</TD>
	</TR>
	<TR>
		<TD colspan="2" align="center">
			<HR>
		</TD>
	</TR>
<!--		<TR>
			<TD width="40%">Your Transaction ID</TD>
			<TD><?php echo $txmeid;?></TD>
		</TR>

		<TR>
			<TD>Your Transaction Payment Status</TD>
			<TD><?php echo $txmessage;?></TD>
		</TR>
-->		
	<tr><td>Transaction Reference: </td><td><?php echo $data['name']." ".$data['lastname'];?> </td></tr>
	<!--<tr><td>Roll number: </td><td>bbbbbbbbbbbbbbbbbbbbb<?php echo $row['rollno'];?> </td></tr>-->
	<tr><td>Payment Id: </td><td><?php echo $row['paymentid'];?> </td></tr>
	<tr><td>Transaction Track ID: </td><td><?php echo $row['trackid'];?> </td></tr>
	<tr><td>Transaction Amount: </td><td><?php echo $row['amt'];?> </td></tr>
	<tr><td>Transaction Date: </td><td><?php echo $row['amt'];?> </td></tr>

	</td></tr></table></td></tr>
</table><br>
	<main>
		<div class='container'>
			<div class='inner-sc mb-4'>
				<div class='row' >
					<div class='col-md-12' >
					<span><br>Dear <?php echo $data['name']." ".$data['lastname'];?>,</span><br><br>
					<span>We're in receipt of your kind donation of <?php echo $row['amt'];?> to the IIIT-H alumni fund.
					This donation is deeply appreciated and will certainly help the cause you have chosen to support. On behalf of the Institute, I thank you for the same. <br>A printed receipt (scanned copy) will be emailed to you shortly.<br><br> If you have any queries, please write to <b>alumnifund@iiit.ac.in</b>
					</span><br><br>
					<p>Best wishes,<br>Alumni Fund Coordinator</p>
					</div>
				</div>
			</div>
		</div>	
	</main>	
</BODY>
</HTML>
<!-- Disclaimer:- Important Note in Sample Pages
- This is a sample demonstration page only ment for demonstration, this page should not be used in production
- Transaction data should only be accepted once from a browser at the point of input, and then kept in a way that does not allow others to modify it (example server session, database  etc.)
- Any transaction information displayed to a customer, such as amount, should be passed only as display information and the actual transactional data should be retrieved from the secure source last thing at the point of processing the transaction.
- Any information passed through the customer's browser can potentially be modified/edited/changed/deleted by the customer, or even by third parties to fraudulently alter the transaction data/information. Therefore, all transaction information should not be passed through the browser to Payment Gateway in a way that could potentially be modified (example hidden form fields). 
 -->
