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
                        <div class="text-section-heading-1">ยืนยันตนพยาบาล
                            <small>ยืนยันตนเพื่อให้พยาบาลสามารถใช้งานในระบบได้อย่างเต็มประสิทธิภาพ</small>
                        </div>
                        <div class="content-panel">
                            <table id="tablePc" class="table table-striped table-advance table-hover">
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
            getPc();
        });

        function getPc() {

            var per_activate = 1;

            $.ajax({
                type: "POST",
                url: mainURLs + "/pcController.php?getPersonalCentralByStatusActivate",
                dataType: 'JSON',
                data: {
                    per_activate: per_activate
                },
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
                        '<td class="text-center"> ' + data[i].per_idcard + ' </td>' +
                        '<td class="text-center"> ' + data[i].prefix_name + data[i].per_fname + ' ' + data[i]
                        .per_lname +
                        ' </td>' +
                        '<td class="text-center"> ' + data[i].professions_name + ' </td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-success btn-xs" onclick="viewFileProfess(\'' + (!isEmpty(data[i]
                            .per_file_profess) ? data[i].per_file_profess : "emptyImage.jpg") +
                        '\');">ดูรูปวิชาชีพ</button> ' +
                        '</td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-success btn-xs" onclick="approvePc(' + data[i].per_id +
                        ');"><i class="fa fa-check"> </i></button> ' +
                        '<button class="btn btn-danger btn-xs" onclick="disApprovePc(' + data[i].per_id +
                        ');"><i class="fa fa-close"> </i></button> ' +
                        '</td>' +
                        '</tr>'
                    );
                }
            }
        }

        function approvePc(per_id) {

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
                        url: mainURLs + "/pcController.php?approvePc",
                        data: {
                            per_id: per_id
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

        function disApprovePc(per_id) {

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
                        url: mainURLs + "/pcController.php?disapprovePc",
                        data: {
                            per_id: per_id
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

        function viewFileProfess(per_file_profess) {

            if (per_file_profess.trim() == "emptyImage.jpg")
                $("#modalViewImage #viewImage").attr("src", "assets/img/emptyImage.jpg");
            if (per_file_profess.trim() != "emptyImage.jpg")
                $("#modalViewImage #viewImage").attr("src", "assets/img/pcFileProfess/" + per_file_profess);
            $("#modalViewImage").modal("show");
        }
    </script>

</body>

</html>