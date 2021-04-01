const currentUrl = new URLSearchParams(window.location.search);

var mainURLs = "/V-OPD/backend";

$(function () {
     // Begin Set Active in Menu
     $("#nav-accordion a").each(function () {

        if (this.href == document.URL) {

            if ($(this).parents('li').length == 2) {

                $(this).parents('li.sub-menu').find('a.sub-link').addClass('active');
                $(this).parents('li.sub-menu').find('ul.sub').css({"overflow": "hidden", "display": "block"});
                // 
            } else {
                
                $(this).addClass("active");
            }
        }
    });
    // End Set Active in Menu
 
    // Begin Set btn to Top
    $("a.go-top").click(function (e) { 
        e.preventDefault();
        
        btn_to_top();
    });
    // End Set btn to Top


    function btn_to_top() {
        $('body,html').animate({
            scrollTop : 0 
        }, 500);
    }
});

// แจ้งเคือน Success
function AlertSuccessful(text, role = null) {
    swal({
        title: "แจ้งเตือน!",
        text: text,
        icon: "success",
        buttons: {
            confirm: "ตกลง"
        }
    }).then((willDelete) => {
        if (willDelete) {
            if(role == 1)
                return;
            if(role == null)
                location.reload();
        }
    });
}

// แจ้งเคือน UnSuccess
function AlertUnsuccessful(text, role = null) {
    swal({
        title: "แจ้งเตือน!",
        text: text,
        icon: "warning",
        buttons: {
            confirm: "ตกลง"
        },
        dangerMode: true
    }).then((willDelete) => {
        if (willDelete) {
            if(role == 1)
                return;
            if(role == null)
                location.reload();
        }
    });
}

const AlertConfirm = (text) => {
    swal({
        title: "แจ้งเตือน!",
        text: text,
        icon: "success",
        buttons: {
            confirm: "ตกลง",
            cancel: "ยกเลิก"
        }
    }).then((willDelete) => {
        if (willDelete) {

            return true;
        } else {

            return false;
        }
    });
}


function AlertDelete() {
    swal({
            title: "คุณต้องการลบข้อมูล ?",
            text: "คุณมั่นใจว่าต้องการลบข้อมูลนี้จริงๆใช่ไหมหรือไม่ ?",
            icon: "warning",
            buttons: {
                cancel: "ยกเลิก",
                confirm: "ลบ"
            },
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("ลบข้อมูลสำเร็จ !", {
                    icon: "success",
                });
            }
            // else {
            //     swal("Your imaginary file is safe!");
            // }
        });
}

function getParameterByName(name, url) {

    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

function getSessionByParameter(role, param) {

    let result;

    if(role == "user") 
        result = $.session.get(param);

    return result;
}  

function opdPrint(booking_id) {
    window.open("opdPrint.php?booking_id=" + booking_id, '_blank');
}

function getRoomID() {

    var room_id = Math.random().toString(36).slice(2).substring(0, 15);

    return room_id;
}

function videoCall(room_id) {

    window.open("https://1410inc.xyz/video-call-app/comm.html?room=" + room_id, '_blank');
}

function getPrefixtoSelectOption() {

    $.ajax({
        type: "POST",
        url: mainURLs + "/prefixController.php?getPrefix",
        dataType: 'JSON',
        async: false,
        cache: false,
        success: function (data) {

            var prefix = $("#prefix_id");

            prefix.empty();

            $.each(data, function (i, item) {
                prefix.append('<option value="' + item.prefix_id + '">' + item.prefix_name + '</option>');
            });
        }
    });
}

function getProfessionstoSelectOption() {

    $.ajax({
        type: "POST",
        url: mainURLs + "/professionsController.php?getProfessions",
        dataType: 'JSON',
        async: false,
        cache: false,
        success: function (data) {

            var professions = $("#professions_id");

            professions.empty();
            professions.append('<option selected disabled value>กรุณาเลือกประเภทวิชาชีพ</option>');

            $.each(data, function (i, item) {
                professions.append('<option value="' + item.professions_id + '">' + item.professions_name + '</option>');
            });
        }
    });
}

function getAffiliationSelectOption() {

    $.ajax({
        type: "POST",
        url: mainURLs + "/affiliationController.php?getAffiliation",
        dataType: 'JSON',
        async: false,
        cache: false,
        success: function (data) {

            var affiliation = $("#affiliation_id");

            affiliation.empty();
            affiliation.append('<option selected disabled value>กรุณาเลือกสังกัด/โรงพยายาล</option>');

            $.each(data, function (i, item) {
                affiliation.append('<option value="' + item.affiliation_id + '">' + item.affiliation_name + '</option>');
            });
        }
    });
}

function isRequired(param) {

    if(!param && param == "") {
        
        alert('กรุณากรอกข้อมูลให้ครบถ้วน!');
        return false;
    }

    return true;
}

function getRatingByDoctorId(doctor_id) {

    let sum_booking_rating;
    $.ajax({
      type: "POST",
      url: mainURLs + "/bookingController.php?getCalRatingByDoctorId",
      data: {
        doctor_id: doctor_id
      },
      dataType: 'JSON',
      async: false,
      cache: false,
      success: function (data) {

        sum_booking_rating = data[0].sum_booking_rating;
      }
    });

    return sum_booking_rating;
}

function objectLength(obj) {

    var result = 0;
    for(var prop in obj) {
        if (obj.hasOwnProperty(prop)) {
            // or Object.prototype.hasOwnProperty.call(obj, prop)
            result++;
        }
    }
    return result;
}
  
function getMaxDate() {

    var today = new Date();
    var dd = today.getDate();

    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }

    return (yyyy + '-' + mm + '-' + dd).toString();
}
  