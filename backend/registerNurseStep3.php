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
        <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
        <!--header start-->
        <header class="header custom-bg">
            <!--logo start-->
            <a href="index.php" class="logo"><b>ลงทะเบียนพยาบาล : Virtual Out Patient Department Online | V-OPD</b></a>
            <!--logo end-->
        </header>
        <!--header end-->

        <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->

        <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
        <!--main content start-->
        <section id="main-content" style="margin-left: 0px;">
            <section class="wrapper">

                <div class="row mt mb">
                    <div class="col-lg-12">
                        <div class="form-panel col-md-12" style="padding: 24px 48px;">
                            <div class="stepwizard col-md-offset-3">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a class="btn btn-success btn-circle" disabled="disabled"><i
                                                class="fa fa-check"></i></a>
                                        <p>ข้อมูลพื้นฐาน</p>
                                    </div>
                                    <div class="stepwizard-step">
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
                            <div class="stepwizard col-md-offset-3">
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
                    <div class="col-lg-12">
                        <div class="form-panel col-md-12">

                            <div class="text-section-heading-1">ข้อมูลพื้นฐาน
                                <small></small>
                            </div>
                            <div class="panel panel-info mb">
                                <div class="panel-heading">
                                    <h3 class="panel-title">กรุณาตรวจสอบข้อมูลให้ถูกต้องครบถ้วน</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-12 mt mb">
                                        <img src="assets/img/pcTmpImage/<?php echo $_SESSION["registerNurse"]["per_img"]; ?>" id="per_img_view" class="img-responsive bg-image-custom" alt="imageProfile" style="height: 250px; object-fit: cover; margin: 0 auto;">
                                    </div>
                                    <div class="col-md-4 mt">
                                        <div class="text-section-heading-3">เลขบัตรประจำตัวประชาชน
                                            <small><?php echo $_SESSION["registerNurse"]["per_idcard"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt">
                                        <div class="text-section-heading-3">ชื่อ-สกุล
                                            <small><?php echo $_SESSION["registerNurse"]["prefix_name"] . $_SESSION["registerNurse"]["per_fname"] . ' ' . $_SESSION["registerNurse"]["per_lname"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt">
                                        <div class="text-section-heading-3">วัน/เดือน/ปีเกิด
                                            <small><?php echo $_SESSION["registerNurse"]["per_birthday"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt">
                                        <div class="text-section-heading-3">เบอร์โทรศัพท์
                                            <small><?php echo $_SESSION["registerNurse"]["per_tel"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt">
                                        <div class="text-section-heading-3">วิชาชีพ
                                            <small><?php echo $_SESSION["registerNurse"]["professions_name"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt">
                                        <div class="text-section-heading-3">ที่อยู่ตามทะเบียนบ้าน
                                            <small><?php echo $_SESSION["registerNurse"]["per_old_address"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt">
                                        <div class="text-section-heading-3">ที่อยู่ปัจจุบัน
                                            <small><?php echo $_SESSION["registerNurse"]["per_address"]; ?></small>
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
                                            <small><?php echo $_SESSION["registerNurse"]["per_username"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center mt">
                                        <div class="text-section-heading-3">รหัสผ่าน
                                            <small><?php echo $_SESSION["registerNurse"]["per_password"]; ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6 text-right">
                                    <a href="registerNurseStep2.php" class="btn btn-danger btn-lg">กลับไปแก้ไข</a>
                                </div>
                                <div class="col-md-6 text-left">
                                    <button id="BtncontinuneStep3" class="btn btn-success btn-lg">สมัครสมาชิก</button>
                                </div>
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
                        url: mainURLs + "/registerNurseController.php?continuneStep3",
                        dataType: 'JSON',
                        async: false,
                        cache: false,
                        success: function (data) {

                            if(data.errorStatus)
                                window.location.href = 'registerNurseStep4.php';
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>