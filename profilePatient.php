<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION["userFontend"]) || empty($_SESSION['userFontend']['userID']) || !array_key_exists('userID',$_SESSION['userFontend'])) {

    header("Location: backend/404_notFound.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once "include/header.php" ?>

<body>

    <?php 
    
    include_once "layout/navbar.php";
    include_once "layout/headerLogo.php";

    ?>

    <section class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <h1 class="display-4">โปรไฟล์</h1>
                    <!-- <p class="lead text-secondary">A free bootstrap template by <a href="https://uicookies.com/" target="_blank">uicookies.com</a></p> -->
                </div>
            </div>
        </div>
    </section>

    <section class="probootstrap-services">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-6 pl-md-1 pb-5 pl-0 probootstrap-inside">
                    <h1 class="mt-4 mb-4">ข้อมูลส่วนตัว </h1>
                    <div class="row">
                        <div class="col-md-12">
                            <form id="updateProfilePatient" class="probootstrap-form">
                                <div class="form-group">
                                    <label for="p_idcard" class="sr-only">เลขประจำตัวประชาชน/หนังสือเดินทาง</label>
                                    <input type="text" class="form-control" id="p_idcard" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="p_name" class="sr-only">ชื่อ-สกุล</label>
                                    <input type="text" class="form-control" id="p_name" placeholder="ชื่อ-สกุล" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="p_birthday" class="sr-only">วัน/เดือน/ปีเกิด</label>
                                    <input type="date" class="form-control" id="p_birthday" placeholder="วัน/เดือน/ปีเกิด" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="p_old_address" class="sr-only">ที่อยู่ตามทะเบียนบ้าน</label>
                                    <textarea id="p_old_address" cols="30" rows="5" class="form-control" placeholder="ที่อยู่ตามทะเบียนบ้าน"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="p_address" class="sr-only">ที่อยู่ปัจจุบัน</label>
                                    <textarea id="p_address" cols="30" rows="5" class="form-control" placeholder="ที่อยู่ปัจจุบัน"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="บันทึกข้อมูล">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-md-5 pb-5 pl-0 probootstrap-inside">
                    <h1 class="mt-4 mb-4">เปลี่ยนรหัสผ่าน </h1>
                    <div class="row">
                        <div class="col-md-12">
                            <form id="changePasswordPatient" class="probootstrap-form">
                                <div class="form-group">
                                    <label for="p_old_password" class="sr-only">รหัสผ่านเดิม</label>
                                    <input type="password" class="form-control" id="p_old_password" placeholder="รหัสผ่านเดิม">
                                </div>
                                <div class="form-group">
                                    <label for="p_password" class="sr-only">รหัสผ่านใหม่</label>
                                    <input type="password" class="form-control" id="p_password" placeholder="รหัสผ่านใหม่">
                                </div>
                                <div class="form-group">
                                    <label for="p_password_cf" class="sr-only">ยืนยันรหัสผ่านใหม่</label>
                                    <input type="password" class="form-control" id="p_password_cf" placeholder="ยืนยันรหัสผ่านใหม่">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="บันทึกข้อมูล">
                                </div>
                            </form>
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

    <script type="text/javascript">
        
        const p_id = <?php echo $_SESSION["userFontend"]["userID"]; ?>;

        $(function () {

            getPatient();
        });

        function getPatient() {

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?getPatientById",
                data: {
                    p_id: p_id
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    console.log(data[0]);
                    $("#p_idcard").val(data[0].p_idcard);
                    $("#p_name").val(data[0].prefix_name + data[0].p_name + ' ' + data[0].p_lname);
                    $("#p_birthday").val(data[0].p_birthday);
                    $("#p_old_address").val(data[0].p_old_address);
                    $("#p_address").val(data[0].p_address);
                }
            });
        }

        $("#updateProfilePatient").submit(function (e) {
            e.preventDefault();

            var p_old_address = $('#p_old_address').val();
            var p_address = $('#p_address').val();

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?updateProfilePatient",
                data: {
                    p_id: p_id,
                    p_old_address: p_old_address,
                    p_address: p_address
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    if (data.errorStatus) {

                        // AlertSuccessful(data.errorMessage);
                        console.log(data.errorMessage);
                        location.reload();
                        return;
                    }
                    if (!data.errorStatus || !data) {
                        // AlertUnsuccessful(data.errorMessage);
                        console.log(data.errorMessage);
                        return;
                    }
                }
            });
        });

        $("#changePasswordPatient").submit(function (e) {
            e.preventDefault();

            var p_old_password = $('#p_old_password').val();
            var p_password = $('#p_password').val();
            var p_password_cf = $('#p_password_cf').val();

            if (p_password != p_password_cf) {
                alert("รหัสผ่านไม่ตรงกัน !");
                return;
            }

            $.ajax({
                type: "POST",
                url: mainURLs + "/patientController.php?changePasswordPatient",
                data: {
                    p_id: p_id,
                    p_old_password: p_old_password,
                    p_password: p_password
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (data) {

                    if (data.errorStatus) {

                        // AlertSuccessful(data.errorMessage);
                        alert(data.errorMessage);
                        location.reload();
                        return;
                    }
                    if (!data.errorStatus || !data) {
                        alert(data.errorMessage);
                        return;
                    }
                }
            });
        });
    </script>
</body>

</html>