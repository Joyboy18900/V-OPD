<?php 

class Enum {

    private $errorMessage = "Can't using process.";

    public function ErrorMessage($errorCode) {

        if($errorCode == "201") {

            $this->errorMessage = "เพิ่มข้อมูลสำเร็จ ";
        }
        if($errorCode == "202") {

            $this->errorMessage = "มีบัตรประชาชนนี้แล้วในระบบ !";
        }
        if($errorCode == "203") {

            $this->errorMessage = "ชื่อผู้ใช้นี้มีแล้วในระบบ !";
        }
        if($errorCode == "501") {

            $this->errorMessage = "เพิ่มข้อมูลไม่สำเร็จ ";
        }
        if($errorCode == "5001") {

            $this->errorMessage = "Can't Connected Database.";
        }
        if($errorCode == "404") {

            $this->errorMessage = "Website Not Found.";
        }
        if($errorCode == "2000") {

            $this->errorMessage = "ไม่พบข้อมูลผู้ใช้";
        }
        if($errorCode == "1001") {

            $this->errorMessage = "ยินดีต้อนรับเข้าสู่ระบบ :)";
        }
        if($errorCode == "1000") {

            $this->errorMessage = "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง!";
        }
        if($errorCode == "3000") {

            $this->errorMessage = "มีแพทย์ท่านอื่นรับเคสนี้ไปแล้ว!";
        }
        if($errorCode == "3001") {

            $this->errorMessage = "รหัสผ่านเดิมไม่ถูกต้อง !";
        }

        return $this->errorMessage;
    }

    public function getDuration($numberDuration = 0) {

        $duration = array( 
            1 => array( "start" => "08.00", "stop" => "13.00"), 
            2 => array( "start" => "13:00", "stop" => "18.00")
        );

        return ($duration != NULL || !empty($duration) ? $duration[$numberDuration] : "Empty Duration");
    }

    public function getDay($numberDay, $dayLanguage = 0) { // 1 ภาษาไทย : ไม่ใส่คือภาษาอังกฤษ

        $dayTH = array( 
            1 => "วันจันทร์",
            2 => "วันอังคาร",
            3 => "วันพุธ",
            4 => "วันพฤหัสบดี",
            5 => "วันศุกรฺ์",
            6 => "วันเสาร์",
            7 => "วันอาทิตย์"
        );

        $dayEN = array(  
            1 => "Monnday",
            2 => "TuesDay",
            3 => "Wendesday",
            4 => "ThuesDay",
            5 => "Friday",
            6 => "Saturday",
            7 => "Sunday"
        );
        
        return ($dayLanguage == 1 ? $dayTH[$numberDay] : $dayEN[$numberDay]);
    }

    public function uploadFiles($files, $filename, $path) {

        try {
            
            if(isset($filename) && !empty($filename)) {

                $temp = explode(".", $files["name"]);
                $newfilename = $filename . '.' . end($temp);
                move_uploaded_file($files["tmp_name"], $path . $newfilename);     

                return $newfilename;
            }
        } catch (Exception $e) {
            
            // VOpdLog::createLogFilesDatabase($e);
            return NULL;
        }   
    }

    public function requireParams($string = NULL) {

        if(isset($string) && !empty($string)) {

            return $string;
        }
        
        return NULL;
    }
}

?>