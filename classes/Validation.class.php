<?php
include_once('DBConn.class.php');

class Validation  extends DBConn {



    function invokeRegistration($url,$curl,$credentials){
        curl_setopt($curl, CURLOPT_URL,$url);

        //setting a custom header
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);

        $curl_response = curl_exec($curl);
        $stepresponsevalue = @json_decode($curl_response, true);
        $accesstoken = $stepresponsevalue{'access_token'};
        curl_close($curl);
        return $accesstoken;
    }



}
