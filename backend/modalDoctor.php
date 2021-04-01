<div id="infoDoctor" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ข้อมูแพทย์</h4>
            </div>
            <div class="modal-body">

                <table id="tableInfoDoctor" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th colspan="13">รายละเอียดของแพทย์</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <h4 class="text-center" style="padding-top: 15px;">เปลี่ยนแปลงรหัสผ่าน</h4>

                <table id="tableChangePasswordDoctor" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th colspan="13">ฟอร์มเปลี่ยนแปลงรหัสผ่าน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form id="changePasswordDoctor">
                            <tr class="hidden">
                                <td>รหัสแพทย์</td>
                                <td>
                                    <input type="text" id="doctor_id" class="form-control" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>รหัสผ่านใหม่</td>
                                <td>
                                    <input type="password" id="doctor_password" class="form-control" required="required">
                                </td>
                            </tr>
                            <tr>
                                <td>ยืนยันรหัสผ่านอีกครั้ง</td>
                                <td><input type="password" id="doctor_password_cf" class="form-control" required="required"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        </div>

    </div>
</div>