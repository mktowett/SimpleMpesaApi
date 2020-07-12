<?php


@session_start();

@error_reporting(E_ALL);

@ini_set('display_errors', TRUE);

@ini_set('display_startup_errors', TRUE);

date_default_timezone_set('Africa/Nairobi');

@ini_set('xdebug.max_nesting_level', 200);


@define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');


class DBConn
{


    var $connection;

    var $DBdate;




    public function __construct()
    {

        $DB_SERVER = 'localhost';

        $DB_USERNAME = 'root';

        $DB_PASSWORD = 'root';

        $DB_DATABASE = 'mpesa';

        $CONSUMER_KEY = 'bQiBO8A0X5Oy4Of2Hl0RVConTBIjuFIC';

        $CONSUMER_SECRET = '1jw3Vw5oNS5RYfrK';

        $URL = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $this->DBdate = date('Y-m-d H:i:s', strtotime('now'));

        $connection = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD) or

        die('Oops connection error -> ' . mysqli_connect_error());

        $this->connection = $connection;

        mysqli_select_db($connection, $DB_DATABASE) or die('Database error -> ' . mysqli_connect_error());

    }

    function Log($action, $user_ID)
    {

        $ip = $_SERVER['REMOTE_ADDR'];

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        $log = $this->lazyInsert("audit_trail", array("AT_ACTION", "USER_ID", "AT_IP", "AT_USERAGENT"), array($action, $user_ID, $ip, $useragent), "");

        return $log;

    }

    function lazyInsert($table, $column, $value)
    {

        $out = array();

        $i = 0;

        if (count($column) != count($value)) {

            return false;

        } else {

            $strINS = "INSERT INTO " . $table;

            $strINS .= "(" . implode(',', $column) . ") ";

            $strINS .= "VALUES ";

            for ($i; $i < count($value); $i++) {

                array_push($out, "'$value[$i]'");

            }

            $strINS .= "(" . (implode(',', $out)) . ")";
            //echo $strINS;
            //exit;

            $objParse = mysqli_query($this->connection, $strINS);


            $id = mysqli_insert_id($this->connection);

            if ($objParse) {

                return $id;

            } else {

                return FALSE;

            }

        }

    }

    function complexSelect($tables, $columns, $conditions)
    {

        $strSEL = "SELECT ";

        //$strSEL .=strtoupper(implode(',',$columns));

        $strSEL .= implode(',', $columns);

        $strSEL .= " FROM ";

        $strSEL .= implode(',', $tables);

        //$strSEL .=" ".strtoupper($conditions);

        $strSEL .= " " . $conditions;

        //echo $strSEL."</br></br>";

        $objSC = mysqli_query($this->connection, $strSEL);

        if ($objSC) {

            $data = array();

            while ($det = mysqli_fetch_assoc($objSC)) {

                $data[] = $det;

            }

            return $data;

        } else {

            return false;

        }

    }

    function lazySelect($start_row, $rows_per_page, $table, $condition)
    {

        //$table = $this->clean($this->clean(mb_strtolower($table)));

        if ($condition == '') {

            $strSEL = "SELECT * FROM " . $table . " ";

        } else {

            $strSEL = "SELECT * FROM " . $table . " " . $condition . "";

        }

        $objSC = mysqli_query($this->connection, $strSEL);

        if ($objSC) {

            $data = array();

            while ($det = mysqli_fetch_assoc($objSC)) {

                $data[] = $det;

            }

            return $data;

        } else {

            return false;

        }

    }

    function lazyUpdate($table, $columns, $values, $uniquecol, $uniqueval)
    {

        //$table = $this->clean(strtolower($table));

        //$table = $this->clean($table);

        $out = array();

        $i = 0;

        $query = "UPDATE " . $table;

        $query .= " SET ";

        foreach ($columns as $col) {

            array_push($out, "$col = '$values[$i]'");

            $i++;

        }

        $query .= implode(',', $out);

        $query .= " WHERE ";

        //$query .="" . strtoupper($uniquecol) . " = '" . $uniqueval . "'";

        $query .= "" . $uniquecol . " = '" . $uniqueval . "'";

        //echo $query;exit;

        $stmt = mysqli_query($this->connection, $query);

        if ($stmt) {

            return true;

        } else {

            return false;

        }

    }

    function lazyUpdate_2_Params($table, $columns, $values, $uniquecol, $uniquecol2, $uniqueval, $uniqueval2)
    {

        $out = array();

        $i = 0;

        $query = "UPDATE " . $table;

        $query .= " SET ";

        foreach ($columns as $col) {

            array_push($out, "$col = '$values[$i]'");

            $i++;

        }

        $query .= implode(',', $out);

        $query .= " WHERE ";

        $query .= "" . strtoupper($uniquecol) . " = '" . $uniqueval . "' AND " . strtoupper($uniquecol2) . " = '" . $uniqueval2 . "'";

        $stmt = mysqli_query($this->connection, $query);

        if ($stmt) {

            return true;

        } else {

            return false;

        }

    }

    function lazyDelete($table, $column, $value)
    {

        //$table = $this->clean(strtolower($table));

        $query = "DELETE FROM " . $table;

        $query .= " WHERE ";

        $query .= "" . $this->clean(strtoupper($column)) . " = '" . $value . "'";

        $stmt = mysqli_query($this->connection, $query);

        if ($stmt) {

            return true;

        } else {

            return false;

        }

    }

    public function clean($str)
    {

        $str = @trim($str);

        if (get_magic_quotes_gpc()) {

            $str = stripslashes($str);

        }

        return @mysqli_real_escape_string($this->connection, $str);

    }

    function simpleLazySelect($table, $condition)
    {

        $strSEL = "SELECT * FROM " . $table . " " . ($condition) . "";

        $objSC = mysqli_query($this->connection, $strSEL);

        if ($objSC) {

            $data = array();

            while ($det = mysqli_fetch_assoc($objSC)) {

                $data[] = $det;

            }

            return $data;

        } else {

            return false;

        }

    }


    function countLazySelect($table, $condition)
    {

        //$strSEL = "SELECT COUNT(*) AS count FROM " . $this->clean(strtolower($table)) . " " . strtoupper($condition) . "";

        $strSEL = "SELECT COUNT(*) AS count FROM " . $table . " " . $condition . "";

        $objSC = mysqli_query($this->connection, $strSEL);

        if ($objSC) {

            $det = mysqli_fetch_assoc($objSC);

            return $det['count'];

        } else {

            return false;

        }

    }


    function lazySum($table, $column, $condition)
    {

        //$strSEL  = "SELECT SUM(".$this -> clean(strtoupper($column)).") AS count FROM ".$this -> clean(strtolower($table))." ".$this -> clean(strtoupper($condition))."";

        //$strSEL = "SELECT SUM(" . $this->clean(strtoupper($column)) . ") AS count FROM " . $this->clean(strtolower($table)) . " " . (strtoupper($condition)) . "";

        $strSEL = "SELECT SUM(" . $column . ") AS count FROM " . $table . " " . $condition . "";

        $objSC = mysqli_query($this->connection, $strSEL);

        if ($objSC) {

            $det = mysqli_fetch_assoc($objSC);

            return $det['count'];

        } else {

            return false;

        }

    }


    function lazyBlank($query)
    {

        $strSEL = $query;

        //echo "</br></br></br>".$strSEL;

        $objSC = mysqli_query($this->connection, $strSEL);

        //echo "</br></br></br>".$query."</br>".json_encode($objSC);exit;

        if ($objSC) {

            $data = array();

            while ($det = mysqli_fetch_assoc($objSC)) {

                $data[] = $det;

            }

            return $data;

        } else {

            return false;

        }

    }


    function lazyBlankComplete($query)
    {

        $strSEL = $query;

        //echo "</br></br></br>".$strSEL;

        $objSC = mysqli_query($this->connection, $strSEL);

        //echo "</br></br></br>".$query."</br>".json_encode($objSC);exit;

        if ($objSC) {

            return $objSC;

        } else {

            return false;

        }

    }


    function complexSum($sumcol, $tables, $condition)
    {

        //$strSEL = "SELECT SUM(" . $this->clean(strtoupper($sumcol)) . ") AS TOTAL FROM "; 

        $strSEL = "SELECT SUM(" . $sumcol . ") AS TOTAL FROM ";

        //$strSEL .=strtoupper(implode(',',$tables));

        $strSEL .= implode(',', $tables);

        //$strSEL .=" ".strtoupper($condition);

        $strSEL .= " " . $condition;

        $objSC = mysqli_query($this->connection, $strSEL);

        if ($objSC) {

            $data = array();

            while ($det = mysqli_fetch_assoc($objSC)) {

                $data[] = $det;

            }

            //$det = mysql_fetch_assoc($objSC);

            return $data;

        } else {

            return false;

        }

    }


    function struuid($lenght = 13)
    {

        // uniqid gives 13 chars, but you could adjust it to your needs.

        if (function_exists("random_bytes")) {

            $bytes = random_bytes(ceil($lenght / 2));

        } elseif (function_exists("openssl_random_pseudo_bytes")) {

            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));

        } else {

            throw new Exception("no cryptographically secure random function available");

        }

        return substr(bin2hex($bytes), 0, $lenght);

    }


    public function __destruct()
    {

        @mysqli_close($this->connection);

    }


}


?>