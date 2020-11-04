
<?php
session_start();
include_once('classes/RegisterUrl.class.php');

$registration = new RegisterUrl();
$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

$access_token = $_SESSION['token']; // check the mpesa_accesstoken.php file for this. No need to writing a new file here, just combine the code as in the tutorial.
$shortCode = '600730'; // provide the short code obtained from your test credentials

/* This two files are provided in the project. */
$confirmationUrl = 'http://gatesystem.rongaiws.com/api/confirmation_url.php'; // path to your confirmation url. can be IP address that is publicly accessible or a url
$validationUrl = 'http://gatesystem.rongaiws.com/api/validationUrl.php'; // path to your validation url. can be IP address that is publicly accessible or a url



$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


$curl_post_data = array(
    //Fill in the request parameters with valid values
    'ShortCode' => $shortCode,
    'ResponseType' => 'Confirmed',
    'ConfirmationURL' => $confirmationUrl,
    'ValidationURL' => $validationUrl
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
$stepresponsevalue = @json_decode($curl_response, true);
$ResponseDescription = $stepresponsevalue{'ResponseDescription'};
$userId = $_POST['userId'];
$data = array();

//access value from response
if ($ResponseDescription == "success"){
    //save details to DB
    $ConversationID = $stepresponsevalue{'ConversationID'};
    $OriginatorCoversationID = $stepresponsevalue{'OriginatorCoversationID'};
    $tokenDetails = $registration->saveToke($ConversationID,$OriginatorCoversationID,$access_token,$userId,$ResponseDescription);

    //handle db insertion
    if ($tokenDetails){
        $data['token'] = $access_token;
        $data['respcode'] = "00";
        $data['respdesc'] = "success";
        $data['tokenDetails'] = $stepresponsevalue;
    }else{
        $data['token'] = $access_token;
        $data['respcode'] = "01";
        $data['respdesc'] = "failed";
        $data['tokenDetails'] = $curl_response;
    }

}else{
    echo "failed";
    $stepresponsevalue = @json_decode($curl_response, true);
    $errorMessage = $stepresponsevalue{'errorMessage'};
    echo $errorMessage;
}

echo json_encode($data);
?>