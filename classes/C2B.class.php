<?php
include_once('DBConn.class.php');
include_once('LogResponse.class.php');

class C2B extends DBConn{

    function invokeC2B($token,$url,$shortCode,$commandID,$amount,$msisdn,$billRefNumber){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer '.$token)); //setting custom header

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => $shortCode,
            'CommandID' => $commandID,
            'Amount' => $amount,//amount
            'Msisdn' => $msisdn,//phone number
            'BillRefNumber' => $billRefNumber//unique reference code for the transaction
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);
        curl_close($curl);

        return $curl_response;
    }

}