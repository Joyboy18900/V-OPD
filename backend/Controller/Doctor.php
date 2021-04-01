<?php

require_once 'Config/Config.php';
require_once ROOT. '/Config/baseFunction.php';
include_once ROOT. '/Model/Patient.php';

// use ModelPatient\Patient as Member;
// use ModeloutPatient\Patient as outPatient;

class Doctor extends connectDB {

    public function readDoctor() {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT doctor_id, doctor_idcard, prefix.prefix_id, prefix.prefix_name, doctor_fname, 
            doctor_lname, doctor_birthday, doctor_old_address, doctor_address, professions.professions_id, 
            professions.professions_name, doctor_file_profess, affiliation_id, doctor_username, doctor_status, 
            doctor_create_date, doctor_update_date 
            FROM doctor
            LEFT JOIN prefix ON doctor.prefix_id = prefix.prefix_id
            LEFT JOIN professions ON doctor.professions_id = professions.professions_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

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

    public function readDoctorByProfesID($professions_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT doctor_id, prefix.prefix_id, prefix.prefix_name, doctor_fname, 
            doctor_lname, doctor_birthday, doctor_old_address, doctor_address, professions.professions_id, 
            professions.professions_name, doctor_file_profess, affiliation_id, doctor_username, doctor_status, 
            doctor_create_date, doctor_update_date 
            FROM doctor
            LEFT JOIN prefix ON doctor.prefix_id = prefix.prefix_id
            LEFT JOIN professions ON doctor.professions_id = professions.professions_id
            WHERE professions.professions_id = :professions_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':professions_id', $professions_id, PDO::PARAM_INT);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

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

    public function readDoctorByDoctorID($doctor_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT doctor_id, doctor_idcard, prefix.prefix_id, prefix.prefix_name, doctor_fname, 
            doctor_lname, doctor_birthday, doctor_old_address, doctor_address, professions.professions_id, 
            professions.professions_name, doctor_file_profess, doctor_signature, doctor_img, affiliation.affiliation_id, affiliation.affiliation_name, doctor_username, doctor_tel, 
            doctor_status, doctor_activate, doctor_tel, doctor_create_date, doctor_update_date 
            FROM doctor
            LEFT JOIN prefix ON doctor.prefix_id = prefix.prefix_id
            LEFT JOIN professions ON doctor.professions_id = professions.professions_id
            LEFT JOIN affiliation ON doctor.affiliation_id = affiliation.affiliation_id
            WHERE doctor_id = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

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

    public function readDoctorByBookingID($booking_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT doctor.doctor_id, doctor.doctor_idcard, prefix.prefix_id, prefix.prefix_name, doctor.doctor_fname, 
            doctor.doctor_lname, doctor.doctor_birthday, doctor.doctor_old_address, doctor.doctor_address, professions.professions_id, 
            professions.professions_name, doctor.doctor_file_profess, doctor.doctor_signature, doctor.doctor_img, affiliation.affiliation_id, affiliation.affiliation_name, doctor.doctor_username, doctor.doctor_tel, 
            doctor.doctor_status, doctor.doctor_tel, doctor.doctor_create_date, doctor.doctor_update_date 
            FROM booking
            LEFT JOIN doctor ON doctor.doctor_id = booking.doctor_id
            LEFT JOIN prefix ON doctor.prefix_id = prefix.prefix_id
            LEFT JOIN professions ON doctor.professions_id = professions.professions_id
            LEFT JOIN affiliation ON doctor.affiliation_id = affiliation.affiliation_id
            WHERE booking.booking_id = :booking_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

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

    public function readDoctorByStatusActivate($doctor_activate) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT doctor_id, doctor_idcard, prefix.prefix_id, prefix.prefix_name, doctor_fname, 
            doctor_lname, doctor_birthday, doctor_old_address, doctor_address, professions.professions_id, 
            professions.professions_name, doctor_file_profess, doctor_img, affiliation.affiliation_id, affiliation.affiliation_name, doctor_username, doctor_tel, 
            doctor_status, doctor_signature, doctor_create_date, doctor_update_date 
            FROM doctor
            LEFT JOIN prefix ON doctor.prefix_id = prefix.prefix_id
            LEFT JOIN professions ON doctor.professions_id = professions.professions_id
            LEFT JOIN affiliation ON doctor.affiliation_id = affiliation.affiliation_id
            WHERE doctor_activate = :doctor_activate";  
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_activate', $doctor_activate, PDO::PARAM_INT);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

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

    public function readDoctorSearch($textSreach) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT doctor_id, doctor_idcard, prefix.prefix_name, doctor_fname, doctor_lname
            FROM `doctor` 
            LEFT JOIN prefix ON doctor.prefix_id = prefix.prefix_id
            WHERE  (
                doctor_idcard LIKE CONCAT('%', :textSreach, '%')  
                    OR prefix_name LIKE CONCAT('%', :textSreach, '%') 
                    OR doctor_fname LIKE CONCAT('%', :textSreach, '%') 
                    OR doctor_lname LIKE CONCAT('%', :textSreach, '%') 
            )";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':textSreach', $textSreach, PDO::PARAM_STR);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            } 
        } 
        
        if (!empty($result)) {

            return $result;
        }
    }

    public function readDoctorSchedule($doctor_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT
                `ds_id`,
                `doctor_id`,
                `ds_duration`,
                `ds_day`,
                `ds_status`,
                `ds_create_date`,
                `ds_update_date`
            FROM
                `doctor_schedule`
            WHERE
                `doctor_id` = :doctor_id AND `ds_status` = 1";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

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

    public function insertDoctor($doctor_idcard, $professions_id, $prefix_id, $doctor_fname, $doctor_lname, $doctor_birthday, $affiliation_id, $doctor_old_address, $doctor_address, $doctor_tel, $doctor_username, $doctor_password, $doctor_file_profess = NULL, $doctor_img  = NULL, $doctor_signature = NULL, $ds_duration, $ds_day) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $checkDup = $this->checkIdCardDuplicate($doctor_idcard);
            
            if(!empty($checkDup)) {

                $ErrorMessage = new ErrorMessage("202", FALSE);  
                return $ErrorMessage;
            }

            $checkDup = $this->checkUsernameDuplicate($doctor_username);
            
            if(!empty($checkDup)) {

                $ErrorMessage = new ErrorMessage("203", FALSE);  
                return $ErrorMessage;
            }

            $sql_doctor = "INSERT INTO `doctor`(
                `doctor_id`, 
                `doctor_idcard`, 
                `prefix_id`, 
                `doctor_fname`, 
                `doctor_lname`, 
                `doctor_birthday`, 
                `doctor_old_address`, 
                `doctor_address`, 
                `professions_id`, 
                `doctor_file_profess`, 
                `doctor_img`, 
                `affiliation_id`, 
                `doctor_username`, 
                `doctor_password`, 
                `doctor_tel`, 
                `doctor_signature`, 
                `doctor_status`, 
                `doctor_create_date`, 
                `doctor_update_date`
                ) 
            VALUES (
                NULL, 
                :doctor_idcard, 
                :prefix_id, 
                :doctor_fname, 
                :doctor_lname, 
                :doctor_birthday, 
                :doctor_old_address, 
                :doctor_address, 
                :professions_id, 
                :doctor_file_profess, 
                :doctor_img, 
                :affiliation_id, 
                :doctor_username, 
                :doctor_password, 
                :doctor_tel, 
                :doctor_signature, 
                2, 
                NOW(), 
                NOW()
                )";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $doctor_password = md5($doctor_password);

            $query_doctor->bindParam(':doctor_idcard', $doctor_idcard, PDO::PARAM_STR);
            $query_doctor->bindParam(':professions_id', $professions_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':prefix_id', $prefix_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_fname', $doctor_fname, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_lname', $doctor_lname, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_birthday', $doctor_birthday, PDO::PARAM_STR);
            $query_doctor->bindParam(':affiliation_id', $affiliation_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_old_address', $doctor_old_address, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_address', $doctor_address, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_tel', $doctor_tel, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_username', $doctor_username, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_password', $doctor_password, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_file_profess', $doctor_file_profess, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_img', $doctor_img, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_signature', $doctor_signature, PDO::PARAM_STR);
             
            $query_doctor->execute();

            if($query_doctor->rowCount() > 0) {

                $query_doctor = $this->insertSchedule($conn->lastInsertId(), $ds_duration, $ds_day);

                if(!$query_doctor->errorStatus) {

                    $ErrorMessage = new ErrorMessage("501", FALSE);  
                    return $ErrorMessage;
                }
            }
            
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

    public function insertRegisterDoctor($doctor_idcard, $professions_id, $prefix_id, $doctor_fname, $doctor_lname, $doctor_birthday, $affiliation_id, $doctor_old_address, $doctor_address, $doctor_img, $doctor_tel, $doctor_username, $doctor_password) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $checkDup = $this->checkIdCardDuplicate($doctor_idcard);
            
            if(!empty($checkDup)) {

                $ErrorMessage = new ErrorMessage("202", FALSE);  
                return $ErrorMessage;
            }

            $sql_doctor = "INSERT INTO `doctor`(
                `doctor_id`, 
                `doctor_idcard`, 
                `prefix_id`, 
                `doctor_fname`, 
                `doctor_lname`, 
                `doctor_birthday`, 
                `doctor_old_address`, 
                `doctor_address`, 
                `professions_id`, 
                `doctor_img`, 
                `affiliation_id`, 
                `doctor_username`, 
                `doctor_password`, 
                `doctor_tel`, 
                `doctor_status`, 
                `doctor_create_date`, 
                `doctor_update_date`
                ) 
            VALUES (
                NULL, 
                :doctor_idcard, 
                :prefix_id, 
                :doctor_fname, 
                :doctor_lname, 
                :doctor_birthday, 
                :doctor_old_address, 
                :doctor_address, 
                :professions_id,
                :doctor_img, 
                :affiliation_id, 
                :doctor_username, 
                :doctor_password, 
                :doctor_tel,
                0, 
                NOW(), 
                NOW()
                )";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $doctor_password = md5($doctor_password);

            $query_doctor->bindParam(':doctor_idcard', $doctor_idcard, PDO::PARAM_STR);
            $query_doctor->bindParam(':professions_id', $professions_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':prefix_id', $prefix_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_fname', $doctor_fname, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_lname', $doctor_lname, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_birthday', $doctor_birthday, PDO::PARAM_STR);
            $query_doctor->bindParam(':affiliation_id', $affiliation_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_old_address', $doctor_old_address, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_address', $doctor_address, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_tel', $doctor_tel, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_username', $doctor_username, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_password', $doctor_password, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_img', $doctor_img, PDO::PARAM_STR);
             
            $query_doctor->execute();
            
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

    public function updateDoctor($doctor_id, $doctor_idcard, $professions_id, $prefix_id, $doctor_fname, $doctor_lname, $doctor_birthday, $affiliation_id, $doctor_old_address, $doctor_address, $doctor_tel, $doctor_file_profess = NULL, $doctor_img  = NULL, $doctor_signature = NULL) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            if($doctor_img != NULL)
                $this->UpdateImg($doctor_id, $doctor_img);
        
            if($doctor_signature != NULL)
                $this->UpdateFileSignature($doctor_id, $doctor_signature);
        
            if($doctor_file_profess != NULL)
                $this->UpdateFileProfess($doctor_id, $doctor_file_profess);

            $sql_doctor = "UPDATE
                    `doctor`
                SET
                    `doctor_idcard` = :doctor_idcard, 
                    `prefix_id` = :prefix_id, 
                    `doctor_fname` = :doctor_fname, 
                    `doctor_lname` = :doctor_lname, 
                    `doctor_birthday` = :doctor_birthday, 
                    `doctor_old_address` = :doctor_old_address, 
                    `doctor_address` = :doctor_address, 
                    `professions_id` = :professions_id, 
                    `affiliation_id` = :affiliation_id, 
                    `doctor_tel` = :doctor_tel, 
                    `doctor_update_date` = NOW() 
                WHERE 
                    `doctor_id` = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_idcard', $doctor_idcard, PDO::PARAM_STR);
            $query_doctor->bindParam(':professions_id', $professions_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':prefix_id', $prefix_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_fname', $doctor_fname, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_lname', $doctor_lname, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_birthday', $doctor_birthday, PDO::PARAM_STR);
            $query_doctor->bindParam(':affiliation_id', $affiliation_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_old_address', $doctor_old_address, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_address', $doctor_address, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_tel', $doctor_tel, PDO::PARAM_STR);
             
            $query_doctor->execute();
            
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

    public function deleteDoctor($doctor_id, $doctor_idcard) {
        
        try { 
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "UPDATE `doctor` SET `doctor_status` = 3 WHERE `doctor_id` = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
             
            $query_doctor->execute();
            
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

    public function UpdateFileVerifyDoctor($doctor_id, $doctor_file_profess, $doctor_signature) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "UPDATE
                    `doctor`
                SET
                    `doctor_file_profess` = :doctor_file_profess, 
                    `doctor_signature` = :doctor_signature, 
                    `doctor_update_date` = NOW() 
                WHERE 
                    `doctor_id` = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_file_profess', $doctor_file_profess, PDO::PARAM_STR);
            $query_doctor->bindParam(':doctor_signature', $doctor_signature, PDO::PARAM_STR);
             
            $query_doctor->execute();
            
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

    public function UpdateDoctorActivate($doctor_id, $doctor_activate) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "UPDATE
                    `doctor`
                SET
                    `doctor_activate` = :doctor_activate, 
                    `doctor_update_date` = NOW() 
                WHERE 
                    `doctor_id` = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_activate', $doctor_activate, PDO::PARAM_INT);
             
            $query_doctor->execute();
            
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

    public function deleteDoctorSchedule($doctor_id) {
        
        try { 
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "UPDATE `doctor` SET `doctor_status` = 3 WHERE `doctor_id` = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
             
            $query_doctor->execute();
            
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

    public function insertSchedule($doctor_id, $ds_duration, $ds_day) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $checkDup = $this->checkScheduleDuplicate($doctor_id, $ds_duration, $ds_day);
            
            if(!empty($checkDup)) {

                $ErrorMessage = new ErrorMessage("501", FALSE);  
                return $ErrorMessage;
            }
            
            $sql_doctor = "INSERT INTO `doctor_schedule`(
                `ds_id`,
                `doctor_id`,
                `ds_duration`,
                `ds_day`,
                `ds_status`,
                `ds_create_date`,
                `ds_update_date`
            )
            VALUES(
                NULL,
                :doctor_id,
                :ds_duration,
                :ds_day,
                1,
                NOW(),
                NOW()
            )";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_STR);
            $query_doctor->bindParam(':ds_duration', $ds_duration, PDO::PARAM_INT);
            $query_doctor->bindParam(':ds_day', $ds_day, PDO::PARAM_INT);
             
            $query_doctor->execute();

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

    public function checkScheduleDuplicate($doctor_id, $ds_duration, $ds_day) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT
                `ds_id`,
                `doctor_id`,
                `ds_duration`,
                `ds_day`,
                `ds_status`,
                `ds_create_date`,
                `ds_update_date`
            FROM
                `doctor_schedule`
            WHERE
                (`doctor_id` = :doctor_id AND `ds_status` = 1) AND (ds_duration = :ds_duration AND ds_day = :ds_day)";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':ds_duration', $ds_duration, PDO::PARAM_INT);
            $query_doctor->bindParam(':ds_day', $ds_day, PDO::PARAM_INT);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

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

    public function enableDoctor($doctor_id) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "UPDATE
                    `doctor`
                SET
                    `doctor_status` = 0
                WHERE 
                    `doctor_id` = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
             
            $query_doctor->execute();
            
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

    public function disableDoctor($doctor_id) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "UPDATE
                    `doctor`
                SET
                    `doctor_status` = 3
                WHERE 
                    `doctor_id` = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
             
            $query_doctor->execute();
            
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

    public function changePasswordDoctor($doctor_id, $doctor_password) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $doctor_password = md5($doctor_password);

            $sql_doctor = "UPDATE
                    `doctor`
                SET
                    `doctor_password` = :doctor_password
                WHERE 
                    `doctor_id` = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_password', $doctor_password, PDO::PARAM_STR);
             
            $query_doctor->execute();
            
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

    public function checkIdCardDuplicate($doctor_idcard) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT doctor_idcard
            FROM
                doctor
            WHERE
                doctor_idcard = :doctor_idcard";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_idcard', $doctor_idcard, PDO::PARAM_STR);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

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

    public function checkUsernameDuplicate($doctor_username) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT doctor_idcard
            FROM
                doctor
            WHERE
                doctor_username = :doctor_username";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_username', $doctor_username, PDO::PARAM_STR);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

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

    public function UpdateImg($doctor_id, $doctor_img) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "UPDATE
                    doctor
                SET
                    doctor_img = :doctor_img
                WHERE 
                    doctor_id = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_img', $doctor_img, PDO::PARAM_STR);
             
            $query_doctor->execute();
            
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

    public function UpdateFileSignature($doctor_id, $doctor_signature) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "UPDATE
                    doctor
                SET
                    doctor_signature = :doctor_signature
                WHERE 
                    doctor_id = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_signature', $doctor_signature, PDO::PARAM_STR);
             
            $query_doctor->execute();
            
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

    public function UpdateFileProfess($doctor_id, $doctor_file_profess) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "UPDATE
                    doctor
                SET
                    doctor_file_profess = :doctor_file_profess
                WHERE 
                    doctor_id = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_file_profess', $doctor_file_profess, PDO::PARAM_STR);
             
            $query_doctor->execute();
            
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

    public function UpdateDoctorStatus($doctor_id, $doctor_status) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "UPDATE
                    `doctor`
                SET
                    `doctor_status` = :doctor_status, 
                    `doctor_update_date` = NOW() 
                WHERE 
                    `doctor_id` = :doctor_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':doctor_status', $doctor_status, PDO::PARAM_INT);
             
            $query_doctor->execute();
            
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