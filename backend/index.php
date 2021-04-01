<!DOCTYPE html>
<html lang="en">

<?php 

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if(!isset($_SESSION["userBackend"]) || (empty($_SESSION['userBackend']['userID']) && !array_key_exists('userID',$_SESSION['userBackend']))) {

  header("Location: login.php");
  exit();
}

if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "1") {

  header("Location: see_doctor.php");
  exit();
}

include_once "include/header.php"; 
include_once "Controller/Patient.php";

?>

<body>

  <section id="container">
    <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
    <!--header start-->
    <?php include_once "layout/top_navigation.php"; ?>
    <!--header end-->

    <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <?php include_once "layout/slide_menu.php"; ?>
    <!--sidebar end-->

    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">

        <?php
        
        if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "2") {
          include_once "CheckSessionDoctor.php";
        ?>

        <div class="row">
          <div class="col-lg-12 main-chart">

            <div class="row mtbox">
              <div class="col-md-4 box0">
                <div class="box1">
                  <span class="li_star"></span>
                  <h3 id="booking_rating_view"></h3>
                </div>
                <p>จำนวนเรตติ้งของคุณในตอนนี้</p>
              </div>
              <div class="col-md-4 box0">
                <div class="box1">
                  <span class="li_stack"></span>
                  <h3 id="booking_q_book"></h3>
                </div>
                <p>จำนวนคนไข้ที่นัดตรวจในวันนี้</p>
              </div>
              <div class="col-md-4 box0">
                <div class="box1">
                  <span class="li_calendar"></span>
                  <h3 id="booking_q_today"></h3>
                </div>
                <p>จำนวนคนไข้ที่รอตรวจในวันนี้</p>
              </div>
            </div>

          </div>
        </div>

        <?php 
        
        }
        
        ?>

      </section>
    </section>
    <!--main content end-->

    <!--footer start-->
    <?php include_once "layout/footer.php"; ?>
    <!--footer end-->
  </section>

  <?php include_once "include/javascript.php"; ?>

  <script>
    var doctor_id = <?php echo $_SESSION["userBackend"]["userID"]; ?>;

    $(function () {

      let booking_rating = getRatingByDoctorId(doctor_id)
      $("#booking_rating_view").html((booking_rating == null ? 0 : booking_rating));
      readBookingFilterDoctorOpStatusIsBooking();
      readBookingFilterDoctor();
    });

    function readBookingFilterDoctorOpStatusIsBooking() {

      $.ajax({
        type: "POST",
        url: mainURLs + "/bookingController.php?readBookingFilterDoctorOpStatusIsBooking",
        dataType: 'JSON',
        async: false,
        cache: false,
        success: function (data) {

          $("#booking_q_book").html(objectLength(data));
        }
      });
    }

    function readBookingFilterDoctor() {

      $.ajax({
        type: "POST",
        url: mainURLs + "/bookingController.php?readBookingFilterDoctor",
        dataType: 'JSON',
        async: false,
        cache: false,
        success: function (data) {

          $("#booking_q_today").html(objectLength(data));
        }
      });
    }
  </script>

</body>

</html>