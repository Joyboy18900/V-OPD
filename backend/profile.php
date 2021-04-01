<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "1") { 
    
    include_once "profilepersonalCentral.php";
}

if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "2") { 
    
    include_once "profileDoctor.php";
}

if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "3") { 

    include_once "profileAdmin.php";
}
?>