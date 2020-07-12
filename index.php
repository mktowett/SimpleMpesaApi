<?php
//includes
include_once('classes/Validation.class.php');
include_once('classes/C2B.class.php');
include_once('classes/LogResponse.class.php');
include_once('classes/RegisterUrl.class.php');


//objects
$validate = new Validation();
$c2b = new C2B();
$log = new LogResponse();
$curl = curl_init();
$registration = new RegisterUrl();

//constants
$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$credentials = base64_encode('bQiBO8A0X5Oy4Of2Hl0RVConTBIjuFIC:1jw3Vw5oNS5RYfrK');
$CONSUMER_KEY = 'bQiBO8A0X5Oy4Of2Hl0RVConTBIjuFIC';
$CONSUMER_SECRET = '1jw3Vw5oNS5RYfrK';


$logFile = "logs/c2b.txt";
$token='nVn7MCOTV5prlPdsJOhbby7zvDW4';
$urlC2B='https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
$shortCode='601446';
$commandID='CustomerPayBillOnline';
$amount='200';
$msisdn='254708374149';
$billRefNumber='Test Simulation';

$registrationUrl='https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

$responseType='Confirmed';
$confirmationURL='http://jochebedscrib.org/victor/confirmation_url.php';
$validationURL='http://jochebedscrib.org/victor/validation.php';

$data = array();
//register url
$data = $validate->invokeRegistration($url,$curl,$credentials);
echo 'is: '.$data['access_token'];
//$registration ->regUrl($token,$registrationUrl,$curl,$shortCode,$responseType,$confirmationURL,$validationURL);


/*//c2b txn
$value = $c2b->invokeC2B($token,$urlC2B,$shortCode,$commandID,$amount,$msisdn,$billRefNumber);

//write file
$log->createLogFile($logFile,$value);
$log->recordResponse($value);*/


