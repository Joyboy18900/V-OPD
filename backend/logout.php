<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "Config/baseFunction.php";
include_once "Controller/personalCentral.php";
include_once "Controller/Doctor.php";


if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "1") { 

    $personalCentral = new PersonalCentral();
    $result = $personalCentral->UpdatePcStatus($_SESSION["userBackend"]["userID"], 0);
}

if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "2") { 

    $Doctor = new Doctor();
    $result = $Doctor->UpdateDoctorStatus($_SESSION["userBackend"]["userID"], 0);
}

if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "3") { 


}

unset($_SESSION["userBackend"]);
header("Location: login.php");

?>