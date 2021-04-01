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

        <!--main content start-->
        <section id="main-content" style="margin-left: 0px;">
            <section class="wrapper">

                <div class="row mt mb">
                    <div class="col-md-12 col-lg-12 col-xs-12">
                        <div class="form-panel col-md-12" style="padding: 24px 48px;">
                            <div class="stepwizard col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step hidden-xs">
                                        <a class="btn btn-success btn-circle" disabled="disabled"><i
                                                class="fa fa-check"></i></a>
                                        <p>ข้อมูลพื้นฐาน</p>
                                    </div>
                                    <div class="stepwizard-step hidden-xs">
                                        <a class="btn btn-success btn-circle" disabled="disabled"><i
                                                class="fa fa-check"></i></a>
                                        <p>ข้อมูลเพิ่มเติม</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a class="btn btn-success btn-circle">3</a>
                                        <p>เสร็จสิ้น</p>
                                    </div>
                                </div>
                            </div>
                            <div class="stepwizard col-md-offset-3 col-sm-offset-3 hidden-xs">
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        <span class="sr-only">100% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt mb">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-panel col-md-12 col-md-12 col-sm-12 col-xs-12">

                            <div class="text-section-heading-1">ข้อมูลพื้นฐาน
                                <small></small>
                            </div>
                            <div class="panel panel-info mb">
                                <div class="panel-heading">
                                    <h3 class="panel-title">กรุณาตรวจสอบข้อมูลให้ถูกต้องครบถ้วน</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-12 col-sm-4 col-sm-offset-4 col-xs-12 mt mb">
                                        <img src="assets/img/doctorTmpImage/<?php echo $_SESSION["registerDoctor"]["doctor_img"]; ?>" id="doctor_img_view" class="img-responsive bg-image-custom" alt="imageProfile" style="height: 250px; object-fit: cover; margin: 0 auto;">
                                    </div>
                                    <div class="col-md-4 col-xs-12 col-sm-12 mt">
                                        <div class="text-section-heading-3">เลขบัตรประจำตัวประชาชน
                                            <small><?php echo $_SESSION["registerDoctor"]["doctor_idcard"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 col-sm-12 mt">
                                        <div class="text-section-heading-3">ชื่อ-สกุล
                                            <small><?php echo $_SESSION["registerDoctor"]["prefix_name"] . $_SESSION["registerDoctor"]["doctor_fname"] . ' ' . $_SESSION["registerDoctor"]["doctor_lname"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 col-sm-12 mt">
                                        <div class="text-section-heading-3">วัน/เดือน/ปีเกิด
                                            <small><?php echo $_SESSION["registerDoctor"]["doctor_birthday"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 col-sm-12 mt">
                                        <div class="text-section-heading-3">เบอร์โทรศัพท์
                                            <small><?php echo $_SESSION["registerDoctor"]["doctor_tel"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 col-sm-12 mt">
                                        <div class="text-section-heading-3">วิชาชีพ
                                            <small><?php echo $_SESSION["registerDoctor"]["professions_name"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 col-sm-12 mt">
                                        <div class="text-section-heading-3">สาขาโรงบาล
                                            <small><?php echo $_SESSION["registerDoctor"]["affiliation_name"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 col-sm-12 mt">
                                        <div class="text-section-heading-3">ที่อยู่ตามทะเบียนบ้าน
                                            <small><?php echo $_SESSION["registerDoctor"]["doctor_old_address"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 col-sm-12 mt">
                                        <div class="text-section-heading-3">ที่อยู่ปัจจุบัน
                                            <small><?php echo $_SESSION["registerDoctor"]["doctor_address"]; ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-section-heading-1 mt">ข้อมูลเพิ่มเติม
                                <small></small>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">กรุณาตรวจสอบข้อมูลให้ถูกต้องครบถ้วน</h3>
                                </div>
                                <div class="panel-body">  
                                    <div class="col-md-12 text-center mt">
                                        <div class="text-section-heading-3">ชื่อผู้ใช้งาน
                                            <small><?php echo $_SESSION["registerDoctor"]["doctor_username"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center mt">
                                        <div class="text-section-heading-3">รหัสผ่าน
                                            <small><?php echo $_SESSION["registerDoctor"]["doctor_password"]; ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-right">
                                    <a href="registerDoctorStep2.php" class="btn btn-danger btn-lg">กลับไปแก้ไข</a>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-left">
                                    <button id="BtncontinuneStep3" class="btn btn-success btn-lg">สมัครสมาชิก</button>
                                </div>
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
        $("#BtncontinuneStep3").click(function (e) {
            e.preventDefault();

            swal({
                title: "แจ้งเตือน!",
                text: "ยืนยันการสมัครสมาชิก !",
                icon: "success",
                buttons: {
                    confirm: "ตกลง",
                    cancel: "ยกเลิก"
                }
            }).then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url: mainURLs + "/registerController.php?continuneStep3",
                        dataType: 'JSON',
                        async: false,
                        cache: false,
                        success: function (data) {

                            if(data.errorStatus)
                                window.location.href = 'registerDoctorStep4.php';
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>