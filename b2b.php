<?php
include_once('classes/B2B.class.php');
include_once('classes/LogResponse.class.php');

$b2b = new B2B();
$log = new LogResponse();

$url='https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
$token='XYbvBH5IPiRAKyPNqQbZVNVI7GlB';

$curl = curl_init();
$initiator='testapi';
$securityCredential='V8sAKPlxqhT+1y52nkMwjJQu/fF/F5JR/Xg89gRyZos1ic8gi1osh9cfvBasxdRuWmwd/sZ5ADL51RMExYTi2f117pix41sbXXZpf8vY2nvFM3fxaF/4fD4Pdij9UGPMY0rhheYt5Heno+wBn31JxS5IeBfuxXywnn7uty3hVEdlt8WOHWW4lj3/QlFAQla+8ktaFBTPCxw4yhmyVmIqZb/3VxxBcZN1Jk13hXAvea3SrMQ7HnmEKskQp+UDDzFN1iUsKai34gMGHVIyFwQS43B4/R07M/E83ZoisS7UDWzyni44bRtF95srrr1Oa9dm54dW4l+orfMp7zlqF1GbAA==';

$commandID='BusinessPayBill';
$senderIdentifierType='4';
$recieverIdentifierType='4';

$amount='200';
$partyA='600130';
$partyB='600000';
$accountReference='KAR400T';
$remarks='Payment of car hire fee';
$queueTimeOutURL='http://jochebedscrib.org/victor/time_out.php';
$resultURL='http://jochebedscrib.org/victor/result.php';
$logFile = 'logs/b2b.txt';

$txn = $b2b->invokeB2B($url,$token,$curl,$initiator,$securityCredential,$commandID,$senderIdentifierType,$recieverIdentifierType,$amount,
    $partyA,$partyB,$accountReference,$remarks,$queueTimeOutURL,$resultURL);

$log->createLogFile($logFile,$txn);
