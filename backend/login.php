<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

  <title>เข้าสู่ระบบ : จัดการข้อมูล V-OPD</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!--external css-->
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

  <div id="login-page">
    <div class="container">

      <form id="frm_login" class="form-login">

        <h2 class="form-login-heading">เข้าใช้งานระบบ V-OPD</h2>
        <div class="login-wrap">
          <input type="text" class="form-control" id="username" placeholder="Username" required="required" autofocus>
          <br>
          <input type="password" class="form-control" id="password" placeholder="Password" required="required">
          <br>
          <select id="loginStatus" class="form-control" required="required">
            <option value="" selected disabled>กรุณาเลือกสถานะการเข้าใช้งาน</option>
            <option value="1">พยาบาล</option>
            <option value="2">แพทย์</option>
            <option value="3">ผู้ดูแลระบบ</option>
          </select>
          <br>
          <button type="submit" class="btn btn-theme btn-block"><i class="fa fa-lock"></i> เข้าสู่ระบบ</button>
          <hr>
        </div>

      </form>

    </div>
  </div>

  <?php 
    include_once "include/javascript.php"; 
  ?>

  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("assets/img/login-bg.jpg", {
      speed: 500
    });

    $(function () {

      $("#frm_login").submit(function (e) {
        e.preventDefault();

        var username = $("#username").val();
        var password = $("#password").val();
        var loginStatus = $("#loginStatus").val();

        $.ajax({
          type: "POST",
          url: mainURLs + "/loginController.php?checkLogin",
          data: {
            username: username,
            password: password,
            loginStatus: loginStatus
          },
          dataType: 'JSON',
          async: false,
          cache: false,
          success: function (data) {

            if (!data.errorStatus) {
              AlertUnsuccessful(data.errorMessage);
              return;
            }

            if (data.errorStatus) {
              AlertSuccessful(data.errorMessage, 1);
              window.location.href = 'index.php';
              return;
            }
          }
        });
        
      });

    });
  </script>


</body>

</html>