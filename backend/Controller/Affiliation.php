<?php

require_once 'Config/Config.php';
require_once ROOT. '/Config/baseFunction.php';
include_once ROOT. '/Model/Patient.php';

// use ModelPatient\Patient as Member;
// use ModeloutPatient\Patient as outPatient;

class Affiliation extends connectDB {

    public function readAffiliation() {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_affiliation = "SELECT
                affiliation_id,
                affiliation_name
            FROM
                affiliation";
            
            $query_affiliation = $conn->prepare($sql_affiliation);

            $query_affiliation->execute();

            $conn->commit();

            $result_affiliation = $query_affiliation->fetchAll(PDO::FETCH_ASSOC);

            return $result_affiliation;

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

    public function readAffiliationById($affiliation_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_affiliation = "SELECT
                affiliation_id,
                affiliation_name
            FROM
                affiliation
            WHERE
                affiliation_id = :affiliation_id";
            
            $query_affiliation = $conn->prepare($sql_affiliation);

            $query_affiliation->bindParam(':affiliation_id', $affiliation_id, PDO::PARAM_INT);

            $query_affiliation->execute();

            $conn->commit();

            $result_affiliation = $query_affiliation->fetchAll(PDO::FETCH_ASSOC);

            return $result_affiliation;

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