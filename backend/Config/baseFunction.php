<?php
date_default_timezone_set('Asia/Bangkok');

require_once $_SERVER['DOCUMENT_ROOT'] . '/V-OPD/backend/Config/Config.php';
require_once ROOT . '/Config/Enum.php';

class connectDB extends Enum {

    private $server = "mysql:host=localhost;dbname=v_opd";

    private $user = "root";

    private $pass = "";

    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    protected $con;

    public function openConnection() {
        try {
            
            $this->con = new PDO($this->server, $this->user, $this->pass, $this->options);
            
            $this->con->exec("set names utf8");
            
            return $this->con;
        } catch (PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);
            
            $ErrorMessage = new ErrorMessage("5001", FALSE);
            return $ErrorMessage;
        }
    }

    public function closeConnection() {
        $this->con = null;
    }
}

class ErrorMessage extends Enum {

    public $errorCode; 
    public $errorMessage;
    public $errorStatus;
    
    function __construct($errorCode, bool $errorStatus) {

        $this->setMessage($errorCode, $errorStatus);
    }

    public function setMessage($errorCode, bool $errorStatus) {
        
        $this->errorCode = $errorCode;
        $this->errorStatus = $errorStatus;
        $this->errorMessage = $this->ErrorMessage($errorCode);
    }
}

class VOpdLog { 

    const PATHFILE = "Log/";

    private $codeError;
    private $messageError;
    private $tempError;

    // public function __construct(PDOException $e) { 

    //     $this->createLogFilesDatabase($e);
    // }
    // public function __construct(PDOException $e) { 

    //     $this->createLogFilesDatabase($e);
    // }

    public static function createLogFilesDatabase(PDOException $errorException) {

        $errorFileName = self::PATHFILE . "Log" . date("dmYHis") . ".txt";

        $errorFileObj = fopen($errorFileName, 'w');
        $codeError = "Code Error : " . $errorException->getCode() . "\r\n";
        fwrite($errorFileObj, $codeError);

        $messageRror = "Message Error : " . $errorException->getMessage() . "\r\n";
        fwrite($errorFileObj, $messageRror);

        $fileError = "File Error : " . $errorException->getFile() . "\r\n";
        fwrite($errorFileObj, $fileError);

        $traceError = "Trace Error : " . $errorException->getTraceAsString() . "\r\n";
        fwrite($errorFileObj, utf8_encode($traceError));
    }
}


?>