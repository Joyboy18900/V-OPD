<?php

require_once 'Config/Config.php';
require_once ROOT. '/Config/baseFunction.php';

class PersonalCentral extends connectDB {

    public function readPersonalCentral() {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_pc = "SELECT
                per_id,
                per_idcard,
                prefix.prefix_id,
                prefix.prefix_name,
                per_fname,
                per_lname,
                per_birthday,
                per_old_address,
                per_address,
                professions.professions_id,
                professions.professions_name, 
                per_file_profess,
                per_img,
                per_username,
                per_password,
                per_tel,
                per_status,
                per_activate,
                per_create_date,
                per_update_date
            FROM
                personal_central
            LEFT JOIN prefix ON personal_central.prefix_id = prefix.prefix_id
            LEFT JOIN professions ON personal_central.professions_id = professions.professions_id";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->execute();

            $conn->commit();

            $result_pc = $query_pc->fetchAll(PDO::FETCH_ASSOC);

            return $result_pc;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);
            
            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            } 
        } 
    }

    public function readPersonalCentralByPerId($per_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_pc = "SELECT
                per_id,
                per_idcard,
                prefix.prefix_id,
                prefix.prefix_name,
                per_fname,
                per_lname,
                per_birthday,
                per_old_address,
                per_address,
                professions.professions_id,
                professions.professions_name, 
                per_file_profess,
                per_img,
                per_username,
                per_password,
                per_tel,
                per_status,
                per_activate,
                per_create_date,
                per_update_date
            FROM
                personal_central
            LEFT JOIN prefix ON personal_central.prefix_id = prefix.prefix_id
            LEFT JOIN professions ON personal_central.professions_id = professions.professions_id
            WHERE per_id = :per_id";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_id', $per_id, PDO::PARAM_INT);

            $query_pc->execute();

            $conn->commit();

            $result_pc = $query_pc->fetchAll(PDO::FETCH_ASSOC);

            return $result_pc;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);
            
            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            } 
        } 
    }

    public function readPersonalCentralByStatusActivate($per_activate) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_pc = "SELECT
                per_id,
                per_idcard,
                prefix.prefix_id,
                prefix.prefix_name,
                per_fname,
                per_lname,
                per_birthday,
                per_old_address,
                per_address,
                professions.professions_id,
                professions.professions_name, 
                per_file_profess,
                per_img,
                per_username,
                per_password,
                per_tel,
                per_status,
                per_activate,
                per_create_date,
                per_update_date
            FROM
                personal_central
            LEFT JOIN prefix ON personal_central.prefix_id = prefix.prefix_id
            LEFT JOIN professions ON personal_central.professions_id = professions.professions_id
            WHERE per_activate = :per_activate";  
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_activate', $per_activate, PDO::PARAM_INT);

            $query_pc->execute();

            $conn->commit();

            $result_pc = $query_pc->fetchAll(PDO::FETCH_ASSOC);

            return $result_pc;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);
            
            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            } 
        } 
    }

    public function insertPc($per_idcard, $professions_id, $prefix_id, $per_fname, $per_lname, $per_birthday, $per_old_address, $per_address, $per_tel, $per_username, $per_password, $per_file_profess, $per_img) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $checkDup = $this->checkIdCardDuplicate($per_idcard);
            
            if(!empty($checkDup)) {

                $ErrorMessage = new ErrorMessage("202", FALSE);  
                return $ErrorMessage;
            }

            $checkDup = $this->checkUsernameDuplicate($per_username);
            
            if(!empty($checkDup)) {

                $ErrorMessage = new ErrorMessage("203", FALSE);  
                return $ErrorMessage;
            }

            $sql_pc = "INSERT INTO personal_central (
                per_id,
                per_idcard,
                prefix_id,
                per_fname,
                per_lname,
                per_birthday,
                per_old_address,
                per_address,
                professions_id,
                per_file_profess,
                per_img,
                per_username,
                per_password,
                per_tel,
                per_status,
                per_activate,
                per_create_date,
                per_update_date
            )
            VALUES(
                null,
                :per_idcard,
                :prefix_id,
                :per_fname,
                :per_lname,
                :per_birthday,
                :per_old_address,
                :per_address,
                :professions_id,
                :per_file_profess,
                :per_img,
                :per_username,
                :per_password,
                :per_tel,
                2,
                0,
                NOW(),
                NOW()
            )";
            
            $query_pc = $conn->prepare($sql_pc);

            $per_password = md5($per_password);

            $query_pc->bindParam(':per_idcard', $per_idcard, PDO::PARAM_STR);
            $query_pc->bindParam(':professions_id', $professions_id, PDO::PARAM_INT);
            $query_pc->bindParam(':prefix_id', $prefix_id, PDO::PARAM_INT);
            $query_pc->bindParam(':per_fname', $per_fname, PDO::PARAM_STR);
            $query_pc->bindParam(':per_lname', $per_lname, PDO::PARAM_STR);
            $query_pc->bindParam(':per_birthday', $per_birthday, PDO::PARAM_STR);
            $query_pc->bindParam(':per_old_address', $per_old_address, PDO::PARAM_STR);
            $query_pc->bindParam(':per_address', $per_address, PDO::PARAM_STR);
            $query_pc->bindParam(':per_tel', $per_tel, PDO::PARAM_STR);
            $query_pc->bindParam(':per_username', $per_username, PDO::PARAM_STR);
            $query_pc->bindParam(':per_password', $per_password, PDO::PARAM_STR);
            $query_pc->bindParam(':per_file_profess', $per_file_profess, PDO::PARAM_STR);
            $query_pc->bindParam(':per_img', $per_img, PDO::PARAM_STR);
             
            $query_pc->execute();
            
            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {
            
            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        }
    }

    public function updatePc($per_id, $per_idcard, $professions_id, $prefix_id, $per_fname, $per_lname, $per_birthday, $per_old_address, $per_address, $per_tel, $per_file_profess = NULL, $per_img = NULL) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            if($per_img != NULL)
                $this->UpdateImg($per_id, $per_img);
        
            if($per_file_profess != NULL)
                $this->UpdateFileProfess($per_id, $per_file_profess);

            $sql_pc = "UPDATE
                personal_central
            SET
                per_idcard = :per_idcard,
                prefix_id = :prefix_id,
                per_fname = :per_fname,
                per_lname = :per_lname,
                per_birthday = :per_birthday,
                per_old_address = :per_old_address,
                per_address = :per_address,
                professions_id = :professions_id,
                per_tel = :per_tel,
                per_update_date = NOW()
            WHERE
                per_id = :per_id ";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_id', $per_id, PDO::PARAM_INT);
            $query_pc->bindParam(':per_idcard', $per_idcard, PDO::PARAM_STR);
            $query_pc->bindParam(':prefix_id', $prefix_id, PDO::PARAM_INT);
            $query_pc->bindParam(':per_fname', $per_fname, PDO::PARAM_STR);
            $query_pc->bindParam(':per_lname', $per_lname, PDO::PARAM_STR);
            $query_pc->bindParam(':per_birthday', $per_birthday, PDO::PARAM_STR);
            $query_pc->bindParam(':per_old_address', $per_old_address, PDO::PARAM_STR);
            $query_pc->bindParam(':per_address', $per_address, PDO::PARAM_STR);
            $query_pc->bindParam(':professions_id', $professions_id, PDO::PARAM_INT);
            $query_pc->bindParam(':per_tel', $per_tel, PDO::PARAM_STR);
             
            $query_pc->execute();
            
            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {
            
            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        }
    }

    public function insertRegisterPc($per_idcard, $professions_id, $prefix_id, $per_fname, $per_lname, $per_birthday, $per_old_address, $per_address, $per_img, $per_tel, $per_username, $per_password) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $checkDup = $this->checkIdCardDuplicate($per_idcard);
            
            if(!empty($checkDup)) {

                $ErrorMessage = new ErrorMessage("202", FALSE);  
                return $ErrorMessage;
            }

            $sql_pc = "INSERT INTO personal_central (
                per_id, 
                per_idcard, 
                prefix_id, 
                per_fname, 
                per_lname, 
                per_birthday, 
                per_old_address, 
                per_address, 
                professions_id, 
                per_img, 
                per_username, 
                per_password, 
                per_tel, 
                per_status, 
                per_create_date, 
                per_update_date
                ) 
            VALUES (
                NULL, 
                :per_idcard, 
                :prefix_id, 
                :per_fname, 
                :per_lname, 
                :per_birthday, 
                :per_old_address, 
                :per_address, 
                :professions_id,
                :per_img, 
                :per_username, 
                :per_password, 
                :per_tel,
                0, 
                NOW(), 
                NOW()
                )";
            
            $query_pc = $conn->prepare($sql_pc);

            $per_password = md5($per_password);

            $query_pc->bindParam(':per_idcard', $per_idcard, PDO::PARAM_STR);
            $query_pc->bindParam(':professions_id', $professions_id, PDO::PARAM_INT);
            $query_pc->bindParam(':prefix_id', $prefix_id, PDO::PARAM_INT);
            $query_pc->bindParam(':per_fname', $per_fname, PDO::PARAM_STR);
            $query_pc->bindParam(':per_lname', $per_lname, PDO::PARAM_STR);
            $query_pc->bindParam(':per_birthday', $per_birthday, PDO::PARAM_STR);
            $query_pc->bindParam(':per_old_address', $per_old_address, PDO::PARAM_STR);
            $query_pc->bindParam(':per_address', $per_address, PDO::PARAM_STR);
            $query_pc->bindParam(':per_tel', $per_tel, PDO::PARAM_STR);
            $query_pc->bindParam(':per_username', $per_username, PDO::PARAM_STR);
            $query_pc->bindParam(':per_password', $per_password, PDO::PARAM_STR);
            $query_pc->bindParam(':per_img', $per_img, PDO::PARAM_STR);
             
            $query_pc->execute();
            
            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {
            
            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        }
    }

    public function changePasswordPc($per_id, $per_password) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $per_password = md5($per_password);

            $sql_pc = "UPDATE
                    `personal_central`
                SET
                    `per_password` = :per_password
                WHERE 
                    `per_id` = :per_id";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_id', $per_id, PDO::PARAM_INT);
            $query_pc->bindParam(':per_password', $per_password, PDO::PARAM_STR);
             
            $query_pc->execute();
            
            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {
            
            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        }
    }

    public function enablePc($per_id) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_pc = "UPDATE
                    `personal_central`
                SET
                    `per_status` = 0
                WHERE 
                    `per_id` = :per_id";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_id', $per_id, PDO::PARAM_INT);
             
            $query_pc->execute();
            
            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {
            
            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        }
    }

    public function disablePc($per_id) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_pc = "UPDATE
                    `personal_central`
                SET
                    `per_status` = 3
                WHERE 
                    `per_id` = :per_id";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_id', $per_id, PDO::PARAM_INT);
             
            $query_pc->execute();
            
            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {
            
            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        }
    }

    public function checkIdCardDuplicate($per_idcard) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_pc = "SELECT per_idcard
            FROM
                personal_central
            WHERE
                per_idcard = :per_idcard";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_idcard', $per_idcard, PDO::PARAM_STR);

            $query_pc->execute();

            $conn->commit();

            $result_pc = $query_pc->fetchAll(PDO::FETCH_ASSOC);

            return $result_pc;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);
            
            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            } 
        } 
    }

    public function checkUsernameDuplicate($per_username) { 

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_pc = "SELECT per_username
            FROM
                personal_central
            WHERE
                per_username = :per_username";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_username', $per_username, PDO::PARAM_STR);

            $query_pc->execute();

            $conn->commit();

            $result_pc = $query_pc->fetchAll(PDO::FETCH_ASSOC);

            return $result_pc;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);
            
            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            } 
        } 
    }

    public function UpdateImg($per_id, $per_img) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_pc = "UPDATE
                    personal_central
                SET
                    per_img = :per_img
                WHERE 
                    per_id = :per_id";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_id', $per_id, PDO::PARAM_INT);
            $query_pc->bindParam(':per_img', $per_img, PDO::PARAM_STR);
             
            $query_pc->execute();
            
            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {
            
            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        }
    }

    public function UpdateFileProfess($per_id, $per_file_profess) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_pc = "UPDATE
                    personal_central
                SET
                    per_file_profess = :per_file_profess
                WHERE 
                    per_id = :per_id";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_id', $per_id, PDO::PARAM_INT);
            $query_pc->bindParam(':per_file_profess', $per_file_profess, PDO::PARAM_STR);
             
            $query_pc->execute();
            
            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {
            
            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        }
    }

    public function UpdateFileVerifyPc($per_id, $per_file_profess) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_pc = "UPDATE
                    `personal_central`
                SET
                    `per_file_profess` = :per_file_profess, 
                    `per_update_date` = NOW() 
                WHERE 
                    `per_id` = :per_id";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_id', $per_id, PDO::PARAM_INT);
            $query_pc->bindParam(':per_file_profess', $per_file_profess, PDO::PARAM_STR);
             
            $query_pc->execute();
            
            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {
            
            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        }
    }

    public function UpdatePcActivate($per_id, $per_activate) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_pc = "UPDATE
                    `personal_central`
                SET
                    `per_activate` = :per_activate, 
                    `per_update_date` = NOW() 
                WHERE 
                    `per_id` = :per_id";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_id', $per_id, PDO::PARAM_INT);
            $query_pc->bindParam(':per_activate', $per_activate, PDO::PARAM_INT);
             
            $query_pc->execute();
            
            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {
            
            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        }
    }

    public function UpdatePcStatus($per_id, $per_status) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_pc = "UPDATE
                    `personal_central`
                SET
                    `per_status` = :per_status, 
                    `per_update_date` = NOW() 
                WHERE 
                    `per_id` = :per_id";
            
            $query_pc = $conn->prepare($sql_pc);

            $query_pc->bindParam(':per_id', $per_id, PDO::PARAM_INT);
            $query_pc->bindParam(':per_status', $per_status, PDO::PARAM_INT);
             
            $query_pc->execute();
            
            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {
            
            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        }
    }
}

?>