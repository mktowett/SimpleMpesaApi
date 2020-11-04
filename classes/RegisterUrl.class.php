<?php
include_once('DBConn.class.php');

class RegisterUrl extends DBConn{

    function regUrl($token,$registerurl,$curl,$shortCode,$responseType,$confirmationURL,$validationURL){

        curl_setopt($curl, CURLOPT_URL, $registerurl);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$token)); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => $shortCode,
            'ResponseType' => 'Confirmed',
            'ConfirmationURL' => $confirmationURL,
            'ValidationURL' => $validationURL
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);

        return $curl_response;
    }

    //'T_CONVERSATIONID', 'T_ORIGINATORCONVERSATIONID', 'TOKEN', 'USER_ID', 'TIMESTAMP', 'T_STATUS'
    function saveToke($ConversationID,$OriginatorCoversationID,$token,$userId,$ResponseDescription){
        $val = $this->lazyInsert("m_token",
            array('T_CONVERSATIONID', 'T_ORIGINATORCONVERSATIONID', 'TOKEN', 'USER_ID', 'T_STATUS'),
            array($ConversationID,$OriginatorCoversationID,$token,$userId,$ResponseDescription));
        return $val;
    }

    function selectPolls(){
        $val = $this->simpleLazySelect("votes","where VT_STATUS=1");
        return $val;
    }
}

//CREATE TABLE `m_token` ( `T_ID` int(11) NOT NULL, `T_CONVERSATIONID` varchar(100)DEFAULT NULL,
//`T_ORIGINATORCONVERSATIONID` varchar(100) DEFAULT NULL, `TOKEN` varchar(100) DEFAULT NULL,`USER_ID` varchar(11) DEFAULT NULL,
//`TIMESTAMP` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6), `T_STATUS` varchar(11) DEFAULT NULL )
//ENGINE=InnoDB DEFAULT CHARSET=latin1