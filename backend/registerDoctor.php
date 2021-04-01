<!DOCTYPE html>
<html lang="en">

<?php 

include_once "include/header.php"; 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<body>

    <section id="container">
        <!--header start-->
        <?php include_once "layout/top_naviga_registerDoctor.php"; ?>
        <!--header end-->
        <!--main content start-->
        <section id="main-content" style="margin-left: 0px;">
            <section class="wrapper">

                <div class="row mt mb">
                    <div class=" col-md-12 col-xs-12 col-sm-12">
                        <div class="form-panel" style="padding: 24px 48px;">
                            <div class="stepwizard col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a class="btn btn-primary btn-circle">1</a>
                                        <p>ข้อมูลพื้นฐาน</p>
                                    </div>
                                    <div class="stepwizard-step hidden-xs">
                                        <a class="btn btn-default btn-circle" disabled="disabled">2</a>
                                        <p>ข้อมูลเพิ่มเติม</p>
                                    </div>
                                    <div class="stepwizard-step hidden-xs">
                                        <a class="btn btn-default btn-circle" disabled="disabled">3</a>
                                        <p>เสร็จสิ้น</p>
                                    </div>
                                </div>
                            </div>
                            <div class="stepwizard col-md-offset-3 col-sm-offset-3 hidden-xs">
                                <div class="progress progress-striped active">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                        aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt mb">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="form-panel">
                            <div class="text-section-heading-1">ข้อมูลพื้นฐาน
                                <small>กรุณากรอกข้อมูลให้ถูกต้องครบถ้วน</small>
                            </div>
                            <form class="style-form" id="frm_add" enctype="multipart/form-data">
                                <div class="form-group col-md-4 col-sm-4 col-sm-offset-4 col-md-offset-4 mb">
                                    <div class="col-md-12 mt">
                                        <img id="doctor_img_view" class="img-responsive bg-image-custom" alt="imageProfile" style="height: 250px; object-fit: cover; margin: 0 auto;">
                                    </div>
                                    <label class="col-md-12 control-label mt">รูปแพทย์</label>
                                    <div class="col-md-12">
                                        <input type="file" class="form-control" id="doctor_img">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12 fg-idcard">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">เลขประจำตัวประชาชน</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="doctor_idcard" maxlength="13"
                                            placeholder="กรุณากรอกเลขประจำตัวประชาชน">
                                            
                                    <span class="help-block help-fg-idcard hidden">มีเลขบัตรนี้ในระบบแล้ว!</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 col-sm-4 col-xs-12">
                                    <label class="col-md-12 col-lg-12 col-sm-12 col-xs-12 control-label">คำนำหน้าชื่อ</label>
                                    <div class="col-md-12 col-xs-12">
                                        <select id="prefix_id" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 col-sm-4 col-xs-12">
                                    <label class="col-md-12 col-lg-12 col-sm-12 col-xs-12 control-label">ชื่อ</label>
                                    <div class="col-md-12 col-xs-12">
                                        <input type="text" class="form-control" id="doctor_fname"
                                            placeholder="กรุณากรอกชื่อจริง">
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">นามสกุล</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="doctor_lname"
                                            placeholder="กรุณากรอกนามสกุลจริง">
                                    </div>
                                </div>
                                <div class="clearfix mt"></div>
                                <div class="form-group col-md-4 col-xs-12 col-sm-12">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ประเภทวิชาชีพ</label>
                                    <div class="col-md-12">
                                        <select id="professions_id" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-xs-12 col-sm-6">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">วัน/เดือน/ปีเกิด</label>
                                    <div class="col-md-8 col-xs-12 col-sm-8 ">
                                        <input type="date" class="form-control" id="doctor_birthday"
                                            placeholder="กรุณาเลือกวัน/เดือน/ปีเกิด">
                                    </div>
                                    <div class="col-md-4 col-xs-4 col-sm-4 hidden-xs">
                                        <div class="input-group">
                                            <input type="number" id="doctor_age" min="0" class="form-control" readonly>
                                            <div class="input-group-addon">ปี</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-xs-12 col-sm-6">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">สังกัด/โรงพยายาล</label>
                                    <div class="col-md-12">
                                        <select id="affiliation_id" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4 col-xs-12 col-sm-6">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ที่อยู่ตามทะเบียนบ้าน</label>
                                    <div class="col-md-12 col-sm-12">
                                        <textarea id="doctor_old_address" rows="4" class="form-control"
                                            placeholder="กรุณากรอกที่อยู่ตามทะเบียนบ้าน"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-xs-12 col-lg-4 col-sm-6">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ที่อยู่ปัจจุบัน 
                                        <span> &nbsp;&nbsp;&nbsp; 
                                            <input type="checkbox" id="chk_old_address"> ที่อยู่เดียวกับทะเบียนบ้าน
                                        </span>
                                    </label>
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <textarea id="doctor_address" rows="4" class="form-control" placeholder="กรุณากรอกที่อยู่ปัจจุบัน"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-xs-12 col-sm-6">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-12 col-sm-12">
                                        <input type="text" class="form-control" id="doctor_tel" maxlength="10" placeholder="กรุณากรอกเบอร์โทรศัพท์">
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-xs-12 text-center" style="padding-top: 50px;">
                                    <div class="col-md-12">
                                        <button type="button" id="BtncontinuneStep1"
                                            class="btn btn-success btn-lg">ต่อไป</a>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </section>
        </section>
        <!--main content end-->

        <!--footer start-->
        <?php include_once "layout/footer.php"; ?>
        <!--footer end-->
    </section>

    <?php include_once "include/javascript.php"; ?>

    <script>
        $(function () {
            
            getPrefixtoSelectOption();
            getProfessionstoSelectOption();
            getAffiliationSelectOption();
            setValueFromSession();
        });

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
                        if (!$("#BtncontinuneStep1").hasClass("disabled"))
                            $("#BtncontinuneStep1").addClass("disabled");
                        if (!$(".fg-idcard").hasClass("has-error"))
                            $(".fg-idcard").addClass("has-error");
                        $(".fg-idcard").addClass('has-error');
                            
                    }
                    if (data.length == 0) {
                        if (!$(".help-fg-idcard").hasClass("hidden"))
                            $(".help-fg-idcard").addClass("hidden");
                        if ($("#BtncontinuneStep1").hasClass("disabled"))
                            $("#BtncontinuneStep1").removeClass("disabled");
                        if ($(".fg-idcard").hasClass("has-error"))
                            $(".fg-idcard").removeClass("has-error");
                    }
                }
            });
        });

        $("#BtncontinuneStep1").click(function (e) {
            e.preventDefault();

            var formData = new FormData();

            if(!isRequired($("#doctor_img_view").attr("src")))
                return;
            if(!isRequired($("#professions_id").val()))
                return; 
            if(!isRequired($("#prefix_id").val()))
                return;
            if(!isRequired($("#doctor_fname").val()))
                return;
            if(!isRequired($("#doctor_lname").val()))
                return;
            if(!isRequired($("#doctor_birthday").val()))
                return;
            if(!isRequired($("#affiliation_id").val()))
                return;
            if(!isRequired($("#doctor_old_address").val()))
                return;
            if(!isRequired($("#doctor_address").val()))
                return;
            if(!isRequired($("#doctor_img")[0].files[0]))
                return;
            if(!isRequired($("#doctor_tel").val()))
                return;

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
            formData.append('doctor_tel', $("#doctor_tel").val());

            $.ajax({
                type: "POST",
                url: mainURLs + "/registerController.php?continuneStep1",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (data) {

                    window.location.href = 'registerDoctorStep2.php';
                    return false;
                    // if (data.errorStatus) {

                    //     AlertSuccessful(data.errorMessage);
                    //     return;
                    // }
                    // if (!data.errorStatus || !data) {
                    //     AlertUnsuccessful(data.errorMessage);
                    //     return;
                    // }
                }
            });
        });

        $("#doctor_birthday").change(function (e) { 
            e.preventDefault();
            
            $("#doctor_age").val(getAge($(this).val()));
        });

        $('#chk_old_address').change(function () {
            if (this.checked) {
                $("#doctor_address").val($("#doctor_old_address").val());
            }
        });

        function setValueFromSession() {

            $("#doctor_idcard").val(
                '<?php echo(isset($_SESSION["registerDoctor"]["doctor_idcard"]) ? $_SESSION["registerDoctor"]["doctor_idcard"] : ""); ?>'
            );
            $("#professions_id").val(
                '<?php echo(isset($_SESSION["registerDoctor"]["professions_id"]) ? $_SESSION["registerDoctor"]["professions_id"] : ""); ?>'
            );
            $("#prefix_id").val(
                '<?php echo(isset($_SESSION["registerDoctor"]["prefix_id"]) ? $_SESSION["registerDoctor"]["prefix_id"] : ""); ?>'
            );
            $("#doctor_fname").val(
                '<?php echo (isset($_SESSION["registerDoctor"]["doctor_fname"]) ? $_SESSION["registerDoctor"]["doctor_fname"] : ""); ?>'
            );
            $("#doctor_lname").val(
                '<?php echo (isset($_SESSION["registerDoctor"]["doctor_lname"]) ? $_SESSION["registerDoctor"]["doctor_lname"] : ""); ?>'
            );
            $("#doctor_birthday").val(
                '<?php echo (isset($_SESSION["registerDoctor"]["doctor_birthday"]) ? $_SESSION["registerDoctor"]["doctor_birthday"] : ""); ?>'
            );
            $("#doctor_birthday").change();
            $("#affiliation_id").val(
                '<?php echo(isset($_SESSION["registerDoctor"]["affiliation_id"]) ? $_SESSION["registerDoctor"]["affiliation_id"] : ""); ?>'
            );
            $("#doctor_old_address").val(
                '<?php echo (isset($_SESSION["registerDoctor"]["doctor_old_address"]) ? $_SESSION["registerDoctor"]["doctor_old_address"] : ""); ?>'
            );
            $("#doctor_address").val(
                '<?php echo (isset($_SESSION["registerDoctor"]["doctor_address"]) ? $_SESSION["registerDoctor"]["doctor_address"] : ""); ?>'
            );
            $("#doctor_img_view").attr("src", 
                '<?php echo (isset($_SESSION["registerDoctor"]["doctor_img"]) ? "assets/img/doctorTmpImage/" . $_SESSION["registerDoctor"]["doctor_img"] : "assets/img/emptyProfile.jpg"); ?>'
            );
            $("#doctor_tel").val(
                '<?php echo (isset($_SESSION["registerDoctor"]["doctor_tel"]) ? $_SESSION["registerDoctor"]["doctor_tel"] : ""); ?>'
            );
        }
    </script>

</body>

</html>