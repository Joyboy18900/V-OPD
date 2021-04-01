const currentUrl = new URLSearchParams(window.location.search); 

const mainURLs = "backend";

$(function () {

    // Set Active in Top navigation
    $('.nav-item a[href^="' + location.pathname.split("/")[2] + '"]').addClass('active');

});

// // แจ้งเคือน Success
// function AlertSuccessful(text, role = null) {
//     swal({
//         title: "แจ้งเตือน!",
//         text: text,
//         icon: "success",
//         buttons: {
//             confirm: "ตกลง"
//         }
//     }).then((willDelete) => {
//         if (willDelete) {
//             if(role == 1)
//                 return;
//             if(role == null)
//                 location.reload();
//         }
//     });
// }

// // แจ้งเคือน UnSuccess
// function AlertUnsuccessful(text) {
//     swal({
//         title: "แจ้งเตือน!",
//         text: text,
//         icon: "warning",
//         buttons: {
//             confirm: "ตกลง"
//         },
//         dangerMode: true
//     }).then((willDelete) => {
//         if (willDelete) {
//             location.reload();
//         }
//     });
// }

// const AlertConfirm = (text) => {
//     swal({
//         title: "แจ้งเตือน!",
//         text: text,
//         icon: "success",
//         buttons: {
//             confirm: "ตกลง",
//             cancel: "ยกเลิก"
//         }
//     }).then((willDelete) => {
//         if (willDelete) {

//             return true;
//         } else {

//             return false;
//         }
//     });
// }


// function AlertDelete() {
//     swal({
//             title: "คุณต้องการลบข้อมูล ?",
//             text: "คุณมั่นใจว่าต้องการลบข้อมูลนี้จริงๆใช่ไหมหรือไม่ ?",
//             icon: "warning",
//             buttons: {
//                 cancel: "ยกเลิก",
//                 confirm: "ลบ"
//             },
//             dangerMode: true,
//         })
//         .then((willDelete) => {
//             if (willDelete) {
//                 swal("ลบข้อมูลสำเร็จ !", {
//                     icon: "success",
//                 });
//             }
//             // else {
//             //     swal("Your imaginary file is safe!");
//             // }
//         });
// }

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