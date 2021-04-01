<!DOCTYPE html>
<html lang="en">

<?php include_once "include/header.php" ?>

<style>
    #tableSchedule>tbody>tr>td {
        color: #FFFFFF;
    }
</style>


<body>

    <?php 
  
    include_once "layout/navbar.php";
    include_once "layout/headerLogo.php";

    ?>

    <section class="mb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-1">
                    <h1 class="display-4">ตารางการทำงานของแพทย์</h1>
                    <!-- <p class="lead text-secondary">A free bootstrap template by <a href="https://uicookies.com/" target="_blank">uicookies.com</a></p> -->
                </div>
            </div>
        </div>
    </section>

    <section class="probootstrap-services">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12 pb-3 pl-0 probootstrap-inside">
                    <div class="card">
                        <!-- <img class="card-img-top" src="holder.js/100x180/" alt=""> -->
                        <div class="card-body">
                            <form class="style-form" id="frm_add">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-12 col-sm-12 control-label">ค้นหารายชื่อแพทย์</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="txtSearch">
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="probootstrap-services">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12 pb-5 pl-0 probootstrap-inside">
                    <div class="card">
                        <!-- <img class="card-img-top" src="holder.js/100x180/" alt=""> -->
                        <div class="card-body">
                            <table id="tableSchedule" class="table table-custom text-center" cellspacing="0"
                                cellpadding="3">
                                <tbody>
                                    <tr class="color-primary">
                                        <td class="text-center"><b>Day</b></td>
                                        <td class="text-center" colspan="4"><b>8:00</b></td>
                                        <td class="text-center" colspan="4"><b>9:00</b></td>
                                        <td class="text-center" colspan="4"><b>10:00</b></td>
                                        <td class="text-center" colspan="4"><b>11:00</b></td>
                                        <td class="text-center" colspan="4"><b>12:00</b></td>
                                        <td class="text-center" colspan="4"><b>13:00</b></td>
                                        <td class="text-center" colspan="4"><b>14:00</b></td>
                                        <td class="text-center" colspan="4"><b>15:00</b></td>
                                        <td class="text-center" colspan="4"><b>16:00</b></td>
                                    </tr>
                                    <tr id="scheduleSunday">
                                    </tr>
                                    <tr id="scheduleMonday">
                                    </tr>
                                    <tr id="scheduleTuesday">
                                    </tr>
                                    <tr id="scheduleWendesday">
                                    </tr>
                                    <tr id="scheduleThuesday">
                                    </tr>
                                    <tr id="scheduleFriday">
                                    </tr>
                                    <tr id="scheduleSaturday">
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once "layout/footer.php"; ?>

    <!-- loader -->
    <div id="probootstrap-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#32609e" /></svg></div>


    <?php include_once "include/javascript.php"; ?>

    <script>
        $(function () {

            clearTableSchedule();

            $("#txtSearch").select2({
                placeholder: ' กรุณาเลือกชื่อผู้ใช้',
                ajax: {
                    url: mainURLs + "/doctorController.php?getDoctorSearch",
                    dataType: 'JSON',
                    delay: 250,
                    data: function (params) {
                        return {
                            txtSearch: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                var name;
                                var id;
                                if (typeof (item) !== "undefined") {
                                    name = (item.prefix_name +
                                        item
                                        .doctor_fname + ' ' + item
                                        .doctor_lname);
                                    id = (item.doctor_id);
                                    return {
                                        text: name,
                                        id: id
                                    }
                                } else {
                                    console.log("ไม่มีข้อมูลผู้ใช้");
                                }
                            })
                        };
                    },
                },
                escapeMarkup: function (markup) {
                    return markup;
                },
                minimumInputLength: 1
            });

            $('#txtSearch').on('change', function () {

                var doctor_id = $("#txtSearch option:selected").val();
                clearTableSchedule();
                getDcctorSearch(doctor_id);
            });

            function getDcctorSearch(doctor_id) {

                var result = {
                    1: {
                        "M": 0,
                        "A": 0
                    },
                    2: {
                        "M": 0,
                        "A": 0
                    },
                    3: {
                        "M": 0,
                        "A": 0
                    },
                    4: {
                        "M": 0,
                        "A": 0
                    },
                    5: {
                        "M": 0,
                        "A": 0
                    },
                    6: {
                        "M": 0,
                        "A": 0
                    },
                    7: {
                        "M": 0,
                        "A": 0
                    }
                };

                $.ajax({
                    type: "POST",
                    url: mainURLs + "/doctorController.php?getDoctorSchedule",
                    data: {
                        doctor_id: doctor_id
                    },
                    dataType: 'JSON',
                    async: false,
                    cache: false,
                    success: function (data) {

                        if (isEmpty(data)) {
                            // $("#tableSchedule").hide();
                            return;
                        }
                        if (!isEmpty(data)) {

                            for (var i = 0; i < data.length; i++) {

                                if (data[i]["ds_day"] == 1) {

                                    if (data[i]["ds_duration"] == 1) {

                                        result[1]["M"] = 1
                                    }
                                    if (data[i]["ds_duration"] == 2) {

                                        result[1]["A"] = 1
                                    }
                                }
                                if (data[i]["ds_day"] == 2) {

                                    if (data[i]["ds_duration"] == 1) {
                                        result[2]["M"] = 1
                                    }
                                    if (data[i]["ds_duration"] == 2) {
                                        result[2]["A"] = 1
                                    }
                                }
                                if (data[i]["ds_day"] == 3) {
                                    if (data[i]["ds_duration"] == 1) {
                                        result[3]["M"] = 1
                                    }
                                    if (data[i]["ds_duration"] == 2) {
                                        result[3]["A"] = 1
                                    }
                                }
                                if (data[i]["ds_day"] == 4) {
                                    if (data[i]["ds_duration"] == 1) {
                                        result[4]["M"] = 1
                                    }
                                    if (data[i]["ds_duration"] == 2) {
                                        result[4]["A"] = 1
                                    }
                                }
                                if (data[i]["ds_day"] == 5) {
                                    if (data[i]["ds_duration"] == 1) {
                                        result[5]["M"] = 1
                                    }
                                    if (data[i]["ds_duration"] == 2) {
                                        result[5]["A"] = 1
                                    }
                                }
                                if (data[i]["ds_day"] == 6) {
                                    if (data[i]["ds_duration"] == 1) {
                                        result[6]["M"] = 1
                                    }
                                    if (data[i]["ds_duration"] == 2) {
                                        result[6]["A"] = 1
                                    }
                                }
                                if (data[i]["ds_day"] == 7) {
                                    if (data[i]["ds_duration"] == 1) {
                                        result[7]["M"] = 1
                                    }
                                    if (data[i]["ds_duration"] == 2) {
                                        result[7]["A"] = 1
                                    }
                                }
                            }

                            setTableSchedule(result);
                        }
                    }
                });
            }

            function setTableSchedule(data) {

                if (data[1]["M"] == 1) {

                    $("#scheduleMonday .day").next().detach();
                    $("#scheduleMonday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงเช้า</tbody>' +
                        '</table>' +
                        '</td>' +
                        '<td colspan="4">&nbsp;</td>'
                    );
                }
                if (data[1]["A"] == 1) {

                    $("#scheduleMonday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงบ่าย</tbody>' +
                        '</table>' +
                        '</td>'
                    );
                }
                if (data[2]["M"] == 1) {

                    $("#scheduleTuesday .day").next().detach();
                    $("#scheduleTuesday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงเช้า</tbody>' +
                        '</table>' +
                        '</td>' +
                        '<td colspan="4">&nbsp;</td>'
                    );
                }
                if (data[2]["A"] == 1) {

                    $("#scheduleTuesday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงบ่าย</tbody>' +
                        '</table>' +
                        '</td>'
                    );
                }
                if (data[3]["M"] == 1) {

                    $("#scheduleWendesday .day").next().detach();
                    $("#scheduleWendesday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงเช้า</tbody>' +
                        '</table>' +
                        '</td>' +
                        '<td colspan="4">&nbsp;</td>'
                    );
                }
                if (data[3]["A"] == 1) {

                    $("#scheduleWendesday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงบ่าย</tbody>' +
                        '</table>' +
                        '</td>'
                    );
                }
                if (data[4]["M"] == 1) {

                    $("#scheduleThuesday .day").next().detach();
                    $("#scheduleThuesday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงเช้า</tbody>' +
                        '</table>' +
                        '</td>' +
                        '<td colspan="4">&nbsp;</td>'
                    );
                }
                if (data[4]["A"] == 1) {

                    $("#scheduleThuesday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงบ่าย</tbody>' +
                        '</table>' +
                        '</td>'
                    );
                }
                if (data[5]["M"] == 1) {

                    $("#scheduleFriday .day").next().detach();
                    $("#scheduleFriday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงเช้า</tbody>' +
                        '</table>' +
                        '</td>' +
                        '<td colspan="4">&nbsp;</td>'
                    );
                }
                if (data[5]["A"] == 1) {

                    $("#scheduleFriday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงบ่าย</tbody>' +
                        '</table>' +
                        '</td>'
                    );
                }
                if (data[6]["M"] == 1) {

                    $("#scheduleSaturday .day").next().detach();
                    $("#scheduleSaturday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงเช้า</tbody>' +
                        '</table>' +
                        '</td>' +
                        '<td colspan="4">&nbsp;</td>'
                    );
                }
                if (data[6]["A"] == 1) {

                    $("#scheduleSaturday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงบ่าย</tbody>' +
                        '</table>' +
                        '</td>'
                    );
                }
                if (data[7]["M"] == 1) {

                    $("#scheduleSunday .day").next().detach();
                    $("#scheduleSunday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงเช้า</tbody>' +
                        '</table>' +
                        '</td>' +
                        '<td colspan="4">&nbsp;</td>'
                    );
                }
                if (data[7]["A"] == 1) {

                    $("#scheduleSunday").append(
                        '<td colspan="16" height="50px" class="color-second">' +
                        '<table width="100%">' +
                        '<tbody>เข้างานช่วงบ่าย</tbody>' +
                        '</table>' +
                        '</td>'
                    );
                }
            }

            function clearTableSchedule() {

                $("#tableSchedule").show();

                $("#scheduleSunday").empty();
                $("#scheduleSunday").append(
                    '<td class="color-primary text-center day" height="50px" rowspan="1"><b>SUN</b></td> ' +
                    '<td colspan="20">&nbsp;</td>'
                );
                $("#scheduleMonday").empty();
                $("#scheduleMonday").append(
                    '<td class="color-primary text-center day" height="50px" rowspan="1"><b>M</b></td> ' +
                    '<td colspan="20">&nbsp;</td>'
                );
                $("#scheduleTuesday").empty();
                $("#scheduleTuesday").append(
                    '<td class="color-primary text-center day" height="50px" rowspan="1"><b>T</b></td> ' +
                    '<td colspan="20">&nbsp;</td>'
                );
                $("#scheduleWendesday").empty();
                $("#scheduleWendesday").append(
                    '<td class="color-primary text-center day" height="50px" rowspan="1"><b>W</b></td> ' +
                    '<td colspan="20">&nbsp;</td>'
                );
                $("#scheduleThuesday").empty();
                $("#scheduleThuesday").append(
                    '<td class="color-primary text-center day" height="50px" rowspan="1"><b>H</b></td> ' +
                    '<td colspan="20">&nbsp;</td>'
                );
                $("#scheduleFriday").empty();
                $("#scheduleFriday").append(
                    '<td class="color-primary text-center day" height="50px" rowspan="1"><b>F</b></td> ' +
                    '<td colspan="20">&nbsp;</td>'
                );
                $("#scheduleSaturday").empty();
                $("#scheduleSaturday").append(
                    '<td class="color-primary text-center day" height="50px" rowspan="1"><b>SAT</b></td> ' +
                    '<td colspan="20">&nbsp;</td>'
                );
            }
        });
    </script>

</body>

</html>