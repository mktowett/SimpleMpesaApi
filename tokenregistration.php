<?php
//includes
session_start();
//header('Location: cb.php');
include_once('classes/Validation.class.php');
include_once('classes/C2B.class.php');
include_once('classes/LogResponse.class.php');
include_once('classes/RegisterUrl.class.php');



//objects
$validate = new Validation();
$c2b = new C2B();
$log = new LogResponse();
$data = array();

$curl = curl_init();
$registration = new RegisterUrl();

//test constants
$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$credentials = base64_encode('bQiBO8A0X5Oy4Of2Hl0RVConTBIjuFIC:1jw3Vw5oNS5RYfrK');
$CONSUMER_KEY = 'bQiBO8A0X5Oy4Of2Hl0RVConTBIjuFIC';
$CONSUMER_SECRET = '1jw3Vw5oNS5RYfrK';
$shortCode='600730';
$registrationUrl='https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
$responseType='Confirmed';

/* This two files are provided in the project. */
$confirmationUrl = 'http://gatesystem.rongaiws.com/api/confirmation_url.php'; // path to your confirmation url. can be IP address that is publicly accessible or a url
$validationUrl = 'http://gatesystem.rongaiws.com/api/validationUrl.php'; // path to your validation url. can be IP address that is publicly accessible or a url


//variable
//$userId = $_POST['userId'];

$data = array();
$curl = curl_init();

//generate token
$token = $validate->invokeRegistration($url,$curl,$credentials);
$_SESSION['token'] = $token;
echo $token;


//register url
//$val = $registration->regUrl($token,$registrationUrl,$curl,$shortCode,$responseType,$confirmationUrl,$validationUrl);

//$values = json_encode($data);
//$obj = json_decode($values,true);
//echo $val;

/*if ($val){
    $data['resp'] = $val;
}


//save response from api
echo $ConversationID = $obj["resp"]["ConversationID"]."</br>";
echo $OriginatorCoversationID = $obj["resp"]["OriginatorCoversationID"]."</br>";
echo $ResponseDescription = $obj["resp"]["ResponseDescription"]."</br>";*/

/*$saveTokeGen = $registration->saveToke($ConversationID,$OriginatorCoversationID,$token,$userId,$ResponseDescription);

if ($saveTokeGen){
    $data['saveToke'] = $saveTokeGen;
    $data['respcode'] = '00';
    $data['respdesc'] = 'SUCCESS';
}else{
    $data['saveToke'] = null;
    $data['respcode'] = '01';
    $data['respdesc'] = 'FAILED';
}*/

//echo json_encode($val);







