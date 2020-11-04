<?php
$callBackResponse = file_get_contents('php://input');

$txn = json_decode($callBackResponse);



$logFile = 'response.txt';
$log = fopen($logFile,"a");
fwrite($log,$callBackResponse);
fclose($log);
