<!DOCTYPE html>
<html lang="en">

<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "include/header.php"; 

?>

<body>

    <section id="container">
        <!--header start-->
        <?php include_once "layout/top_naviga_registerDoctor.php"; ?>
        <!--header end-->

        <section id="main-content" style="margin-left: 0px;">
            <section class="wrapper">

                <div class="row mt mb">
                    <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                        <div class="form-panel" style="padding: 24px 48px;">
                            <div class="stepwizard col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step hidden-xs">
                                        <a class="btn btn-primary btn-circle" disabled="disabled"><i
                                                class="fa fa-check"></i></a>
                                        <p>ข้อมูลพื้นฐาน</p>
                                    </div>
                                    <div class="stepwizard-step ">
                                        <a class="btn btn-primary btn-circle">2</a>
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
                                    <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                        aria-valuemax="100" style="width: 75%">
                                        <span class="sr-only">75% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt mb">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-panel">  
                            <div class="text-section-heading-1">ข้อมูลพื้นฐาน
                                <small>กรุณากรอกข้อมูลให้ถูกต้องครบถ้วน</small>
                            </div>
                            <form class="style-form" id="frm_add" enctype="multipart/form-data">
                                <div class="col-md-offset-3 col-sm-offset-3">
                                    <div class="form-group col-md-12 col-lg-12 col-sm-12 col-xs-12 fg-username">
                                        <label class="col-md-12 col-lg-12 col-sm-12 col-xs-12 control-label">ชื่อผู้ใช้</label>
                                        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
                                            <input type="text" class="form-control" id="doctor_username">
                                            <span class="help-block help-fg-username hidden">มีชื่อผู้ใช้นี้ในระบบแล้ว!</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-md-12 col-lg-12 col-xs-12">
                                        <label class="col-md-12 col-lg-12 col-sm-12 col-xs-12 control-label">รหัสผ่าน</label>
                                        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
                                            <input type="password" class="form-control" id="doctor_password">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-md-12 col-lg-12 col-xs-12">
                                        <label class="col-md-12 col-lg-12 col-sm-12 col-xs-12 control-label">ยืนยันรหัสผ่าน</label>
                                        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
                                            <input type="password" class="form-control" id="doctor_password_cf">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-md-8 col-sm-8 col-xs-12 " style="padding-top: 50px;">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                            <a href="registerDoctor.php" class="btn btn-danger btn-lg">ย้อนกลับ</a>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                            <button type="button" id="BtncontinuneStep2"
                                                class="btn btn-success btn-lg">ต่อไป</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
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

            setValueFromSession();
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
                        if (!$("#BtncontinuneStep2").hasClass("disabled"))
                            $("#BtncontinuneStep2").addClass("disabled");
                        if (!$(".fg-username").hasClass("has-error"))
                            $(".fg-username").addClass("has-error");
                        $(".fg-username").addClass('has-error');
                            
                    }
                    if (data.length == 0) {
                        if (!$(".help-fg-username").hasClass("hidden"))
                            $(".help-fg-username").addClass("hidden");
                        if ($("#BtncontinuneStep2").hasClass("disabled"))
                            $("#BtncontinuneStep2").removeClass("disabled");
                        if ($(".fg-username").hasClass("has-error"))
                            $(".fg-username").removeClass("has-error");
                    }
                }
            });
        });

        $("#BtncontinuneStep2").click(function (e) {
            e.preventDefault();

            if(!isRequired($("#doctor_username").val()))
                return;
            if(!isRequired($("#doctor_password").val()))
                return; 
            if(!isRequired($("#doctor_password_cf").val()))
                return; 

            var doctor_password = $('#doctor_password').val();
            var doctor_password_cf = $('#doctor_password_cf').val();

            if (doctor_password != doctor_password_cf) {
                alert("รหัสผ่านไม่ตรงกัน !");
                return;
            }

            var formData = new FormData();

            formData.append('doctor_username', $("#doctor_username").val());
            formData.append('doctor_password', $("#doctor_password").val());

            $.ajax({
                type: "POST",
                url: mainURLs + "/registerController.php?continuneStep2",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (data) {

                    console.log(data);
                    window.location.href = 'registerDoctorStep3.php';
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

        function setValueFromSession() {

            $("#doctor_username").val(
                '<?php echo (isset($_SESSION["registerDoctor"]["doctor_username"]) ? $_SESSION["registerDoctor"]["doctor_username"] : ""); ?>'
                );
        }
    </script>

</body>

</html>