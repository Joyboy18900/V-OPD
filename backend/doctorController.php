<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "Controller/Doctor.php";
include_once "Config/Enum.php";
include_once "Config/baseFunction.php";

if(isset($_GET["getDoctor"])) { 

    $Doctor = new Doctor();
    $result = $Doctor->readDoctor();

    echo json_encode($result);
}

if(isset($_GET["getDoctorByDoctorID"])) { 

    $Doctor = new Doctor();
    $result = $Doctor->readDoctorByDoctorID($_POST["doctor_id"]);

    echo json_encode($result);
}

if(isset($_GET["getDoctorByProID"])) { 

    $Doctor = new Doctor();
    $result = $Doctor->readDoctorByProfesID($_POST["professions_id"]);

    echo json_encode($result);
}

if(isset($_GET["getDoctorByBookingID"])) { 

    $Doctor = new Doctor();
    $result = $Doctor->readDoctorByBookingID($_POST["booking_id"]);

    echo json_encode($result);
}

if(isset($_GET["getDoctorByStatusActivate"])) { 

    $Doctor = new Doctor();
    $result = $Doctor->readDoctorByStatusActivate($_POST["doctor_activate"]);

    echo json_encode($result);
}

if(isset($_GET["getDoctorSearch"])) { 

    $Doctor = new Doctor();
    $result = $Doctor->readDoctorSearch($_GET["txtSearch"]);

    echo json_encode($result);
}

if(isset($_GET["getDoctorSchedule"])) { 

    $Doctor = new Doctor();
    $result = $Doctor->readDoctorSchedule($_POST["doctor_id"]);

    echo json_encode($result);
}

if(isset($_GET["addDoctor"])) { 

    $doctor_idcard = Enum::requireParams($_POST['doctor_idcard']);
    $professions_id = Enum::requireParams($_POST['professions_id']);
    $prefix_id = Enum::requireParams($_POST['prefix_id']);
    $doctor_fname = Enum::requireParams($_POST['doctor_fname']);
    $doctor_lname = Enum::requireParams($_POST['doctor_lname']);
    $doctor_birthday = Enum::requireParams($_POST['doctor_birthday']);
    $affiliation_id = Enum::requireParams($_POST['affiliation_id']);
    $doctor_old_address = Enum::requireParams($_POST['doctor_old_address']);
    $doctor_address = Enum::requireParams($_POST['doctor_address']);
    $doctor_tel = Enum::requireParams($_POST['doctor_tel']);
    $doctor_username = Enum::requireParams($_POST['doctor_username']);
    $doctor_password = Enum::requireParams($_POST['doctor_password']);
    $doctor_file_profess = (isset($_FILES['doctor_file_profess']) && !empty($_FILES['doctor_file_profess']) ? Enum::uploadFiles($_FILES['doctor_file_profess'], $doctor_idcard, 'assets/img/doctorFileProfess/') : NULL);
    $doctor_img = (isset($_FILES['doctor_img']) && !empty($_FILES['doctor_img']) ? Enum::uploadFiles($_FILES['doctor_img'], $doctor_idcard, 'assets/img/doctorImage/') : NULL);
    $doctor_signature = (isset($_FILES['doctor_signature']) && !empty($_FILES['doctor_signature']) ? Enum::uploadFiles($_FILES['doctor_signature'], $doctor_idcard, 'assets/img/doctorSignature/') : NULL);
    $ds_duration = Enum::requireParams($_POST['ds_duration']); 
    $ds_day = Enum::requireParams($_POST['ds_day']);

    $Doctor = new Doctor();
    $result = $Doctor->insertDoctor($doctor_idcard, $professions_id, $prefix_id, $doctor_fname, $doctor_lname, $doctor_birthday, $affiliation_id, $doctor_old_address, $doctor_address, $doctor_tel, $doctor_username, $doctor_password, $doctor_file_profess, $doctor_img, $doctor_signature, $ds_duration, $ds_day);

    echo json_encode($result);
}

if(isset($_GET["editDoctor"])) { 

    $doctor_id = Enum::requireParams($_POST['doctor_id']);
    $doctor_idcard = Enum::requireParams($_POST['doctor_idcard']);
    $professions_id = Enum::requireParams($_POST['professions_id']);
    $prefix_id = Enum::requireParams($_POST['prefix_id']);
    $doctor_fname = Enum::requireParams($_POST['doctor_fname']);
    $doctor_lname = Enum::requireParams($_POST['doctor_lname']);
    $doctor_birthday = Enum::requireParams($_POST['doctor_birthday']);
    $affiliation_id = Enum::requireParams($_POST['affiliation_id']);
    $doctor_old_address = Enum::requireParams($_POST['doctor_old_address']);
    $doctor_address = Enum::requireParams($_POST['doctor_address']);
    $doctor_tel = Enum::requireParams($_POST['doctor_tel']);
    $doctor_file_profess = (isset($_FILES['doctor_file_profess']) && !empty($_FILES['doctor_file_profess']) ? Enum::uploadFiles($_FILES['doctor_file_profess'], $doctor_idcard, 'assets/img/doctorFileProfess/') : NULL);
    $doctor_img = (isset($_FILES['doctor_img']) && !empty($_FILES['doctor_img']) ? Enum::uploadFiles($_FILES['doctor_img'], $doctor_idcard, 'assets/img/doctorImage/') : NULL);
    $doctor_signature = (isset($_FILES['doctor_signature']) && !empty($_FILES['doctor_signature']) ? Enum::uploadFiles($_FILES['doctor_signature'], $doctor_idcard, 'assets/img/doctorSignature/') : NULL);

    $Doctor = new Doctor();
    $result = $Doctor->updateDoctor($doctor_id, $doctor_idcard, $professions_id, $prefix_id, $doctor_fname, $doctor_lname, $doctor_birthday, $affiliation_id, $doctor_old_address, $doctor_address, $doctor_tel, $doctor_file_profess, $doctor_img, $doctor_signature);

    echo json_encode($result);
}

