<?php 
if(isset($_SESSION["userBackend"]["userActivate"]) && $_SESSION["userBackend"]["userActivate"] == "0") { 
?>

<div class="row mt">
    <div class="col-lg-12">
        <div class="alert alert-danger">
            <strong>แจ้งเตือน! </strong> กรุณายืนยันตนเพื่อใช้งานระบบ
        </div>
    </div>
</div>

<?php 
}
?>

<?php 
if(isset($_SESSION["userBackend"]["userActivate"]) && $_SESSION["userBackend"]["userActivate"] == "1") { 
?>

<div class="row mt">
    <div class="col-lg-12">
        <div class="alert alert-warning">
            <strong>แจ้งเตือน! </strong> รอผู้ดูแลลระบบ Approve
        </div>
    </div>
</div>

<?php 
}
?>

<?php 
if(isset($_SESSION["userBackend"]["userActivate"]) && $_SESSION["userBackend"]["userActivate"] == "3") { 
?>

<div class="row mt">
    <div class="col-lg-12">
        <div class="alert alert-danger">
            <strong>แจ้งเตือน! </strong> คุณยืนยันตนไม่สำเร็จ กรุณายืนยันตนใหม่อีกครั้ง
        </div>
    </div>
</div>

<?php 
}
?>