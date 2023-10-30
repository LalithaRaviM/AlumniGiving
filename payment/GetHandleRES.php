<?php


include('../sqlinfo.php');
include('mailCode.php');
/*
******************************************************************
			* COMPANY    - FSS Pvt. Ltd.
*****************************************************************

Name of the Program : Hosted UMI Sample Pages
Page Description    : Receives response from Payment Gateway and handles the same
Response parameters : Result,Ref,Transaction id, Payment id,Auth Code, Track ID,
                      Amount, UDF1-UDF5
Values from Session : No
Values to Session   : No
Created by          : FSS Payment Gateway Team
Created On          : 19-04-2011
Version             : Version 2.0

***************************************************************** 
*/
/* Disclaimer:- Important Note in Sample Pages
- This is a sample demonstration page only ment for demonstration, this page should not be used in production
- Transaction data should only be accepted once from a browser at the point of input, and then kept in a way that does not allow others to modify it (example server session, database  etc.)
- Any transaction information displayed to a customer, such as amount, should be passed only as display information and the actual transactional data should be retrieved from the secure source last thing at the point of processing the transaction.
- Any information passed through the customer's browser can potentially be modified/edited/changed/deleted by the customer, or even by third parties to fraudulently alter the transaction data/information. Therefore, all transaction information should not be passed through the browser to Payment Gateway in a way that could potentially be modified (example hidden form fields). 
*/

/* Capture the IP Address from where the response has been received */
$strResponseIPAdd = getenv('REMOTE_ADDR');
//$strResponseIPAdd = getenv('HTTP_X_FORWARDED_FOR');
//$strResponseIPAdd = $_SERVER['HTTP_X_FORWARDED_FOR'];


//echo $strResponseIPAdd;


