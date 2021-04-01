<!DOCTYPE html>
<html lang="en">

<?php 

require_once "CheckSessionDoctor.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "include/header.php"; 
include_once "modal_member.php";

?>

<style>
    #tableSchedule>tbody>tr>td {
        color: #FFFFFF;
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
        <section id="main-content">
            <section class="wrapper">
                <div class="row mt">
                    <div class="col-md-6">
                        <h3><i class="fa fa-user-o"></i> รายงานรับการตรวจคนไข้</h3>
                    </div>
                </div>

                <!-- <div class="row mt">
                    <div class="col-md-12">
                        <div class="content-panel" style="padding: 15px;">
                            <form class="form-horizontal style-form" id="frm_add">
                                <div class="form-group col-md-6">
                                    <div class="col-md-4">
                                        <label class="col-sm-12 col-sm-12 control-label">ค้นหารายชื่อแพทย์</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-control" id="txtSearch">
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div> -->
                <!-- '<h2>ไม่มีข้อมูล !</h2>' -->
                <div class="row mt">
                    <div class="col-md-12">
                        <div class="content-panel" style="padding: 15px;">
                            <table id="TableListOpd" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>วันที่ตรวจ</th>
                                        <th>คนไข้ที่รับการรักษา</th>
                                        <th>พยาบาลที่รับการตรวจ</th>
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

            const doctor_id = <?php echo $_SESSION["userBackend"]["userID"]; ?>

            getOutPatientByDoctorId(doctor_id);
        });


        function getOutPatientByDoctorId(doctor_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?getOutPatientByDoctorId",
                data: {
                    doctor_id: doctor_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    setTableListOpd(data);
                }
            });
        }

        function info_opd(op_id) {
            getOutPatientByOpId(op_id);
            $("#info_opd").modal("show");
        }

        function getOutPatientByOpId(op_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?getOutPatientByOpId",
                data: {
                    op_id: op_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    setInfoOpd(data);
                }
            });
        }

        function setInfoOpd(data) {

            $("#btnPrintOpd").attr("onclick","opdPrint(" + data[0].booking_id + ");");

            $('#info_opd #TableInfoOpd tbody').empty();
            $("#info_opd #op_create_date").empty();
            $("#info_opd #op_detail_sick").empty();
            $("#info_opd #op_dispense").empty();
            $("#info_opd #op_suggestion").empty();

            $('#TableInfoOpd tbody').append(
                '<tr>' +
                '<td><label class="label_opd_detail">' + data[0].prefix_name + data[0].p_name + ' ' + data[0]
                .p_lname + '</label></td>' +
                '</tr>' +
                '<tr>' +
                '<td>' +
                '<label class="label_opd_detail"><b>โรคประจำตัว:</b> ' + (data[0].op_cd != null ? data[0].op_cd :
                    " - ") + '</label>' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' +
                '<label class="label_opd_detail"><b>แพ้ยา:</b> ' + (data[0].op_drugs_allergy != null ? data[0]
                    .op_drugs_allergy : " - ") + '</label>' +
                '</td>' +
                '<tr>' +
                '<td>' +
                '<label class="label_opd_detail"><b>น้ำหนัก:</b> ' + (data[0].op_weight != null ? data[0]
                    .op_weight : " - ") + ' <b>กิโลกลัม</b></label>' +
                '</td>' +
                '<td>' +
                '<label class="label_opd_detail"><b>ส่วนสูง:</b> ' + (data[0].op_height != null ? data[0]
                    .op_height : " - ") + ' <b>เซ็นติเมตร</b></label>' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' +
                '<label class="label_opd_detail"><b>ความดันโลหิต:</b> ' + (data[0].op_bp != null ? data[0].op_bp :
                    " - ") + '</label>' +
                '</td>' +
                '<td>' +
                '<label class="label_opd_detail"><b>อุณหภูมิร่างกาย:</b> ' + (data[0].op_body_temp != null ? data[0]
                    .op_body_temp : " - ") + ' <b>องศาเซลเซียส</b></label>' +
                '</td>' +
                '</tr>'
            );

            $("#info_opd #op_create_date").append('<h4>วันเดือนปี ' + (data[0].op_create_date != null ?
                changFormatDateToTH(data[0].op_create_date) : " DD/MM/YYYY ") + '</h4>');
            $("#info_opd #op_detail_sick").append('<label class="label_opd_detail"><b>อาการที่มาพบแพทย์:</b> ' + (data[
                0].op_detail_sick != null ? data[0].op_detail_sick : " - ") + '</label>');
            $("#info_opd #op_dispense").append('<label class="label_opd_detail"><b>ยาที่จ่ายในการตรวจ:</b> ' + (data[0]
                .op_dispense != null ? data[0].op_dispense : " - ") + ' </label>');
            $("#info_opd #op_suggestion").append('<label class="label_opd_detail"><b>ข้อเสนอแนะ:</b> ' + (data[0]
                .op_suggestion != null ? data[0].op_suggestion : " - ") + ' </label>');
        }

        function setTableListOpd(data) {

            $('#TableListOpd tbody').empty();

            $('#TableListOpd tbody').append(
                '<tr>' +
                '<td colspan="3" class="text-center">ไม่มีข้อมูลซักประวัติของผู้ใช้งาน !!</td>' +
                '</tr>'
            );

            if (data.length > 0) {

                $('#TableListOpd tbody').empty();

                for (var i = 0; i < data.length; i++) {

                    let patient = (data[i].prefix_patient != null ? data[i].prefix_patient : "") + (data[i]
                        .p_name != null ? data[i].p_name : "") + ' ' + (data[i].p_lname !=
                        null ? data[i]
                        .p_lname : "")

                    let pc_name = (data[i].prefix_pc != null ? data[i].prefix_pc : "") + (data[i]
                        .per_fname != null ? data[i].per_fname : "") + ' ' + (data[i].per_lname !=
                        null ? data[i]
                        .per_lname : "")

                    $('#TableListOpd tbody').append(
                        '<tr onclick="info_opd(' + data[i].op_id + ');">' +
                        '<td>' + data[i].op_create_date + '</td>' +
                        '<td>' + patient + '</td>' +
                        '<td>' + pc_name + '</td>' +
                        '</tr>'
                    );

                }
            }
        }
    </script>

</body>

</html>