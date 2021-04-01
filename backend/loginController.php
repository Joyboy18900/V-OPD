<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "Controller/Login.php";
include_once "Config/baseFunction.php";
include_once "Controller/personalCentral.php";
include_once "Controller/Doctor.php";

if(isset($_GET["checkLogin"])) {

    if(isset($_POST["loginStatus"])) {

        if($_POST["loginStatus"] == "1") { // พนักงานพยาบาล
            
            $LoginPc = new Login();
            $result = $LoginPc->personalCentral($_POST["username"], $_POST["password"]);

            if(isset($result->errorStatus) && !$result->errorStatus) {

                echo json_encode($result);
                exit();
            }
            
            $_SESSION["userBackend"]["userID"] = $result["per_id"];
            $_SESSION["userBackend"]["userFullname"] = $result["prefix_name"] . $result["per_fname"] . ' ' . $result["per_lname"];
            $_SESSION["userBackend"]["userUsername"] = $result["per_username"];
            $_SESSION["userBackend"]["userProfession"] = $result["professions_id"];
            $_SESSION["userBackend"]["userActivate"] = $result["per_activate"]; 
            $_SESSION["userBackend"]["userRole"] = "1"; 
            $_SESSION["userBackend"]["userImg"] = $result["per_img"];

            
            $personalCentral = new PersonalCentral();
            $result = $personalCentral->UpdatePcStatus($result["per_id"], 1);

            $ErrorMessage = new ErrorMessage("1001", TRUE);
            echo json_encode($ErrorMessage);
        }

        if($_POST["loginStatus"] == "2") { // แพทย์

            $CheckDoctor = new Login();
            $result = $CheckDoctor->checkDoctor($_POST["username"], $_POST["password"]);

            if(isset($result->errorStatus) && !$result->errorStatus) {

                echo json_encode($result);
                exit();
            }
            
            $_SESSION["userBackend"]["userID"] = $result["doctor_id"];
            $_SESSION["userBackend"]["userFullname"] = $result["prefix_name"] . $result["doctor_fname"] . ' ' . $result["doctor_lname"];
            $_SESSION["userBackend"]["userUsername"] = $result["doctor_username"];
            $_SESSION["userBackend"]["userProfession"] = $result["professions_id"];
            $_SESSION["userBackend"]["userAffiliation"] = $result["affiliation_id"]; 
            $_SESSION["userBackend"]["userActivate"] = $result["doctor_activate"]; 
            $_SESSION["userBackend"]["userRole"] = "2"; 
            $_SESSION["userBackend"]["userImg"] = $result["doctor_img"];

            $Doctor = new Doctor();
            $result = $Doctor->UpdateDoctorStatus($result["doctor_id"], 1);
            

            $ErrorMessage = new ErrorMessage("1001", TRUE);
            echo json_encode($ErrorMessage);
        }
        
        if($_POST["loginStatus"] == "3") { // ผู้ดูแลระบบ

            if($_POST["username"] == "admin" && $_POST["password"] == "password") {

                $_SESSION["userBackend"]["userID"] = "1";
                $_SESSION["userBackend"]["userFullname"] = "admin";
                $_SESSION["userBackend"]["userUsername"] = "admin";
                $_SESSION["userBackend"]["userProfession"] = "admin";
                $_SESSION["userBackend"]["userAffiliation"] = "admin";
                $_SESSION["userBackend"]["userRole"] = "3"; 
    
                $ErrorMessage = new ErrorMessage("1001", TRUE);
                echo json_encode($ErrorMessage);
                exit();            
            }

            $ErrorMessage = new ErrorMessage("1000", FALSE);

            echo json_encode($ErrorMessage);
            exit();
        }
    }
}

?>