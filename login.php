<!DOCTYPE html>
<html lang="en">

<?php include_once "include/header.php" ?>

<body>

    <?php include_once "layout/navbar.php" ?>
    <!-- END nav -->
    <!-- <header role="banner" class="probootstrap-header py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <a href="index.php" class="mr-auto"><img src="assets/images/logo.png" width="212" height="48"
                            class="hires" alt="Free Template by uiCookies"></a>
                </div>
                <div class="col-md-9">
                    <div class="float-md-right float-none">
                        <div class="probootstrap-contact-phone d-flex align-items-top mb-3 float-left">
                            <span class="icon mr-2"><i class="icon-phone"></i></span>
                            <span class="probootstrap-text"> +900 123 456 7 <small class="d-block"><a href="#"
                                        class="arrow-link">Appointment
                                        <i class="icon-chevron-right"></i></a></small></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header> -->

    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <!-- <h5 class="card-title text-center">Sign In</h5> -->
                    <div class="card-title text-center">
                        <img src="assets/images/logo.png" width="212" height="48" class="hires" alt="Logo">
                    </div>
                    <form class="form-signin" id="frmLogin">
                        <div class="form-label-group">
                            <input type="text" id="inputUsername" class="form-control" placeholder="Username" required
                                autofocus>
                            <label for="inputUsername">ID Card</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password"
                                required>
                            <label for="inputPassword">Password</label>
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase mt-4">Sign
                            in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- loader -->
    <div id="probootstrap-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#32609e" /></svg></div>

    <?php include_once "include/javascript.php"; ?>

    <script>
        
        $("#frmLogin").submit(function (e) {
            e.preventDefault();

            var username = $("#inputUsername").val();
            var password = $("#inputPassword").val();

            $.ajax({
                type: "POST",
                url: "loginController.php?checkLogin",
                data: {
                    username: username,
                    password: password
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    if (!data.errorStatus) {
                        // AlertUnsuccessful(data.errorMessage);
                        alert(data.errorMessage);
                        return;
                    }

                    if (data.errorStatus) {
                        // AlertSuccessful(data.errorMessage, 1);
                        window.location.href = 'index.php';
                        return;
                    }
                }
            });

        });
    </script>

</body>

</html>