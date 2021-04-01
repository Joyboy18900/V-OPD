<!DOCTYPE html>
<html lang="en">

<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "CheckSessionPc.php";
include_once "include/header.php"; 
include_once "modal_member.php";

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

                <!-- '<h2>ไม่มีข้อมูล !</h2>' -->
                <div class="row mt">
                    <div class="col-md-12">
                        <div class="text-section-heading-1">รายงานรับการตรวจคนไข้
                            <small></small>
                        </div>
                        <div class="content-panel" style="padding: 15px;">
                            <table id="TableListOpd" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>วันที่ตรวจ</th>
                                        <th>คนไข้ที่รับการรักษา</th>
                                        <th>แพทย์ที่รับการตรวจ</th>
                                        <th>สถานะการตรวจ</th>
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

            const per_id = <?php echo $_SESSION["userBackend"]["userID"]; ?>

            getOutPatientByPerId(per_id);
            // $('#TableListOpd').DataTable();
        });

        function getOutPatientByPerId(per_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?getOutPatientByPerId",
                data: {
                    per_id: per_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    setTableListOpd(data);
                    
                    console.log(data);
                }
            });
        }

        function setTableListOpd(data) {

            $('#TableListOpd tbody').empty();

            $('#TableListOpd tbody').append(
                '<tr>' +
                '<td colspan="3" class="text-center">ไม่มีข้อมูลซักประวัติของผู้ใช้งาน !!</td>' +
                '</tr>'
            );

            if (data.length > 0) {

                console.log(data);

                $('#TableListOpd tbody').empty();

                for (var i = 0; i < data.length; i++) {

                    let patient = (data[i].prefix_patient != null ? data[i].prefix_patient : "") + (data[i]
                        .p_name != null ? data[i].p_name : "") + ' ' + (data[i].p_lname !=
                        null ? data[i]
                        .p_lname : "")

                    let doctor_name = (data[i].prefix_doctor != null ? data[i].prefix_doctor : "") + (data[i]
                        .doctor_fname != null ? data[i].doctor_fname : "") + ' ' + (data[i]
                        .doctor_lname !=
                        null ? data[i]
                        .doctor_lname : "")

                    let button_status = "";

                    if(data[i].booking_status == 1) {
                        button_status = " <a href='contactBooking.php?room_id=" + data[i].room_id +
                                        "&booking_id=" + data[i].booking_id +
                                        "&contactDoctor' class='btn btn-warning' target='_blank'>รอตรวจ</a>";
                    }

                    if(data[i].booking_status == 2) {
                        button_status = " <a href='#' class='btn btn-success' disabled>ตรวจเสร็จแล้ว</button>";
                    }

                    $('#TableListOpd tbody').append(
                        '<tr>' +
                        '<td>' + data[i].op_create_date + '</td>' +
                        '<td>' + patient + '</td>' +
                        '<td>' + doctor_name + '</td>' +
                        '<td>' +
                        '<button class="btn btn-info" onclick="info_opd(' + data[i].op_id + ');">ข้อมูล OPD</button> ' + 
                        button_status + 
                        '</td>' + 
                        '</tr>'
                    );
                }
            }
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
                '<td><label class="label_opd_detail">' + data[0].prefix_name + data[0].p_name + ' ' +
                data[0]
                .p_lname + '</label></td>' +
                '</tr>' +
                '<tr>' +
                '<td>' +
                '<label class="label_opd_detail"><b>โรคประจำตัว:</b> ' + (data[0].op_cd != null ? data[
                        0].op_cd :
                    " - ") + '</label>' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' +
                '<label class="label_opd_detail"><b>แพ้ยา:</b> ' + (data[0].op_drugs_allergy != null ?
                    data[0]
                    .op_drugs_allergy : " - ") + '</label>' +
                '</td>' +
                '<tr>' +
                '<td>' +
                '<label class="label_opd_detail"><b>น้ำหนัก:</b> ' + (data[0].op_weight != null ? data[
                        0]
                    .op_weight : " - ") + ' <b>กิโลกลัม</b></label>' +
                '</td>' +
                '<td>' +
                '<label class="label_opd_detail"><b>ส่วนสูง:</b> ' + (data[0].op_height != null ? data[
                        0]
                    .op_height : " - ") + ' <b>เซ็นติเมตร</b></label>' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' +
                '<label class="label_opd_detail"><b>ความดันโลหิต:</b> ' + (data[0].op_bp != null ? data[
                        0].op_bp :
                    " - ") + '</label>' +
                '</td>' +
                '<td>' +
                '<label class="label_opd_detail"><b>อุณหภูมิร่างกาย:</b> ' + (data[0].op_body_temp !=
                    null ? data[0]
                    .op_body_temp : " - ") + ' <b>องศาเซลเซียส</b></label>' +
                '</td>' +
                '</tr>'
            );

            $("#info_opd #op_create_date").append('<h4>วันเดือนปี ' + (data[0].op_create_date != null ?
                changFormatDateToTH(data[0].op_create_date) : " DD/MM/YYYY ") + '</h4>');
            $("#info_opd #op_detail_sick").append(
                '<label class="label_opd_detail"><b>อาการที่มาพบแพทย์:</b> ' + (data[
                    0].op_detail_sick != null ? data[0].op_detail_sick : " - ") + '</label>');
            $("#info_opd #op_dispense").append(
                '<label class="label_opd_detail"><b>ยาที่จ่ายในการตรวจ:</b> ' + (data[0]
                    .op_dispense != null ? data[0].op_dispense : " - ") + ' </label>');
            $("#info_opd #op_suggestion").append('<label class="label_opd_detail"><b>ข้อเสนอแนะ:</b> ' + (
                data[0]
                .op_suggestion != null ? data[0].op_suggestion : " - ") + ' </label>');
        }
    </script>

</body>

</html>