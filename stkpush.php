<?php
include_once('classes/STKPush.class.php');
include_once('classes/LogResponse.class.php');

$stkpush = new STKPush();
$log = new LogResponse();

//const
$url='https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$PasswordKey='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

//goten from generateToken.php
$token= $_POST['token'];

$curl = curl_init();
$BusinessShortCode= $_POST['businessShortCode'];

//make variable
$Timestamp= $_POST['timestamp'];
$TransactionType= $_POST['transactionType'];
$Amount= $_POST['amount'];
$PartyA= $_POST['partyA'];
$PartyB= $_POST['partyB'];
$PhoneNumber= $_POST['phoneNumber'];

//constants
$CallBackURL='http://www.nearfieldltd.com/api/callback.php';
$AccountReference='Little Cash';
$TransactionDesc='Little Cash';
$Password=base64_encode($BusinessShortCode.$PasswordKey.$Timestamp);

$logFile = 'logs/stkpush.txt';

/*$txn = $stkpush->initSTKPush($url,$Password,$token,$curl,$BusinessShortCode,$Timestamp,$TransactionType,
    $Amount,$PartyA,$PartyB,$PhoneNumber,$CallBackURL,$AccountReference,$TransactionDesc);*/

$log->createLogFile($logFile,$txn);

echo $txn;
