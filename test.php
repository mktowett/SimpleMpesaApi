<?php
include_once('classes/RegisterUrl.class.php');

$registration = new RegisterUrl();
/*$jsonRep  = '{
    "Body": {
        "stkCallback": {
            "MerchantRequestID": "22027-4988848-1",
            "CheckoutRequestID": "ws_CO_120720201917095081",
            "ResultCode": 0,
            "ResultDesc": "The service request is processed successfully.",
            "CallbackMetadata": {
                "Item": [
                    {
                        "Name": "Amount",
                        "Value": 2.00
                    },
                    {
                        "Name": "MpesaReceiptNumber",
                        "Value": "OGC7P6FFQP"
                    },
                    {
                        "Name": "TransactionDate",
                        "Value": 20200712191723
                    },
                    {
                        "Name": "PhoneNumber",
                        "Value": 254721888560
                    }
                ]
            }
        }
    }
}';

$data = json_decode($jsonRep);

//access top level valus of json
$MerchantRequestID = $data->Body->stkCallback->CallbackMetadata->Item;
$callbackArray = array();
$callback = $data->Body->stkCallback->CallbackMetadata->Item;
//access value of CallbackMetadata
//$MerchantRequestID = $data->Body->stkCallback->Item[0];
$result = json_encode($callback);*/


$tokenDetails = $registration->saveToke("vvvv","ihgfdsa","12345rtfghu765",
    "12","S");

$result = "INSERT INTO `m_token` (`T_ID`, `T_CONVERSATIONID`, `T_ORIGINATORCONVERSATIONID`, `TOKEN`, `USER_ID`, `TIMESTAMP`, `T_STATUS`) VALUES ('2', 'e456789uihgfdre546', '098765rfghji9876543', '12345r6tygfdew32123456tyghyu7yuhy654ed', '12', 'CURRENT_TIMESTAMP(6).000000', 'S')";

var_dump($result);
echo $result;