/* Check whether the IP Address from where response is received is PG IP */
//if($strResponseIPAdd == "221.134.101.174" || $strResponseIPAdd == "221.134.101.169" || $strResponseIPAdd == "198.64.129.10" || $strResponseIPAdd == "198.64.133.213")
//if($strResponseIPAdd == "221.134.101.175" || $strResponseIPAdd == "221.134.101.187" || $strResponseIPAdd == "221.134.101.166")
//{
if($strResponseIPAdd == "10.4.21.75" || $strResponseIPAdd == "221.134.101.175" || $strResponseIPAdd == "221.134.101.187" || $strResponseIPAdd == "221.134.101.166")
{

	$ErrorTx = isset($_POST['Error']) ? $_POST['Error'] : '';               //Error Number
	$ErrorResult = isset($_POST['ErrorText']) ? $_POST['ErrorText'] : '';   //Error message
	$payID = isset($_POST['paymentid']) ? $_POST['paymentid'] : '';			//Payment Id
	$METRANID = isset($_POST['trackid'])?$_POST['trackid']:'';              //Merchant Track ID

	/* Merchant (ME) checks, if error number is NOT present, then create Dual Verification 
	request, send to Paymnent Gateway. ME SHOULD ONLY USE PAYMENT GATEWAY TRAN ID FOR DUAL
	VERIFICATION */
    /* NOTE - MERCHANT MUST LOG THE RESPONSE RECEIVED IN LOGS AS PER BEST PRACTICE */

	if ($ErrorTx == '')
		{
			//To collect transaction result
			$txmessage = isset($_POST['result']) ? $_POST['result'] : '';

            //To collect Payment Gateway Transaction ID, this value will be used in dual verification request
			$pgtxnid = isset($_POST['tranid']) ? $_POST['tranid'] : '';     

			//To collect Merchant Track ID
			$txmeid = isset($_POST['trackid']) ? $_POST['trackid'] : '';

			//To collect amount from response
			$txamount = isset($_POST['amt'])?$_POST['amt']:'';             
			
		

	
			
			//To collect currency from response
			$txcurrencycode = isset($_POST['currencycode'])?$_POST['currencycode']:'';             
            
			//check result is captured or approved i.e. successful
			if ($txmessage == 'CAPTURED' || $txmessage == 'APPROVED')
			{
			   //result is successful, hence create dual verification request

			   //ID given by bank to Merchant (Tranportal ID), same iD that was passed in initial request
			  // $TranportalID = "<id>90002292</id>";
				
			//   $getUDF5 = $xmlSTR->udf5;
			
			$sql_qry1="select * from request_values where trackid='$txmeid'";
			$result = mysql_query($sql_qry1);
			if (!$result) {
			    die('Invalid query: ' . mysql_error());
			}

			while($sql_exe1=mysql_fetch_assoc($result))
			{
			        $currency=$sql_exe1['currency'];
			        $amount=$sql_exe1['amt'];
			        $name=$sql_exe1['name'];
			        $rollno=$sql_exe1['rollno'];
			        $email=$sql_exe1['email'];
			        $phoneno=$sql_exe1['phoneno'];
			}
			   
			   if($currency=="INR")	
			   {	
			   	$TranportalID = "<id>70003082</id>";

			   //Password given by bank to merchant (Tranportal Password), same password that was passed in initial request
		           	$TranportalPWD = "<password>70003082</password>";
			   }
			   else if ($currency=="USD")
			   {
			        $TranportalID = "<id>79020358</id>";
			        $TranportalPWD = "<password>79020358</password>";
			   }
			   else if ($currency=="GBP")
			   {	
        			$TranportalID = "<id>79030109</id>";
			        $TranportalPWD = "<password>79030109</password>";
			   }		
			   else if ($currency=="EUR")
			   {
			        $TranportalID = "<id>79040104</id>";
			        $TranportalPWD = "<password>79040104</password>";
			   }
			   else if ($currency=="AUD")
			   {
				$TranportalID = "<id>79090028</id>";
			        $TranportalPWD = "<password>79090028</password>";
			   }
			
			/*	
			   if($txcurrencycode==356)	
			   {	
			   	$TranportalID = "<id>70003082</id>";

			   //Password given by bank to merchant (Tranportal Password), same password that was passed in initial request
		           	$TranportalPWD = "<password>70003082</password>";
			   }
			   else if ($txcurrencycode==840)
			   {
			        $TranportalID = "<id>79020358</id>";
			        $TranportalPWD = "<password>79020358</password>";
			   }
			   else if ($txcurrencycode==826)
			   {	
        			$TranportalID = "<id>79030109</id>";
			        $TranportalPWD = "<password>79030109</password>";
			   }		
			   else if ($txcurrency==978)
			   {
			        $TranportalID = "<id>79040104</id>";
			        $TranportalPWD = "<password>79040104</password>";
			   }
			   else if ($txcurrency==036)
			   {
				$TranportalID = "<id>79090028</id>";
			        $TranportalPWD = "<password>79090028</password>";
			   }
	 		   else
			   {
				$TranportalID = "<id>70003082</id>";
				$TranportalPWD = "<password>70003082</password>";
			   }			

				*/
				
			   // Pass DUAL VERIFICATION action code, always pass "8" for DUAL VERIFICATION
			   $straction = "<action>8</action>";

			   //Pass PG Transaction ID for Dual Verification
			   $reqpgtxnid = "<transid>".$pgtxnid."</transid>";
			
			   //create string for request of input parameters
			   $ReqString = $TranportalID.$TranportalPWD.$straction.$reqpgtxnid;
			   
			   //DUAL VERIFIACTION URL, this is test environment URL, contact bank for production DUAL Verification URL
			 //  $DualReqURL = "https://securepgtest.fssnet.co.in/pgway/servlet/TranPortalXMLServlet";  // Test URL

			     $DualReqURL = "https://hdfcbankpayments.hdfcbank.com/PG/servlet/TranPortalXMLServlet"; //Production URL 	
			    // $DualReqURL = "https://securepg.fssnet.co.in/pgway/servlet/TranPortalXMLServlet"; //Production URL 	
			   
			   //PHP FUNCTION for connection and posting the request ..starts here
			   $dvreq = curl_init() or die(curl_error()); 
			   curl_setopt($dvreq, CURLOPT_POST,1); 
			   curl_setopt($dvreq, CURLOPT_POSTFIELDS,$ReqString); 
			   curl_setopt($dvreq, CURLOPT_URL,$DualReqURL); 
			   curl_setopt($dvreq, CURLOPT_PORT, 443);
			   curl_setopt($dvreq, CURLOPT_RETURNTRANSFER, 1); 
			   curl_setopt($dvreq, CURLOPT_SSL_VERIFYHOST,0); 
			   curl_setopt($dvreq, CURLOPT_SSL_VERIFYPEER,0); 
			   $dataret=curl_exec($dvreq) or die(curl_error());
			   curl_close($dvreq); 
  			   //PHP FUNCTION for connection and posting the request ..ends here

			   //XML response received for DUAL VERIFICATION.
			   /* 
			   NOTE - MERCHANT MUST LOG THE RESPONSE RECEIVED IN LOGS AS PER BEST PRACTICE
			   */
			   $DVresponse = $dataret;
			   //print_r $DVresponse;
			   $GEnXMLForm="<xmltg>".$DVresponse."</xmltg>";
			   $xmlSTR = simplexml_load_string( $GEnXMLForm,null,true);
               
			   //Collect DUAL VERIFICATION RESULT
			   $getTxnResult = $xmlSTR-> result;
               
			   //If DUAL VERIFICATION RESULT is CAPTURED or APPROVED
			   if ($getTxnResult == 'CAPTURED' || $getTxnResult == 'APPROVED')
				{
				  //collecting all mandatory parameters to update merchant database
				  $getTxnResult = $xmlSTR->result; //It will give Inquiry Result.
				  $getTxnAvr = $xmlSTR->avr; //It will give AVR value.
                  $getTxnPostDate = $xmlSTR->postdate; //It will give transaction date.

			      $getTxnAuthCode = $xmlSTR->auth; //It will give Auth Code.
                  $getTxnTrackID=$xmlSTR->trackid; //It will give Merchant TrackID/Merchant Reference NO
                  $getTxnTranid=$xmlSTR->tranid; //It will give TransactionID
                  $getTxnAmt=$xmlSTR->amt; //It will give Transaction Amount
	//		      $getTxnPaymentId=$xmlSTR->paymentid; //It will give PaymentID
		  $getTxnPaymentId=$xmlSTR->payid;		
			      $getTxnRefID = $xmlSTR->ref; //It will give Ref.NO.
                  $getUDF1 = $xmlSTR->udf1;    //It will give udf1
			      $getUDF2 = $xmlSTR->udf2;    //It will give udf2
			      $getUDF3 = $xmlSTR->udf3;	   //It will give udf3
			      $getUDF4 = $xmlSTR->udf4;	   //It will give udf4
			      $getUDF5 = $xmlSTR->udf5;	   //It will give udf5
				  /*
				  IMPORTANT NOTE - MERCHANT DOES RESPONSE HANDLING AND VALIDATIONS OF 
				  TRACK ID, AMOUNT AT THIS PLACE. THEN ONLY MERCHANT SHOULD UPDATE 
				  TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
				  AND THEN REDIRECT CUSTOMER ON RESULT PAGE
				  */
			$email2="$getUDF2";	
		include('../sqlinfo.php');
		
		
		//inserting to response values
		$query2 = "insert into response_values(trackid, paymentid, name, rollno, email, phoneno, currency, amt, ipaddr, result, avr, trans_date, trans_authcode, transid, trans_ref, error_res, error_msg) values(
		'" . addslashes($getTxnTrackID) . "', 
		'" . addslashes($getTxnPaymentId) . "', 
                '" . addslashes($getUDF4) . "', 
                '" . addslashes($getUDF1) . "', 
                '" . addslashes($getUDF2) . "', 
                '" . addslashes($getUDF3) . "', 
                '" . addslashes($currency) . "', 
                '" . addslashes($getTxnAmt) . "', 
                '" . addslashes($getUDF5) . "',
                '" . addslashes($getTxnResult) . "',
                '" . addslashes($getTxnAvr) . "',
                '" . addslashes($getTxnPostDate) . "',
                '" . addslashes($getTxnAuthCode) . "',
                '" . addslashes($getTxnTranid) . "',
                '" . addslashes($getTxnRefID) . "',
                '" . addslashes($ErrorTx) . "',
                '" . addslashes($ErrorResult) . "'
		)";					
			
		$result2 = mysql_query($query2)or die("Couldnot execute the Query- Response Values:" . mysql_error());

	//	$query3 = "select trackid, rollno, email, amt from request_values where trackid =$getTxnTrackID ";

          //      $result3 = mysql_query($query3)or die("Couldnot execute the Query- Request verification:" . mysql_error());
		
	//	$row = mysql_fetch_row($result3);
		
	//	if($row[1] == $getUDF2 && $row[2] == $getUDF3 && $row[3] == $getTxnAmt)
	//	if($row[2] == $getUDF3)
	//	{  
	
// Mial code start

	$email="$getUDF2";
	$email1="alumnifund@iiit.ac.in";
	$message=" Transaction Status... \n\n A Donation of $getUDF5 $getTxnAmt towards IIIT Hyderabad Alumni Fund \n\nPlease contact our administrator if you have any questions and quote the following:\n\nTrack ID:  $getTxnTrackID, \nName:  $getUDF4 , \nRoll Number: $getUDF1, \nEmail: $getUDF2 , \nAmount: $getTxnAmt, \nDate: $getTxnPostDate \nPayment ID: $getTxnPaymentId . ";
    
    $message1="Dear $getUDF4,
    
    We're in receipt of your kind donation of $getTxnAmt to the IIIT-H alumni fund.
    This donation is deeply appreciated and will certainly help the cause you have chosen to support. On behalf of the Institute I thank you for the same.
    A printed receipt (scanned copy) will be emailed to you shortly.
    
    Best wishes,
    
    Alumni Coordinator ";
	$tdate = date('d-M-Y');
	$sub = "Giving : ".$getUDF4.", ".$getTxnAmt.", Payment Success, ".$tdate;
	
	sendMail($email, "alumnifund@iiit.ac.in" ,$email , "Payment Received: $getTxnTrackID : $getUDF4 ", "$message");
	sendMail($email1, "alumnifund@iiit.ac.in" ,$email1 , $sub, "$message");
	sendMail($email, "alumnifund@iiit.ac.in" ,$email , "Payment Received: $getTxnTrackID : $getUDF4 ", "$message1");
	sendMail($email1, "alumnifund@iiit.ac.in" ,$email1 , $sub, "$message1");
// Mail code end

	
		/* !!IMPORTANT INFORMATION!!
        During redirection, ME can pass the values as per ME requirement.
		NOTE: NO PROCESSING should be done on the RESULT PAGE basis of values passed in the RESULT PAGE from this page. 
		ME does all validations on the responseURL page and then redirects the customer to RESULT 
		PAGE ONLY FOR RECEIPT PRESENTATION/TRANSACTION STATUS CONFIRMATION
		For demonstration purpose the result and track id are passed to Result page
		*/

	       	$REDIRECT = 'REDIRECT=https://alumnifund.iiit.ac.in/payment/StatusTRAN.php?message=PAYMENT SUCESSFUL'.'&ME_TX_ID='.$getTxnTrackID;
	      	echo $REDIRECT;
		 	
	//	}
		}
				else
				{
				  /*
				  IMPORTANT NOTE - MERCHANT SHOULD UPDATE 
				  TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
				  AND THEN REDIRECT CUSTOMER ON RESULT PAGE
				  */
					$ip = $_SERVER["REMOTE_ADDR"];
					 //inserting to error values
			                $query3 = "insert into error_values(trackid, paymentid, error_msg, error_result, ipaddr) values(
			                '" . addslashes($METRANID) . "', 
			                '" . addslashes($payID) . "', 
			                '" . addslashes($ErrorTx) . "', 
			                '" . addslashes($ErrorResult) . "', 
			                '" . addslashes($ip) . "')";

			                $result3 = mysql_query($query3)or die("Couldnot execute the Query- Error Values:" . mysql_error());	


					// Mail code start
					$email="$getUDF2";
					$email1="alumnifund@iiit.ac.in";
					$message=" Unable to process your donation for $getUDF5 $getTxnAmt at this point of time.\n We kindly request you to tyr again or contact administrator for support. \n Track ID:  $METRANID, \n  Name:  $getUDF4 , \n Roll Number: $getUDF1, \n  Email: $getUDF2 , \n Phone No: $getUDF3, \n Amount: $getTxnAmt, \n Date: $getTxnPostDate \n Payment ID: $payID. Error Text: $ErrorTx  ";

					sendMail($email, "alumnifund@iiit.ac.in" ,$email , "Payment Failed: $getTxnTrackID : $getUDF4 ", "$message");
					sendMail($email1, "alumnifund@iiit.ac.in" ,$email1 , "Payment Failed: $getTxnTrackID : $getUDF4 ", "$message");
					// Mail code end
					
					
					$REDIRECT = 'REDIRECT=https://alumnifund.iiit.ac.in/payment/FailedTRAN.php?message=ERROR - PAYMENT FAILED IN DUAL VERIFICATION ('.$getTxnResult.' )&ME_TX_ID='.$txmeid;
					echo $REDIRECT;
				
				}

			}
			else
			{

				/*
				IMPORTANT NOTE - MERCHANT SHOULD UPDATE 
				TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
				AND THEN REDIRECT CUSTOMER ON RESULT PAGE
				*/
				$ip = $_SERVER["REMOTE_ADDR"];
                                         //inserting to error values
                                        $query4 = "insert into error_values(trackid, paymentid, error_msg, error_result, ipaddr) values(
                                        '" . addslashes($METRANID) . "', 
                                        '" . addslashes($payID) . "', 
                                        '" . addslashes($ErrorTx) . "', 
                                        '" . addslashes($ErrorResult) . "', 
                                        '" . addslashes($ip) . "')";

                                        $result4 = mysql_query($query4)or die("Couldnot execute the Query- Error Values:" . mysql_error());
					
					// Mail code start
					$email="$getUDF2";
					$email1="alumnifund@iiit.ac.in";
					$message=" Unable to process your donation for $getUDF5 $getTxnAmt at this point of time.\n We kindly request you to tyr again or contact administrator for support. \n Track ID:  $METRANID, \n  Name:  $getUDF4 , \n Roll Number: $getUDF1, \n  Email: $getUDF2 , \n Phone No: $getUDF3, \n Amount: $getTxnAmt, \n Date: $getTxnPostDate \n Payment ID: $payID. Error Text: $ErrorTx  ";

					sendMail($email, "alumnifund@iiit.ac.in" ,$email , "Payment Failed: $getTxnTrackID : $getUDF4 ", "$message");
					sendMail($email1, "alumnifund@iiit.ac.in" ,$email1 , "Payment Failed: $getTxnTrackID : $getUDF4 ", "$message");
					// Mail code end


				$REDIRECT = 'REDIRECT=https://alumnifund.iiit.ac.in/payment/FailedTRAN.php?message=PAYMENT FAILED ('.$txmessage.' )&ME_TX_ID='.$txmeid;
				echo $REDIRECT;
				
			}



		//echo $REDIRECT;
	}
	else 
	{
				/*
				ERROR IN TRANSACTION PROCESSING
				IMPORTANT NOTE - MERCHANT SHOULD UPDATE 
				TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
				AND THEN REDIRECT CUSTOMER ON RESULT PAGE
				*/
 
				$ip = $_SERVER["REMOTE_ADDR"];
                                         //inserting to error values
                                        $query5 = "insert into error_values(trackid, paymentid, error_msg, error_result, ipaddr) values(
                                        '" . addslashes($METRANID) . "', 
                                        '" . addslashes($payID) . "', 
                                        '" . addslashes($ErrorTx) . "', 
                                        '" . addslashes($ErrorResult) . "', 
                                        '" . addslashes($ip) . "')";

                                        $result5 = mysql_query($query5)or die("Couldnot execute the Query- Error Values:" . mysql_error());
					
					
					// Mail code start
					$email="$getUDF2";
					$email1="alumnifund@iiit.ac.in";
					$message=" Unable to process your donation for $getUDF5 $getTxnAmt at this point of time.\n We kindly request you to tyr again or contact administrator for support. \n Track ID:  $METRANID, \n  Name:  $getUDF4 , \n Roll Number: $getUDF1, \n  Email: $getUDF2 , \n Phone No: $getUDF3, \n Amount: $getTxnAmt, \n Date: $getTxnPostDate \n Payment ID: $payID. Error Text: $ErrorTx  ";

					sendMail($email, "alumnifund@iiit.ac.in" ,$email , "Payment Failed: $getTxnTrackID : $getUDF4 ", "$message");
					sendMail($email1, "alumnifund@iiit.ac.in" ,$email1 , "Payment Failed: $getTxnTrackID : $getUDF4 ", "$message");
					sendMail($email2, "alumnifund@iiit.ac.in" ,$email2 , "Payment Failed: $getTxnTrackID : $getUDF4 ", "$message");
					// Mail code end


				$REDIRECT = 'REDIRECT=https://alumnifund.iiit.ac.in/payment/FailedTRAN.php?message=ERROR IN PROCESSING PAYMENT ('.$ErrorResult.' )&ME_TX_ID='.$METRANID;
				echo $REDIRECT;
	}


}


