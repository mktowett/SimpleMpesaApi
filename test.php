<?php
require_once('classes/LogResponse.class.php');
include_once('classes/Test.class.php');
$logResp = new LogResponse();
$test = new Test();

$inp = $test->recordSTKCallback("2"/*"OKF5JH15M1","0","20201115190507",
    "254740189040","18054-8759923-1","CheckoutRequestID","ResultDesc"*/);

if($inp){
    echo $inp;
}else{
    echo "failed";
    echo null;
}

