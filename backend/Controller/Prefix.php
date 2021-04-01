<?php

require_once 'Config/Config.php';
require_once ROOT. '/Config/baseFunction.php';
include_once ROOT. '/Model/Patient.php';

// use ModelPatient\Patient as Member;
// use ModeloutPatient\Patient as outPatient;

class Prefix extends connectDB {

    public function readPrefix() {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_prefix = "SELECT
                prefix_id,
                prefix_name
            FROM
                prefix";
            
            $query_prefix = $conn->prepare($sql_prefix);

            $query_prefix->execute();

            $conn->commit();

            $result_prefix = $query_prefix->fetchAll(PDO::FETCH_ASSOC);

            return $result_prefix;

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

    public function readPrefixById($prefix_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_prefix = "SELECT
                prefix_id,
                prefix_name
            FROM
                prefix
            WHERE
                prefix_id = :prefix_id";
            
            $query_prefix = $conn->prepare($sql_prefix);

            $query_prefix->bindParam(':prefix_id', $prefix_id, PDO::PARAM_INT);

            $query_prefix->execute();

            $conn->commit();

            $result_prefix = $query_prefix->fetchAll(PDO::FETCH_ASSOC);

            return $result_prefix;

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