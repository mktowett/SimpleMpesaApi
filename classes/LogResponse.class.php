<?php
include_once('DBConn.class.php');
class LogResponse extends DBConn{

    // write the M-PESA Response to file
    function createLogFile($logFile,$curl_response){
        $log = fopen($logFile, "a");
        fwrite($log, $curl_response);
        fclose($log);
    }

    function recordResponse($curl_response){
        $val =$this->lazyInsert('cb',array('CB_RESPONSE'),array($curl_response));
        return $val;
    }
}