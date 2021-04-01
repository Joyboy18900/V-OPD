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
        <header class="header custom-bg">
            <!--logo start-->
            <a href="index.php" class="logo"><b>ลงทะเบียนพยาบาล : Virtual Out Patient Department Online | V-OPD</b></a>
            <!--logo end-->
        </header>

        <section id="main-content" style="margin-left: 0px;">
            <section class="wrapper">

                <div class="row mt mb">
                    <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                        <div class="form-panel" style="padding: 24px 48px;">
                            <div class="stepwizard col-md-offset-3">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a class="btn btn-primary btn-circle" disabled="disabled"><i
                                                class="fa fa-check"></i></a>
                                        <p>ข้อมูลพื้นฐาน</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a class="btn btn-primary btn-circle">2</a>
                                        <p>ข้อมูลเพิ่มเติม</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a class="btn btn-default btn-circle" disabled="disabled">3</a>
                                        <p>เสร็จสิ้น</p>
                                    </div>
                                </div>
                            </div>
                            <div class="stepwizard col-md-offset-3">
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
                    <div class="col-lg-12">
                        <div class="form-panel">  
                            <div class="text-section-heading-1">ข้อมูลพื้นฐาน
                                <small>กรุณากรอกข้อมูลให้ถูกต้องครบถ้วน</small>
                            </div>
                            <form class="style-form" id="frm_add" enctype="multipart/form-data">
                                <div class="col-md-offset-3">
                                    <div class="form-group col-md-12 fg-username">
                                        <label class="col-md-12 col-lg-12 col-sm-12 control-label">ชื่อผู้ใช้</label>
                                        <div class="col-md-8 col-lg-8">
                                            <input type="text" class="form-control" id="per_username">
                                            <span class="help-block help-fg-username hidden">มีชื่อผู้ใช้นี้ในระบบแล้ว!</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-md-12">
                                        <label class="col-md-12 col-lg-12 col-sm-12 control-label">รหัสผ่าน</label>
                                        <div class="col-md-8 col-lg-8">
                                            <input type="password" class="form-control" id="per_password">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-md-12">
                                        <label
                                            class="col-md-12 col-lg-12 col-sm-12 control-label">ยืนยันรหัสผ่าน</label>
                                        <div class="col-md-8 col-lg-8">
                                            <input type="password" class="form-control" id="per_password_cf">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-md-8" style="padding-top: 50px;">
                                        <div class="col-md-6 text-right">
                                            <a href="registerNurse.php" class="btn btn-danger btn-lg">ย้อนกลับ</a>
                                        </div>
                                        <div class="col-md-6 text-left">
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

        $("#per_username").blur(function (e) {
            e.preventDefault();

            var per_username = $(this).val();

            $.ajax({
                type: "POST",
                url: mainURLs + "/pcController.php?checkUsernameDuplicate",
                data: {
                    per_username: per_username
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

            if(!isRequired($("#per_username").val()))
                return;
            if(!isRequired($("#per_password").val()))
                return; 
            if(!isRequired($("#per_password_cf").val()))
                return; 

            var per_password = $('#per_password').val();
            var per_password_cf = $('#per_password_cf').val();

            if (per_password != per_password_cf) {
                alert("รหัสผ่านไม่ตรงกัน !");
                return;
            }

            var formData = new FormData();

            formData.append('per_username', $("#per_username").val());
            formData.append('per_password', $("#per_password").val());

            $.ajax({
                type: "POST",
                url: mainURLs + "/registerNurseController.php?continuneStep2",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (data) {

                    console.log(data);
                    window.location.href = 'registerNurseStep3.php';
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

            $("#per_username").val(
                '<?php echo (isset($_SESSION["registerNurse"]["per_username"]) ? $_SESSION["registerNurse"]["per_username"] : ""); ?>'
                );
        }
    </script>

</body>

</html>