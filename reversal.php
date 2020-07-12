<?php
include_once('classes/Reversal.class.php');
include_once('classes/LogResponse.class.php');

$reversal = new Reversal();
$log = new LogResponse();

$url='https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';
$curl = curl_init();
$token='Gh3MTRQBkXWpXA0HDEMlP5WrbS7Q';
$initiator='apitest446';
$securityCredential='Safaricom111!';
$commandID='TransactionReversal';
$transactionID='MKRA2400';
$amount='200';
$receiverParty='254708374149';
$recieverIdentifierType='4';
$resultURL='http://jochebedscrib.org/victor/result.php';
$queueTimeOutURL='http://jochebedscrib.org/victor/time_out.php';
$remarks='Reversal';
$logFile = 'logs/reversal.txt';

$txn = $reversal->invokeReversal($url,$curl,$token,$initiator,$securityCredential,$commandID,$transactionID,$amount,$receiverParty,
    $recieverIdentifierType,$resultURL,$queueTimeOutURL,$remarks);
$log->createLogFile($logFile,$txn);
