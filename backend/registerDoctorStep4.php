<!DOCTYPE html>
<html lang="en">

<?php 

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
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-panel" style="padding: 24px 48px;">
                            <div class="col-lg-12 text-center text-success">
                                <i class="fa fa-check-circle-o" aria-hidden="true" style="font-size: 30rem;"></i>
                                <h1>สมัครสมาชิกเสร็จสิ้น</h1>
                            </div>
                            <div class="col-lg-12 text-center mt">
                                <a href="login.php" target="_blank" class="btn btn-info btn-lg">เข้าสู่ระบบสำหรับแพทย์</a>
                            </div>
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

</body>

</html>