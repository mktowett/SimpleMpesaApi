<?php
include_once('DBConn.class.php');

class B2B extends DBConn{

    function invokeB2B($url,$token,$curl,$initiator,$securityCredential,$commandID,$senderIdentifierType,$recieverIdentifierType,$amount,
                        $partyA,$partyB,$accountReference,$remarks,$queueTimeOutURL,$resultURL){

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer '.$token)); //setting custom header

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'Initiator' => $initiator, //This is the credential/username used to authenticate the transaction request.
            'SecurityCredential' => $securityCredential,
            'CommandID' => $commandID,//	Unique command for each transaction type
            'SenderIdentifierType' => $senderIdentifierType,//Type of organization sending the transaction.
            'RecieverIdentifierType' => $recieverIdentifierType,//Type of organization receiving the funds being transacted.
            'Amount' => $amount,//amount being transacted
            'PartyA' => $partyA,//	Organization’s short code initiating the transaction.
            'PartyB' => $partyB,//Organization’s short code receiving the funds being transacted.
            'AccountReference' => $accountReference,//Account Reference mandatory for “BusinessPaybill” CommandID.
            'Remarks' => $remarks,//	Comments that are sent along with the transaction.
            'QueueTimeOutURL' => $queueTimeOutURL,//The path that stores information of time out transactions.
            'ResultURL' => $resultURL//The path that receives logs from M-Pesa
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