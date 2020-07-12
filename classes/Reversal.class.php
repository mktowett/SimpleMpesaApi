<?php
include_once('DBConn.class.php');

class Reversal extends DBConn{
    function invokeReversal($url,$curl,$token,$initiator,$securityCredential,$commandID,$transactionID,$amount,$receiverParty,
                            $recieverIdentifierType,$resultURL,$queueTimeOutURL,$remarks){

        $url = 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer '.$token)); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            // 'CommandID' => ' ',
            'Initiator' => $initiator,//This is the credential/username used to authenticate the transaction request.
            'SecurityCredential' => $securityCredential,
            'CommandID' => $commandID,//Unique command for each transaction type,
            'TransactionID' => $transactionID,//Organization Receiving the funds.
            'Amount' => $amount,
            'ReceiverParty' => $receiverParty,
            'RecieverIdentifierType' => $recieverIdentifierType,//Type of organization receiving the transaction.
            'ResultURL' => $resultURL,//The path that stores information of transaction.
            'QueueTimeOutURL' => $queueTimeOutURL,//The path that stores information of time out transaction.
            'Remarks' => $remarks,//Comments that are sent along with the transaction.
            //'Occasion' => ' '//optional
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;
    }
}