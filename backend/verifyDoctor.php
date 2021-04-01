<!DOCTYPE html>
<html lang="en">

<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION["userBackend"]) && $_SESSION["userBackend"]["userActivate"] == "2") {

    header("Location: profile.php");
    exit();
}

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
                        <div class="text-section-heading-1">ยืนยันตน
                            <small>กรุณาระบุข้อมูลโปรไฟล์ของคุณให้ถูกต้องครบถ้วน</small></div>
                        <div class="form-panel">
                            <form class="form-horizontal style-form" id="frm_verify" enctype="multipart/form-data">
                                <div class="form-group col-md-4 hidden">
                                    <label
                                        class="col-md-12 col-lg-12 col-sm-12 control-label sr-only"></label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="doctor_id" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 hidden">
                                    <label
                                        class="col-md-12 col-lg-12 col-sm-12 control-label sr-only"></label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="doctor_idcard" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mt">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ใบประกอบวิชาชีพ</label>
                                    <div class="col-md-12 mt">
                                        <img id="doctor_file_profess_view" class="img-responsive bg-image-custom"
                                            alt="imageProfile"
                                            style="height: 250px; object-fit: cover; margin: 0 auto;">
                                    </div>
                                    <div class="col-md-12 mt">
                                        <input type="file" class="form-control" id="doctor_file_profess" required>
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
                                        <input type="file" class="form-control" id="doctor_signature" required>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-12">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">บันทึกข้อมูล</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
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

            fecthDoctor(doctor_id);

            $('#doctor_birthday').change(function () {

                let birthDay = new Date(this.value);

                $("#doctor_age").val(getAge(birthDay));
            });

            $('#chk_old_address').change(function () {
                if (this.checked) {
                    $("#doctor_address").val($("#doctor_old_address").val());
                }
            });

            $("#frm_verify").submit(function (e) {
                e.preventDefault();

                var formData = new FormData();

                formData.append('doctor_id', $("#doctor_id").val());
                formData.append('doctor_idcard', $("#doctor_idcard").val());
                formData.append('doctor_file_profess', $("#doctor_file_profess")[0].files[0]);
                formData.append('doctor_signature', $("#doctor_signature")[0].files[0]);

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
                            url: mainURLs + "/doctorController.php?verifyDoctor",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            dataType: "JSON",
                            success: function (data) {
                                // console.log(data);
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
                        if (!isEmpty(data[0].doctor_file_profess))
                            $("#doctor_file_profess_view").attr("src", "assets/img/doctorFileProfess/" + data[0].doctor_file_profess);
                        if (isEmpty(data[0].doctor_file_profess))
                            $("#doctor_file_profess_view").attr("src", "assets/img/emptyFile.png");
                        if (!isEmpty(data[0].doctor_signature))
                            $("#doctor_signature_view").attr("src", "assets/img/doctorSignature/" + data[0].doctor_signature);
                        if (isEmpty(data[0].doctor_signature))
                            $("#doctor_signature_view").attr("src", "assets/img/emptyFile.png");
                    }
                });
            }
        });
    </script>

</body>

</html>