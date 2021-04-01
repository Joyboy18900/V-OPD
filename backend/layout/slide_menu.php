<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

        <?php
        
        if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] != "3") {

            if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "1") {
        ?>
            <p class="centered">
                <a href="profile.php">
                    <img src="assets/img/pcImage/<?php echo $_SESSION["userBackend"]["userImg"]; ?>" class="img-circle"
                        width="60">
                </a>
            </p>

            <?php 
            }

            if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "2") {
            
            ?>

            <p class="centered">
                <a href="profile.php">
                    <img src="assets/img/doctorImage/<?php echo $_SESSION["userBackend"]["userImg"]; ?>" class="img-circle"
                        width="60">
                </a>
            </p>

            <?php 
            }
            ?>
            
            <h5 class="centered">
                <?php echo (isset($_SESSION["userBackend"]["userFullname"])) ? $_SESSION["userBackend"]["userFullname"] : ""; ?>
            </h5>

            <?php
        }
            if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] != "1") { 
            ?>

            <li class="mt">
                <a class="" href="index.php">
                    <i class="fa fa-indent"></i>
                    <span class="bold">หน้าแรก</span>
                </a>
            </li>

            <?php 
            }
            ?>

            <?php 
            if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "1") { 

                if(isset($_SESSION["userBackend"]["userActivate"]) && $_SESSION["userBackend"]["userActivate"] != "2") { 
                ?>
                
                    <li class="sub-menu">
                        <a href="verifyPc.php">
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                            <span class="bold">ยืนยันตน</span>
                        </a>
                    </li>
                
                <?php 
                }

                if(isset($_SESSION["userBackend"]["userActivate"]) && $_SESSION["userBackend"]["userActivate"] == "2") { 
                ?>

                    <li class="sub-menu">
                        <a href="javascript:;" class="sub-link">
                            <i class="fa fa-address-book"></i>
                            <span class="bold">ข้อมูลคนไข้</span>
                        </a>
                        <ul class="sub">
                            <li><a href="patient.php">ข้อมูลคนไข้</a></li>
                            <li><a href="patient_add.php">เพิ่มข้อมูลคนไข้</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;" class="sub-link">
                            <i class="fa fa-user-md"></i>
                            <span class="bold">พบแพทย์</span>
                        </a>
                        <ul class="sub">
                            <li><a href="see_doctor.php">ปกติ</a></li>
                            <li><a href="doctor_appoint.php">แพทย์นัด</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="doctorSchedule.php" class="sub-link">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span class="bold">วันเวลาทำงานแพทย์</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="reportPatientByPersonal.php" class="sub-link">
                            <i class="fa fa-table" aria-hidden="true"></i>
                            <span class="bold">รายงานรับการตรวจคนไข้</span>
                        </a>
                    </li>

                <?php 
                }
                ?>

            <?php 
            }
            ?>

            <?php 
            if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "2") { 

                if(isset($_SESSION["userBackend"]["userActivate"]) && $_SESSION["userBackend"]["userActivate"] != "2") { 
                ?>
                
                    <li class="sub-menu">
                        <a href="verifyDoctor.php">
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                            <span class="bold">ยืนยันตน</span>
                        </a>
                    </li>
                
                <?php 
                }

                if(isset($_SESSION["userBackend"]["userActivate"]) && $_SESSION["userBackend"]["userActivate"] == "2") { 
                ?>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-desktop"></i>
                            <span class="bold">พบคนไข้</span>
                        </a>
                        <ul class="sub">
                            <li><a href="see_patient.php">รายการคนไข้ขอพบ</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="doctorAddSchedule.php">
                            <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                            <span class="bold">เพิ่มวันเวลาการทำงาน</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="reportPatientByDoctor.php" class="sub-link">
                            <i class="fa fa-table" aria-hidden="true"></i>
                            <span class="bold">รายงานรับการตรวจคนไข้</span>
                        </a>
                    </li>

                <?php 
                }
                ?>

            <?php 
            }
            ?>

            <?php 
            if(isset($_SESSION["userBackend"]["userRole"]) && $_SESSION["userBackend"]["userRole"] == "3") { 
            ?>

            <li class="sub-menu">
                <a href="javascript:;" class="sub-link">
                    <i class="fa fa-address-book"></i>
                    <span class="bold">ข้อมูลผู้แพทย์</span>
                </a>
                <ul class="sub">
                    <li><a href="doctor.php">ข้อมูลแพทย์</a></li>
                    <li><a href="approveVerifyDocter.php">ยืนยันตนแพทย์</a></li>
                    <li><a href="doctor_add.php">เพิ่มข้อมูลแพทย์</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="sub-link">
                    <i class="fa fa-address-book"></i>
                    <span class="bold">ข้อมูลพยาบาล</span>
                </a>
                <ul class="sub">
                    <li><a href="pc.php">ข้อมูลพยาบาล</a></li>
                    <li><a href="approveVerifyPc.php">ยืนยันตนพยาบาล</a></li>
                    <li><a href="pc_add.php">เพิ่มข้อมูลพยาบาล</a></li>
                </ul>
            </li>

            <?php 
            }
            ?>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>