<!DOCTYPE html>
<html lang="en">

<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "CheckSessionAdmin.php";
include_once "include/header.php"; 
include_once "modalDoctor.php";

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
                        <div class="text-section-heading-1">ข้อมูลแพทย์
                            <small>รายการข้อมูลแพทย์</small>
                        </div>
                        <div class="content-panel" style="padding: 15px;">
                            <div class="table-responsive">
                                <table id="tablePatient" class="table table-striped table-advance table-hover">
                                    <thead>
                                        <!-- class = hidden-phone -->
                                        <tr>
                                            <th class="text-center"><i class="fa fa-bullhorn"></i> รหัสผู้ใช้</th>
                                            <th class="text-center"><i class="fa fa-question-circle"></i> ชื่อผู้ใช้</th>
                                            <th class="text-center"><i class="fa fa-bookmark"></i> ชื่อวิชาชีพ</th>
                                            <th class="text-center"><i class="fa fa-edit"></i> จัดการ</th>
                                            <th class="text-center"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
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
            getDoctor();
            $('#tablePatient').DataTable();
        });

        function getDoctor() {

            $.ajax({
                type: "POST",
                url: mainURLs + "/doctorController.php?getDoctor",
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    $('#tablePatient tbody').empty();
                    setTable(data);
                }
            });
        }

        function setTable(data) {

            if (data.length > 0) {

                for (var i = 0; i < data.length; i++) {

                    $('#tablePatient tbody').append(
                        '<tr class="' + (data[i].doctor_status == 3 ? "danger" : "") + '">' +
                        '<td class="text-center"> ' + data[i].doctor_id + ' </td>' +
                        '<td class="text-center"> ' + data[i].prefix_name + data[i].doctor_fname + ' ' + data[i]
                        .doctor_lname +
                        ' </td>' +
                        '<td class="text-center"> ' + data[i].professions_name + ' </td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-info btn-xs" onclick="infoDoctor(' + data[i].doctor_id +
                        ');"><i class="fa fa-search"> </i></button> ' +
                        '<a href="doctor_edit.php?doctor_id=' + data[i].doctor_id +
                        '" class="btn btn-warning btn-xs"><i class="fa fa-pencil"> </i></a> ' +
                        '</td>' +
                        '<td>' +

                        // '<input type="checkbox" id="switch' + data[i].doctor_id +
                        // '" class="switch" onclick="switchActive(' + data[i].doctor_id +
                        // ')" ' + (data[i].doctor_status == 0 | data[i].doctor_status == 1 ? 'checked=""' : "") +
                        // ' data-toggle="switch" />' +

                        '<div class="material-switch">' + 
                        '<input type="checkbox" id="switch' + data[i].doctor_id + 
                        '" class="switch" onclick="switchActive(' + data[i].doctor_id +
                        ')" ' + (data[i].doctor_status == 0 | data[i].doctor_status == 1 ? 'checked=""' : "") + '/>' + 
                        '<label for="switch' + data[i].doctor_id + '" class="label-success"></label>' + 
                        '</div>' + 
                        
                        '</td>' +
                        '</tr>'
                    );
                }
            }
        }

        function infoDoctor(doctor_id) {

            getDoctorById(doctor_id);
            $("#infoDoctor").modal("show");
        }

        function getDoctorById(doctor_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/doctorController.php?getDoctorByDoctorID",
                data: {
                    doctor_id: doctor_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {
                    setTableInfoDoctor(data);
                }
            });
        }

        function setTableInfoDoctor(data) {

            $('#tableInfoDoctor tbody').empty();

            $("#doctor_id").val(data[0].doctor_id);

            $('#tableInfoDoctor tbody').append(
                '<tr>' +
                '<td><b>เลขประจำตัวประชาชน</b></td>' +
                '<td>' + data[0].doctor_idcard + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>คำนำหน้า</b></td>' +
                '<td>' + data[0].prefix_name + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ชื่อ-สกุล</b></td>' +
                '<td>' + data[0].doctor_fname + ' ' + data[0].doctor_lname + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>วัน/เดือน/ปีเกิด</b></td>' +
                '<td>' + data[0].doctor_birthday + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>อายุ</b></td>' +
                '<td>' + getAge(data[0].doctor_birthday) + ' ปี</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ที่อยู่ตามทะเบียนบ้าน</b></td>' +
                '<td>' + data[0].doctor_old_address + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ที่อยู่ปัจจุบัน</b></td>' +
                '<td>' + data[0].doctor_address + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ประเภทวิชาชีพ</b></td>' +
                '<td>' + data[0].professions_name + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>สังกัดโรงบาล</b></td>' +
                '<td>' + data[0].affiliation_name + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ชื่อผู้ใช้งาน</b></td>' +
                '<td>' + data[0].doctor_username + '</td>' +
                '</tr>'
            );

            $("#btnCardVOpdPrint").attr("onclick", 'cardVOpdPrint(\'' + data[0].p_idcard + '\')');
        }

        $("#changePasswordDoctor").submit(function (e) {
            e.preventDefault();

            var doctor_id = $("#tableChangePasswordDoctor #doctor_id").val();
            var doctor_password = $('#doctor_password').val();
            var doctor_password_cf = $('#doctor_password_cf').val();

            if (doctor_password != doctor_password_cf) {
                alert("รหัสผ่านไม่ตรงกัน !");
                return;
            }

            $.ajax({
                type: "POST",
                url: mainURLs + "/doctorController.php?changePasswordDoctor",
                data: {
                    doctor_id: doctor_id,
                    doctor_password: doctor_password
                },
                dataType: 'JSON',
                async: false,
                cache: false,
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
        });

        function switchActive(doctor_id) {

            if ($("#switch" + doctor_id).prop('checked')) {
                enableDoctor(doctor_id);
            }
            if (!$("#switch" + doctor_id).prop('checked')) {
                disableDoctor(doctor_id);
            }

            getDoctor();
        }

        function enableDoctor(doctor_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/doctorController.php?enableDoctor",
                data: {
                    doctor_id: doctor_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {
                    console.log(data);
                }
            });
        }

        function disableDoctor(doctor_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/doctorController.php?disableDoctor",
                data: {
                    doctor_id: doctor_id
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