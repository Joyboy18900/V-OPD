<style>
    #scoreVote img {
        width: 50px;
    }
</style>

<!-- Vote Comment -->
<div class="modal fade" id="modalVoteComment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vote & Comment</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <form id="frm_vote">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="form-group col-md-12">
                                    <div class="text-section-heading-3 text-center mb">ระดับความพึงพอใจ
                                        <small></small>
                                    </div>
                                    <div class="col-md-12 mt">
                                        <div id="scoreVote" data-score="1"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 mt">
                                <hr class="hr_opd">
                            </div>
                            <div class="col-md-12">
                                <div class="text-section-heading-3 text-center mt mb">แสดงความคิดเห็นหลังจากการตรวจ (ถ้ามี)
                                    <small></small>
                                </div>
                                <div class="form-group col-md-12 mt">
                                    <div class="col-md-12">
                                        <textarea id="booking_comment" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix mb"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Image -->
<div class="modal fade" id="modalViewImage" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ดูรูปภาพ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <img id="viewImage" class="img-responsive" alt="imageView">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>