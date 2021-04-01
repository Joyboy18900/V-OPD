<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "backend/Controller/Login.php";
include_once "backend/Config/baseFunction.php";

if(isset($_GET["checkLogin"])) {

    $Patient = new Login();
    $result = $Patient->Patient($_POST["username"], $_POST["password"]);

    if(isset($result->errorStatus) && !$result->errorStatus) {

        echo json_encode($result);
        exit();
    }
    
    $_SESSION["userFontend"]["userID"] = $result["p_id"];
    $_SESSION["userFontend"]["userFullname"] = $result["prefix_name"] . $result["p_name"] . ' ' . $result["p_lname"];
    $_SESSION["userFontend"]["userUsername"] = $result["p_idcard"];
    $_SESSION["userFontend"]["userVopdID"] = $result["vopd_id"];
    
    $ErrorMessage = new ErrorMessage("1001", TRUE);
    echo json_encode($ErrorMessage);
}

?>