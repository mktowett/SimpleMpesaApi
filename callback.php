<?php
include_once('classes/LogResponse.class.php');
$callBackResponse = file_get_contents('php://input');
$logResponse = new LogResponse();
$data  = array();

/*$txn = json_decode($callBackResponse);
$logFile = 'response.txt';
$log = fopen($logFile,"a");
fwrite($log,$callBackResponse);
fclose($log);

$result = json_decode($txn);
echo "am here - ".$result->Body;
echo json_encode($result);*/

$object = json_decode($callBackResponse,true);
$stkCallBack = json_encode($object['Body']['stkCallback']);
$callBackData = json_decode($stkCallBack,true);
//get result code
$ResultCode = json_encode($object['Body']['stkCallback']['ResultCode']);



//handle success result code
if($ResultCode == 0){

    //access values in the stkCallback
    $MerchantRequestID = json_encode($callBackData['MerchantRequestID']);
    $CheckoutRequestID = json_encode($callBackData['CheckoutRequestID']);
    $ResultDesc = json_encode($callBackData['ResultDesc']);


    //get user details data in CallbackMetadata
    $CallbackMetadata = json_encode($callBackData['CallbackMetadata']['Item']);
    $data = json_decode($CallbackMetadata,true);
    $Amount = json_encode($data[0]['Value']);
    $MpesaReceiptNumber = json_encode($data[1]['Value']);
    //$Balance = json_encode($data[2]['Name']);
    $Balance = "0";
    $TransactionDate = json_encode($data[2]['Value']);
    $PhoneNumber = json_encode($data[3]['Value']);

    //echo our data
    echo "Amount: ".$Amount."\n";
    echo "MpesaReceiptNumber: ".$MpesaReceiptNumber."\n";
    echo "Balance: ".$Balance."\n";
    echo "TransactionDate: ".$TransactionDate."\n";
    echo "PhoneNumber: ".$PhoneNumber."\n";
    echo "MerchantRequestID: ".$MerchantRequestID."\n";
    echo "CheckoutRequestID: ".$CheckoutRequestID."\n";
    echo "ResultDesc: ".$ResultDesc."\n";

    //'P_AMOUNT','P_RECEIPTNUMBER','P_BALANCE','P_TRANSACTIONDATE','P_PHONENUMBER', 'P_MERCHANTREQUEST', 'P_CHECKOUTREQUEST'

    //store data in our database
    $val = $logResponse->recordSTKCallback($Amount,$MpesaReceiptNumber,$Balance,$TransactionDate,
        $PhoneNumber,$MerchantRequestID, $CheckoutRequestID);
    if ($val){
        $data['respcode'] = "00";
        $data['respdecs'] = $ResultDesc;
    }else{
        $data['respcode'] = "01";
        $data['respdecs'] = "Something went wrong while processing your transaction. Please contact customer care for assistance";
    }

} else{
    //handle failed response code
   // $ResultDesc = json_encode($callBackData['ResultDesc']);
    echo "Failed to complete transaction. Please try again later";
}
