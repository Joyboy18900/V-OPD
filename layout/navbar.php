<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark probootstrap-navbar-dark">
    <div class="container">
        <!-- <a class="navbar-brand" href="index.html">Health</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#probootstrap-nav"
            aria-controls="probootstrap-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse m-2" id="probootstrap-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="index.php" class="nav-link pl-0">หน้าแรก</a></li>
                <!-- <li class="nav-item"><a href="departments.php" class="nav-link">Departments</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li> -->
                <li class="nav-item"><a href="doctorSchedule.php" class="nav-link">ตารางการทำงานของแพทย์</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        สำหรับพยาบาล
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="backend/login.php" target="_blank">เข้าสู่ระบบ</a>
                        <a class="dropdown-item" href="backend/registerNurse.php" target="_blank">สมัครสมาชิก</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        สำหรับแพทย์
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="backend/login.php" target="_blank">เข้าสู่ระบบ</a>
                        <a class="dropdown-item" href="backend/registerDoctor.php" target="_blank">สมัครสมาชิก</a>
                    </div>
                </li>

                <?php
                if(isset($_SESSION['userFontend']) || !empty($_SESSION['userFontend'])) { 
                ?>
                <li class="nav-item"><a href="profilePatient.php" class="nav-link">โปรไฟล์</a></li>
                <?php
                } 
                ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <?php 
                if(!isset($_SESSION['userFontend']) || empty($_SESSION['userFontend'])) { 
                ?>
                <a href="login.php" class="btn btn-outline-warning my-2 p-3 my-sm-0">เข้าสู่ระบบ</a>
                <?php
                } 
                if(isset($_SESSION['userFontend']) || !empty($_SESSION['userFontend'])) { 
                ?>
                <a href="logout.php" class="btn btn-outline-warning my-2 p-3 my-sm-0">ออกจากระบบ</a>
                <?php
                } 
                ?>
            </form>
        </div>
    </div>
</nav>