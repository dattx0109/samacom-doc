<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: flex;">
                <h5 class="modal-title" id="exampleModalLabel1">THẦN THÁI</h5>
                <div style="width: 26px;height: 26px; border: 1px solid white;border-radius: 50%">
                    <button type="button"  class="close button-style" data-dismiss="modal" aria-label="Close">
                        <span style="margin-right: 4px;margin-top: 4px;font-size: 22px;color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <div class="modal-body">
                <form class="form-inline">
                    <div class="form-group">
                        <label class="width100">Họ và tên</label>
                        <input style="width: 330px;" type="text" name="name"  class=" width74 form-control form-style ">
                        <div id="hovaten"></div>
                    </div>
                    <div class="form-group" >
                        <label class="width100"> Giọng nói</label>
                        <div class="inile100">
                            <input type="radio" class=" form-style1 noi1"   name="giongnoi"  value="1">&nbsp; Mỏng
                        </div>
                        <div class="inile100">
                            <input type="radio"  class="form-style1 noi2" name="giongnoi" value="2">&nbsp; Dày
                        </div>
                        <div class="append3 text-danger"></div>

                    </div>
                    <div class="form-group" >
                        <label class="width100">Khuôn mặt</label>
                        <div class="inile100">
                        <input type="radio" class=" form-style2 mat1"  name="khuonmat"  value="1">&nbsp; Mềm mại
                        </div>
                        <div class="inile100">
                        <input type="radio" class=" form-style3 mat2" name="khuonmat" value="2">&nbsp; Góc cạnh
                        </div>
                        <div class="append4 text-danger"></div>

                    </div>
                    <div class="form-group" >
                        <label class="width100">Khí chất </label>
                        <div class="inile100">
                        <input type="radio"  name="khichat" class="gan1"   value="1">&nbsp; Dễ gần
                        </div>
                        <div class="inile100">
                        <input type="radio"   name="khichat" class="gan2" value="2">&nbsp; Khó gần
                        </div>
                        <div class="append5 text-danger"></div>

                    </div>
                    <div class="form-group">
                        <label class="width100">Điện thoại</label>
                        <input style="width: 330px;" type="number" name="phone"  class="form-control form-style width74">
                    </div>
                    <div class="form-group">
                        <label class="width100">Email</label>
                        <input style="width: 330px;" type="email" name="email"  class="form-control form-style width74">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button"  id="thanthai" class="btn " style="margin: auto;color: white;font-weight:500;    background: linear-gradient(261.43deg, #B32020 -27.03%, #6B0B67 92.79%);;">TẢI CV</button>
            </div>
        </div>
    </div>
</div>
