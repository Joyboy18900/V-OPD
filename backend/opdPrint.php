<!DOCTYPE html>
<html lang="en">

<?php include_once "include/header.php"; ?>

<body onload="printPage();">

    <section id="container">
        <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <div class="col-md-12" style="padding-top: 15px;">
                    <div class="col-md-6 text-left">
                        <h1>V-OPD Online</h1>
                    </div>
                    <div class="col-md-6 text-right" id="op_create_date">
                    </div>
                    <div class="col-md-12 text-left" style="padding-top: 15px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td><label class="label_opd_detail" id="p_name"></label></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="label_opd_detail" id="op_cd"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="label_opd_detail" id="op_drugs_allergy"></label>
                                    </td>
                                <tr>
                                    <td>
                                        <label class="label_opd_detail" id="op_weight"></label>
                                    </td>
                                    <td>
                                        <label class="label_opd_detail" id="op_height"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="label_opd_detail" id="op_bp"></label>
                                    </td>
                                    <td>
                                        <label class="label_opd_detail" id="op_body_temp"></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-left" id="op_detail_sick" style="padding-top: 15px;">
                    </div>
                    <div class="col-md-12 text-left" id="op_dispense" style="padding-top: 50px;">
                    </div>
                    <div class="col-md-12 text-left" id="op_suggestion" style="padding-top: 50px;">
                    </div>
                </div>

            </section>
            <! --/wrapper -->
        </section><!-- /MAIN CONTENT -->

        <!--main content end-->
        <!--footer start-->

        <!--footer end-->
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <?php include_once "include/javascript.php"; ?>

    <script type="text/javascript">
        window.onload = function () {

            const booking_id = getParameterByName('booking_id');
            getOutPatientByBookingId(booking_id);
            window.print();
        }

        function getOutPatientByBookingId(booking_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?getOutPatientByBookingId",
                data: {
                    booking_id: booking_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    setinfoOpdOnce(data);
                }
            });
        }

        function setinfoOpdOnce(data) {

            $("#p_name").text(data[0].prefix_name + data[0].p_name + ' ' + data[0].p_lname);
            $("#op_cd").append("<b>โรคประจำตัว: </b>");
            $("#op_cd b").after(data[0].op_cd != null ? data[0].op_cd : " - ");
            $("#op_drugs_allergy").append("<b>แพ้ยา: </b>");
            $("#op_drugs_allergy b").after((data[0].op_drugs_allergy != null ? data[0].op_drugs_allergy : " - "));

            $("#op_weight").append('<b>น้ำหนัก: </b> ');
            $("#op_weight b").append().after('<label>' + (data[0].op_weight != null ? data[0].op_weight : " - ") + ' กิโลกลัม</label>');

            $("#op_height").append('<b>ส่วนสูง: </b> ');
            $("#op_height b").append().after('<label>' + (data[0].op_height != null ? data[0].op_height : " - ") + ' เซ็นติเมตร</label>');


            $("#op_bp").append('<b>ความดันโลหิต: </b> ');
            $("#op_bp b").append().after((data[0].op_bp != null ? data[0].op_bp : " - "));

            $("#op_body_temp").append('<b>อุณหภูมิร่างกาย: </b>');
            $("#op_body_temp").append().after('<label> ' + (data[0].op_body_temp != null ? data[0].op_body_temp : "&nbsp;&nbsp;- ") + ' องศาเซลเซียส</label>');

            $("#op_create_date").append('<h4>วันเดือนปี ' + (data[0].op_create_date != null ?
                changFormatDateToTH(data[
                    0].op_create_date) : " DD/MM/YYYY ") + '</h4>');

            $("#op_detail_sick").append(
                '<label class="label_opd_detail"><b>อาการที่มาพบแพทย์:</b> ' + (
                    data[0]
                    .op_detail_sick != null ? data[0].op_detail_sick : " - ") + '</label>');
            $("#op_dispense").append(
                '<label class="label_opd_detail"><b>ยาที่จ่ายในการตรวจ:</b> ' + (data[
                        0]
                    .op_dispense != null ? data[0].op_dispense : " - ") + ' </label>');
            $("#op_suggestion").append('<label class="label_opd_detail"><b>ข้อเสนอแนะ:</b> ' + (
                data[0]
                .op_suggestion !=
                null ? data[0].op_suggestion : " - ") + ' </label>');
        }
    </script>

</body>

</html>