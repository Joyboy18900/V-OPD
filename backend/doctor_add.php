<!DOCTYPE html>
<html lang="en">

<?php 

require_once "CheckSessionAdmin.php";
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

                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="text-section-heading-1">ข้อมูลแพทย์
                            <small>เพิ่มข้อมูลแพทย์</small>
                        </div>
                        <div class="form-panel" style="padding: 15px;">
                            <form class="style-form" id="frm_add" enctype="multipart/form-data">
                                <div class="form-group col-md-4 fg-idcard">
                                    <label class="col-md-12 control-label">เลขประจำตัวประชาชน</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="doctor_idcard" maxlength="13"
                                            placeholder="กรุณากรอกเลขประจำตัวประชาชน" required>

                                        <span class="help-block help-fg-idcard hidden">มีเลขบัตรนี้ในระบบแล้ว!</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ชื่อ</label>
                                    <div class="col-md-5">
                                        <select id="prefix_id" class="form-control" required>
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" id="doctor_fname"
                                            placeholder="กรุณากรอกชื่อจริง" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="col-md-4 col-lg-4">
                                        <label class="col-md-12 control-label">นามสกุล</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" required id="doctor_lname"
                                            placeholder="กรุณากรอกนามสกุลจริง">
                                    </div>
                                </div>
                                <div class="clearfix mt"></div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ประเภทวิชาชีพ</label>
                                    <div class="col-md-12">
                                        <select id="professions_id" class="form-control" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">วัน/เดือน/ปีเกิด</label>
                                    <div class="col-md-7">
                                        <input type="date" class="form-control" required id="doctor_birthday"
                                            placeholder="กรุณาเลือกวัน/เดือน/ปีเกิด">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="number" id="doctor_age" min="0" class="form-control" required readonly>
                                            <div class="input-group-addon">ปี</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">สังกัด/โรงพยายาล</label>
                                    <div class="col-md-12">
                                        <select id="affiliation_id" class="form-control" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ที่อยู่ตามทะเบียนบ้าน</label>
                                    <div class="col-md-12">
                                        <textarea id="doctor_old_address" rows="4" class="form-control" required
                                            placeholder="กรุณากรอกที่อยู่ตามทะเบียนบ้าน"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ที่อยู่ปัจจุบัน <span> &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" id="chk_old_address">
                                            ที่อยู่เดียวกับทะเบียนบ้าน</span></label>
                                    <div class="col-md-12">
                                        <textarea id="doctor_address" rows="4" class="form-control" required
                                            placeholder="กรุณากรอกที่อยู่ปัจจุบัน"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" required id="doctor_tel"
                                            placeholder="กรุณากรอกเบอร์โทรศัพท์" maxlength="10">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="hr_opd">
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">รูปแพทย์</label>
                                    <div class="col-md-12">
                                        <input type="file" class="form-control" required id="doctor_img">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ใบประกอบวิชาชีพ</label>
                                    <div class="col-md-12">
                                        <input type="file" class="form-control" required id="doctor_file_profess">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ลายเซ็นอิเล็กทรอนิกส์</label>
                                    <div class="col-md-12">
                                        <input type="file" class="form-control" required id="doctor_signature">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ช่วงเวลาการทำการ</label>
                                    <div class="col-md-12">
                                        <select id="ds_duration" class="form-control" required>
                                            <option selected disabled>กรุณาเลือกช่วงเวลาการทำงาน</option>
                                            <option value="1">ช่วงเช้า : </option>
                                            <option value="2">ช่วงบ่าย : </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">วันที่ทำการ</label>
                                    <div class="col-md-12">
                                        <select id="ds_day" class="form-control" required>
                                            <option selected disabled>กรุณาเลือกช่วงเวลาการทำงาน</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4 fg-username">
                                    <label class="col-md-12 control-label">ชื่อผู้ใช้</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" required id="doctor_username">
                                        <span class="help-block help-fg-username hidden">มีชื่อผู้ใช้นี้ในระบบแล้ว!</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">รหัสผ่าน</label>
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" required id="doctor_password">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ยืนยันรหัสผ่าน</label>
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" required id="doctor_password_cf">
                                    </div>
                                </div>
                                <div class="form-group col-md-12 text-right mt">
                                    <div class="col-md-6 text-left">
                                        <button type="submit" id="btnSubmit" class="btn btn-success btn-lg">บันทึกข้อมูล</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="doctor.php" class="btn btn-danger btn-lg">ยกเลิก</a>
                                    </div>
                                </div>
                            </form>
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

            getPrefixtoSelectOption();
            getProfessionstoSelectOption();
            getAffiliationSelectOption();

            $('#doctor_birthday').change(function () {
                let birthDay = new Date(this.value);

                $("#doctor_age").val(getAge(birthDay));
            });

            $('#chk_old_address').change(function () {
                if (this.checked) {
                    $("#doctor_address").val($("#doctor_old_address").val());
                }
            });

            $("#doctor_idcard").blur(function (e) {
                e.preventDefault();

                var doctor_idcard = $(this).val();

                $.ajax({
                    type: "POST",
                    url: mainURLs + "/doctorController.php?checkIdCardDuplicate",
                    data: {
                        doctor_idcard: doctor_idcard
                    },
                    dataType: 'JSON',
                    async: false,
                    cache: false,
                    success: function (data) {

                        if (data.length == 1) {
                            if ($(".help-fg-idcard").hasClass("hidden"))
                                $(".help-fg-idcard").removeClass("hidden");
                            if (!$("#btnSubmit").hasClass("disabled"))
                                $("#btnSubmit").addClass("disabled");
                            if (!$(".fg-idcard").hasClass("has-error"))
                                $(".fg-idcard").addClass("has-error");
                            $(".fg-idcard").addClass('has-error');

                        }
                        if (data.length == 0) {
                            if (!$(".help-fg-idcard").hasClass("hidden"))
                                $(".help-fg-idcard").addClass("hidden");
                            if ($("#btnSubmit").hasClass("disabled"))
                                $("#btnSubmit").removeClass("disabled");
                            if ($(".fg-idcard").hasClass("has-error"))
                                $(".fg-idcard").removeClass("has-error");
                        }
                    }
                });
            });

            $("#doctor_username").blur(function (e) {
                e.preventDefault();

                var doctor_username = $(this).val();

                $.ajax({
                    type: "POST",
                    url: mainURLs + "/doctorController.php?checkUsernameDuplicate",
                    data: {
                        doctor_username: doctor_username
                    },
                    dataType: 'JSON',
                    async: false,
                    cache: false,
                    success: function (data) {

                        if (data.length == 1) {
                            if ($(".help-fg-username").hasClass("hidden"))
                                $(".help-fg-username").removeClass("hidden");
                            if (!$("#btnSubmit").hasClass("disabled"))
                                $("#btnSubmit").addClass("disabled");
                            if (!$(".fg-username").hasClass("has-error"))
                                $(".fg-username").addClass("has-error");
                            $(".fg-username").addClass('has-error');

                        }
                        if (data.length == 0) {
                            if (!$(".help-fg-username").hasClass("hidden"))
                                $(".help-fg-username").addClass("hidden");
                            if ($("#btnSubmit").hasClass("disabled"))
                                $("#btnSubmit").removeClass("disabled");
                            if ($(".fg-username").hasClass("has-error"))
                                $(".fg-username").removeClass("has-error");
                        }
                    }
                });
            });

            $("#frm_add").submit(function (e) {
                e.preventDefault();

                var doctor_password = $('#doctor_password').val();
                var doctor_password_cf = $('#doctor_password_cf').val();

                if (doctor_password != doctor_password_cf) {
                    alert("รหัสผ่านไม่ตรงกัน !");
                    return;
                }

                var formData = new FormData();

                formData.append('doctor_idcard', $("#doctor_idcard").val());
                formData.append('professions_id', $("#professions_id").val());
                formData.append('prefix_id', $("#prefix_id").val());
                formData.append('doctor_fname', $("#doctor_fname").val());
                formData.append('doctor_lname', $("#doctor_lname").val());
                formData.append('doctor_birthday', $("#doctor_birthday").val());
                formData.append('affiliation_id', $("#affiliation_id").val());
                formData.append('doctor_old_address', $("#doctor_old_address").val());
                formData.append('doctor_address', $("#doctor_address").val());
                formData.append('doctor_file_profess', $("#doctor_file_profess")[0].files[0]);
                formData.append('doctor_img', $("#doctor_img")[0].files[0]);
                formData.append('doctor_tel', $("#doctor_tel").val());
                formData.append('doctor_signature', $("#doctor_signature")[0].files[0]);
                formData.append('ds_duration', $("#ds_duration").val());
                formData.append('ds_day', $("#ds_day").val());
                formData.append('doctor_username', $("#doctor_username").val());
                formData.append('doctor_password', $("#doctor_password").val());

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
                            url: mainURLs + "/doctorController.php?addDoctor",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            dataType: "JSON",
                            success: function (data) {
                                if (data.errorStatus) {

                                    AlertSuccessful(data.errorMessage);
                                    return;
                                }
                                if (!data.errorStatus || !data) {
                                    AlertUnsuccessful(data.errorMessage);
                                    return;
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>