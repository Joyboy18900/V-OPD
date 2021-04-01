<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION["userBackend"]) || empty($_SESSION['userBackend']['userRole']) || (array_key_exists('userID',$_SESSION['userBackend']) && $_SESSION["userBackend"]["userRole"] != "3")) {

    header("Location: 404_notFound.php");
}

?>