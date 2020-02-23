 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: flex;">
                <h5 class="modal-title" id="exampleModalLabel">THẦN THÁI KHÁCH HÀNG</h5>
                <div style="width: 26px;height: 26px; border: 1px solid white;border-radius: 50%">
                    <button type="button"  class="close button-style" data-dismiss="modal" aria-label="Close">
                        <span style="margin-right: 4px;margin-top: 4px;font-size: 22px;color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <div class="modal-body">
                <form class="form-inline" id="than_thai">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label class="width100">Họ và tên</label>
                        <input type="text" class="form-control" style="width: 310px;" name="full_name_than_thai">
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;display: block">
                        <label class="width100"> Giọng nói</label>
                        <div class="inile100">
                        <input type="radio" class="" name="giongnoi" value="1" checked>&nbsp; Mỏng
                        </div>
                        <div class="inile100">
                        <input type="radio"  name="giongnoi" value="2">&nbsp; Dày
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label class="width100">Khuôn mặt</label>
                        <div class="inile100">
                        <input type="radio" class=" " name="khuonmat" value="1" checked>&nbsp; Mềm mại
                        </div>
                        <div class="inile100">
                        <input type="radio"  name="khuonmat" value="2">&nbsp; Góc cạnh
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label  class="width100">Khí chất</label>
                        <div class="inile100">
                        <input type="radio"  name="khichat" value="1" checked>&nbsp; Dễ gần
                        </div>
                        <div class="inile100">
                        <input type="radio" name="khichat" value="2">&nbsp; Khó gần
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  id="ketqua" class="btn " style="margin: auto;color: white;font-weight:500;background: linear-gradient(256.45deg, #46A5F1 0.33%, #38DED4 112.15%);">XEM KẾT QUẢ</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
