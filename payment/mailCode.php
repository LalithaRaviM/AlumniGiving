
<?php
ini_set("include_path",".:/usr/share/pear/");
include('Mail.php'); // located by default at: /usr/share/pear/Mail.php
function sendMail($recipients,$from,$to,$subject,$body,$cc="")
{

	$recipients = "$to";

$headers['From']    = "$from";
$headers['To']      = "$to";
if($cc!='')$headers['cc'] = $cc;
$headers['Subject'] = "$subject";

$body = "$body";

//$params['host'] = '10.4.2.202';
//$params['host'] = '10.4.2.250';
$params['host'] = 'neelgiri.iiit.ac.in';
//$params['host'] = '10.4.2.100';

// Create the mail object using the Mail::factory method

$mail_object =& Mail::factory('smtp', $params) or print "Can create mail factory";
$val=$mail_object->send($recipients, $headers, $body) or print "Cannot send mail";


return $val;
#if($val){
#print "SEnt Mail succesfully";
#}
#else{
	print "Cannot Deliver mail";
#}


}
?>

