<?php
include_once('classes/B2C.class.php');
include_once('classes/LogResponse.class.php');

$b2c = new B2C();
$log = new LogResponse();

$url='https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
$token='uqlApNf4AWAgoNMHn6xIFh1LSSQ5';
$curl = curl_init();
$initiator='apitest446';
$securityCredential='V8sAKPlxqhT+1y52nkMwjJQu/fF/F5JR/Xg89gRyZos1ic8gi1osh9cfvBasxdRuWmwd/sZ5ADL51RMExYTi2f117pix41sbXXZpf8vY2nvFM3fxaF/4fD4Pdij9UGPMY0rhheYt5Heno+wBn31JxS5IeBfuxXywnn7uty3hVEdlt8WOHWW4lj3/QlFAQla+8ktaFBTPCxw4yhmyVmIqZb/3VxxBcZN1Jk13hXAvea3SrMQ7HnmEKskQp+UDDzFN1iUsKai34gMGHVIyFwQS43B4/R07M/E83ZoisS7UDWzyni44bRtF95srrr1Oa9dm54dW4l+orfMp7zlqF1GbAA==';
$commandID='SalaryPayment';
$coId = 'SalaryPayment';
$amount='3000';
$partyA='600130';
$partyB='254708374149';
$remarks='September salary';
$queueTimeOutURL='http://jochebedscrib.org/victor/time_out.php';
$resultURL='http://jochebedscrib.org/victor/result.php';
$logFile = 'logs/b2c.txt';


$txn = $b2c->invokeB2C($url,$curl,$token,$initiator,$coId,$securityCredential,$amount,$partyA,$partyB,$remarks,$queueTimeOutURL,$resultURL);
$log->createLogFile($logFile,$txn);

