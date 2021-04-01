<!DOCTYPE html>
<html lang="en">

<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "CheckSessionPc.php";
include_once "include/header.php"; 
include_once "baseModal.php";

?>

<link rel="stylesheet" href="assets/css/jquery.raty.css">

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
                <!-- <h3><i class="fa fa-angle-right"></i> พบแพทย์</h3> -->

                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="text-section-heading-1">พบแพทย์
                            <small>*เมื่อใช้งานเสร็จแล้วกดปุ่มจบการสนทนา</small>
                        </div>
                        <div class="form-panel">
                            <div class="col-md-12">
                                <div class="col-md-12 text-center">
                                    <div id="labelStatusBookingFalse" class="text-section-heading-mega text-danger">
                                        ยังไม่ถึงคิวของคุณในขณะนี้
                                        <small></small>
                                    </div>
                                </div>
                                <div id="labelStatusBookingTrue" class="col-md-12 text-center hidden">
                                    <div class="text-section-heading-mega text-success">ถึงคิวของคุณแล้ว
                                        กดปุ่มเริ่มสนทนากับแพทย์
                                        <small></small>
                                    </div>
                                </div>
                                <div id="ImageLoading" class="col-md-5 col-md-offset-3 text-center">
                                    <img src="assets/img/loading.gif" class="img-responsive">
                                </div>
                                <div id="infoDoctor" class="col-md-12 mb hidden">
                                    <div class="form-group col-md-4 hidden">
                                        <label class="col-md-12 col-lg-12 col-sm-12 control-label sr-only"></label>
                                        <div class="col-md-12 col-lg-12">
                                            <input type="text" class="form-control" id="doctor_id" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb">
                                        <div class="col-md-12 mt">
                                            <img id="doctor_img_view" class="img-responsive bg-image-custom"
                                                alt="imageProfile"
                                                style="height: 250px; object-fit: cover; margin: 0 auto;">
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding-top: 40px;">
                                        <div class="form-group col-md-12 mb">
                                            <div class="text-section-heading-3 text-success" id="doctor_full_name">
                                                ชื่อ-นามสกุล
                                                <small></small>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 mb">
                                            <div class="text-section-heading-3 text-success" id="professions_name">
                                                ประเภทวิชาชีพ
                                                <small></small>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 mb">
                                            <div class="text-section-heading-3 text-success" id="affiliation_name">
                                                สังกัด/โรงพยายาล
                                                <small></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-5 col-md-offset-3 mt mb text-center" style="padding-top: 15px;">
                                    <button id="btnContactDoctor"
                                        class="btn btn-lg btn-info">เริ่มสนทนากับแพทย์</button>
                                </div>
                                <div class="col-md-6 mt mb text-right" style="padding-top: 15px;">
                                    <button id="btnCancelBooking" class="btn btn-lg btn-danger">ยกเลิกการสนทนา</button>
                                </div>
                                <div class="col-md-6 mt mb text-left" style="padding-top: 15px;">
                                    <button type="button" id="btnVote" onclick="voteComment();"
                                        class="btn btn-success btn-lg">จบการสนทนา</button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>

            </section>
        </section><!-- /MAIN CONTENT -->

        <!--main content end-->
        <!--footer start-->

        <!--footer end-->
    </section>

    <!--Snackbar -->
    <div id="snackbar"></div>
    <!-- Snackbar -->

    <!-- js placed at the end of the document so the pages load faster -->
    <?php include_once "include/javascript.php"; ?>

    <script src="assets/js/jquery.raty.js"></script>

    <script>
        $(function () {

            const booking_id = getParameterByName('booking_id');
            const room_id = getParameterByName('room_id');

            $('#btnContactDoctor').attr("onclick", "videoCall(\'" + room_id + "\')");

            if (!$("#btnContactDoctor").hasClass("disabled"))
                $("#btnContactDoctor").addClass("disabled");
            if (!$("#btnVote").hasClass("disabled"))
                $("#btnVote").addClass("disabled");

            var RunGetBookingStatus = setInterval(function () {
                getStatusBookingByBookingId(booking_id)
            }, 5000);

            $.fn.raty.defaults.path = 'assets/img/';

            $('#scoreVote').raty({
                score: function () {
                    return $(this).attr('data-score');
                }
            });

            $("#btnInfoPatient").attr('onClick', 'info_opd(' + booking_id + ')');

            $("#frm_vote").submit(function (e) {
                e.preventDefault();

                var booking_rating = $("#frm_vote #scoreVote input[name=score]").val();
                var booking_comment = $("#frm_vote #booking_comment").val();

                $.ajax({
                    type: "POST",
                    url: mainURLs + "/bookingController.php?updateRatingAndCommentBooking",
                    data: {
                        booking_id: booking_id,
                        booking_rating: booking_rating,
                        booking_comment: booking_comment
                    },
                    dataType: 'JSON',
                    async: false,
                    cache: false,
                    success: function (data) {

                        if (data.errorStatus) {

                            swal({
                                title: "แจ้งเตือน!",
                                text: "ยืนยันการกดบันทึก",
                                icon: "success",
                                buttons: {
                                    confirm: "ตกลง",
                                    cancel: "ยกเลิก"
                                }
                            }).then((willDelete) => {
                                if (willDelete) {

                                    window.open("opdPrint.php?booking_id=" +
                                        booking_id, '_blank');
                                    window.location.href = "see_doctor.php";
                                }
                            });
                        }
                        if (!data.errorStatus) {

                            AlertUnsuccessful(data.errorMessage);
                            return;
                        }
                    }
                });
            });

            $("#btnCancelBooking").click(function (e) {
                e.preventDefault();

                let booking_status = 0;

                $.ajax({
                    type: "POST",
                    url: mainURLs + "/bookingController.php?updateBookingStatus",
                    data: {
                        booking_id: booking_id,
                        booking_status: 3
                    },
                    dataType: 'JSON',
                    async: false,
                    cache: false,
                    success: function (data) {
                        
                        if (data.errorStatus) {

                            swal({
                                title: "แจ้งเตือน!",
                                text: "ยืนยันการยกเลิก",
                                icon: "success",
                                buttons: {
                                    confirm: "ตกลง",
                                    cancel: "ยกเลิก"
                                }
                            }).then((willDelete) => {
                                if (willDelete) {

                                    window.location.href = "see_doctor.php";
                                }
                            });
                        }
                        if (!data.errorStatus) {

                            AlertUnsuccessful(data.errorMessage);
                            return;
                        }
                    }
                });

            });

            function getStatusBookingByBookingId(booking_id) {

                $.ajax({
                    type: "POST",
                    url: mainURLs + "/bookingController.php?getStatusBookingByBookingId",
                    data: {
                        booking_id: booking_id
                    },
                    dataType: 'JSON',
                    async: false,
                    cache: false,
                    success: function (data) {

                        if (data[0].booking_status == 1) {

                            getDoctorByBookingId(booking_id);
                            $("#ImageLoading").addClass("hidden");
                            $("#infoDoctor").removeClass("hidden");
                            $("#labelStatusBookingTrue").removeClass("hidden");
                            $("#labelStatusBookingFalse").addClass("hidden");

                            if ($("#btnContactDoctor").hasClass("disabled"))
                                $("#btnContactDoctor").removeClass("disabled");
                        }

                        if (data[0].booking_status == 2) {

                            getDoctorByBookingId(booking_id);
                            if (!$("#ImageLoading").hasClass("hidden"))
                                $("#ImageLoading").addClass("hidden");
                            if ($("#infoDoctor").hasClass("hidden"))
                                $("#infoDoctor").removeClass("hidden");
                            $("#labelStatusBookingTrue").removeClass("hidden");
                            $("#labelStatusBookingFalse").addClass("hidden");
                            if (!$("#btnContactDoctor").hasClass("disabled"))
                                $("#btnContactDoctor").addClass("disabled");
                            if ($("#btnVote").hasClass("disabled"))
                                $("#btnVote").removeClass("disabled");
                            clearInterval(RunGetBookingStatus);
                        }
                    }
                });
            }
        });

        function getDoctorByBookingId(booking_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/doctorController.php?getDoctorByBookingID",
                data: {
                    booking_id: booking_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    fecthDoctor(data[0].doctor_id);
                }
            });
        }

        function voteComment() {

            $("#modalVoteComment").modal('show');
        }

        function fecthDoctor(doctor_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/doctorController.php?getDoctorByDoctorID",
                data: {
                    doctor_id: doctor_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    $("#doctor_id").val(data[0].doctor_id);
                    $("#doctor_full_name small").empty();
                    $("#doctor_full_name small").append(data[0].prefix_name + data[0].doctor_fname + ' ' +
                        data[0].doctor_lname);
                    $("#professions_name small").empty();
                    $("#professions_name small").append(data[0].professions_name);
                    $("#affiliation_name small").empty();
                    $("#affiliation_name small").append(data[0].affiliation_name);
                    if (!isEmpty(data[0].doctor_img))
                        $("#doctor_img_view").attr("src", "assets/img/doctorImage/" + data[0]
                            .doctor_img);
                    if (isEmpty(data[0].doctor_img))
                        $("#doctor_img_view").attr("src", "assets/img/emptyProfile.jpg");
                }
            });
        }
    </script>

</body>

</html>