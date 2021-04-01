<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "Config/Enum.php";
include_once "Config/baseFunction.php";
include_once "Controller/Prefix.php";

if(isset($_GET["getPrefix"])) { 

    $Prefix = new Prefix();
    $result = $Prefix->readPrefix();

    echo json_encode($result);
}

?>