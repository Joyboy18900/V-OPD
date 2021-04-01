<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'Config/Config.php';
require_once ROOT. '/Config/baseFunction.php';
include_once ROOT. '/Model/Patient.php';
require_once ROOT. '/Controller/Booking.php';
require_once ROOT. '/Controller/Booking.php';

use ModelPatient\Patient as Member;
use ModeloutPatient\Patient as outPatient;
// use ModelDoctor\Doctor as Doctor;

class Patient extends connectDB {

    /* Fetch All */
    public function readPatient() {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT p_id, vopd_id, p_idcard, prefix.prefix_name, department.dep_name, p_name, p_lname, p_birthday, 
            p_old_address, p_address, p_blood, p_create_date, p_update_date 
            FROM patient
            LEFT JOIN prefix ON patient.prefix_id = prefix.prefix_id
            LEFT JOIN department ON patient.dep_id = department.dep_id";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->execute();

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            // $patient = new Member();

            // foreach ($result_patient as $key => $value) {
                
            //     $patient->p_id = $value["p_id"];
            //     $patient->p_idcard = $value["p_idcard"];
            //     $patient->prefix_id = $value["prefix_id"];
            //     $patient->p_name = $value["p_name"];
            //     $patient->p_lname = $value["p_lname"];
            //     $patient->p_birthday = $value["p_birthday"];
            //     $patient->p_old_address = $value["p_old_address"];
            //     $patient->p_address = $value["p_address"];
            //     $patient->dep_id = $value["dep_id"];
            //     $patient->p_blood = $value["p_blood"];
            //     $patient->p_create_date = $value["p_create_date"];
            //     $patient->p_update_date = $value["p_update_date"];
            // }

            return $result_patient;

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

    // Fecth By p_id
    public function readPatientById($p_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT patient.p_id, patient.p_idcard, vopd_id, prefix.prefix_id, prefix.prefix_name, patient.p_name, patient.p_lname, patient.p_birthday, 
            patient.p_old_address, patient.p_address, department.dep_id, department.dep_name, patient.p_blood, patient.p_tel, patient.p_create_date, patient.p_update_date 
            FROM patient
            LEFT JOIN prefix ON patient.prefix_id = prefix.prefix_id
            LEFT JOIN department ON patient.dep_id = department.dep_id
            WHERE p_id = :p_id";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_id', $p_id, PDO::PARAM_STR);

            $query_patient->execute();

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient;

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

    public function readPatientByIdCard($p_idcard) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT patient.p_id, patient.p_idcard, patient.vopd_id, prefix.prefix_id, prefix.prefix_name, patient.p_name, patient.p_lname, patient.p_birthday, 
            patient.p_old_address, patient.p_address, department.dep_id, department.dep_name, patient.p_blood, patient.p_create_date, patient.p_update_date 
            FROM patient
            LEFT JOIN prefix ON patient.prefix_id = prefix.prefix_id
            LEFT JOIN department ON patient.dep_id = department.dep_id
            WHERE p_idcard = :p_idcard";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_idcard', $p_idcard, PDO::PARAM_STR);

            $query_patient->execute();

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient;

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

    // Fecth to Search 
    public function readPatientSearch($textSreach) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT p_id, p_idcard, prefix.prefix_name, p_name, p_lname
            FROM `patient` 
            LEFT JOIN prefix ON patient.prefix_id = prefix.prefix_id
            WHERE  (
                p_idcard LIKE CONCAT('%', :textSreach, '%') 
                    OR prefix_name LIKE CONCAT('%', :textSreach, '%') 
                    OR p_name LIKE CONCAT('%', :textSreach, '%') 
                    OR p_name LIKE CONCAT('%', :textSreach, '%') 
            )";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':textSreach', $textSreach, PDO::PARAM_STR);

            $query_patient->execute();

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient;

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

    public function readPatientAfterSearch($p_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT patient.p_id, p_idcard, prefix.prefix_name, p_name, p_lname, p_birthday, dep_name, p_blood, op_cd, op_food_allergy,
            op_drugs_allergy, professions_id, doctor_id, op_detail_sick, op_mark_date, op_status 
            FROM patient 
            LEFT JOIN out_patient op ON patient.p_id = op.p_id 
            LEFT JOIN prefix ON patient.prefix_id = prefix.prefix_id 
            LEFT JOIN department ON patient.dep_id = department.dep_id 
            WHERE op.op_update_date IN 
            ( 
                SELECT MAX(op_update_date) 
                FROM out_patient 
                WHERE patient.p_id = :p_id
                GROUP BY p_id
            )";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_id', $p_id, PDO::PARAM_INT);

            $query_patient->execute();

            if($query_patient->rowCount() <= 0) {

                $ErrorMessage = new ErrorMessage("2000", false);
                return $ErrorMessage;
            }

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", false);
                return $ErrorMessage;
            } 
        } 
    }

