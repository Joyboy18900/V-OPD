<!DOCTYPE html>
<html lang="en">

<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "CheckSessionAdmin.php";
include_once "include/header.php"; 
include_once "modalDoctor.php";
include_once "baseModal.php";

?>

<style>
    #modalViewImage #viewImage {
        margin: 0 auto;
    }
</style>

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

                <div class="row mt">
                    <div class="col-md-12">
                        <div class="text-section-heading-1">ยืนยันตนแพทย์
                            <small>ยืนยันตนเพื่อให้แพทย์สามารถใช้งานในระบบได้อย่างเต็มประสิทธิภาพ</small>
                        </div>
                        <div class="content-panel">
                            <table id="tablePatient" class="table table-striped table-advance table-hover">
                                <h4><i class="fa fa-angle-right"></i> รายการข้อมูลแพทย์</h4>
                                <hr>
                                <thead>
                                    <!-- class = hidden-phone -->
                                    <tr>
                                        <th class="text-center"><i class="fa fa-bullhorn"></i> รหัสผู้ใช้</th>
                                        <th class="text-center"><i class="fa fa-question-circle"></i> รหัสบัตรประชาชน
                                        </th>
                                        <th class="text-center"><i class="fa fa-question-circle"></i> ชื่อผู้ใช้</th>
                                        <th class="text-center"><i class="fa fa-bookmark"></i> ชื่อวิชาชีพ</th>
                                        <th class="text-center"><i class="fa fa-bookmark"></i> ไฟล์ยืนยันตน</th>
                                        <th class="text-center"><i class="fa fa-edit"></i> จัดการ</th>
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
            getDoctor();
        });

        function getDoctor() {

            var doctor_activate = 1;

            $.ajax({
                type: "POST",
                url: mainURLs + "/doctorController.php?getDoctorByStatusActivate",
                dataType: 'JSON',
                data: {
                    doctor_activate: doctor_activate
                },
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
                        '<td class="text-center"> ' + data[i].doctor_idcard + ' </td>' +
                        '<td class="text-center"> ' + data[i].prefix_name + data[i].doctor_fname + ' ' + data[i]
                        .doctor_lname +
                        ' </td>' +
                        '<td class="text-center"> ' + data[i].professions_name + ' </td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-success btn-xs" onclick="viewFileProfess(\'' + (!isEmpty(data[i]
                            .doctor_file_profess) ? data[i].doctor_file_profess : "emptyImage.jpg") +
                        '\');">ดูรูปวิชาชีพ</button> ' +
                        '<button class="btn btn-success btn-xs" onclick="viewSignature(\'' + (!isEmpty(data[i]
                            .doctor_signature) ? data[i].doctor_signature : "emptyImage.jpg") +
                        '\');">ดูรูปลายเซ็น</button> ' +
                        '</td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-success btn-xs" onclick="approveDoctor(' + data[i].doctor_id +
                        ');"><i class="fa fa-check"> </i></button> ' +
                        '<button class="btn btn-danger btn-xs" onclick="disApproveDoctor(' + data[i].doctor_id +
                        ');"><i class="fa fa-close"> </i></button> ' +
                        '</td>' +
                        '</tr>'
                    );
                }
            }
        }

        function approveDoctor(doctor_id) {

            swal({
                title: "แจ้งเตือน!",
                text: "ต้องการอนุมัติรายการนี้ใช่หรือไม่",
                icon: "warning",
                buttons: {
                    confirm: "ตกลง",
                    cancel: "ยกเลิก"
                }
            }).then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url: mainURLs + "/doctorController.php?approveDoctor",
                        data: {
                            doctor_id: doctor_id
                        },
                        dataType: 'JSON',
                        async: false,
                        cache: false,
                        success: function (data) {
                            console.log(data);
                            if (data.errorStatus)
                                location.reload();
                            if (!data.errorStatus)
                                alert('อนุมัติไม่สำเร็จ !');
                        }
                    });
                }
            });
        }

        function disApproveDoctor(doctor_id) {

            swal({
                title: "แจ้งเตือน!",
                text: "ไม่อนุมัติรายการนี้ใช่หรือไม่",
                icon: "warning",
                buttons: {
                    confirm: "ตกลง",
                    cancel: "ยกเลิก"
                }
            }).then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url: mainURLs + "/doctorController.php?disapproveDoctor",
                        data: {
                            doctor_id: doctor_id
                        },
                        dataType: 'JSON',
                        async: false,
                        cache: false,
                        success: function (data) {
                            console.log(data);
                            if (data.errorStatus)
                                location.reload();
                            if (!data.errorStatus)
                                alert('ไม่สำเร็จ !');
                        }
                    });
                }
            });
        }

        function viewFileProfess(doctor_file_profess) {

            if (doctor_file_profess.trim() == "emptyImage.jpg")
                $("#modalViewImage #viewImage").attr("src", "assets/img/emptyImage.jpg");
            if (doctor_file_profess.trim() != "emptyImage.jpg")
                $("#modalViewImage #viewImage").attr("src", "assets/img/doctorFileProfess/" + doctor_file_profess);
            $("#modalViewImage").modal("show");
        }

        function viewSignature(doctor_signature) {
            if (doctor_signature.trim() == "emptyImage.jpg")
                $("#modalViewImage #viewImage").attr("src", "assets/img/emptyImage.jpg");
            if (doctor_signature.trim() != "emptyImage.jpg")
                $("#modalViewImage #viewImage").attr("src", "assets/img/doctorSignature/" + doctor_signature);
            $("#modalViewImage").modal("show");
        }
    </script>

</body>

</html>