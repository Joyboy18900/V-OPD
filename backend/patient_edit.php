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

                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="text-section-heading-1">ข้อมูลคนไข้
                            <small>แก้ไขข้อมูลคนไข้</small>
                        </div>
                        <div class="form-panel" style="padding: 15px;">
                            <form class="style-form" id="frm_edit">
                                <div class="form-group col-md-4 col-lg-4 hidden">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">รหัสคนไข้</label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="p_id">
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label
                                        class="col-md-12 col-lg-12 col-sm-12 control-label">เลขประจำตัวประชาชน</label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="p_idcard" maxlength="13"
                                            aria-describedby="p_idcardHelp">
                                        <small id="p_idcardHelp" class="form-text text-muted text-danger">
                                            * หรือสามารถใช้รหัสหนังสือเดินทางได้
                                        </small>
                                    </div>
                                </div>
                                <!-- <div class="form-group col-md-6 col-lg-6">
                                    <div class="col-md-4 col-lg-4">
                                        <label class="col-md-12 col-lg-12 col-sm-12 control-label">แผนก</label>
                                    </div>
                                    <div class="col-md-8 col-lg-8">
                                        <select id="dep_id" class="form-control">
                                            <option selected disabled>กรุณาเลือกแผนกงานของผู้ใช้</option>
                                            <option value="1">แผนกจัดซื้อ</option>
                                            <option value="2">แผนกจัดส่ง</option>
                                            <option value="3">แผนกลายผลิต</option>
                                            <option value="4">แผนก IT </option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group col-md-4 col-lg-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ชื่อ</label>
                                    <div class="col-md-5">
                                        <select id="prefix_id" class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" id="p_name">
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">นามสกุล</label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="p_lname"
                                            placeholder="กรุณากรอกนามสกุลจริง">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">วัน/เดือน/ปีเกิด</label>
                                    <div class="col-md-7">
                                        <input type="date" class="form-control" id="p_birthday"
                                            placeholder="กรุณาเลือกวัน/เดือน/ปีเกิด">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="number" id="p_age" min="0" class="form-control" readonly>
                                            <div class="input-group-addon">ปี</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 col-lg-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">กรุ๊ปเลือด</label>
                                    <div class="col-md-12 col-lg-12">
                                        <select id="p_blood" class="form-control">
                                            <option selected disabled>กรุณาเลือกกรุ๊ปเลือด</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 col-lg-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" id="p_tel" class="form-control" maxlength="10"> 
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label
                                        class="col-md-12 col-lg-12 col-sm-12 control-label">ที่อยู่ตามทะเบียนบ้าน</label>
                                    <div class="col-md-12 col-lg-12">
                                        <textarea id="p_old_address" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label class="col-md-12 col-lg-12 control-label">ที่อยู่ปัจจุบัน <span> &nbsp;&nbsp;&nbsp; <input
                                                type="checkbox" id="chk_old_address"> ที่อยู่เดียวกับทะเบียนบ้าน</span></label>

                                    <div class="col-md-12 col-lg-12">
                                        <textarea id="p_address" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-12 text-right">
                                    <div class="col-md-6 text-left">
                                        <button type="submit" class="btn btn-success btn-lg">บันทึกข้อมูล</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="patient.php" class="btn btn-danger btn-lg">ยกเลิก</a>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
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

            getPrefixtoSelectOption();

            var p_id = getParameterByName('p_id');


            $('#p_birthday').change(function () {

                var tmp = this.value.split("-");
                var current = new Date();
                var current_year = current.getFullYear();

                $("#p_age").val(current_year - tmp[0]);
            });

            fecthPatient(p_id);
            // เหลือ Confirm ก่อนบันทึก
            $("#frm_edit").submit(function (e) {
                e.preventDefault();

                var p_id = $("#p_id").val();
                var p_idcard = $("#p_idcard").val();
                var dep_id = 1
                var prefix_id = $("#prefix_id").val();
                var p_name = $("#p_name").val();
                var p_lname = $("#p_lname").val();
                var p_birthday = $("#p_birthday").val();
                var p_blood = $("#p_blood").val();
                var p_tel = $("#p_tel").val();
                var p_old_address = $("#p_old_address").val();
                var p_address = $("#p_address").val();

                $.ajax({
                    type: "POST",
                    url: mainURLs + "/patientController.php?editPatient",
                    data: {
                        p_id: p_id,
                        p_idcard: p_idcard,
                        dep_id: dep_id,
                        prefix_id: prefix_id,
                        p_name: p_name,
                        p_lname: p_lname,
                        p_birthday: p_birthday,
                        p_blood: p_blood,
                        p_tel: p_tel,
                        p_old_address: p_old_address,
                        p_address: p_address
                    },
                    dataType: 'JSON',
                    async: false,
                    cache: false,
                    success: function (data) {

                        if (data.errorStatus) {

                            AlertSuccessful(data.errorMessage);
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

        function fecthPatient(p_id) {

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
                    $("#p_idcard").val(data[0].p_idcard);
                    $("#prefix_id").val(data[0].prefix_id);
                    $("#p_name").val(data[0].p_name);
                    $("#p_lname").val(data[0].p_lname);
                    $("#dep_id").val(data[0].dep_id);
                    $("#p_blood").val(data[0].p_blood);
                    $("#p_birthday").val(data[0].p_birthday);
                    $("#p_birthday").trigger("change");
                    $("#p_old_address").val(data[0].p_old_address);
                    $("#p_address").val(data[0].p_address);
                    $("#p_tel").val(data[0].p_tel);
                }
            });
        }

        $('#chk_old_address').change(function () {
            if (this.checked) {
                $("#p_address").val($("#p_old_address").val());
            }
        });
    </script>

</body>

</html>