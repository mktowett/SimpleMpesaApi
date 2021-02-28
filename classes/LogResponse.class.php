<?php
include_once('DBConn.class.php');
class LogResponse extends DBConn{

    // write the M-PESA Response to file
    function createLogFile($logFile,$curl_response){
        $log = fopen($logFile, "a");
        fwrite($log, $curl_response);
        fclose($log);
    }

    //`M_ID`, 'M_AMOUNT', 'M_RECEIPTNUMBER', 'M_BALANCE', 'M_TRANSACTIONDATE', 'M_PHONENUMBER', 'M_MERCHANTREQUEST',
    // 'M_CHECKOUTREQUEST', 'M_RESULTDESCRIPTION', 'M_STATUS',
    function recordSTKCallback($amount,$receiptNumber,$balance,$transactionDate,$phoneNumber,$merchantRequest,$checkhoutRequest){
        $val = $this->lazyInsert('payments',
            array('P_AMOUNT','P_RECEIPTNUMBER','P_BALANCE','P_TRANSACTIONDATE','P_PHONENUMBER',
                'P_MERCHANTREQUEST', 'P_CHECKOUTREQUEST',),
            array($amount,$receiptNumber,$balance,$transactionDate,$phoneNumber,$merchantRequest,$checkhoutRequest)
        );
        return $val;
    }

    function getMpesaByPhone($phoneNumber){
        $val = $this->simpleLazySelect('Mpesa',"WHERE M_PHONENUMBER = $phoneNumber");
    }
}