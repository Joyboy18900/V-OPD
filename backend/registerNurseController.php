<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "Config/Enum.php";
include_once "Config/baseFunction.php";
include_once "Controller/personalCentral.php";
include_once "Controller/Prefix.php";
include_once "Controller/Professions.php";

$Prefix = new Prefix();
$Professions = new Professions();

if(isset($_GET["continuneStep1"])) {

    $_SESSION['registerNurse']['per_idcard'] = Enum::requireParams($_POST['per_idcard']);
    $_SESSION['registerNurse']['professions_id'] = Enum::requireParams($_POST['professions_id']);
    $_SESSION['registerNurse']['professions_name'] = $Professions->readProfessionsById(Enum::requireParams($_POST['professions_id']))[0]['professions_name'];
    $_SESSION['registerNurse']['prefix_id'] = Enum::requireParams($_POST['prefix_id']);
    $_SESSION['registerNurse']['prefix_name'] = $Prefix->readPrefixById($_POST['prefix_id'])[0]['prefix_name'];
    $_SESSION['registerNurse']['per_fname'] = Enum::requireParams($_POST['per_fname']);
    $_SESSION['registerNurse']['per_lname'] = Enum::requireParams($_POST['per_lname']);
    $_SESSION['registerNurse']['per_birthday'] = Enum::requireParams($_POST['per_birthday']);
    $_SESSION['registerNurse']['per_old_address'] = Enum::requireParams($_POST['per_old_address']);
    $_SESSION['registerNurse']['per_address'] = Enum::requireParams($_POST['per_address']);
    if(isset($_FILES["per_img"]) && !empty($_FILES["per_img"]) || !isset($_SESSION['registerNurse']['per_img'])) {
        $_SESSION['registerNurse']['per_img'] = (isset($_FILES['per_img']) && !empty($_FILES['per_img']) ? Enum::uploadFiles($_FILES['per_img'], $_POST['per_idcard'], 'assets/img/pcTmpImage/') : NULL);
    }
    $_SESSION['registerNurse']['per_tel'] = Enum::requireParams($_POST['per_tel']);
}

if(isset($_GET["continuneStep2"])) {

    $_SESSION['registerNurse']['per_username'] = Enum::requireParams($_POST['per_username']);
    $_SESSION['registerNurse']['per_password'] = Enum::requireParams($_POST['per_password']);
}

if(isset($_GET["continuneStep3"])) {

    $per_idcard = $_SESSION['registerNurse']['per_idcard'];
    $professions_id = $_SESSION['registerNurse']['professions_id'];
    $prefix_id = $_SESSION['registerNurse']['prefix_id'];
    $per_fname = $_SESSION['registerNurse']['per_fname'];
    $per_lname = $_SESSION['registerNurse']['per_lname'];
    $per_birthday = $_SESSION['registerNurse']['per_birthday'];
    $per_old_address = $_SESSION['registerNurse']['per_old_address'];
    $per_address = $_SESSION['registerNurse']['per_address'];
    $per_img = $_SESSION['registerNurse']['per_img'];
    $per_tel = $_SESSION['registerNurse']['per_tel'];
    $per_username = $_SESSION['registerNurse']['per_username'];
    $per_password = $_SESSION['registerNurse']['per_password'];

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->insertRegisterPc($per_idcard, $professions_id, $prefix_id, $per_fname, $per_lname, $per_birthday, $per_old_address, $per_address, $per_img, $per_tel, $per_username, $per_password);
    
    if($result->errorStatus) {
        copy('assets/img/pcTmpImage/' . $per_img, 'assets/img/pcImage/' . $per_img);
        unlink('assets/img/pcTmpImage/' . $per_img);
        
        unset($_SESSION['registerNurse']);
    }

    echo json_encode($result);    
}

?>