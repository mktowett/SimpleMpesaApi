<?php
include_once('DBConn.class.php');

class B2C extends DBConn{
    function invokeB2C($url,$curl,$token,$initiator,$commandID,$securityCredential,$amount,$partyA,$partyB,$remarks,$queueTimeOutURL,$resultURL){
        //$url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';//url b2c

        //$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer '.$token)); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'InitiatorName' => $initiator,//This is the credential/username used to authenticate the transaction request.
            'SecurityCredential' => 'Safaricom111!',
            'CommandID' => $commandID,//Unique command for each transaction type
            'Amount' => $amount,//The amount being transacted
            'PartyA' => $partyA,//Organization’s shortcode initiating the transaction.
            'PartyB' => $partyB,//Phone number receiving the transaction
            'Remarks' => $remarks,//Comments that are sent along with the transaction.
            'QueueTimeOutURL' => $queueTimeOutURL,//The timeout end-point that receives a timeout response.
            'ResultURL' => $resultURL,//The end-point that receives the response of the transaction
            // 'Occasion' => ' '//optional
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        return $curl_response;
    }
}