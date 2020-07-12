<?php
include_once('DBConn.class.php');

class Validation  extends DBConn {

    public function __construct(){
        $CONSUMER_KEY = 'bQiBO8A0X5Oy4Of2Hl0RVConTBIjuFIC';

        $CONSUMER_SECRET = '1jw3Vw5oNS5RYfrK';

        $URL = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    }

    function invokeRegistration($url,$curl,$credentials){

        curl_setopt($curl, CURLOPT_URL, $url);
        //setting a custom header
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials));
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result);
    }

}
