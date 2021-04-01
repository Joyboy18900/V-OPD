<!DOCTYPE html>
<html lang="en">

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />

<?php 

require_once "CheckSessionDoctor.php";
include_once "include/header.php"; 

?>

<body>

    <section id="container">

        <!--header start-->
        <?php include_once "layout/top_navigation.php"; ?>
        <!--header end-->

        <!--sidebar start-->
        <?php include_once "layout/slide_menu.php"; ?>
        <!--sidebar end-->

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <!--verify Notification start-->
                <?php include_once "layout/verifyNotification.php"; ?>
                <!--verify Notification end-->

                <!-- BASIC FORM ELELEMNTS -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-section-heading-1">ตั้งค่าโปรไฟล์
                            <small>กรุณาระบุข้อมูลโปรไฟล์ของคุณให้ถูกต้องครบถ้วน</small>
                        </div>
                        <form class="style-form" id="frm_edit" enctype="multipart/form-data">
                            <div class="form-panel mb">
                                <div class="form-group col-md-4 hidden">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label sr-only"></label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="doctor_id" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-md-offset-4 mb">
                                    <div class="col-md-12 mt">
                                        <img id="doctor_img_view" class="img-responsive bg-image-custom"
                                            alt="imageProfile"
                                            style="height: 250px; object-fit: cover; margin: 0 auto;">
                                    </div>
                                    <label class="col-md-12 control-label mt">รูปแพทย์</label>
                                    <div class="col-md-12">
                                        <input type="file" class="form-control" id="doctor_img">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4">
                                    <label
                                        class="col-md-12 col-lg-12 col-sm-12 control-label">เลขประจำตัวประชาชน</label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="doctor_idcard" maxlength="13"
                                            placeholder="กรุณากรอกเลขประจำตัวประชาชน" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ชื่อ</label>
                                    <div class="col-md-5">
                                        <select id="prefix_id" class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" id="doctor_fname"
                                            placeholder="กรุณากรอกชื่อจริง">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">นามสกุล</label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="doctor_lname"
                                            placeholder="กรุณากรอกนามสกุลจริง">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ประเภทวิชาชีพ</label>
                                    <div class="col-md-12 col-lg-12">
                                        <select id="professions_id" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">วัน/เดือน/ปีเกิด</label>
                                    <div class="col-md-7">
                                        <input type="date" class="form-control" id="doctor_birthday"
                                            placeholder="กรุณาเลือกวัน/เดือน/ปีเกิด">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="number" id="doctor_age" min="0" class="form-control" readonly>
                                            <div class="input-group-addon">ปี</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">สังกัด/โรงพยายาล</label>
                                    <div class="col-md-12">
                                        <select id="affiliation_id" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4">
                                    <label
                                        class="col-md-12 col-lg-12 col-sm-12 control-label">ที่อยู่ตามทะเบียนบ้าน</label>
                                    <div class="col-md-12">
                                        <textarea id="doctor_old_address" rows="4" class="form-control"
                                            placeholder="กรุณากรอกที่อยู่ตามทะเบียนบ้าน"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ที่อยู่ปัจจุบัน
                                        <span> &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" id="chk_old_address" value="">
                                            ที่อยู่เดียวกับทะเบียนบ้าน
                                        </span></label>
                                    <div class="col-md-12">
                                        <textarea id="doctor_address" rows="4" class="form-control"
                                            placeholder="กรุณากรอกที่อยู่ปัจจุบัน"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="doctor_tel" maxlength="10">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <?php 
                                if(isset($_SESSION["userBackend"]["userActivate"]) && $_SESSION["userBackend"]["userActivate"] != "2") { 
                                ?>
                                <div class="form-group col-md-12 mt">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-success btn-lg btn-block">บันทึกข้อมูล</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <?php
                                }
                                ?>
                            </div>

                            <?php 
                            if(isset($_SESSION["userBackend"]["userActivate"]) && $_SESSION["userBackend"]["userActivate"] == "2") { 
                            ?>

                            <div class="form-panel mt">
                                <div class="form-group col-md-6 mt">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ใบประกอบวิชาชีพ</label>
                                    <div class="col-md-12 mt">
                                        <img id="doctor_file_profess_view" class="img-responsive bg-image-custom"
                                            alt="imageProfile"
                                            style="height: 250px; object-fit: cover; margin: 0 auto;">
                                    </div>
                                    <div class="col-md-12 mt">
                                        <input type="file" class="form-control" id="doctor_file_profess">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mt">
                                    <label
                                        class="col-md-12 col-lg-12 col-sm-12 control-label">ลายเซ็นอิเล็กทรอนิกส์</label>
                                    <div class="col-md-12 mt">
                                        <img id="doctor_signature_view" class="img-responsive bg-image-custom"
                                            alt="imageProfile"
                                            style="height: 250px; object-fit: cover; margin: 0 auto;">
                                    </div>
                                    <div class="col-md-12 mt">
                                        <input type="file" class="form-control" id="doctor_signature">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-12 mt">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-success btn-lg btn-block">บันทึกข้อมูล</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <?php 
                            }
                            ?>
                        </form>
                    </div><!-- col-lg-12-->
                </div>

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

            // var doctor_id = getParameterByName('doctor_id');
            var doctor_id = <?php echo $_SESSION["userBackend"]["userID"]; ?>;

            getPrefixtoSelectOption();
            getProfessionstoSelectOption();
            getAffiliationSelectOption();

            document.getElementById('doctor_img').onchange = function (evt) {

                var tgt = evt.target || window.event.srcElement,
                    files = tgt.files;

                // FileReader support
                if (FileReader && files && files.length) {
                    var fr = new FileReader();
                    fr.onload = function () {
                        document.getElementById('doctor_img_view').src = fr.result;
                    }
                    fr.readAsDataURL(files[0]);
                }
            }

            document.getElementById('doctor_file_profess').onchange = function (evt) {

                var tgt = evt.target || window.event.srcElement,
                    files = tgt.files;

                // FileReader support
                if (FileReader && files && files.length) {
                    var fr = new FileReader();
                    fr.onload = function () {
                        document.getElementById('doctor_file_profess_view').src = fr.result;
                    }
                    fr.readAsDataURL(files[0]);
                }
            }

            document.getElementById('doctor_signature').onchange = function (evt) {

                var tgt = evt.target || window.event.srcElement,
                    files = tgt.files;

                // FileReader support
                if (FileReader && files && files.length) {
                    var fr = new FileReader();
                    fr.onload = function () {
                        document.getElementById('doctor_signature_view').src = fr.result;
                    }
                    fr.readAsDataURL(files[0]);
                }
            }

            $('#doctor_birthday').change(function () {

                let birthDay = new Date(this.value);

                $("#doctor_age").val(getAge(birthDay));
            });

            fecthDoctor(doctor_id);

            $('#chk_old_address').change(function () {
                if (this.checked) {
                    $("#doctor_address").val($("#doctor_old_address").val());
                }
            });

            $("#frm_edit").submit(function (e) {
                e.preventDefault();

                var formData = new FormData();

                formData.append('doctor_id', $("#doctor_id").val());
                formData.append('doctor_idcard', $("#doctor_idcard").val());
                formData.append('professions_id', $("#professions_id").val());
                formData.append('prefix_id', $("#prefix_id").val());
                formData.append('doctor_fname', $("#doctor_fname").val());
                formData.append('doctor_lname', $("#doctor_lname").val());
                formData.append('doctor_birthday', $("#doctor_birthday").val());
                formData.append('affiliation_id', $("#affiliation_id").val());
                formData.append('doctor_old_address', $("#doctor_old_address").val());
                formData.append('doctor_address', $("#doctor_address").val());
                formData.append('doctor_img', $("#doctor_img")[0].files[0]);
                formData.append('doctor_file_profess', $("#doctor_file_profess")[0].files[0]);
                formData.append('doctor_signature', $("#doctor_signature")[0].files[0]);
                formData.append('doctor_tel', $("#doctor_tel").val());

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
                            url: mainURLs + "/doctorController.php?editDoctor",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            dataType: "JSON",
                            success: function (data) {
                                // console.log(data);
                                if (data.errorStatus) {
                                    setValueSession($("#doctor_id").val());
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
                        $("#doctor_idcard").val(data[0].doctor_idcard);
                        $("#professions_id").val(data[0].professions_id);
                        $("#prefix_id").val(data[0].prefix_id);
                        $("#doctor_fname").val(data[0].doctor_fname);
                        $("#doctor_lname").val(data[0].doctor_lname);
                        $("#doctor_birthday").val(data[0].doctor_birthday);
                        $("#doctor_birthday").change();
                        $("#affiliation_id").val(data[0].affiliation_id);
                        $("#doctor_old_address").val(data[0].doctor_old_address);
                        $("#doctor_address").val(data[0].doctor_address);
                        $("#doctor_tel").val(data[0].doctor_tel);
                        if (!isEmpty(data[0].doctor_img))
                            $("#doctor_img_view").attr("src", "assets/img/doctorImage/" + data[0]
                                .doctor_img);
                        if (isEmpty(data[0].doctor_img))
                            $("#doctor_img_view").attr("src", "assets/img/emptyProfile.jpg");
                        if (!isEmpty(data[0].doctor_file_profess))
                            $("#doctor_file_profess_view").attr("src",
                                "assets/img/doctorFileProfess/" + data[0].doctor_file_profess);
                        if (isEmpty(data[0].doctor_file_profess))
                            $("#doctor_file_profess_view").attr("src", "assets/img/emptyFile.png");
                        if (!isEmpty(data[0].doctor_signature))
                            $("#doctor_signature_view").attr("src", "assets/img/doctorSignature/" +
                                data[0].doctor_signature);
                        if (isEmpty(data[0].doctor_signature))
                            $("#doctor_signature_view").attr("src", "assets/img/emptyFile.png");
                    }
                });
            }

            function setValueSession(doctor_id) {

                $.ajax({
                    type: "POST",
                    url: mainURLs + "/doctorController.php?setSessionValue",
                    data: {
                        doctor_id: doctor_id
                    },
                    dataType: "JSON",
                    async: false,
                    cache: false,
                    success: function (data) {
                        // console.log(data);
                    }
                });
            }
        });
    </script>

</body>

</html>