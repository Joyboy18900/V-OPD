<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "Controller/personalCentral.php";
include_once "Config/Enum.php";
include_once "Config/baseFunction.php";

if(isset($_GET["getPersonalCentral"])) { 

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->readPersonalCentral();

    echo json_encode($result);
}

if(isset($_GET["getPersonalCentralByPerId"])) { 

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->readPersonalCentralByPerId($_POST["per_id"]);

    echo json_encode($result);
}

if(isset($_GET["getPersonalCentralByStatusActivate"])) { 

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->readPersonalCentralByStatusActivate($_POST["per_activate"]);

    echo json_encode($result);
}

if(isset($_GET["addPc"])) { 

    $per_idcard = Enum::requireParams($_POST['per_idcard']);
    $professions_id = Enum::requireParams($_POST['professions_id']);
    $prefix_id = Enum::requireParams($_POST['prefix_id']);
    $per_fname = Enum::requireParams($_POST['per_fname']);
    $per_lname = Enum::requireParams($_POST['per_lname']);
    $per_birthday = Enum::requireParams($_POST['per_birthday']);
    $per_old_address = Enum::requireParams($_POST['per_old_address']);
    $per_address = Enum::requireParams($_POST['per_address']);
    $per_tel = Enum::requireParams($_POST['per_tel']);
    $per_username = Enum::requireParams($_POST['per_username']);
    $per_password = Enum::requireParams($_POST['per_password']);
    $per_file_profess = (isset($_FILES['per_file_profess']) && !empty($_FILES['per_file_profess']) ? Enum::uploadFiles($_FILES['per_file_profess'], $per_idcard, 'assets/img/pcFileProfess/') : NULL);
    $per_img = (isset($_FILES['per_img']) && !empty($_FILES['per_img']) ? Enum::uploadFiles($_FILES['per_img'], $per_idcard, 'assets/img/pcImage/') : NULL);

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->insertPc($per_idcard, $professions_id, $prefix_id, $per_fname, $per_lname, $per_birthday, $per_old_address, $per_address, $per_tel, $per_username, $per_password, $per_file_profess, $per_img);

    echo json_encode($result);
}

if(isset($_GET["editPc"])) { 

    $per_id = Enum::requireParams($_POST['per_id']);
    $per_idcard = Enum::requireParams($_POST['per_idcard']);
    $professions_id = Enum::requireParams($_POST['professions_id']);
    $prefix_id = Enum::requireParams($_POST['prefix_id']);
    $per_fname = Enum::requireParams($_POST['per_fname']);
    $per_lname = Enum::requireParams($_POST['per_lname']);
    $per_birthday = Enum::requireParams($_POST['per_birthday']);
    $per_old_address = Enum::requireParams($_POST['per_old_address']);
    $per_address = Enum::requireParams($_POST['per_address']);
    $per_tel = Enum::requireParams($_POST['per_tel']);
    $per_file_profess = (isset($_FILES['per_file_profess']) && !empty($_FILES['per_file_profess']) ? Enum::uploadFiles($_FILES['per_file_profess'], $per_idcard, 'assets/img/pcFileProfess/') : NULL);
    $per_img = (isset($_FILES['per_img']) && !empty($_FILES['per_img']) ? Enum::uploadFiles($_FILES['per_img'], $per_idcard, 'assets/img/pcImage/') : NULL);

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->updatePc($per_id, $per_idcard, $professions_id, $prefix_id, $per_fname, $per_lname, $per_birthday, $per_old_address, $per_address, $per_tel, $per_file_profess, $per_img);

    echo json_encode($result);
}

if(isset($_GET["verifyPc"])) { 

    $per_id = Enum::requireParams($_POST['per_id']);
    $per_idcard = Enum::requireParams($_POST['per_idcard']);
    $per_file_profess = (isset($_FILES['per_file_profess']) && !empty($_FILES['per_file_profess']) ? Enum::uploadFiles($_FILES['per_file_profess'], $per_idcard, 'assets/img/pcFileProfess/') : NULL);
    $per_activate = 1;

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->UpdateFileVerifyPc($per_id, $per_file_profess);

    if($result->errorStatus) 
        $result = $PersonalCentral->UpdatePcActivate($per_id, $per_activate);

    if($result->errorStatus) 
        $_SESSION["userBackend"]["userActivate"] = $per_activate;

    echo json_encode($result);
}

if(isset($_GET["approvePc"])) { 

    $per_id = Enum::requireParams($_POST['per_id']);
    $per_activate = 2;

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->UpdatePcActivate($per_id, $per_activate);

    echo json_encode($result);
}

if(isset($_GET["disapprovePc"])) { 

    $per_id = Enum::requireParams($_POST['per_id']);
    $per_activate = 3;

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->UpdatePcActivate($per_id, $per_activate);

    echo json_encode($result);
}

if(isset($_GET["changePasswordPc"])) { 

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->changePasswordPc($_POST["per_id"], $_POST["per_password"]);

    echo json_encode($result);
}

if(isset($_GET["enablePc"])) { 

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->enablePc($_POST["per_id"]);

    echo json_encode($result);
}

if(isset($_GET["disablePc"])) { 

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->disablePc($_POST["per_id"]);

    echo json_encode($result);
}

if(isset($_GET["checkIdCardDuplicate"])) { 

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->checkIdCardDuplicate($_POST["per_idcard"]);

    echo json_encode($result);
}

if(isset($_GET["checkUsernameDuplicate"])) { 

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->checkUsernameDuplicate($_POST["per_username"]);

    echo json_encode($result);
}

if(isset($_GET["setSessionValue"])) {

    $per_id = Enum::requireParams($_POST['per_id']);

    $PersonalCentral = new PersonalCentral();
    $result = $PersonalCentral->readPersonalCentralByPerId($per_id);

    $_SESSION["userBackend"]["userFullname"] = $result[0]["prefix_name"] . $result[0]["per_fname"] . ' ' . $result[0]["per_lname"];

    echo json_encode($result);
}

?>