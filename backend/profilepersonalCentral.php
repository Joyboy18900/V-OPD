<!DOCTYPE html>
<html lang="en">

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />

<?php 

require_once "CheckSessionPc.php";
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
                        <div class="text-section-heading-1">ตั้งค่าโปรไฟล์
                            <small>กรุณาระบุข้อมูลโปรไฟล์ของคุณให้ถูกต้องครบถ้วน</small>
                        </div>
                        <form class="style-form" id="frm_edit" enctype="multipart/form-data">
                            <div class="form-panel mb">
                                <div class="form-group col-md-4 hidden">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label sr-only"></label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="per_id" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-md-offset-4 mb">
                                    <div class="col-md-12 mt">
                                        <img id="per_img_view" class="img-responsive bg-image-custom"
                                            alt="imageProfile"
                                            style="height: 250px; object-fit: cover; margin: 0 auto;">
                                    </div>
                                    <label class="col-md-12 control-label mt">รูปแพทย์</label>
                                    <div class="col-md-12">
                                        <input type="file" class="form-control" id="per_img">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4">
                                    <label
                                        class="col-md-12 col-lg-12 col-sm-12 control-label">เลขประจำตัวประชาชน</label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="per_idcard" maxlength="13"
                                            placeholder="กรุณากรอกเลขประจำตัวประชาชน" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ชื่อ</label>
                                    <div class="col-md-5">
                                        <select id="prefix_id" class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" id="per_fname"
                                            placeholder="กรุณากรอกชื่อจริง">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">นามสกุล</label>
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="per_lname"
                                            placeholder="กรุณากรอกนามสกุลจริง">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ประเภทวิชาชีพ</label>
                                    <div class="col-md-12 col-lg-12">
                                        <select id="professions_id" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">วัน/เดือน/ปีเกิด</label>
                                    <div class="col-md-7">
                                        <input type="date" class="form-control" id="per_birthday"
                                            placeholder="กรุณาเลือกวัน/เดือน/ปีเกิด">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="number" id="per_age" min="0" class="form-control" readonly>
                                            <div class="input-group-addon">ปี</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="per_tel" maxlength="10">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4">
                                    <label
                                        class="col-md-12 col-lg-12 col-sm-12 control-label">ที่อยู่ตามทะเบียนบ้าน</label>
                                    <div class="col-md-12">
                                        <textarea id="per_old_address" rows="4" class="form-control"
                                            placeholder="กรุณากรอกที่อยู่ตามทะเบียนบ้าน"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ที่อยู่ปัจจุบัน
                                        <span> &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" id="chk_old_address" value="">
                                            ที่อยู่เดียวกับทะเบียนบ้าน
                                        </span></label>
                                    <div class="col-md-12">
                                        <textarea id="per_address" rows="4" class="form-control"
                                            placeholder="กรุณากรอกที่อยู่ปัจจุบัน"></textarea>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <?php 
                                if(isset($_SESSION["userBackend"]["userActivate"]) && $_SESSION["userBackend"]["userActivate"] != "2") { 
                                ?>
                                <div class="form-group col-md-12 mt">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-success btn-lg btn-block">บันทึกข้อมูล</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <?php
                                }
                                ?>
                            </div>

                            <?php 
                            if(isset($_SESSION["userBackend"]["userActivate"]) && $_SESSION["userBackend"]["userActivate"] == "2") { 
                            ?>

                            <div class="form-panel mt">
                                <div class="form-group col-md-4 col-md-offset-4 mt">
                                    <label class="col-md-12 col-lg-12 col-sm-12 control-label">ใบประกอบวิชาชีพ</label>
                                    <div class="col-md-12 mt">
                                        <img id="per_file_profess_view" class="img-responsive bg-image-custom"
                                            alt="imageProfile"
                                            style="height: 250px; object-fit: cover; margin: 0 auto;">
                                    </div>
                                    <div class="col-md-12 mt">
                                        <input type="file" class="form-control" id="per_file_profess">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-12 mt">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-success btn-lg btn-block">บันทึกข้อมูล</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <?php 
                            }
                            ?>
                        </form>
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

            getPrefixtoSelectOption();
            getProfessionstoSelectOption();

            document.getElementById('per_img').onchange = function (evt) {

                var tgt = evt.target || window.event.srcElement,
                    files = tgt.files;

                // FileReader support
                if (FileReader && files && files.length) {
                    var fr = new FileReader();
                    fr.onload = function () {
                        document.getElementById('per_img_view').src = fr.result;
                    }
                    fr.readAsDataURL(files[0]);
                }
            }

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

            $('#per_birthday').change(function () {

                let birthDay = new Date(this.value);

                $("#per_age").val(getAge(birthDay));
            });

            fecthDoctor(per_id);

            $('#chk_old_address').change(function () {
                if (this.checked) {
                    $("#per_address").val($("#per_old_address").val());
                }
            });

            $("#frm_edit").submit(function (e) {
                e.preventDefault();

                var formData = new FormData();

                formData.append('per_id', $("#per_id").val());
                formData.append('per_idcard', $("#per_idcard").val());
                formData.append('professions_id', $("#professions_id").val());
                formData.append('prefix_id', $("#prefix_id").val());
                formData.append('per_fname', $("#per_fname").val());
                formData.append('per_lname', $("#per_lname").val());
                formData.append('per_birthday', $("#per_birthday").val());
                formData.append('per_old_address', $("#per_old_address").val());
                formData.append('per_address', $("#per_address").val());
                formData.append('per_img', $("#per_img")[0].files[0]);
                formData.append('per_file_profess', $("#per_file_profess")[0].files[0]);
                formData.append('per_tel', $("#per_tel").val());

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
                            url: mainURLs + "/pcController.php?editPc",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            dataType: "JSON",
                            success: function (data) {
                                // console.log(data);
                                if (data.errorStatus) {
                                    setValueSession($("#per_id").val());
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

            function fecthDoctor(per_id) {

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
                        $("#professions_id").val(data[0].professions_id);
                        $("#prefix_id").val(data[0].prefix_id);
                        $("#per_fname").val(data[0].per_fname);
                        $("#per_lname").val(data[0].per_lname);
                        $("#per_birthday").val(data[0].per_birthday);
                        $("#per_birthday").change();
                        $("#per_old_address").val(data[0].per_old_address);
                        $("#per_address").val(data[0].per_address);
                        $("#per_tel").val(data[0].per_tel);
                        if (!isEmpty(data[0].per_img))
                            $("#per_img_view").attr("src", "assets/img/pcImage/" + data[0].per_img);
                        if (isEmpty(data[0].per_img))
                            $("#per_img_view").attr("src", "assets/img/emptyProfile.jpg");
                        if (!isEmpty(data[0].per_file_profess))
                            $("#per_file_profess_view").attr("src", "assets/img/pcFileProfess/" + data[0].per_file_profess);
                        if (isEmpty(data[0].per_file_profess))
                            $("#per_file_profess_view").attr("src", "assets/img/emptyFile.png");
                    }
                });
            }

            function setValueSession(per_id) {

                $.ajax({
                    type: "POST",
                    url: mainURLs + "/pcController.php?setSessionValue",
                    data: {
                        per_id: per_id
                    },
                    dataType: "JSON",
                    async: false,
                    cache: false,
                    success: function (data) {
                        console.log(data);
                    }
                });
            }
        });
    </script>

</body>

</html>