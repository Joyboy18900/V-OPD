<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "Config/Enum.php";
include_once "Config/baseFunction.php";
include_once "Controller/Affiliation.php";

if(isset($_GET["getAffiliation"])) { 

    $Affiliation = new Affiliation();
    $result = $Affiliation->readAffiliation();

    echo json_encode($result);
}

?>