    public function readOutPatientById($p_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT op_id, p_id, prefix.prefix_name, doctor.doctor_fname, doctor.doctor_lname, professions.professions_id, op_detail_sick, op_body_temp, op_height, 
            op_weight, op_food_allergy, op_drugs_allergy, op_cd, op_bp, op_suggestion, op_dispense, op_mark_date, 
            op_status, op_create_date, op_update_date 
            FROM out_patient op
            LEFT JOIN doctor ON op.doctor_id = doctor.doctor_id 
            LEFT JOIN prefix ON doctor.prefix_id = prefix.prefix_id 
            LEFT JOIN professions ON op.professions_id = professions.professions_id 
            WHERE op.p_id = :p_id";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_id', $p_id, PDO::PARAM_INT);

            $query_patient->execute();

            if($query_patient->rowCount() <= 0) {

                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            }

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", false);
                return $ErrorMessage;
            } 
        }
    }

    public function readOutPatientByPerId($per_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT op.op_id, per_id, p.p_id, booking.booking_id, p.p_name, p.p_lname, prefix_patient.prefix_name AS prefix_patient ,prefix_doctor.prefix_name AS prefix_doctor, doctor.doctor_fname, doctor.doctor_lname, professions.professions_id, op_detail_sick, op_body_temp, op_height, 
            op_weight, op_food_allergy, op_drugs_allergy, op_cd, op_bp, op_suggestion, op_dispense, op_mark_date, booking.room_id,
            op_status, booking.booking_status, op_create_date, op_update_date 
            FROM out_patient op
            LEFT JOIN patient p ON op.p_id = p.p_id 
            LEFT JOIN doctor ON op.doctor_id = doctor.doctor_id 
            LEFT JOIN prefix prefix_patient ON p.prefix_id = prefix_patient.prefix_id 
            LEFT JOIN prefix prefix_doctor ON doctor.prefix_id = prefix_doctor.prefix_id 
            LEFT JOIN professions ON op.professions_id = professions.professions_id 
            LEFT JOIN booking ON op.op_id = booking.op_id 
            WHERE op.per_id = :per_id AND (booking.booking_status = 1 OR booking.booking_status = 2) ";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':per_id', $per_id, PDO::PARAM_INT);

            $query_patient->execute();

            if($query_patient->rowCount() <= 0) {

                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            }

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", false);
                return $ErrorMessage;
            } 
        }
    }

    public function readOutPatientByDoctorId($doctor_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT op.op_id, op.per_id, p.p_id, p.p_name, p.p_lname, prefix_patient.prefix_name AS prefix_patient, prefix_pc.prefix_name AS prefix_pc, pc.per_fname, pc.per_lname, professions.professions_id, op_detail_sick, op_body_temp, op_height, 
            op_weight, op_food_allergy, op_drugs_allergy, op_cd, op_bp, op_suggestion, op_dispense, op_mark_date, 
            op_status, op_create_date, op_update_date 
            FROM out_patient op
            LEFT JOIN patient p ON op.p_id = p.p_id 
            LEFT JOIN personal_central pc ON op.per_id = pc.per_id 
            LEFT JOIN prefix prefix_patient ON p.prefix_id = prefix_patient.prefix_id 
            LEFT JOIN prefix prefix_pc ON pc.prefix_id = prefix_pc.prefix_id 
            LEFT JOIN professions ON op.professions_id = professions.professions_id 
            RIGHT JOIN booking ON op.op_id = booking.op_id
            WHERE op.doctor_id = :doctor_id AND booking.booking_status = 2";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);

            $query_patient->execute();

            if($query_patient->rowCount() <= 0) {

                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            }

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", false);
                return $ErrorMessage;
            } 
        }
    }

    public function readOutPatientByOpId($op_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT patient.p_id, p_idcard, booking_id, prefix.prefix_name, p_name, p_lname, p_birthday, dep_name, 
            p_old_address, p_address, p_blood, op.op_detail_sick, op.op_dispense, op.op_suggestion, op.op_height, op.op_weight, op.op_cd, op.op_bp, op.op_food_allergy, 
            op.op_drugs_allergy, op.op_create_date, op.op_update_date
            FROM patient 
            LEFT JOIN out_patient op ON patient.p_id = op.p_id 
            LEFT JOIN prefix ON patient.prefix_id = prefix.prefix_id 
            LEFT JOIN department ON patient.dep_id = department.dep_id
            LEFT JOIN booking ON booking.op_id = op.op_id 
            WHERE op.op_id = :op_id";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':op_id', $op_id, PDO::PARAM_INT);

            $query_patient->execute();

            if($query_patient->rowCount() <= 0) {

                return $this->readPatientById($p_id);
            }

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient;

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

    public function readOutPatientByBookingId($booking_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT patient.p_id, p_idcard, prefix.prefix_name, p_name, p_lname, p_birthday, dep_name, 
            p_old_address, p_address, p_blood, op.op_detail_sick, op_body_temp, op.op_dispense, op.op_suggestion, op.op_height, op.op_weight, op.op_cd, op.op_bp, op.op_food_allergy, 
            op.op_drugs_allergy, op.op_create_date, op.op_update_date
            FROM patient 
            LEFT JOIN out_patient op ON patient.p_id = op.p_id 
            LEFT JOIN booking ON op.op_id = booking.op_id
            LEFT JOIN prefix ON patient.prefix_id = prefix.prefix_id 
            LEFT JOIN department ON patient.dep_id = department.dep_id
            WHERE booking.booking_id = :booking_id";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);

            $query_patient->execute();

            if($query_patient->rowCount() <= 0) {

                return $this->readPatientById($p_id);
            }

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient;

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

    public function readPatientAndOutPatientById($p_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT patient.p_id, p_idcard, vopd_id, prefix.prefix_name, p_name, p_lname, p_birthday, dep_name, p_old_address, p_address, p_blood, 
            op.op_height, op.op_weight, op.op_cd, op.op_food_allergy, op.op_drugs_allergy
            FROM patient 
            LEFT JOIN out_patient op ON patient.p_id = op.p_id 
            LEFT JOIN prefix ON patient.prefix_id = prefix.prefix_id 
            LEFT JOIN department ON patient.dep_id = department.dep_id 
            WHERE op.op_update_date IN 
            ( 
                SELECT MAX(op_update_date) 
                FROM out_patient 
                WHERE patient.p_id = :p_id
                GROUP BY p_id
            )";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_id', $p_id, PDO::PARAM_INT);

            $query_patient->execute();

            if($query_patient->rowCount() <= 0) {

                return $this->readPatientById($p_id);
            }

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient;

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

    /* Add Just a Patient */
    public function insertPatient($p_idcard, $prefix_id, $p_name, $p_lname, $p_birthday, $p_old_address, $p_address, $dep_id, $p_blood, $p_tel) {

        try {
                             
            $conn = $this->openConnection();

            $conn->beginTransaction();

            $checkDup = $this->checkIdCardDuplicate($p_idcard);
            
            if(!empty($checkDup)) {

                $ErrorMessage = new ErrorMessage("202", FALSE);  
                return $ErrorMessage;
            }

            $date = new DateTime();

            $vopd_id = 'VO' . $date->format("dyu");
            $p_password = md5(preg_replace('/[^\p{L}\p{N}\s]/u', '', date("d-m-Y", strtotime($p_birthday))));

            $sql_patient = "INSERT INTO `patient`(`p_id`, `p_idcard`, `vopd_id`, `prefix_id`, `p_name`, `p_lname`, `p_birthday`, `p_old_address`, `p_address`, `dep_id`, `p_blood`, `p_tel`, `p_password`, `p_create_date`, `p_update_date`) 
            VALUES (null, :p_idcard, :vopd_id, :prefix_id, :p_name, :p_lname, :p_birthday, :p_old_address, :p_address, :dep_id, :p_blood, :p_tel, :p_password, NOW(), NOW())";

            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_idcard', $p_idcard, PDO::PARAM_STR);
            $query_patient->bindParam(':vopd_id', $vopd_id, PDO::PARAM_STR);
            $query_patient->bindParam(':prefix_id', $prefix_id, PDO::PARAM_INT);
            $query_patient->bindParam(':p_name', $p_name, PDO::PARAM_STR);
            $query_patient->bindParam(':p_lname', $p_lname, PDO::PARAM_STR);
            $query_patient->bindParam(':p_birthday', $p_birthday, PDO::PARAM_STR);
            $query_patient->bindParam(':p_old_address', $p_old_address, PDO::PARAM_STR);
            $query_patient->bindParam(':p_address', $p_address, PDO::PARAM_STR);
            $query_patient->bindParam(':dep_id', $dep_id, PDO::PARAM_INT);
            $query_patient->bindParam(':p_blood', $p_blood, PDO::PARAM_STR);
            $query_patient->bindParam(':p_tel', $p_tel, PDO::PARAM_STR);
            $query_patient->bindParam(':p_password', $p_password, PDO::PARAM_STR);
            
            $result = $query_patient->execute();

            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", true);
            return $ErrorMessage;

            $this->closeConnection();
        } catch (PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if(isset($conn)) {

                $conn->rollback();

                $ErrorMessage = new ErrorMessage("501", false);
                return $ErrorMessage;
            }
        }
    }

    /* Add Just a Patient */
    public function editPatient($p_id, $p_idcard, $prefix_id, $p_name, $p_lname, $p_birthday, $p_old_address, $p_address, $dep_id, $p_blood, $p_tel) {

        try {
                             
            $conn = $this->openConnection();

            $conn->beginTransaction();

            $sql_patient = "UPDATE patient 
            SET p_idcard= :p_idcard, prefix_id= :prefix_id,
            p_name = :p_name, p_lname = :p_lname, p_birthday = :p_birthday, p_old_address = :p_old_address,
            p_address = :p_address, dep_id = :dep_id, p_blood = :p_blood, p_tel = :p_tel, p_update_date = NOW() 
            WHERE p_id = :p_id ";

            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_id', $p_id, PDO::PARAM_INT);
            $query_patient->bindParam(':p_idcard', $p_idcard, PDO::PARAM_STR);
            $query_patient->bindParam(':prefix_id', $prefix_id, PDO::PARAM_INT);
            $query_patient->bindParam(':p_name', $p_name, PDO::PARAM_STR);
            $query_patient->bindParam(':p_lname', $p_lname, PDO::PARAM_STR);
            $query_patient->bindParam(':p_birthday', $p_birthday, PDO::PARAM_STR);
            $query_patient->bindParam(':p_old_address', $p_old_address, PDO::PARAM_STR);
            $query_patient->bindParam(':p_address', $p_address, PDO::PARAM_STR);
            $query_patient->bindParam(':dep_id', $dep_id, PDO::PARAM_INT);
            $query_patient->bindParam(':p_blood', $p_blood, PDO::PARAM_STR);
            $query_patient->bindParam(':p_tel', $p_tel, PDO::PARAM_STR);
            
            $result = $query_patient->execute();

            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", true);
            return $ErrorMessage;

            $this->closeConnection();
        } catch (PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if(isset($conn)) {

                $conn->rollback();
                $ErrorMessage = new ErrorMessage("501", false);
                return $ErrorMessage;
            }
        } 
    }

    /* Add Just Out Record By p_id */
    public function insertOutPatient($p_id, $per_id, $op_cd, $op_food_allergy, $op_drugs_allergy, $op_weight, $op_height, $op_body_temp, $op_bp, $professions_id, $op_detail_sick, $doctor_id = NULL, $room_id) {

        try {
                             
            $conn = $this->openConnection();

            $conn->beginTransaction();

            $sql_patient = "INSERT INTO `out_patient`(`op_id`, `p_id`, `per_id`, `doctor_id`, `professions_id`, `op_detail_sick`, `op_body_temp`, `op_height`, `op_weight`, `op_food_allergy`, `op_drugs_allergy`, `op_cd`, `op_bp`, `op_create_date`, `op_update_date`) 
            VALUES (null, :p_id, :per_id, :doctor_id, :professions_id, :op_detail_sick, :op_body_temp, :op_height, :op_weight, :op_food_allergy, :op_drugs_allergy, :op_cd, :op_bp, NOW(), NOW())";

            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_id', $p_id, PDO::PARAM_STR);
            $query_patient->bindParam(':per_id', $per_id, PDO::PARAM_INT);
            $query_patient->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_patient->bindParam(':professions_id', $professions_id, PDO::PARAM_INT);
            $query_patient->bindParam(':op_detail_sick', $op_detail_sick, PDO::PARAM_STR);
            $query_patient->bindParam(':op_body_temp', $op_body_temp, PDO::PARAM_STR);
            $query_patient->bindParam(':op_height', $op_height, PDO::PARAM_STR);
            $query_patient->bindParam(':op_weight', $op_weight, PDO::PARAM_STR);
            $query_patient->bindParam(':op_food_allergy', $op_food_allergy, PDO::PARAM_STR);
            $query_patient->bindParam(':op_drugs_allergy', $op_drugs_allergy, PDO::PARAM_STR);
            $query_patient->bindParam(':op_cd', $op_cd, PDO::PARAM_STR);
            $query_patient->bindParam(':op_bp', $op_bp, PDO::PARAM_STR);

            $result = $query_patient->execute();

            $op_id = $conn->lastInsertId();
            
            $conn->commit();
            
            $Booking = new Booking();
            $result_booking = $Booking->insertBooking($op_id, $doctor_id, $room_id);
            
            if($result_booking->errorStatus) {

                // $conn->commit();
                $ErrorMessage = new ErrorMessage("201", TRUE);
                $ErrorMessage->op_id = $op_id;
                $ErrorMessage->booking_id = $result_booking->booking_id;
                return $ErrorMessage;
            }

            $this->closeConnection();
        } catch (PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);
            
            if(isset($conn)) {

                $conn->rollback();

                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            }
        }
    }

    public function updatePatientAfterBooking($booking_id, $doctor_id, $op_suggestion, $op_dispense, $op_mark_date = NULL) {

        try {
                             
            $conn = $this->openConnection();

            $conn->beginTransaction();

            $sql_patient = "UPDATE booking 
            INNER JOIN out_patient ON booking.op_id = out_patient.op_id
            SET out_patient.doctor_id = :doctor_id, 
                out_patient.op_suggestion = :op_suggestion, 
                out_patient.op_dispense = :op_dispense, 
                out_patient.op_mark_date = NULL,
                out_patient.op_update_date = NOW(),
                booking.doctor_id = :doctor_id,
                booking.booking_status = 2, 
                booking.booking_update_date = NOW()  
            WHERE booking.booking_id = :booking_id";

            if($op_mark_date != NULL) {

                $sql_patient = "UPDATE booking 
                INNER JOIN out_patient ON booking.op_id = out_patient.op_id
                SET out_patient.doctor_id = :doctor_id, 
                    out_patient.op_suggestion = :op_suggestion, 
                    out_patient.op_dispense = :op_dispense, 
                    out_patient.op_mark_date = :op_mark_date, 
                    out_patient.op_status = 1,
                    out_patient.op_update_date = NOW(),
                    booking.doctor_id = :doctor_id,
                    booking.booking_status = 2, 
                    booking.booking_update_date = NOW()  
                WHERE booking.booking_id = :booking_id";
            }

            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
            $query_patient->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_patient->bindParam(':op_suggestion', $op_suggestion, PDO::PARAM_STR);
            $query_patient->bindParam(':op_dispense', $op_dispense, PDO::PARAM_STR);
            $query_patient->bindParam(':op_mark_date', $op_mark_date, PDO::PARAM_STR);

            $result = $query_patient->execute();

            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", true);
            return $ErrorMessage;

            $this->closeConnection();
        } catch (PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if(isset($conn)) {

                $conn->rollback();
                $ErrorMessage = new ErrorMessage("501", false);
                return $ErrorMessage;
            }
        }
    }

    public function changePasswordPatient($p_id, $p_old_password, $p_password) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $checkDup = $this->checkPasswordPatient($p_id, $p_old_password);
            
            if(empty($checkDup)) {

                $ErrorMessage = new ErrorMessage("3001", FALSE);  
                return $ErrorMessage;
            }

            $p_old_password = md5($p_old_password);
            $p_password = md5($p_password);

            $sql_patient = "UPDATE
                patient p
            SET
                p.p_password = :p_password
            WHERE
                p.p_id = :p_id AND p_password IN (:p_old_password) ";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_id', $p_id, PDO::PARAM_INT);
            $query_patient->bindParam(':p_old_password', $p_old_password, PDO::PARAM_STR);
            $query_patient->bindParam(':p_password', $p_password, PDO::PARAM_STR);
             
            $query_patient->execute();
            
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

    public function checkPasswordPatient($p_id, $p_password) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $p_password = md5($p_password);

            $sql_patient = "SELECT p_id
            FROM
                patient
            WHERE
                p_id = :p_id AND p_password = :p_password";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_id', $p_id, PDO::PARAM_INT);
            $query_patient->bindParam(':p_password', $p_password, PDO::PARAM_STR);

            $query_patient->execute();

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient;

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

    public function updateProfilePatient($p_id, $p_old_address, $p_address) {
        
        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "UPDATE
                patient
            SET
                p_old_address = :p_old_address,
                p_address = :p_address
            WHERE
                p_id = :p_id ";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_id', $p_id, PDO::PARAM_INT);
            $query_patient->bindParam(':p_old_address', $p_old_address, PDO::PARAM_STR);
            $query_patient->bindParam(':p_address', $p_address, PDO::PARAM_STR);
             
            $query_patient->execute();
            
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

    public function checkIdCardDuplicate($p_idcard) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT p_idcard
            FROM
                patient
            WHERE
                p_idcard = :p_idcard";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_idcard', $p_idcard, PDO::PARAM_STR);

            $query_patient->execute();

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient;

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
}

?>