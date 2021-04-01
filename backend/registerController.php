<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "Config/Enum.php";
include_once "Config/baseFunction.php";
include_once "Controller/Doctor.php";
include_once "Controller/Affiliation.php";
include_once "Controller/Prefix.php";
include_once "Controller/Professions.php";

$Affiliation = new Affiliation();
$Prefix = new Prefix();
$Professions = new Professions();

if(isset($_GET["continuneStep1"])) {

    $_SESSION['registerDoctor']['doctor_idcard'] = Enum::requireParams($_POST['doctor_idcard']);
    $_SESSION['registerDoctor']['professions_id'] = Enum::requireParams($_POST['professions_id']);
    $_SESSION['registerDoctor']['professions_name'] = $Professions->readProfessionsById(Enum::requireParams($_POST['professions_id']))[0]['professions_name'];
    $_SESSION['registerDoctor']['prefix_id'] = Enum::requireParams($_POST['prefix_id']);
    $_SESSION['registerDoctor']['prefix_name'] = $Prefix->readPrefixById($_POST['prefix_id'])[0]['prefix_name'];
    $_SESSION['registerDoctor']['doctor_fname'] = Enum::requireParams($_POST['doctor_fname']);
    $_SESSION['registerDoctor']['doctor_lname'] = Enum::requireParams($_POST['doctor_lname']);
    $_SESSION['registerDoctor']['doctor_birthday'] = Enum::requireParams($_POST['doctor_birthday']);
    $_SESSION['registerDoctor']['affiliation_id'] = Enum::requireParams($_POST['affiliation_id']);
    $_SESSION['registerDoctor']['affiliation_name'] = $Affiliation->readAffiliationById($_POST['affiliation_id'])[0]['affiliation_name'];
    $_SESSION['registerDoctor']['doctor_old_address'] = Enum::requireParams($_POST['doctor_old_address']);
    $_SESSION['registerDoctor']['doctor_address'] = Enum::requireParams($_POST['doctor_address']);
    if(isset($_FILES["doctor_img"]) && !empty($_FILES["doctor_img"]) || !isset($_SESSION['registerDoctor']['doctor_img'])) {
        $_SESSION['registerDoctor']['doctor_img'] = (isset($_FILES['doctor_img']) && !empty($_FILES['doctor_img']) ? Enum::uploadFiles($_FILES['doctor_img'], $_POST['doctor_idcard'], 'assets/img/doctorTmpImage/') : NULL);
    }
    $_SESSION['registerDoctor']['doctor_tel'] = Enum::requireParams($_POST['doctor_tel']);
}

if(isset($_GET["continuneStep2"])) {

    $_SESSION['registerDoctor']['doctor_username'] = Enum::requireParams($_POST['doctor_username']);
    $_SESSION['registerDoctor']['doctor_password'] = Enum::requireParams($_POST['doctor_password']);
}

if(isset($_GET["continuneStep3"])) {

    $doctor_idcard = $_SESSION['registerDoctor']['doctor_idcard'];
    $professions_id = $_SESSION['registerDoctor']['professions_id'];
    $prefix_id = $_SESSION['registerDoctor']['prefix_id'];
    $doctor_fname = $_SESSION['registerDoctor']['doctor_fname'];
    $doctor_lname = $_SESSION['registerDoctor']['doctor_lname'];
    $doctor_birthday = $_SESSION['registerDoctor']['doctor_birthday'];
    $affiliation_id = $_SESSION['registerDoctor']['affiliation_id'];
    $doctor_old_address = $_SESSION['registerDoctor']['doctor_old_address'];
    $doctor_address = $_SESSION['registerDoctor']['doctor_address'];
    $doctor_img = $_SESSION['registerDoctor']['doctor_img'];
    $doctor_tel = $_SESSION['registerDoctor']['doctor_tel'];
    $doctor_username = $_SESSION['registerDoctor']['doctor_username'];
    $doctor_password = $_SESSION['registerDoctor']['doctor_password'];

    $Doctor = new Doctor();
    $result = $Doctor->insertRegisterDoctor($doctor_idcard, $professions_id, $prefix_id, $doctor_fname, $doctor_lname, $doctor_birthday, $affiliation_id, $doctor_old_address, $doctor_address, $doctor_img, $doctor_tel, $doctor_username, $doctor_password);
    
    if($result->errorStatus) {
        copy('assets/img/doctorTmpImage/' . $doctor_img, 'assets/img/doctorImage/' . $doctor_img);
        unlink('assets/img/doctorTmpImage/' . $doctor_img);
        
        unset($_SESSION['registerDoctor']);
    }

    echo json_encode($result);    
}

?>