<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "Controller/Booking.php";
include_once "Config/baseFunction.php";

if(isset($_GET["readBookingFilterDoctor"])) { 

    $Booking = new Booking();
    $result = $Booking->readBookingFilterDoctor($_SESSION["userBackend"]["userID"], $_SESSION["userBackend"]["userProfession"]);

    echo json_encode($result);
}

if(isset($_GET["readBookingFilterDoctorOpStatusIsBooking"])) { 

    $Booking = new Booking();
    $result = $Booking->readBookingFilterDoctorOpStatusIsBooking($_SESSION["userBackend"]["userID"], $_SESSION["userBackend"]["userProfession"]);

    echo json_encode($result);
}

if(isset($_GET["ApproveBooking"])) {

    $Booking = new Booking();
    $result = $Booking->ApproveBooking($_POST["booking_id"], $_SESSION["userBackend"]["userID"]);

    echo json_encode($result);
}

if(isset($_GET["getStatusBookingByBookingId"])) { 

    $Booking = new Booking();
    $result = $Booking->getStatusBooking($_POST["booking_id"]);

    echo json_encode($result);
}

if(isset($_GET["getCountQueueBookingDcotor"])) {

    $Booking = new Booking();
    $result = $Booking->countQueueBookingDcotor($_POST["doctor_id"]);

    echo json_encode($result);
}

if(isset($_GET["updateRatingAndCommentBooking"])) {

    $Booking = new Booking();
    $result = $Booking->updateRatingAndCommentBooking($_POST["booking_id"], $_POST["booking_rating"], $_POST["booking_comment"]);

    echo json_encode($result);
}

if(isset($_GET["getCalRatingByDoctorId"])) {

    $Booking = new Booking();
    $result = $Booking->CalRatingByDoctorId($_POST["doctor_id"]);

    echo json_encode($result);
}

if(isset($_GET["updateBookingStatus"])) {

    $Booking = new Booking();
    $result = $Booking->updateBookingStatus($_POST["booking_id"], $_POST["booking_status"]);

    echo json_encode($result);
}

?>