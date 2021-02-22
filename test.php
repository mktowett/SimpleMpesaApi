<?php

$callbackJSONData = '{
   "Body": {
      "stkCallback": {
         "MerchantRequestID": "18054-8759923-1",
         "CheckoutRequestID": "ws_CO_151120201904555477",
         "ResultCode": 0,
         "ResultDesc": "The service request is processed successfully.",
         "CallbackMetadata": {
            "Item": [
               {
                  "Name": "Amount",
                  "Value": 1
               },
               {
                  "Name": "MpesaReceiptNumber",
                  "Value": "OKF5JH15M1"
               },
               {
                  "Name": "Balance"
               },
               {
                  "Name": "",
                  "Value": 20201115190507
               },
               {
                  "Name": "PhoneNumber",
                  "Value": 254740189040
               }
            ]
         }
      }
   }
}';
$object = json_decode($callbackJSONData,true);
$ResultCode = json_encode($object['Body']['stkCallback']['ResultCode']);

if($ResultCode == 0){

    $stkCallBack = json_encode($object['Body']['stkCallback']);
    $callBackData = json_decode($stkCallBack,true);

    //access values in the stkCallback
    $MerchantRequestID = json_encode($callBackData['MerchantRequestID']);
    $CheckoutRequestID = json_encode($callBackData['CheckoutRequestID']);
    $ResultDesc = json_encode($callBackData['ResultDesc']);


    //get user details data in CallbackMetadata
    $CallbackMetadata = json_encode($callBackData['CallbackMetadata']['Item']);
    $data = json_decode($CallbackMetadata,true);
    $Amount = json_encode($data[0]['Value']);
    $MpesaReceiptNumber = json_encode($data[1]['Value']);
    $Balance = json_encode($data[2]['Name']);
    $TransactionDate = json_encode($data[3]['Value']);
    $PhoneNumber = json_encode($data[4]['Value']);

    echo "Amount: ".$Amount."\n";
    echo "MpesaReceiptNumber: ".$MpesaReceiptNumber."\n";
    echo "Balance: ".$Balance."\n";
    echo "TransactionDate: ".$TransactionDate."\n";
    echo "PhoneNumber: ".$PhoneNumber."\n";
    echo "MerchantRequestID: ".$MerchantRequestID."\n";
    echo "CheckoutRequestID: ".$CheckoutRequestID."\n";
    echo "ResultDesc: ".$ResultDesc."\n";

}else{
    echo "Failed to complete transaction. Please try again later";
}
