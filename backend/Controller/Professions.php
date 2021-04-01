<?php

require_once 'Config/Config.php';
require_once ROOT. '/Config/baseFunction.php';
include_once ROOT. '/Model/Patient.php';

// use ModelPatient\Patient as Member;
// use ModeloutPatient\Patient as outPatient;

class Professions extends connectDB {

    public function readProfessions() {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_professions = "SELECT
                professions_id,
                professions_name
            FROM
                professions";
            
            $query_professions = $conn->prepare($sql_professions);

            $query_professions->execute();

            $conn->commit();

            $result_professions = $query_professions->fetchAll(PDO::FETCH_ASSOC);

            return $result_professions;

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

    public function readProfessionsById($professions_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_professions = "SELECT
                professions_id,
                professions_name
            FROM
                professions
            WHERE
                professions_id = :professions_id";
            
            $query_professions = $conn->prepare($sql_professions);

            $query_professions->bindParam(':professions_id', $professions_id, PDO::PARAM_INT);

            $query_professions->execute();

            $conn->commit();

            $result_professions = $query_professions->fetchAll(PDO::FETCH_ASSOC);

            return $result_professions;

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