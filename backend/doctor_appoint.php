<!DOCTYPE html>
<html lang="en">

<?php 

require_once "CheckSessionPc.php";
include_once "include/header.php"; 

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
                <div class="text-section-heading-1"><i class="fa fa-user"></i> แพทย์นัด
                    <small></small>
                </div>

                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel col-md-12">
                            <div class="text-section-heading-1">ซักประวัติ
                                <small>กรุณาระบุข้อมูลให้ถูกต้องครบถ้วน</small>
                            </div>
                            <form class="style-form" id="frm_add">
                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label">ค้นหา</label>
                                    <div class="col-md-12">
                                        <select class="form-control" id="txtSearch">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 hidden">
                                    <label class="col-md-12 control-label">รหัสผู้ใช้</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="p_id" readonly>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ชื่อ - นามสกุล</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="p_fullname" readonly>
                                    </div>
                                </div>
                                <!-- <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">แผนกงานของผู้ใช้</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="dep_name" readonly>
                                    </div>
                                </div> -->
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">วัน/เดือน/ปีเกิด</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" id="p_birthday" readonly>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="number" id="p_age" min="0" class="form-control" readonly>
                                            <div class="input-group-addon">ปี</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">กรุ๊ปเลือด</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="p_blood" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">โรคประจำตัว</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="op_cd">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">อาหารที่แพ้</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="op_food_allergy">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">แพ้ที่ยา</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="op_drugs_allergy">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">น้ำหนัก</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="op_weight">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ส่วนสูง</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="op_height">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">อุณหภูมิ</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="op_body_temp">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ความดันโลหิต</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="op_bp">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">แผนก</label>
                                    <div class="col-md-12">
                                        <select id="professions_id" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">เลือกแพทย์</label>
                                    <div class="col-md-7">
                                        <select id="doctor_id" class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <button type="button" id="btn_doctor_status" class="btn btn-block disabled">
                                            สถานะแพทย์ <span class="badge"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">รายละเอียดอาการป่วย</label>
                                    <div class="col-md-12">
                                        <textarea id="op_detail_sick" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 text-right">
                                    <div class="col-md-6 text-left">
                                        <button type="submit" id="btnSubmit"
                                            class="btn btn-success btn-lg">ยืนยัน</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="patient.php" class="btn btn-danger btn-lg">ยกเลิก</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- col-lg-12-->
                </div><!-- /row -->

            </section>
            <! --/wrapper -->
        </section><!-- /MAIN CONTENT -->

        <!--main content end-->
        <!--footer start-->

        <!--footer end-->
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <?php include_once "include/javascript.php"; ?>

    <script>
        $(function () {

            getProfessionstoSelectOption();

            $("#txtSearch").select2({
                placeholder: 'กรุณาเลือกชื่อผู้ใช้',
                ajax: {
                    url: mainURLs + "/patientController.php?getPatientSearch",
                    dataType: 'JSON',
                    delay: 250,
                    data: function (params) {
                        return {
                            txtSearch: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                var name;
                                var id;
                                if (typeof (item) !== "undefined") {
                                    name = (item.p_idcard + ' : ' + item.prefix_name + item
                                        .p_name + ' ' + item
                                        .p_lname);
                                    id = (item.p_id);
                                    return {
                                        text: name,
                                        id: id
                                    }
                                } else {
                                    console.log("ไม่มีข้อมูลผู้ใช้");
                                }
                            })
                        };
                    },
                },
                escapeMarkup: function (markup) {
                    return markup;
                },
                minimumInputLength: 1
            });

        });

        $('#txtSearch').on('change', function () {
            var p_id = $("#txtSearch option:selected").val();
            getPatientSearchForm(p_id);
        });

        $('#doctor_id').on('change', function () {

            var doctor_id = $("#doctor_id option:selected").val();
            var doctor_status = $("#doctor_id option:selected").data("status");

            if ($("#doctor_id option:selected").val() == "") {
                $("#btn_doctor_status").html("สถานะแพทย์");
                if ($("#btn_doctor_status").hasClass("btn-success"))
                    $("#btn_doctor_status").removeClass("btn-success");
                if ($("#btn_doctor_status").hasClass("btn-danger"))
                    $("#btn_doctor_status").removeClass("btn-danger");
                if ($("#btnSubmit").hasClass("disabled"))
                    $("#btnSubmit").removeClass("disabled");
            }

            if (doctor_status == 0) {

                oflineStatusBtn();
            }
            if (doctor_status == 1) {

                onlineStatusBtn(doctor_id);
            }
        })

        $('#professions_id').on('change', function () {

            var professions_id = $("#professions_id option:selected").val();

            $.ajax({
                type: "POST",
                url: mainURLs + "/doctorController.php?getDoctorByProID",
                data: {
                    professions_id: professions_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    var doctor = $("#doctor_id");

                    doctor.empty();
                    doctor.append('<option selected value="">ไม่ระบุแพทย์</option>');

                    $.each(data, function (i, item) {
                        doctor.append('<option data-status="' + item
                            .doctor_status + '" value="' + item.doctor_id +
                            '">' + item.prefix_name + item.doctor_fname +
                            ' ' + item.doctor_lname + '</option>');
                    });

                    $("#doctor_id").select2();
                }
            });
        });

        $('#p_birthday').change(function () {
            let birthDay = new Date(this.value);
            let currentDate = new Date();

            monthBirthDay = birthDay.getFullYear();
            monthCurrentDay = currentDate.getFullYear();

            $("#p_age").val(monthCurrentDay - monthBirthDay);
        });

        $("#frm_add").submit(function (e) {
            e.preventDefault();

            var p_id = $("#p_id").val();
            var op_cd = $("#op_cd").val();
            var op_food_allergy = $("#op_food_allergy").val();
            var op_drugs_allergy = $("#op_drugs_allergy").val();
            var op_weight = $("#op_weight").val();
            var op_height = $("#op_height").val();
            var op_body_temp = $("#op_body_temp").val();
            var op_bp = $("#op_bp").val();
            var professions_id = $("#professions_id").val();
            var op_detail_sick = $("#op_detail_sick").val();
            var doctor_id = $("#doctor_id").val();
            var room_id = getRoomID();

            swal({
                title: "แจ้งเตือน!",
                text: "ต้องการบันทึกข้อมูลใช่หรือไม่",
                icon: "success",
                buttons: {
                    confirm: "ตกลง",
                    cancel: "ยกเลิก"
                }
            }).then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url: mainURLs + "/patientController.php?addOutPatient",
                        data: {
                            p_id: p_id,
                            op_cd: op_cd,
                            op_food_allergy: op_food_allergy,
                            op_drugs_allergy: op_drugs_allergy,
                            op_weight: op_weight,
                            op_height: op_height,
                            op_body_temp: op_body_temp,
                            op_bp: op_bp,
                            professions_id: professions_id,
                            op_detail_sick: op_detail_sick,
                            doctor_id: doctor_id,
                            room_id: room_id
                        },
                        dataType: 'JSON',
                        async: false,
                        cache: false,
                        success: function (data) {

                            if (data.errorStatus) {

                                AlertSuccessful(data.errorMessage, 1);
                                window.location.href = "contactBooking.php?room_id=" +
                                    room_id + "&booking_id=" + data.booking_id +
                                    "&contactDoctor";
                                return;
                            }
                            if (!data.errorStatus) {

                                AlertUnsuccessful(data.errorMessage);
                                return;
                            }
                        }
                    });
                }
            });
        });
        // getDoctorByProID
        function getPatientSearchForm(p_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?getPatientSearchForm",
                data: {
                    p_id: p_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    if (!data.errorStatus && data.hasOwnProperty('errorStatus')) {

                        AlertUnsuccessful(data.errorMessage);
                        return;
                    }

                    if (data[0].op_mark_date == null && data[0].op_status == 0 || Date.parse(data[0]
                            .op_mark_date) != Date.parse(getCurrentDate())) {

                        AlertUnsuccessful('ไม่มีการนัดของคนไข้รายนี้อยู่ในระบบ !');
                        return;
                    }

                    if (data) {
                        $("#p_id").val(data[0].p_id);
                        $("#p_fullname").val(data[0].prefix_name + data[0].p_name + ' ' + data[
                            0].p_lname);
                        $("#dep_name").val(data[0].dep_name);
                        $("#p_blood").val(data[0].p_blood);
                        $("#p_birthday").val(data[0].p_birthday);
                        $('#p_birthday').trigger('change');
                        $("#op_cd").val(data[0].op_cd);
                        $("#op_food_allergy").val(data[0].op_food_allergy);
                        $("#op_drugs_allergy").val(data[0].op_drugs_allergy);
                        $("#professions_id").val(data[0].professions_id);
                        $('#professions_id').select2().trigger('change');
                        $("#doctor_id").val(data[0].doctor_id);
                        $('#doctor_id').select2().trigger('change');
                        $("#op_detail_sick").val(data[0].op_detail_sick);
                    }
                }
            });
        }

        function getPatientById(p_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?getPatientById",
                data: {
                    p_id: p_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    $("#p_id").val(data[0].p_id);
                    $("#p_fullname").val(data[0].prefix_name + data[0].p_name + ' ' + data[
                        0].p_lname);
                    // $("#dep_name").val(data[0].dep_name);
                    $("#p_blood").val(data[0].p_blood);
                    $("#p_birthday").val(data[0].p_birthday);
                    $("#op_cd").val("");
                    $("#op_food_allergy").val("");
                    $("#op_drugs_allergy").val("");
                }
            });
        }

        function onlineStatusBtn(doctor_id) {
            $("#btn_doctor_status").html("ออนไลน์");
            setQueueBooking(doctor_id);
            if ($("#btn_doctor_status").hasClass("btn-danger"))
                $("#btn_doctor_status").removeClass("btn-danger");
            if (!$("#btn_doctor_status").hasClass("btn-success"))
                $("#btn_doctor_status").addClass("btn-success");
            if ($("#btnSubmit").hasClass("disabled"))
                $("#btnSubmit").removeClass("disabled");
        }

        function oflineStatusBtn() {

            $("#btn_doctor_status").html("ออฟไลน์");
            if ($("#btn_doctor_status").hasClass("btn-success"))
                $("#btn_doctor_status").removeClass("btn-success");
            if (!$("#btn_doctor_status").hasClass("btn-danger"))
                $("#btn_doctor_status").addClass("btn-danger");
            $("#btnSubmit").addClass("disabled");
        }

        function setQueueBooking(doctor_id) {
            // badge
            $.ajax({
                type: "POST",
                url: mainURLs + "/bookingController.php?getCountQueueBookingDcotor",
                data: {
                    doctor_id: doctor_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    $("#btn_doctor_status").append(' <span class="badge"></span>');
                    $("#btn_doctor_status span.badge").text(data[0].queue_booking);
                }
            });
        }
    </script>

</body>

</html>