<!DOCTYPE html>
<html lang="en">

<?php 

include_once "include/header.php"; 

?>

<body>

    <section id="container">
        <!--header start-->
        <header class="header custom-bg">
            <!--logo start-->
            <a href="index.php" class="logo"><b>ลงทะเบียนพยาบาล : Virtual Out Patient Department Online | V-OPD</b></a>
            <!--logo end-->
        </header>
        <!--header end-->
        <!--main content start-->
        <section id="main-content" style="margin-left: 0px;">
            <section class="wrapper">

                <div class="row mt mb">
                    <div class="col-lg-12">
                        <div class="form-panel" style="padding: 24px 48px;">
                            <div class="col-lg-12 text-center text-success">
                                <i class="fa fa-check-circle-o" aria-hidden="true" style="font-size: 30rem;"></i>
                                <h1>สมัครสมาชิกเสร็จสิ้น</h1>
                            </div>
                            <div class="col-lg-12 text-center mt">
                                <a href="login.php" target="_blank" class="btn btn-info btn-lg">เข้าสู่ระบบสำหรับพยาบาล</a>
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