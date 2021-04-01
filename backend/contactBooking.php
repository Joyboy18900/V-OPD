<?php 

if(isset($_GET["contactPatient"])) {

    include_once "see_patient_contact.php";
}

if(isset($_GET["contactDoctor"])) {

    include_once "contactDoctor.php";
}

?>
