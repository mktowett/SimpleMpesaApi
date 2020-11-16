<?php

$callbackJSONData ='{"Body":{"stkCallback":{"MerchantRequestID":"12666-11209806-1","CheckoutRequestID":"ws_CO_161120202242362544","ResultCode":0,"ResultDesc":"The service request is processed successfully.","CallbackMetadata":{"Item":[{"Name":"Amount","Value":1.00},{"Name":"MpesaReceiptNumber","Value":"OKG8KUW812"},{"Name":"Balance"},{"Name":"TransactionDate","Value":20201116223158},{"Name":"PhoneNumber","Value":254726773920}]}}}}';

//$callbackData = json_encode($callbackJSONData);
 $result = json_encode($callbackJSONData,true);

echo json_decode();
$CheckoutRequestID = $result->CheckoutRequestID;
$ResultCode = $result->ResultCode;
$ResultDesc = $result->ResultDesc;


//var_dump( $callbackData = json_decode($callbackJSONData));