<!DOCTYPE html>
<html lang="en">

<?php include_once "include/header.php"; ?>

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
                            <small>กรุณาระบุข้อมูลยืนยันของคุณให้ถูกต้องครบถ้วน</small></div>
                        <div class="form-panel">
                            <form class="style-form" id="frm_verify" enctype="multipart/form-data">
                                <div class="form-group col-md-4 hidden">
                                    <label
                                        class="col-md-12 col-lg-12 col-sm-12 control-label sr-only"></label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="per_id" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 hidden">
                                    <label
                                        class="col-md-12 col-lg-12 col-sm-12 control-label sr-only"></label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="per_idcard" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-offset-3 col-md-6 mt">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ใบประกอบวิชาชีพ</label>
                                    <div class="col-md-12 mt">
                                        <img id="per_file_profess_view" class="img-responsive bg-image-custom"
                                            alt="imageProfile"
                                            style="height: 250px; object-fit: cover; margin: 0 auto;">
                                    </div>
                                    <div class="col-md-12 mt">
                                        <input type="file" class="form-control" id="per_file_profess" required>
                                    </div>
                                </div>
                                <div class="clearfix mt"></div>
                                <div class="form-group col-md-12 mt">
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

            // var per_id = getParameterByName('per_id');
            var per_id = <?php echo $_SESSION["userBackend"]["userID"]; ?>;

            document.getElementById('per_file_profess').onchange = function (evt) {

                var tgt = evt.target || window.event.srcElement,
                    files = tgt.files;

                // FileReader support
                if (FileReader && files && files.length) {
                    var fr = new FileReader();
                    fr.onload = function () {
                        document.getElementById('per_file_profess_view').src = fr.result;
                    }
                    fr.readAsDataURL(files[0]);
                }
            }

            fecthPc(per_id);

            $("#frm_verify").submit(function (e) {
                e.preventDefault();

                var formData = new FormData();

                formData.append('per_id', $("#per_id").val());
                formData.append('per_idcard', $("#per_idcard").val());
                formData.append('per_file_profess', $("#per_file_profess")[0].files[0]);

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
                            url: mainURLs + "/pcController.php?verifyPc",
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

            function fecthPc(per_id) {

                $.ajax({
                    type: "POST",
                    url: mainURLs + "/pcController.php?getPersonalCentralByPerId",
                    data: {
                        per_id: per_id
                    },
                    dataType: 'JSON',
                    async: false,
                    cache: false,
                    success: function (data) {

                        $("#per_id").val(data[0].per_id);
                        $("#per_idcard").val(data[0].per_idcard);
                        if (!isEmpty(data[0].per_file_profess))
                            $("#per_file_profess_view").attr("src", "assets/img/pcFileProfess/" + data[0].per_file_profess);
                        if (isEmpty(data[0].per_file_profess))
                            $("#per_file_profess_view").attr("src", "assets/img/emptyFile.png");
                    }
                });
            }
        });
    </script>

</body>

</html>