if(isset($_GET["deleteDoctor"])) { 

    $doctor_id = Enum::requireParams($_POST['doctor_id']);
    $doctor_idcard = Enum::requireParams($_POST['doctor_idcard']);

    $Doctor = new Doctor();
    $result = $Doctor->deleteDoctor($doctor_id, $doctor_idcard);

    echo json_encode($result);
}

if(isset($_GET["verifyDoctor"])) { 

    $doctor_id = Enum::requireParams($_POST['doctor_id']);
    $doctor_idcard = Enum::requireParams($_POST['doctor_idcard']);
    $doctor_file_profess = (isset($_FILES['doctor_file_profess']) && !empty($_FILES['doctor_file_profess']) ? Enum::uploadFiles($_FILES['doctor_file_profess'], $doctor_idcard, 'assets/img/doctorFileProfess/') : NULL);
    $doctor_signature = (isset($_FILES['doctor_signature']) && !empty($_FILES['doctor_signature']) ? Enum::uploadFiles($_FILES['doctor_signature'], $doctor_idcard, 'assets/img/doctorSignature/') : NULL);
    $doctor_activate = 1;

    $Doctor = new Doctor();
    $result = $Doctor->UpdateFileVerifyDoctor($doctor_id, $doctor_file_profess, $doctor_signature);

    if($result->errorStatus) 
        $result = $Doctor->UpdateDoctorActivate($doctor_id, $doctor_activate);

    if($result->errorStatus) 
        $_SESSION["userBackend"]["userActivate"] = $doctor_activate;

    echo json_encode($result);
}

if(isset($_GET["approveDoctor"])) { 

    $doctor_id = Enum::requireParams($_POST['doctor_id']);
    $doctor_activate = 2;

    $Doctor = new Doctor();
    $result = $Doctor->UpdateDoctorActivate($doctor_id, $doctor_activate);

    // if($result->errorStatus) 
    //     $_SESSION["userBackend"]["userActivate"] = $doctor_activate;

    echo json_encode($result);
}

if(isset($_GET["disapproveDoctor"])) { 

    $doctor_id = Enum::requireParams($_POST['doctor_id']);
    $doctor_activate = 3;

    $Doctor = new Doctor();
    $result = $Doctor->UpdateDoctorActivate($doctor_id, $doctor_activate);

    // if($result->errorStatus) 
    //     $_SESSION["userBackend"]["userActivate"] = $doctor_activate;

    echo json_encode($result);
}

if(isset($_GET["addSchedule"])) { 

    $doctor_id = Enum::requireParams($_POST['doctor_id']);
    $ds_duration = Enum::requireParams($_POST['ds_duration']); 
    $ds_day = Enum::requireParams($_POST['ds_day']);

    $Doctor = new Doctor();
    $result = $Doctor->insertSchedule($doctor_id, $ds_duration, $ds_day);

    echo json_encode($result);
}

function addSchedule($doctor_id, $ds_duration, $ds_day) {
    
    $Doctor = new Doctor();
    $result = $Doctor->insertSchedule($doctor_id, $ds_duration, $ds_day);

    echo json_encode($result);
}

if(isset($_GET["enableDoctor"])) { 

    $Doctor = new Doctor();
    $result = $Doctor->enableDoctor($_POST["doctor_id"]);

    echo json_encode($result);
}

if(isset($_GET["disableDoctor"])) { 

    $Doctor = new Doctor();
    $result = $Doctor->disableDoctor($_POST["doctor_id"]);

    echo json_encode($result);
}

if(isset($_GET["changePasswordDoctor"])) { 

    $Doctor = new Doctor();
    $result = $Doctor->changePasswordDoctor($_POST["doctor_id"], $_POST["doctor_password"]);

    echo json_encode($result);
}

if(isset($_GET["checkIdCardDuplicate"])) { 

    $Doctor = new Doctor();
    $result = $Doctor->checkIdCardDuplicate($_POST["doctor_idcard"]);

    echo json_encode($result);
}

if(isset($_GET["checkUsernameDuplicate"])) { 

    $Doctor = new Doctor();
    $result = $Doctor->checkUsernameDuplicate($_POST["doctor_username"]);

    echo json_encode($result);
}

if(isset($_GET["setSessionValue"])) {

    $doctor_id = Enum::requireParams($_POST['doctor_id']);

    $Doctor = new Doctor();
    $result = $Doctor->readDoctorByDoctorID($_POST["doctor_id"]);

    $_SESSION["userBackend"]["userFullname"] = $result[0]["prefix_name"] . $result[0]["doctor_fname"] . ' ' . $result[0]["doctor_lname"];

    echo json_encode($result);
}
?>