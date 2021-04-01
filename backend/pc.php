<!DOCTYPE html>
<html lang="en">

<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "CheckSessionAdmin.php";
include_once "include/header.php"; 
include_once "modalPc.php";

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
        <!-- Image loader -->
        <section id="main-content">
            <section class="wrapper">

                <div class="row mt mb">
                    <div class="col-md-12">
                        <div class="text-section-heading-1">ข้อมูลพยาบาล
                            <small>รายการข้อมูลพยาบาล</small>
                        </div>
                        <div class="content-panel" style="padding: 15px;">
                            <table id="tablePc" class="table table-striped table-advance table-hover">
                                <thead>
                                    <!-- class = hidden-phone -->
                                    <tr>
                                        <th class="text-center"><i class="fa fa-bullhorn"></i> รหัสผู้ใช้</th>
                                        <th class="text-center"><i class="fa fa-question-circle"></i> ชื่อ-สกุล</th>
                                        <th class="text-center"><i class="fa fa-bookmark"></i> ชื่อวิชาชีพ</th>
                                        <th class="text-center"><i class="fa fa-edit"></i> จัดการ</th>
                                        <th class="text-center"></i> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div><!-- /content-panel -->
                    </div><!-- /col-md-12 -->
                </div><!-- /row -->

            </section>
        </section>

        <!--main content end-->

        <!--footer start-->
        <?php include_once "layout/footer.php"; ?>
        <!--footer end-->
    </section>

    <?php 
    
    include_once "include/javascript.php"; 

    ?>

    <script>
        $(function () {
            getPc();
            $('#tablePc').DataTable();
        });

        function getPc() {

            $.ajax({
                type: "POST",
                url: mainURLs + "/pcController.php?getPersonalCentral",
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    $('#tablePc tbody').empty();
                    setTable(data);
                }
            });
        }

        function setTable(data) {

            if (data.length > 0) {

                for (var i = 0; i < data.length; i++) {

                    $('#tablePc tbody').append(
                        '<tr class="' + (data[i].per_status == 3 ? "danger" : "") + '">' +
                        '<td class="text-center"> ' + data[i].per_id + ' </td>' +
                        '<td class="text-center"> ' + data[i].prefix_name + data[i].per_fname + ' ' + data[i]
                        .per_lname +
                        ' </td>' +
                        '<td class="text-center"> ' + data[i].professions_name + ' </td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-info btn-xs" onclick="infoPc(' + data[i].per_id +
                        ');"><i class="fa fa-search"> </i></button> ' +
                        '<a href="pc_edit.php?per_id=' + data[i].per_id +
                        '" class="btn btn-warning btn-xs"><i class="fa fa-pencil"> </i></a> ' +
                        '</td>' +
                        '<td>' +
                        '<input type="checkbox" id="switch' + data[i].per_id +
                        '" class="switch" onclick="switchActive(' + data[i].per_id +
                        ')" ' + (data[i].per_status == 0 | data[i].per_status == 1 ? 'checked=""' : "") +
                        ' data-toggle="switch" />' +
                        '</td>' +
                        '</tr>'
                    );
                }
            }
        }

        function infoPc(per_id) {

            getPcById(per_id);
            $("#infoPc").modal("show");
        }

        function getPcById(per_id) {

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
                    setTableInfoPc(data);
                }
            });
        }

        function setTableInfoPc(data) {

            $('#tableInfoPc tbody').empty();

            $("#per_id").val(data[0].per_id);

            $('#tableInfoPc tbody').append(
                '<tr>' +
                '<td><b>เลขประจำตัวประชาชน</b></td>' +
                '<td>' + data[0].per_idcard + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>คำนำหน้า</b></td>' +
                '<td>' + data[0].prefix_name + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ชื่อ-สกุล</b></td>' +
                '<td>' + data[0].per_fname + ' ' + data[0].per_lname + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>วัน/เดือน/ปีเกิด</b></td>' +
                '<td>' + data[0].per_birthday + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>อายุ</b></td>' +
                '<td>' + getAge(data[0].per_birthday) + ' ปี</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ที่อยู่ตามทะเบียนบ้าน</b></td>' +
                '<td>' + data[0].per_old_address + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ที่อยู่ปัจจุบัน</b></td>' +
                '<td>' + data[0].per_address + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ประเภทวิชาชีพ</b></td>' +
                '<td>' + data[0].professions_name + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ชื่อผู้ใช้งาน</b></td>' +
                '<td>' + data[0].per_username + '</td>' +
                '</tr>'
            );
        }

        $("#changePasswordPc").submit(function (e) {
            e.preventDefault();

            var per_id = $("#tableChangePasswordPc #per_id").val();
            var per_password = $('#per_password').val();
            var per_password_cf = $('#per_password_cf').val();

            if (per_password != per_password_cf) {
                AlertUnsuccessful("รหัสผ่านไม่ตรงกัน !", 1);
                return;
            }

            $.ajax({
                type: "POST",
                url: mainURLs + "/pcController.php?changePasswordPc",
                data: {
                    per_id: per_id,
                    per_password: per_password
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {
                    if (data.errorStatus) {

                        AlertSuccessful(data.errorMessage, 1);
                        $('#per_password').val("");
                        $('#per_password_cf').val("");
                        return;
                    }
                    if (!data.errorStatus || !data) {
                        AlertUnsuccessful(data.errorMessage, 1);
                        return;
                    }
                }
            });
        });

        function switchActive(per_id) {

            if ($("#switch" + per_id).prop('checked')) {
                enablePc(per_id);
            }
            if (!$("#switch" + per_id).prop('checked')) {
                disablePc(per_id);
            }

            getPc();
        }

        function enablePc(per_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/pcController.php?enablePc",
                data: {
                    per_id: per_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {
                    console.log(data);
                }
            });
        }

        function disablePc(per_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/pcController.php?disablePc",
                data: {
                    per_id: per_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {
                    console.log(data);
                }
            });
        }
    </script>

</body>

</html>