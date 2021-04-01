<!DOCTYPE html>
<html lang="en">

<?php include_once "include/header.php"; ?>
<!-- onload="printPage();" -->

<style>
    label {
        color: #000000;
    }

    .label-topic {
        font-size: 50px;
        font-weight: bold;
    }

    #label-vcard,
    #label-fname,
    #label-lname {
        font-size: 40px;
    }
</style>

<body>

    <section id="container">
        <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <div class="col-md-6" style="background: #fdcf66; padding: 15px; border: 1px solid #000000; border-radius: 15px;">
                    <div class="col-md-12 text-left">
                        <div class="form-group col-md-12">
                            <label class="label-topic">V-OPD</label>
                        </div>
                    </div>
                    <div class="col-md-12 text-left">
                        <div class="form-group col-md-12">
                            <label id="label-vcard">เลขบัตร : </label>
                        </div>
                    </div>
                    <div class="col-md-12 text-left">
                        <div class="form-group col-md-12">
                            <label id="label-fname">ชื่อ : </label>
                        </div>
                    </div>
                    <div class="col-md-12 text-left">
                        <div class="form-group col-md-12">
                            <label id="label-lname">นามสกุล : </label>
                        </div>
                    </div>
                </div>

            </section>
        </section><!-- /MAIN CONTENT -->

        <!--main content end-->
        <!--footer start-->

        <!--footer end-->
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <?php include_once "include/javascript.php"; ?>

    <script type="text/javascript">
        window.onload = function () {
            window.print();
        }
        $(function () {
            const p_idcard = getParameterByName('p_idcard');

            getPatientByIdCard(p_idcard);
        });

        function getPatientByIdCard(p_idcard) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?getPatientByIdCard",
                data: {
                    p_idcard: p_idcard
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    $("#label-vcard").text('เลขบัตร : ' + data[0].vopd_id);
                    $("#label-fname").text('ชื่อ : ' + data[0].p_name);
                    $("#label-lname").text('นามสกุล : ' + data[0].p_lname);
                }
            });
        }
    </script>

</body>

</html>