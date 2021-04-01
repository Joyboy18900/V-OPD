<!DOCTYPE html>
<html lang="en">

<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "CheckSessionDoctor.php";
include_once "include/header.php"; 
include_once "modal_member.php";
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

                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="text-section-heading-1">พบคนไข้
                            <small>*เมื่อใช้งานเสร็จแล้วกดปุ่มเสร็จสิ้นการตรวจ</small>
                        </div>
                        <div class="form-panel">
                            <div class="col-md-12">
                                <div id="infoPatient" class="col-md-12 mb">
                                    <div class="col-md-12" style="padding-top: 40px;">
                                        <div class="form-group col-md-3 mb">
                                            <div class="text-section-heading-3 text-success" id="patient_full_name">
                                                ชื่อ-นามสกุล
                                                <small></small>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 mb">
                                            <div class="text-section-heading-3 text-success" id="op_cd">
                                                โรคประจำตัว
                                                <small></small>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 mb">
                                            <div class="text-section-heading-3 text-success" id="op_drugs_allergy">
                                                แพ้ยา
                                                <small></small>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 mb">
                                            <div class="text-section-heading-3 text-success" id="op_food_allergy">
                                                แพ้อาหาร
                                                <small></small>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 mb">
                                            <div class="text-section-heading-3 text-success" id="op_weight">
                                                น้ำหนัก
                                                <small></small>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 mb">
                                            <div class="text-section-heading-3 text-success" id="op_height">
                                                ส่วนสูง
                                                <small></small>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 mb">
                                            <div class="text-section-heading-3 text-success" id="op_bp">
                                                ความดันโลหิต
                                                <small></small>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 mb">
                                            <div class="text-section-heading-3 text-success" id="op_body_temp">
                                                อุณหภูมิร่างกาย
                                                <small></small>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 mb">
                                            <div class="text-section-heading-3 text-success" id="op_detail_sick">
                                                อาการที่มาพบแพทย์
                                                <small></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="col-md-12">
                                    <form class="style-form" id="frm_add">
                                        <div class="form-group col-md-4">
                                            <label class="col-md-12 control-label">คำแนะนำ</label>
                                            <div class="col-md-12">
                                                <textarea id="op_suggestion" rows="4" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="col-md-12 control-label">ยาที่จ่ายในการตรวจ (ถ้ามี)</label>
                                            <div class="col-md-12 col-lg-12">
                                                <textarea id="op_dispense" rows="4" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="col-md-12 control-label">วันนัด (ถ้ามี)</label>
                                            <div class="col-md-12">
                                                <input type="date" id="op_mark_date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-md-offset-3 mt mb text-center"
                                            style="padding-top: 15px;">
                                            <button type="button" id="btnContactPatient"
                                                class="btn btn-lg btn-info">เริ่มสนทนากับคนไข้</button>
                                        </div>
                                        <div class="col-md-5 col-md-offset-3 mt mb text-center">
                                            <div class="col-md-12 text-center">
                                                <button type="submit"
                                                    class="btn btn-success btn-lg">เสร็จสิ้นการตรวจ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div><!-- col-lg-12-->
                </div><!-- /row -->

            </section>
        </section><!-- /MAIN CONTENT -->

        <!--main content end-->
        <!--footer start-->

        <!--footer end-->
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <?php include_once "include/javascript.php"; ?>

    <script>
        $(function () {

            const booking_id = getParameterByName('booking_id');
            const room_id = getParameterByName('room_id');

            $('#btnContactPatient').attr("onclick", "videoCall(\'" + room_id + "\')");

            getOutPatientByBookingId(booking_id);

            $("#frm_add").submit(function (e) {
                e.preventDefault();

                var op_suggestion = $("#frm_add #op_suggestion").val();
                var op_dispense = $("#frm_add #op_dispense").val();
                var op_mark_date = $("#frm_add #op_mark_date").val();

                $.ajax({
                    type: "POST",
                    url: mainURLs + "/patientController.php?updatePatientAfterBooking",
                    data: {
                        booking_id: booking_id,
                        op_suggestion: op_suggestion,
                        op_dispense: op_dispense,
                        op_mark_date: op_mark_date
                    },
                    dataType: 'JSON',
                    async: false,
                    cache: false,
                    success: function (data) {

                        if (data.errorStatus) {

                            AlertSuccessful(data.errorMessage, 1);
                            window.location.href = "see_patient.php";
                            return;
                        }
                        if (!data.errorStatus) {

                            AlertUnsuccessful(data.errorMessage);
                            return;
                        }
                    }
                });
            });
        });

        function getOutPatientByBookingId(booking_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?getOutPatientByBookingId",
                data: {
                    booking_id: booking_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    fecthPatient(data);
                }
            });
        }

        function fecthPatient(data) {

            $('#patient_full_name small').empty();
            $("#op_cd small").empty();
            $("#op_drugs_allergy small").empty();
            $("#op_food_allergy small").empty();
            $('#op_weight small').empty();
            $("#op_height small").empty();
            $("#op_bp small").empty();
            $("#op_body_temp small").empty();
            $("#op_detail_sick small").empty();

            $("#patient_full_name small").empty();
            $("#patient_full_name small").append(data[0].prefix_name + data[0].p_name +
                ' ' + data[0].p_lname);

            $("#op_cd small").empty();
            $("#op_cd small").append(data[0].op_cd);

            $("#op_drugs_allergy small").empty();
            $("#op_drugs_allergy small").append(data[0].op_drugs_allergy);

            $("#op_food_allergy small").empty();
            $("#op_food_allergy small").append(data[0].op_food_allergy);

            $("#op_weight small").empty();
            $("#op_weight small").append(data[0].op_weight + ' กิโลกรัม');

            $("#op_height small").empty();
            $("#op_height small").append(data[0].op_height + ' เซ็นติเมตร');

            $("#op_bp small").empty();
            $("#op_bp small").append(data[0].op_bp);

            $("#op_body_temp small").empty();
            $("#op_body_temp small").append(data[0].op_body_temp + ' องศาเซลเซียส');

            $("#op_detail_sick small").empty();
            $("#op_detail_sick small").append(data[0].op_detail_sick);
        }
    </script>

</body>

</html>