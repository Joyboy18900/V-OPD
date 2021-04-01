<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "Controller/Doctor.php";

if(isset($_SESSION["userBackend"]) && $_SESSION["userBackend"]["userActivate"] != "2") {

    $Doctor = new Doctor();
    $result = $Doctor->readDoctorByDoctorID($_SESSION['userBackend']['userID']);

    $_SESSION["userBackend"]["userActivate"] = $result[0]["doctor_activate"];
}

if(!isset($_SESSION["userBackend"]) || empty($_SESSION['userBackend']['userRole']) || (array_key_exists('userID',$_SESSION['userBackend']) && $_SESSION["userBackend"]["userRole"] != "2") || $_SESSION["userBackend"]["userActivate"] > "2") {

    header("Location: 404_notFound.php");
}

?>