else //IF ip address recevied is not Payment Gateway IP Address
{
			/*
			IMPORTAN NOTE - IF IP ADDRESS MISMATCHES, ME LOGS DETAILS IN LOGS,
			UPDATES MERCHANT DATABASE WITH PAYMENT FAILURE, REDIRECTS CUSTOMER 
			ON FAILURE PAGE WITH RESPECTIVE MESSAGE
			*/

			$ip = $_SERVER["REMOTE_ADDR"];
			$ip2 = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                         //inserting to error values
                                        $query6 = "insert into error_values(trackid, paymentid, error_msg, error_result, ipaddr,ipaddrremote) values(
                                        '" . addslashes($METRANID) . "', 
                                        '" . addslashes($payID) . "', 
                                        '" . addslashes($ErrorTx) . "', 
                                        '" . addslashes($ErrorResult) . "', 
                                        '" . addslashes($ip) . "',
                                        '" . addslashes($ip2) . "')";

                                        $result6 = mysql_query($query6)or die("Couldnot execute the Query- Error Values:" . mysql_error());
					
					
					// Mail code start
					$email="$getUDF2";
					$email1="alumnifund@iiit.ac.in";
					$message=" Unable to process your donation for $getUDF5 $getTxnAmt at this point of time.\n We kindly request you to tyr again or contact administrator for support. \n Track ID:  $METRANID, \n  Name:  $getUDF4 , \n Roll Number: $getUDF1, \n  Email: $getUDF2 , \n Phone No: $getUDF3, \n Amount: $getTxnAmt, \n Date: $getTxnPostDate \n Payment ID: $payID. Error Text: $ErrorTx  ";

					sendMail($email, "alumnifund@iiit.ac.in" ,$email , "Payment Failed: $getTxnTrackID : $getUDF4 ", "$message");
					sendMail($email1, "alumnifund@iiit.ac.in" ,$email1 , "Payment Failed: $getTxnTrackID : $getUDF4 ", "$message");
					sendMail($email2, "alumnifund@iiit.ac.in" ,$email2 , "Payment Failed: $getTxnTrackID : $getUDF4 ", "$message");
					// Mail code end



			$REDIRECT = 'REDIRECT=https://alumnifund.iiit.ac.in/payment/FailedTRAN.php?message=IP ADDRESS MISMATCH';
			echo $REDIRECT;
}

/*
<!-- 
to get the IP Address in case of proxy server used
function getIPfromXForwarded() { 
$ipString=@getenv("HTTP_X_FORWARDED_FOR"); 
$addr = explode(",",$ipString); 
return $addr[sizeof($addr)-1]; 
} 
 
*/
?>


