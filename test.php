<?php
//The C2B Register URL API registers the 3rd party’s
//confirmation and validation URLs to M-Pesa

//get the access token
//require "access_token.php";

//register the 3rd party urls.
$access_token = 'ThRWmFGkXG4BBkv4trAjNsqWFGMD';
$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';//sktpush url
$BusinessShortCode='174379';//shortcode
$Passkey='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c9';//passkey
$Timestamp=date("YmdGis");//timestamp
$Password=base64_encode($BusinessShortCode.$Passkey.$Timestamp);//password encoded Base64

//log password and timestamp
$logFile = "logs/password.txt";
$log = fopen($logFile, "a");
fwrite($log, "Password=".$Password);
fwrite($log, " Timestamp=".$Timestamp);
fclose($log);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer '.$access_token)); //setting custom header


$curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,//The organization shortcode used to receive the transaction.
    'Password' => $Password,//This is generated by base64 encoding BusinessShortcode, Passkey and Timestamp.
    'Timestamp' => $Timestamp,//The timestamp of the transaction in the format yyyymmddhhiiss.
    'TransactionType' => 'CustomerPayBillOnline',//The transaction type to be used for this request.
    'Amount' => '1000',//The amount to be transacted.
    'PartyA' => '254700352822',//The MSISDN sending the funds.
    'PartyB' => '174379',//The organization shortcode receiving the funds
    'PhoneNumber' => '254700352822',//The MSISDN sending the funds.
    'CallBackURL' => 'http://j/callback.php',//The url to where logs from M-Pesa will be sent to.
    'AccountReference' => 'STK001',//Used with M-Pesa PayBills.
    'TransactionDesc' => 'stk testing'//A description of the transaction.
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

/******* log the response**********/
$logFile = "logs/stkpush.txt";
// write the M-PESA Response to file
$log = fopen($logFile, "a");
fwrite($log, $curl_response);
fclose($log);

//display result
echo $curl_response;
