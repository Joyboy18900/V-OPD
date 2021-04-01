<style>
    .label_opd_detail {
        font-size: 20px;
    }
</style>

<!-- Modal -->
<div id="info_member" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ข้อมูลผู้ใช้</h4>
            </div>
            <div class="modal-body">

                <table id="tableInfoPatient" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th colspan="13">รายละเอียดของผู้ใช้</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" id="btnCardVOpdPrint" class="btn btn-primary">ปริ้นบัตร V-OPD</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="list_opd" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">รายการข้อมูลซักประวัติ</h4>
            </div>
            <div class="modal-body">

                <table id="TableListOpd" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>วันที่ตรวจ</th>
                            <th>แพทย์ที่รับการตรวจ</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="info_opd" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">รายการข้อมูลซักประวัติ</h4>
            </div>
            <div class="modal-body">

                <div class="col-md-12" style="padding-top: 15px;">
                    <div class="col-md-6 text-left">
                        <h1>V-OPD Online</h1>
                    </div>
                    <div id="op_create_date" class="col-md-6 text-right">
                        <h4>วันเดือนปี dd/mm/yyyy</h4>
                    </div>
                    <div class="col-md-12 text-left" style="padding-top: 15px;">
                        <table id="TableInfoOpd">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div id="op_detail_sick" class="col-md-12 text-left" style="padding-top: 15px;">
                        <label class="label_opd_detail"><b>อาการที่มาพบแพทย์:</b> - </label>
                    </div>
                    <div id="op_dispense" class="col-md-12 text-left" style="padding-top: 50px;">
                        <label class="label_opd_detail"><b>ยาที่จ่ายในการตรวจ:</b> - </label>
                    </div>
                    <div id="op_suggestion" class="col-md-12 text-left" style="padding-top: 50px;">
                        <label class="label_opd_detail"><b>ข้อเสนอแนะ:</b> - </label>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="btnPrintOpd" class="btn btn-primary">ปริ้นใบ OPD</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="infoOpdOnce" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">รายการข้อมูลซักประวัติ</h4>
            </div>
            <div class="modal-body">

                <div class="col-md-12" style="padding-top: 15px;">
                    <div class="col-md-6 text-left">
                        <h1>V-OPD Online</h1>
                    </div>
                    <div id="op_create_date" class="col-md-6 text-right">
                        <h4>วันเดือนปี dd/mm/yyyy</h4>
                    </div>
                    <div class="col-md-12 text-left" style="padding-top: 15px;">
                        <table id="TableinfoOpdOnce">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div id="op_detail_sick" class="col-md-12 text-left" style="padding-top: 15px;">
                        <label class="label_opd_detail"><b>อาการที่มาพบแพทย์:</b> - </label>
                    </div>
                    <div id="op_dispense" class="col-md-12 text-left" style="padding-top: 50px;">
                        <label class="label_opd_detail"><b>ยาที่จ่ายในการตรวจ:</b> - </label>
                    </div>
                    <div id="op_suggestion" class="col-md-12 text-left" style="padding-top: 50px;">
                        <label class="label_opd_detail"><b>ข้อเสนอแนะ:</b> - </label>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        </div>

    </div>
</div>