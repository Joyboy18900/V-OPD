<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "Controller/Patient.php";
include_once "Config/baseFunction.php";

if(isset($_GET["getPatient"])) { 

    $Patient = new Patient();
    $result = $Patient->readPatient();

    echo json_encode($result);
}

if(isset($_GET["getPatientById"])) { 

    $Patient = new Patient();
    $result = $Patient->readPatientById($_POST['p_id']);

    echo json_encode($result);
}

if(isset($_GET["getPatientByIdCard"])) { 

    $Patient = new Patient();
    $result = $Patient->readPatientByIdCard($_POST['p_idcard']);

    echo json_encode($result);
}

if(isset($_GET["getPatientSearch"])) { 

    $Patient = new Patient();
    $result = $Patient->readPatientSearch($_GET["txtSearch"]);

    echo json_encode($result);
}

if(isset($_GET["getPatientSearchForm"])) { 

    $Patient = new Patient();
    $result = $Patient->readPatientAfterSearch($_POST["p_id"]);

    if(isset($result->errorStatus) && !$result->errorStatus) {

        echo json_encode($result);
        exit();
    }

    echo json_encode($result);
}

if(isset($_GET["getOutPatientById"])) { 

    $Patient = new Patient();
    $result = $Patient->readOutPatientById($_POST["p_id"]);

    if(isset($result->errorStatus) && !$result->errorStatus) {

        echo json_encode($result);
        exit();
    }

    echo json_encode($result);
}

if(isset($_GET["getOutPatientByPerId"])) { 

    $Patient = new Patient();
    $result = $Patient->readOutPatientByPerId($_POST["per_id"]);

    if(isset($result->errorStatus) && !$result->errorStatus) {

        echo json_encode($result);
        exit();
    }

    echo json_encode($result);
}

if(isset($_GET["getOutPatientByDoctorId"])) { 

    $Patient = new Patient();
    $result = $Patient->readOutPatientByDoctorId($_POST["doctor_id"]);

    if(isset($result->errorStatus) && !$result->errorStatus) {

        echo json_encode($result);
        exit();
    }

    echo json_encode($result);
}

if(isset($_GET["getOutPatientByOpId"])) { 

    $Patient = new Patient();
    $result = $Patient->readOutPatientByOpId($_POST["op_id"]);

    if(isset($result->errorStatus) && !$result->errorStatus) {

        echo json_encode($result);
        exit();
    }

    echo json_encode($result);
}

if(isset($_GET["getOutPatientByBookingId"])) { 

    $Patient = new Patient();
    $result = $Patient->readOutPatientByBookingId($_POST["booking_id"]);

    if(isset($result->errorStatus) && !$result->errorStatus) {

        echo json_encode($result);
        exit();
    }

    echo json_encode($result);
}

if(isset($_GET["getPatientAndOutPatientById"])) { 

    $Patient = new Patient();
    $result = $Patient->readPatientAndOutPatientById($_POST["p_id"]);

    if(isset($result->errorStatus) && !$result->errorStatus) {

        echo json_encode($result);
        exit();
    }

    echo json_encode($result);
}

if(isset($_GET["addPatient"])) {

    $p_idcard = $_POST['p_idcard'];
    $prefix_id = $_POST['prefix_id'];
    $p_name = $_POST['p_name'];
    $p_lname = $_POST['p_lname'];
    $p_birthday = $_POST['p_birthday'];
    $p_old_address = $_POST['p_old_address'];
    $p_address = $_POST['p_address'];
    $dep_id = $_POST['dep_id'];
    $p_blood = $_POST['p_blood'];
    $p_tel = $_POST['p_tel'];
    
    $Patient = new Patient();
    
    $result = $Patient->insertPatient($p_idcard, $prefix_id, $p_name, $p_lname, $p_birthday, $p_old_address, $p_address, $dep_id, $p_blood, $p_tel);

    echo json_encode($result);
}

if(isset($_GET["editPatient"])) {

    $p_id = $_POST['p_id'];
    $p_idcard = $_POST['p_idcard'];
    $prefix_id = $_POST['prefix_id'];
    $p_name = $_POST['p_name'];
    $p_lname = $_POST['p_lname'];
    $p_birthday = $_POST['p_birthday'];
    $p_old_address = $_POST['p_old_address'];
    $p_address = $_POST['p_address'];
    $dep_id = $_POST['dep_id'];
    $p_blood = $_POST['p_blood'];
    $p_tel = $_POST['p_tel'];
    
    $Patient = new Patient();
    
    $result = $Patient->editPatient($p_id, $p_idcard, $prefix_id, $p_name, $p_lname, $p_birthday, $p_old_address, $p_address, $dep_id, $p_blood, $p_tel);

    echo json_encode($result);
}

if(isset($_GET["addOutPatient"])) {

    $p_id = $_POST['p_id'];
    $per_id = $_SESSION['userBackend']['userID'];
    $op_cd = $_POST['op_cd'];
    $op_food_allergy = $_POST['op_food_allergy'];
    $op_drugs_allergy = $_POST['op_drugs_allergy'];
    $op_weight = $_POST['op_weight'];
    $op_height = $_POST['op_height'];
    $op_body_temp = $_POST['op_body_temp'];
    $op_bp = $_POST['op_bp'];
    $professions_id = $_POST['professions_id'];
    $op_detail_sick = $_POST['op_detail_sick'];
    $doctor_id = $_POST["doctor_id"];
    $room_id = $_POST["room_id"];

    $Patient = new Patient();

    if($doctor_id == 0) {

        $result = $Patient->insertOutPatient($p_id, $per_id, $op_cd, $op_food_allergy, $op_drugs_allergy, $op_weight, $op_height, $op_body_temp, $op_bp, $professions_id, $op_detail_sick, NULL, $room_id);
    }

    if($doctor_id != 0) {

        $result = $Patient->insertOutPatient($p_id, $per_id, $op_cd, $op_food_allergy, $op_drugs_allergy, $op_weight, $op_height, $op_body_temp, $op_bp, $professions_id, $op_detail_sick, $doctor_id, $room_id);
    }

    echo json_encode($result);
}

if(isset($_GET["updatePatientAfterBooking"])) {

    $booking_id = $_POST['booking_id'];
    $doctor_id = $_SESSION["userBackend"]["userID"];
    $op_suggestion = $_POST['op_suggestion'];
    $op_dispense = $_POST['op_dispense'];
    $op_mark_date = $_POST['op_mark_date'];

    $Patient = new Patient();
    
    $result = $Patient->updatePatientAfterBooking($booking_id, $doctor_id, $op_suggestion, $op_dispense, $op_mark_date);

    echo json_encode($result);
}

if(isset($_GET["changePasswordPatient"])) { 

    $Patient = new Patient();
    $result = $Patient->changePasswordPatient($_POST["p_id"], $_POST["p_old_password"], $_POST["p_password"]);

    echo json_encode($result);
}

if(isset($_GET["updateProfilePatient"])) {

    $Patient = new Patient();
    $result = $Patient->updateProfilePatient($_POST["p_id"], $_POST["p_old_address"], $_POST["p_address"]);

    echo json_encode($result);
}

if(isset($_GET["checkIdCardDuplicate"])) { 

    $Patient = new Patient();
    $result = $Patient->checkIdCardDuplicate($_POST["p_idcard"]);

    echo json_encode($result);
}

?>