<?php

require_once 'Config/Config.php';
require_once ROOT. '/Config/baseFunction.php';

class Booking extends connectDB {

    /* Fetch All */
    public function readBookingFilterDoctor($doctor_id, $professions_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT
                op_view.*
            FROM
                booking
            INNER JOIN(
                SELECT
                    b.booking_id,
                    pre.prefix_name,
                    p.p_name,
                    p.p_lname,
                    p.p_birthday,
                    op.op_id,
                    op.op_detail_sick,
                    op.op_status,
                    b.room_id 
                FROM
                    booking b
                LEFT JOIN out_patient op ON
                    b.op_id = op.op_id
                LEFT JOIN patient p ON
                    p.p_id = op.p_id
                INNER JOIN prefix pre ON
                    pre.prefix_id = p.prefix_id
                WHERE
                    op.professions_id = :professions_id AND DATE(booking_create_date) = CURDATE() AND b.booking_status = 0
            ) op_view
            ON
                booking.booking_id = op_view.booking_id
            WHERE booking.doctor_id = :doctor_id OR booking.doctor_id IS NULL
            ORDER BY booking.booking_create_date ASC";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':professions_id', $professions_id, PDO::PARAM_INT);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            } 
        } 
        
        if (!empty($result)) {

            return $result;
        }
    }

    public function readBookingFilterDoctorOpStatusIsBooking($doctor_id, $professions_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT
                op_view.*
            FROM
                booking
            INNER JOIN(
                SELECT
                    b.booking_id,
                    pre.prefix_name,
                    p.p_name,
                    p.p_lname,
                    p.p_birthday,
                    op.op_id,
                    op.op_detail_sick,
                    op.op_status,
                    b.room_id 
                FROM
                    booking b
                LEFT JOIN out_patient op ON
                    b.op_id = op.op_id
                LEFT JOIN patient p ON
                    p.p_id = op.p_id
                INNER JOIN prefix pre ON
                    pre.prefix_id = p.prefix_id
                WHERE
                    op.professions_id = :professions_id AND DATE(booking_create_date) = CURDATE() AND b.booking_status = 0 
            ) op_view
            ON
                booking.booking_id = op_view.booking_id
            WHERE booking.doctor_id = :doctor_id
            ORDER BY booking.booking_create_date ASC";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_doctor->bindParam(':professions_id', $professions_id, PDO::PARAM_INT);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            } 
        } 
        
        if (!empty($result)) {

            return $result;
        }
    }

    public function insertBooking($op_id, $doctor_id = NULL, $room_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_booking = "INSERT INTO `booking`(`booking_id`, `op_id`, `doctor_id`, `booking_status`, `room_id`, `booking_create_date`, `booking_update_date`)
            VALUES (null, :op_id, :doctor_id, 0, :room_id, NOW(), NOW())";
            
            $query_booking = $conn->prepare($sql_booking);

            $query_booking->bindParam(':op_id', $op_id, PDO::PARAM_INT);
            $query_booking->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            $query_booking->bindParam(':room_id', $room_id, PDO::PARAM_STR);
            
            $query_booking->execute();

            $booking_id = $conn->lastInsertId();

            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            $ErrorMessage->booking_id = $booking_id;
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {
            
            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        }
    }

    public function ApproveBooking($booking_id, $doctor_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $result_check_booking = $this->getStatusBooking($booking_id);

            if($result_check_booking[0]["booking_status"] == "1") {

                $ErrorMessage = new ErrorMessage("3000", FALSE);
                return $ErrorMessage;
            }

            $sql_booking = "UPDATE
                booking b
            INNER JOIN out_patient op ON
                b.op_id = op.op_id
            SET
                b.booking_status = 1,
                b.doctor_id = :doctor_id,
                op.doctor_id = :doctor_id
            WHERE
                b.booking_id = :booking_id";
            
            $query_booking = $conn->prepare($sql_booking);

            $query_booking->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
            $query_booking->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);

            $query_booking->execute();

            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", true);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000");
                return $ErrorMessage;
            } 
        } 
        
        if (!empty($result)) {

            return $result;
        }
    }

    public function getStatusBooking($booking_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT `booking_id`, `booking_status` FROM `booking` WHERE `booking_id` = :booking_id";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            } 
        } 
        
        if (!empty($result)) {

            return $result;
        }
    }

    public function countQueueBookingDcotor($doctor_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT
                COUNT(booking_id) AS queue_booking
            FROM
                booking
            WHERE
                doctor_id = :doctor_id AND DATE(booking_create_date) = CURDATE() AND booking_status = 0";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            } 
        } 
        
        if (!empty($result)) {

            return $result;
        }
    }

    public function updateRatingAndCommentBooking($booking_id, $booking_rating, $booking_comment) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_booking = "UPDATE
                booking
            SET
                booking_rating = :booking_rating, 
                booking_comment = :booking_comment 
            WHERE
                booking_id = :booking_id";
            
            $query_booking = $conn->prepare($sql_booking);

            $query_booking->bindParam(':booking_rating', $booking_rating, PDO::PARAM_INT);
            $query_booking->bindParam(':booking_comment', $booking_comment, PDO::PARAM_STR);
            $query_booking->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);

            $query_booking->execute();

            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        } 
    }

    public function CalRatingByDoctorId($doctor_id) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_doctor = "SELECT FORMAT((SUM(booking_rating) / COUNT(booking_id)), 2) AS sum_booking_rating
            FROM
                booking
            WHERE
                doctor_id = :doctor_id AND booking_status = 2";
            
            $query_doctor = $conn->prepare($sql_doctor);

            $query_doctor->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);

            $query_doctor->execute();

            $conn->commit();

            $result_doctor = $query_doctor->fetchAll(PDO::FETCH_ASSOC);

            return $result_doctor;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("2000", FALSE);
                return $ErrorMessage;
            } 
        } 
    }

    public function updateBookingStatus($booking_id, $booking_status) {

        try {   
            
            $conn = $this->openConnection();
            
            $conn->beginTransaction();

            $sql_booking = "UPDATE
                booking
            SET
                booking_status = :booking_status
            WHERE
                booking_id = :booking_id";
            
            $query_booking = $conn->prepare($sql_booking);

            $query_booking->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
            $query_booking->bindParam(':booking_status', $booking_status, PDO::PARAM_INT);

            $query_booking->execute();

            $conn->commit();

            $ErrorMessage = new ErrorMessage("201", TRUE);
            return $ErrorMessage;

            $this->closeConnection();
        } catch(PDOException $e) {

            VOpdLog::createLogFilesDatabase($e);

            if (isset($conn)) {
                
                $conn->rollback();
                
                $ErrorMessage = new ErrorMessage("501", FALSE);
                return $ErrorMessage;
            } 
        } 
    }
}

?>