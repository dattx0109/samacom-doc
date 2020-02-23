<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: flex;">
                <h5 class="modal-title" id="exampleModalLabel1">NHÂN TƯỚNG HỌC</h5>
                <div style="width: 26px;height: 26px; border: 1px solid white;border-radius: 50%">
                    <button type="button"  class="close button-style" data-dismiss="modal" aria-label="Close">
                        <span style="margin-right: 4px;margin-top: 4px;font-size: 22px;color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form class="form-inline">
            <div class="modal-body">
                    <div class="form-group" >
                        <label class="width100" >Họ và tên</label>
                        <input type="text" style="width: 330px;"  name="namehoc" class="  form-control form-style ">
                    </div>
                    <div class="form-group" >
                        <label class="width100"> Giới tính</label>
                        <div class="inile100">
                        <input type="radio" class=" form-style1 nam" value="1"  required="required"  name="gioitinh">&nbsp; Nam
                        </div>
                        <div class="inile100">
                        <input type="radio"  class="form-style1 nu" value="2" required="required" name="gioitinh">&nbsp; Nữ
                        </div>
                        <div class="append text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label class="width100">Năm sinh</label>
                        <input type="number" style="width: 330px;" name="namsinhhoc" class="  form-control form-style width74">
                    </div>
                    <div class="form-group" >
                        <label class="width100" >Khuôn mặt</label>
                        <div class="inile100">
                        <input type="radio" class=" form-style2 khuon1" value="1"  required="required"  name="khuonmathoc">&nbsp; Mềm mại
                        </div>
                        <div class="inile100">
                        <input type="radio"  class=" form-style3 khuon2" value="2" required="required" name="khuonmathoc">&nbsp; Góc cạnh
                        </div>
                        <div class="append1 text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label class="width100">Điện thoại</label>
                        <input type="number" style="width: 330px;"  name="phonehoc"  class=" form-control form-style width74">
                    </div>
                    <div class="form-group">
                        <label class="width100">Email</label>
                        <input type="email" style="width: 330px;" name="emailhoc"  class=" form-control form-style width74">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button"  id="nhantuong" class="btn " style="margin: auto;color: white;font-weight:500;    background: linear-gradient(261.43deg, #B32020 -27.03%, #6B0B67 92.79%);;">TẢI CV</button>
            </div>
            </form>
        </div>
    </div>
</div>
