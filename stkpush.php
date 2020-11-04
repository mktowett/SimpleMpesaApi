<?php
include_once('classes/STKPush.class.php');
include_once('classes/LogResponse.class.php');

$stkpush = new STKPush();
$log = new LogResponse();

//const
$url='https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$PasswordKey='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

//goten from generateToken.php
$token='64e34GLFsgkJQYIGJLvvENAQrUWW';

$curl = curl_init();
$BusinessShortCode='174379';

//make variable
$Timestamp='20180814085620';
$TransactionType='CustomerPayBillOnline';
$Amount='1';
$PartyA='254721888560';
$PartyB='174379';
$PhoneNumber='254721888560';
$CallBackURL='http://www.nearfieldltd.com/mpesaApi/callback.php';
$AccountReference='STK001';
$TransactionDesc='UniPay';
$Password=base64_encode($BusinessShortCode.$PasswordKey.$Timestamp);
$logFile = 'logs/stkpush.txt';

$txn = $stkpush->initSTKPush($url,$Password,$token,$curl,$BusinessShortCode,$Timestamp,$TransactionType,
    $Amount,$PartyA,$PartyB,$PhoneNumber,$CallBackURL,$AccountReference,$TransactionDesc);

$log->createLogFile($logFile,$txn);
