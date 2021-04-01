<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/V-OPD/backend/Config/Config.php';
require_once ROOT. '/Config/baseFunction.php';
include_once ROOT. '/Model/Patient.php';

use ModelPatient\Patient as Member;
use ModeloutPatient\Patient as outPatient;

class Login extends connectDB {

    public function CreateLogin($username, $password) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);

            $sql_patient = "SELECT patient.p_id, patient.p_idcard, prefix.prefix_name, patient.p_name, patient.p_lname, patient.p_birthday, 
            patient.p_old_address, patient.p_address, department.dep_name, patient.p_blood, patient.p_create_date, patient.p_update_date 
            FROM patient
            LEFT JOIN prefix ON patient.prefix_id = prefix.prefix_id
            LEFT JOIN department ON patient.dep_id = department.dep_id
            WHERE p_id = :p_id";
            
            $query_patient = $conn->prepare($sql_patient);

            $query_patient->bindParam(':p_id', $p_id, PDO::PARAM_STR);

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

    public function checkDoctor($username, $password) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT doctor_id, prefix.prefix_name, doctor_fname, doctor_lname, doctor_birthday, doctor_old_address, 
            doctor_address, professions.professions_id, doctor_img, doctor_file_profess, affiliation.affiliation_id, doctor_username, 
            doctor_status, doctor_activate, doctor_create_date, doctor_update_date 
            FROM doctor
            LEFT JOIN prefix ON doctor.prefix_id = prefix.prefix_id
            LEFT JOIN affiliation ON doctor.affiliation_id = affiliation.affiliation_id
            LEFT JOIN professions ON doctor.professions_id = professions.professions_id
            WHERE doctor_username = :username
            AND doctor_password = :password 
            AND doctor_status != 3";
            
            $query_patient = $conn->prepare($sql_patient);

            $password = md5($password);

            $query_patient->bindParam(':username', $username, PDO::PARAM_STR);
            $query_patient->bindParam(':password', $password, PDO::PARAM_STR);

            $query_patient->execute();

            if($query_patient->rowCount() <= 0) {

                $ErrorMessage = new ErrorMessage("1000", false);
                return $ErrorMessage;
            }

            $conn->commit();

            $result_patient = $query_patient->fetchAll(PDO::FETCH_ASSOC);

            return $result_patient[0];

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

    public function personalCentral($username, $password) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT per_id, prefix.prefix_name, per_fname, per_lname, per_birthday, per_old_address, 
            per_address, professions.professions_id, per_img, per_file_profess, per_username, 
            per_status, per_activate, per_create_date, per_update_date 
            FROM personal_central pc
            LEFT JOIN prefix ON pc.prefix_id = prefix.prefix_id
            LEFT JOIN professions ON pc.professions_id = professions.professions_id
            WHERE pc.per_username = :username
            AND pc.per_password = :password ";
            
            $query_patient = $conn->prepare($sql_patient);

            $password = md5($password);

            $query_patient->bindParam(':username', $username, PDO::PARAM_STR);
            $query_patient->bindParam(':password', $password, PDO::PARAM_STR);

            $query_patient->execute();

            if($query_patient->rowCount() <= 0) {

                $ErrorMessage = new ErrorMessage("1000", false);
                return $ErrorMessage;
            }

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

            return $result_patient[0];

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

    public function Patient($username, $password) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_patient = "SELECT
                p_id,
                p_idcard,
                vopd_id,
                prefix.prefix_name,
                p_name,
                p_lname,
                p_birthday,
                p_old_address,
                p_address,
                p_blood,
                p_tel,
                p_create_date,
                p_update_date
            FROM
                patient p
            LEFT JOIN prefix ON p.prefix_id = prefix.prefix_id
            WHERE
                p_idcard = :username AND p_password = :password ";
            
            $query_patient = $conn->prepare($sql_patient);

            $password = md5($password);

            $query_patient->bindParam(':username', $username, PDO::PARAM_STR);
            $query_patient->bindParam(':password', $password, PDO::PARAM_STR);

            $query_patient->execute();

            if($query_patient->rowCount() <= 0) {

                $ErrorMessage = new ErrorMessage("1000", false);
                return $ErrorMessage;
            }

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

            return $result_patient[0];

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