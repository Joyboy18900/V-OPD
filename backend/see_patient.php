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
                    <div class="col-md-12">
                        <div class="text-section-heading-1">ข้อมูลคนไข้ขอพบ
                            <small>รายการข้อมูลคนไข้</small>
                        </div>
                        <div class="content-panel" style="padding: 15px;">
                            <table id="tablePatient" class="table table-striped table-advance table-hover">
                                <thead>
                                    <!-- class = hidden-phone -->
                                    <tr>
                                        <th class="text-center"><i class="fa fa-bullhorn"></i> ชื่อ - นามสกุล</th>
                                        <th class="text-center"><i class="fa fa-question-circle"></i> เพศ</th>
                                        <th class="text-center"><i class="fa fa-bookmark"></i> อายุ</th>
                                        <th class="text-center"><i class="fa fa-bookmark"></i> อาการป่วย</th>
                                        <th class="text-center"><i class="fa fa-bookmark"></i> สถานะ</th>
                                        <th class="text-center"><i class="fa fa-edit"></i> Status</th>
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
            $("#tablePatient").DataTable({
                searching: false,
                ordering: false
            });
        });

        function getPatient() {

            $.ajax({
                type: "POST",
                url: mainURLs + "/bookingController.php?readBookingFilterDoctor",
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    setTable(data);
                }
            });
        }

        function setTable(data) {

            if (data.length > 0) {

                $("#tablePatient tbody").empty();

                for (var i = 0; i < data.length; i++) {

                    if (data[i].op_status == 0) {
                        $('#tablePatient tbody').append(
                            '<tr class=' + (i != 0 ? "danger" : "") + '>' +
                            '<td class="text-center"> ' + data[i].prefix_name + data[i].p_name + ' ' + data[i]
                            .p_lname + ' </td>' +
                            '<td class="text-center">ชาย</td>' +
                            '<td class="text-center"> ' + getAge(data[i].p_birthday) + ' ปี</td>' +
                            '<td class="text-center"> ' + data[i].op_detail_sick + ' </td>' +
                            '<td class="text-center"><span class="label label-primary">ปกติ</span></td>' +
                            '<td class="text-center">' +
                            '<button class="btn btn-success btn-xs" ' + (i != 0 ? "disabled" : "") +
                            ' onclick="AppovePatient(' + data[i].booking_id + ',\'' + data[i].room_id + '\'' +
                            ');"> <i class="fa fa-check"> </i></button> ' +
                            '</td>' +
                            '</tr>'
                        );
                    }

                    if (data[i].op_status == 1) {
                        $('#tablePatient tbody').append(
                            '<tr class=' + (i != 0 ? "danger" : "") + '>' +
                            '<td class="text-center"> ' + data[i].prefix_name + data[i].p_name + ' ' + data[i]
                            .p_lname + ' </td>' +
                            '<td class="text-center">ชาย</td>' +
                            '<td class="text-center"> ' + getAge(data[i].p_birthday) + ' ปี</td>' +
                            '<td class="text-center"> ' + data[i].op_detail_sick + ' </td>' +
                            '<td class="text-center"><span class="label label-success">แพทย์นัด</span></td>' +
                            '<td class="text-center">' +
                            '<button class="btn btn-success btn-xs" ' + (i != 0 ? "disabled" : "") +
                            ' onclick="AppovePatient(' + data[i].booking_id + ',\'' + data[i].room_id + '\'' +
                            ');"> <i class="fa fa-check"> </i></button> ' +
                            '</td>' +
                            '</tr>'
                        );
                    }
                }
            }
        }

        function AppovePatient(booking_id, room_id) {

            swal({
                    title: "คุณต้องการอนุมัติรายการนี้ ?",
                    icon: "warning",
                    buttons: {
                        cancel: "ยกเลิก",
                        confirm: "อนุมัติ"
                    },
                })
                .then((willDelete) => {

                    if (willDelete) {
                        approveBooking(booking_id, room_id);
                    }
                });
        }

        function approveBooking(booking_id, room_id) {

            $.ajax({
                type: "POST",
                url: mainURLs + "/bookingController.php?ApproveBooking",
                data: {
                    booking_id: booking_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    if (data.errorStatus) {

                        window.open("contactBooking.php?room_id=" + room_id + "&booking_id=" + booking_id +
                            "&contactPatient", '_blank');
                        location.reload();
                    }

                    if (!data.errorStatus && data.errorCode == "3000") {

                        AlertUnsuccessful(data.errorMessage);
                    }
                }
            });
        }
    </script>

</body>

</html>