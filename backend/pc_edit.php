<!DOCTYPE html>
<html lang="en">

<?php 

require_once "CheckSessionAdmin.php";
include_once "include/header.php"; 

?>

<body>

    <section id="container">
        <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
        <!--header start-->
        <?php include_once "layout/top_navigation.php"; ?>
        <!--header end-->

        <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
        <!--sidebar start-->
        <?php include_once "layout/slide_menu.php"; ?>
        <!--sidebar end-->

        <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="text-section-heading-1">ข้อมูลพยาบาล
                            <small>แก้ไขข้อมูลพยาบาล</small>
                        </div>
                        <div class="form-panel" style="padding: 15px;">
                            <form class="style-form" id="frm_edit" enctype="multipart/form-data">
                                <div class="form-group col-md-12 hidden">
                                    <label class="col-md-12 control-label">รหัสพยาบาล</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" required id="per_id" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">เลขประจำตัวประชาชน</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" required id="per_idcard" maxlength="13"
                                            placeholder="กรุณากรอกเลขประจำตัวประชาชน" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ชื่อ</label>
                                    <div class="col-md-5">
                                        <select id="prefix_id" class="form-control" required>
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" required id="per_fname"
                                            placeholder="กรุณากรอกชื่อจริง">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="col-md-4 col-lg-4">
                                        <label class="col-md-12 control-label">นามสกุล</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" required id="per_lname"
                                            placeholder="กรุณากรอกนามสกุลจริง">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ประเภทวิชาชีพ</label>
                                    <div class="col-md-12">
                                        <select id="professions_id" class="form-control" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">วัน/เดือน/ปีเกิด</label>
                                    <div class="col-md-7">
                                        <input type="date" class="form-control" required id="per_birthday"
                                            placeholder="กรุณาเลือกวัน/เดือน/ปีเกิด">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="number" id="per_age" min="0" class="form-control" required readonly>
                                            <div class="input-group-addon">ปี</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" required id="per_tel"
                                            placeholder="กรุณากรอกเบอร์โทรศัพท์" maxlength="10">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ที่อยู่ตามทะเบียนบ้าน</label>
                                    <div class="col-md-12">
                                        <textarea id="per_old_address" rows="4" class="form-control" required
                                            placeholder="กรุณากรอกที่อยู่ตามทะเบียนบ้าน"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ที่อยู่ปัจจุบัน <span> &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" id="chk_old_address">
                                            ที่อยู่เดียวกับทะเบียนบ้าน</span></label>
                                    <div class="col-md-12">
                                        <textarea id="per_address" rows="4" class="form-control" required
                                            placeholder="กรุณากรอกที่อยู่ปัจจุบัน"></textarea>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="hr_opd">
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">รูปพยาบาล</label>
                                    <div class="col-md-12 mt">
                                        <img id="per_img_view" class="img-responsive bg-image-custom"
                                            alt="imageProfile"
                                            style="height: 250px; object-fit: cover; margin: 0 auto;">
                                    </div>
                                    <div class="col-md-12 mt">
                                        <input type="file" class="form-control" id="per_img">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-12 control-label">ใบประกอบวิชาชีพ</label>
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
                                <div class="form-group col-md-12 text-right mt">
                                    <div class="col-md-6 text-left">
                                        <button type="submit" class="btn btn-success btn-lg">บันทึกข้อมูล</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="pc.php" class="btn btn-danger btn-lg">ยกเลิก</a>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div><!-- col-lg-12-->
                </div><!-- /row -->

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

            getPrefixtoSelectOption();
            getProfessionstoSelectOption();

            var per_id = getParameterByName('per_id');

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

            fecthPc(per_id);

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
                formData.append('per_file_profess', $("#per_file_profess")[0].files[0]);
                formData.append('per_img', $("#per_img")[0].files[0]);
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
                        $("#professions_id").val(data[0].professions_id);
                        $("#prefix_id").val(data[0].prefix_id);
                        $("#per_fname").val(data[0].per_fname);
                        $("#per_lname").val(data[0].per_lname);
                        $("#per_birthday").val(data[0].per_birthday);
                        $("#per_old_address").val(data[0].per_old_address);
                        $("#per_address").val(data[0].per_address);
                        $("#per_tel").val(data[0].per_tel);
                        $("#per_birthday").trigger("change");
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
        });
    </script>

</body>

</html>