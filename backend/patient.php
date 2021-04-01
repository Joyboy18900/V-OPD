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

                <div class="row mt mb">
                    <div class="col-md-12">
                        <div class="text-section-heading-1">ข้อมูลคนไข้
                            <small>รายการข้อมูลคนไข้</small>
                        </div>
                        <div class="content-panel" style="padding: 15px;">
                            <table id="tablePatient" class="table table-striped table-advance table-hover">
                                <thead>
                                    <!-- class = hidden-phone -->
                                    <tr>
                                        <th class="text-center"><i class="fa fa-address-card-o"></i> รหัสบัตร OPD</th>
                                        <th class="text-center"><i class="fa fa-user-o"></i> ชื่อผู้ใช้</th>
                                        <th class="text-center"><i class="fa fa-cog"></i> อื่นๆ</th>
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
            getPatient();
            $('#tablePatient').DataTable();
        });

        function getPatient() {

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?getPatient",
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    setTable(data);
                }
            });
        }

        function getPatientById(p_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?getPatientAndOutPatientById",
                data: {
                    p_id: p_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    setTableInfoPatient(data);
                }
            });
        }

        function getOutPatientById(p_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?getOutPatientById",
                data: {
                    p_id: p_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    setTableListOpd(data);
                }
            });
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

        function setTable(data) {

            if (data.length > 0) {

                for (var i = 0; i < data.length; i++) {

                    $('#tablePatient tbody').append(
                        '<tr>' +
                        '<td class="text-center"> ' + data[i].vopd_id + ' </td>' +
                        '<td class="text-center"> ' + data[i].prefix_name + data[i].p_name + ' ' + data[i].p_lname +
                        ' </td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-info btn-xs" onclick="info_member(' + data[i].p_id +
                        ');"><i class="fa fa-search"> </i></button> ' +
                        '<button class="btn btn-primary btn-xs" onclick="list_opd(' + data[i].p_id +
                        ');"><i class="fa fa-address-card"> </i></button> ' +
                        '<a href="patient_edit.php?p_id=' + data[i].p_id + '" class="btn btn-warning btn-xs"><i class="fa fa-pencil"> </i></a> ' +
                        '</td>' +
                        '</tr>'
                    );
                }
            }
        }

        function setTableInfoPatient(data) {

            $('#tableInfoPatient tbody').empty();

            $('#tableInfoPatient tbody').append(
                '<tr>' +
                '<td><b>เลขประจำตัวประชาชน</b></td>' +
                '<td>' + data[0].p_idcard + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>คำนำหน้า</b></td>' +
                '<td>' + data[0].prefix_name + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ชื่อ-สกุล</b></td>' +
                '<td>' + data[0].p_name + ' ' + data[0].p_lname + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>วัน/เดือน/ปีเกิด</b></td>' +
                '<td>' + data[0].p_birthday + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>อายุ</b></td>' +
                '<td>' + getAge(data[0].p_birthday) + ' ปี</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ที่อยู่ตามทะเบียนบ้าน</b></td>' +
                '<td>' + data[0].p_old_address + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ที่อยู่ปัจจุบัน</b></td>' +
                '<td>' + data[0].p_address + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>กรุ๊ปเลือด</b></td>' +
                '<td>' + data[0].p_blood + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>น้ำหนัก</b></td>' +
                '<td>' + (data[0].op_weight != null ? data[0].op_weight : "") + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ส่วนสูง</b></td>' +
                '<td>' + (data[0].op_height != null ? data[0].op_height : "") + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>โรคประจำตัว</b></td>' +
                '<td>' + (data[0].op_cd != null ? data[0].op_cd : "") + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>อาหารที่แพ้</b></td>' +
                '<td>' + (data[0].op_food_allergy != null ? data[0].op_food_allergy : "") + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td><b>ยาที่แพ้</b></td>' +
                '<td>' + (data[0].op_drugs_allergy != null ? data[0].op_drugs_allergy : "") + '</td>' +
                '</tr>'
            );
            
            $("#btnCardVOpdPrint").attr("onclick",'cardVOpdPrint(\'' + data[0].p_idcard + '\')');
        }

        function setTableListOpd(data) {

            $('#TableListOpd tbody').empty();

            $('#TableListOpd tbody').append(
                '<tr>' +
                '<td colspan="2" class="text-center">ไม่มีข้อมูลซักประวัติของผู้ใช้งาน !!</td>' +
                '</tr>'
            );

            if (data.length > 0) {

                $('#TableListOpd tbody').empty();

                for (var i = 0; i < data.length; i++) {

                    let doctor_name = (data[i].prefix_name != null ? data[i].prefix_name : "") + (data[i]
                        .doctor_fname != null ? data[i].doctor_fname : "") + (data[i].doctor_lname != null ? data[i]
                        .doctor_lname : "")

                    $('#TableListOpd tbody').append(
                        '<tr onclick="info_opd(' + data[i].op_id + ');">' +
                        '<td>' + data[i].op_create_date + '</td>' +
                        '<td>' + doctor_name + '</td>' +
                        '</tr>'
                    );
                }
            }
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
                '<td><label class="label_opd_detail">' + data[0].prefix_name + data[0].p_name + ' ' + data[0].p_lname + '</label></td>' +
                '</tr>' +
                '<tr>' +
                '<td>' +
                '<label class="label_opd_detail"><b>โรคประจำตัว:</b> ' + (data[0].op_cd != null ? data[0].op_cd : " - ") + '</label>' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' +
                '<label class="label_opd_detail"><b>แพ้ยา:</b> ' + (data[0].op_drugs_allergy != null ? data[0].op_drugs_allergy : " - ") + '</label>' +
                '</td>' +
                '<tr>' +
                '<td>' +
                '<label class="label_opd_detail"><b>น้ำหนัก:</b> ' + (data[0].op_weight != null ? data[0].op_weight : " - ") + ' <b>กิโลกลัม</b></label>' +
                '</td>' +
                '<td>' +
                '<label class="label_opd_detail"><b>ส่วนสูง:</b> ' + (data[0].op_height != null ? data[0].op_height : " - ") + ' <b>เซ็นติเมตร</b></label>' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' +
                '<label class="label_opd_detail"><b>ความดันโลหิต:</b> ' + (data[0].op_bp != null ? data[0].op_bp : " - ") + '</label>' +
                '</td>' +
                '<td>' +
                '<label class="label_opd_detail"><b>อุณหภูมิร่างกาย:</b> ' + (data[0].op_body_temp != null ? data[0].op_body_temp : " - ") + ' <b>องศาเซลเซียส</b></label>' +
                '</td>' +
                '</tr>'
            );
            
            $("#info_opd #op_create_date").append('<h4>วันเดือนปี ' + (data[0].op_create_date != null ? changFormatDateToTH(data[0].op_create_date) : " DD/MM/YYYY ") + '</h4>');
            $("#info_opd #op_detail_sick").append('<label class="label_opd_detail"><b>อาการที่มาพบแพทย์:</b> ' + (data[0].op_detail_sick != null ? data[0].op_detail_sick : " - ") + '</label>');
            $("#info_opd #op_dispense").append('<label class="label_opd_detail"><b>ยาที่จ่ายในการตรวจ:</b> ' + (data[0].op_dispense != null ? data[0].op_dispense : " - ") + ' </label>');
            $("#info_opd #op_suggestion").append('<label class="label_opd_detail"><b>ข้อเสนอแนะ:</b> ' + (data[0].op_suggestion != null ? data[0].op_suggestion : " - ") + ' </label>');
        }

        function info_member(p_id) {

            getPatientById(p_id);
            $("#info_member").modal("show");
        }

        function list_opd(p_id) {
            getOutPatientById(p_id);
            $("#list_opd").modal("show");
        }

        function info_opd(op_id) {
            getOutPatientByOpId(op_id);
            $("#info_opd").modal("show");
        }

        function cardVOpdPrint(p_idcard) {

            window.open("viewCardOpd.php?p_idcard=" + p_idcard, '_blank');
        }
    </script>

</body>

</html>