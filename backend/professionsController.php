<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "Config/Enum.php";
include_once "Config/baseFunction.php";
include_once "Controller/Professions.php";

if(isset($_GET["getProfessions"])) { 

    $Professions = new Professions();
    $result = $Professions->readProfessions();

    echo json_encode($result);
}

?>