<?php
require_once'DBConn.class.php';

class Test extends DBConn{



    function recordMpesa($amount,$receiptNumber,$balance,$transactionDate,$phone,
                         $merchantRequest,$checkoutRequest,$description){
        $query= 'INSERT INTO `Mpesa`(`M_AMOUNT`, `M_RECEIPTNUMBER`, `M_BALANCE`, `M_TRANSACTIONDATE`, `M_PHONENUMBER`, `M_MERCHANTREQUEST`, `M_CHECKOUTREQUEST`, `M_RESULTDESCRIPTION`) 
VALUES (1,"OKF5JH15M1","0",20201115190507,254740189040,"18054-8759923-1","ws_CO_151120201904555477","yes bos")';
        $val = $this->lazyBlank($query);
        return $val;
    }

    function recordSTKCallback($amount/*,$receiptNumber,$balance,$transactionDate,$phoneNumber,
                               $merchantRequest,$checkoutRequest, $resultDescription*/){
        $val = $this->lazyInsert('Mpesa',
            array('M_AMOUNT' /*'M_RECEIPTNUMBER', 'M_BALANCE', 'M_TRANSACTIONDATE', 'M_PHONENUMBER',
                'M_MERCHANTREQUEST', 'M_CHECKOUTREQUEST', 'M_RESULTDESCRIPTION'*/),
            array($amount/*,$receiptNumber,$balance,$transactionDate,$phoneNumber,$merchantRequest,$checkoutRequest,$resultDescription*/)
        );

        return $val;
    }
}