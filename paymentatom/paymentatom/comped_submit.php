<?php
	include "config.php";
	include "payment.php";
	session_start();
	
	// print_r($_SESSION);
	// echo "***************<br/>";
	// print_r($_POST);
	// echo "\n****************************<br/>";
	
	if(empty($_SESSION) or empty($_SESSION['regid'] ) and !$_SESSION['spaymentflag']){
		header('location: /registration.php');
	}
	// exit;

	class ProcessPayment {

		function __construct(){

			$this->paymentConfig = new payment_config();

		}

		function requestMerchant(){

			$payment = new payment();

			date_default_timezone_set('Asia/Calcutta');

			$datenow = date("d/m/Y h:m:s");

			// $payment = new payment();

			// $this->paymentConfig = new payment_config();

			$transactionDate = str_replace(" ", "%20", $datenow);

			$transactionId = $_POST['trackid'];


			$mode = "live";
			$mode = "test"; 

			$login = $this->paymentConfig->Login;

			$pass = $this->paymentConfig->Password;

			$ProductId = $_POST['product'];

			$amount = round($_SESSION['atom_pay_amount'],0);

			$Currency = $this->paymentConfig->TxnCurr;

			$ClientCode = $_POST['clientcode'];

			// $CustomerNam = $this->paymentConfig->MerchantName;

			$CustomerNam = $_SESSION['susername'];

			$EmailId = $_SESSION['smail'] ;

			$Mobile = $_SESSION['sphone'];

			$BillingAddress = 'Hyderabad';

			$Account = $_POST['AccountNo']; 

			$HashKey = $this->paymentConfig->ReqHashKey;

			$applicationid = $_POST['applicationid'];

			require_once 'TransactionRequest.php';

			$transactionRequest = new TransactionRequest();

				
			////Production Code

			if($mode == 'live') {

				 $transactionRequest->setMode($mode);

				$transactionRequest->setLogin($login); 

				$transactionRequest->setPassword($pass);

				$transactionRequest->setProductId($ProductId);

				$transactionRequest->setAmount($amount);

				$transactionRequest->setTransactionCurrency($Currency);

				$transactionRequest->setTransactionAmount($amount);

				

				$transactionRequest->setReturnUrl($_POST['ru']);

				$transactionRequest->setClientCode($ClientCode);

				$transactionRequest->setTransactionId($transactionId);

				$transactionRequest->setTransactionDate($transactionDate);

				$transactionRequest->setCustomerName($CustomerNam);

				$transactionRequest->setCustomerEmailId($EmailId );

				$transactionRequest->setCustomerMobile($Mobile);

				$transactionRequest->setCustomerBillingAddress($BillingAddress);

				$transactionRequest->setCustomerAccount($Account);

				$transactionRequest->setReqHashKey($HashKey); 

				

			}

			

			 ////Test Code

			 //Setting all values here

		else if($mode == 'test') {

				$transactionRequest->setMode($mode);

				$transactionRequest->setLogin(197); 

				$transactionRequest->setPassword("Test@123");

				

				// $transactionRequest->setProductId("NSE");

				// $transactionRequest->setAmount($amount);

				// $transactionRequest->setTransactionCurrency("INR");

				// $transactionRequest->setTransactionAmount($amount);

				// $transactionRequest->setReturnUrl("https://ims-dev.iiit.ac.in/payment/covid19_response.php");

				// $transactionRequest->setClientCode($applicationid);

				// $transactionRequest->setTransactionId($transactionId);

				// $transactionRequest->setTransactionDate($transactionDate);

				// $transactionRequest->setCustomerName("ramesh reddy");

				// $transactionRequest->setCustomerEmailId("ramesh.br@test.com");

				// $transactionRequest->setCustomerMobile("9999999999");

				// $transactionRequest->setCustomerBillingAddress("Mumbai");

				// $transactionRequest->setCustomerAccount("639827");

				// $transactionRequest-> setReqHashKey($HashKey); 

				

				$transactionRequest->setProductId("NSE");

				$transactionRequest->setAmount($amount);

				$transactionRequest->setTransactionCurrency($Currency);

				$transactionRequest->setTransactionAmount($amount);

				

				$transactionRequest->setReturnUrl($_POST['ru']);

				$transactionRequest->setClientCode($ClientCode);

				$transactionRequest->setTransactionId($transactionId);

				$transactionRequest->setTransactionDate($transactionDate);

				$transactionRequest->setCustomerName($CustomerNam);

				$transactionRequest->setCustomerEmailId("lalitha.gutha@iiit.ac.in");

				$transactionRequest->setCustomerMobile($Mobile);

				$transactionRequest->setCustomerBillingAddress($BillingAddress);

				$transactionRequest->setCustomerAccount($Account);

				$transactionRequest->setReqHashKey($HashKey); 

		}

			  

			  

			$url = $transactionRequest->getPGUrl();

			// echo $url;

			// exit;

			header("Location: $url");

			

		}

		

		function writeLog($data){
			//echo "dddddd";
			//exit;
			$fileName = date("Y-m-d").".txt"; 

			$fp = fopen("log/".$fileName, 'a+');

			$data = date("Y-m-d H:i:s")." - ".$data;

			fwrite($fp,$data);

			fclose($fp); 

		}



		function xmltoarray($data){

			$parser = xml_parser_create('');

			xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); 

			xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);

			xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);

			xml_parse_into_struct($parser, trim($data), $xml_values);

			xml_parser_free($parser);

			

			$returnArray = array();

			$returnArray['url'] = $xml_values[3]['value'];

			$returnArray['tempTxnId'] = $xml_values[5]['value'];

			$returnArray['token'] = $xml_values[6]['value'];



			return $returnArray;

		} 

	}

	function hash_hmacatom($str, $ReqHashKey){

		$sign   =  hash_hmac('sha512', $str, $ReqHashKey);

		return $sign;

	}

	

	$processPayment = new ProcessPayment();

//	$processPayment->storeData();

	$processPayment->requestMerchant();

?>
