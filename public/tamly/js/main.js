(function ($) {


    let khaoSat = (function ($, window, document) {
        let dataRequest = {};
        //than thai
        dataRequest.fullNameThanThai = $('input[name="full_name_than_thai"]');
        dataRequest.fullNameThanThai = $('input[name="full_name_than_thai"]');
        dataRequest.giongNoiThanThai = $('input[name="giongnoi"]');
        dataRequest.khuonMatThanThai = $('input[name="khuonmat"]');
        dataRequest.khiChatThanThai = $('input[name="khichat"]');
        dataRequest.dataInsert;
        //ketqua
        dataRequest.fullName = $('input[name="FullNameContact"]');
        dataRequest.genderContact = $('input[name="gender_contact"]');
        dataRequest.date_of_birth_contact = $('input[name="date_of_birth_contact"]');
        dataRequest.phone_contact = $('input[name="phone_contact"]');
        dataRequest.email_contact = $('input[name="email_contact"]');
        dataRequest.nganh_dang_lam = $('input[name="nganh_dang_lam"]');
        dataRequest.vi_tri_sale = $('input[name="vi_tri_sale"]');
        dataRequest.dataContactInsert;
        //nhan khau hoc
        dataRequest.fullNameNhanKhauHoc = $('input[name="full_name_nhan_khau_hoc"]');
        dataRequest.ngaySinhNhanKhauHoc = $('input[name="ngay_sinh_nhan_khau_hoc"]');
        dataRequest.LinhVucNhanKhauHoc = $('input[name="linh_vuc_nhan_khau_hoc"]');
        dataRequest.electorError = $('input[name="ngay_sinh_nhan_khau_hoc"]');
        //nhan tuong hoc
        dataRequest.fullNameNhanTuongHoc = $('input[name="full_name_nhan_tuong_hoc"]');
        dataRequest.gioiTinhNhanTuongHoc = $('input[name="gioi_tinh_nhan_tuong_hoc"]');
        dataRequest.ngaySinhNhaTuongHoc = $('input[name="ngay_sinh_nhan_tuong_hoc"]');
        dataRequest.khuonMatNhanTuongHoc = $('input[name="khuon_mat_nha_tuong_hoc"]');

        return dataRequest;

    }(window.jQuery, window, document));

    let error = false;

    $("#btn-thanthai").on("click", function () {
        $("#btn-thanthai").addClass("thanthai")
    });
    $("#nhankhauhoc1").on("click", function () {
        $("#nhankhauhoc1").addClass("thanthai")
    });
    $("#nhantuonghoc1").on("click", function () {
        $("#nhantuonghoc1").addClass("thanthai")
    });

    // form modal than thai
    $("#ketqua").on("click", function () {

        let checkNameThanThai = checkRequired(khaoSat.fullNameThanThai);
        khaoSat.dataInsert = {
            'full_name': khaoSat.fullNameThanThai.val(),
            'giong_noi': khaoSat.giongNoiThanThai.filter(":checked").val(),
            'khuon_mat': khaoSat.khuonMatThanThai.filter(":checked").val(),
            'khi_chat': khaoSat.khiChatThanThai.filter(":checked").val(),
        }

        if (checkNameThanThai == true) {
            return;
        } else {
            $('#exampleModal').hide();
            $('#exampleModal2').modal('show');
        }
        console.log(khaoSat.dataInsert);
    });
    $("#thongbaothanhcong1").on("click", function () {
        $('#exampleModal2').hide();
        $('#exampleModal5').hide();
        $('#exampleModal6').hide();
        $('#exampleModal1').modal('show');
    });


        // form modal nhan khau hoc
    $("#nhankhauhoc").on("click", function () {
        let checkNameNhanKhauHoc = checkRequired(khaoSat.fullNameNhanKhauHoc);
        // let checkNgaySinhNhanKhauHoc = checkRequired(khaoSat.ngaySinhNhanKhauHoc);
        let checkNgaySinhNhanKhauHoc = checkRequiredDayMonth(khaoSat.ngaySinhNhanKhauHoc, khaoSat.electorError);
        let checkLinhVucNhanKhauHoc = checkRequired(khaoSat.LinhVucNhanKhauHoc);

        khaoSat.dataInsertNhanKhauHoc = {
            'full_name_nhan_khau_hoc': khaoSat.fullNameNhanKhauHoc.val(),
            'ngay_sinh_nhan_khau_hoc': khaoSat.ngaySinhNhanKhauHoc.val(),
            'linh_vuc_nhan_khau_hoc': khaoSat.LinhVucNhanKhauHoc.val(),
        }
        if (checkNameNhanKhauHoc == true || checkLinhVucNhanKhauHoc == true || checkNgaySinhNhanKhauHoc == true) {
            return;
        } else {
            $('#exampleModal5').hide();
            $('#exampleModal2').modal('show');
            // $('#exampleModal1').modal('show');
        }
    });

    // form modal nhan tuong hoc
    $("#nhantuonghoc").on("click", function () {
      let  errorYearNhanTuongHoc =true;
      let  errorNameNhanTuongHoc =true;
        if(khaoSat.ngaySinhNhaTuongHoc.val()=='')
        {
            errorYearNhanTuongHoc =false;
            khaoSat.ngaySinhNhaTuongHoc.next('div').remove();
            khaoSat.ngaySinhNhaTuongHoc.after('<div class="text-danger">Trường này không được để trống</div>')
        }else if(checkRequiredNumber(khaoSat.ngaySinhNhaTuongHoc)){
            errorYearNhanTuongHoc =false;
            khaoSat.ngaySinhNhaTuongHoc.next('div').remove();
            khaoSat.ngaySinhNhaTuongHoc.after('<div class="text-danger">Không đúng định dạng số </div>')
        }else if(checkNumberYear(khaoSat.ngaySinhNhaTuongHoc)) {
            errorYearNhanTuongHoc =false;
            khaoSat.ngaySinhNhaTuongHoc.next('div').remove();
            khaoSat.ngaySinhNhaTuongHoc.after('<div class="text-danger">Không đúng định dạng năm sinh </div>')
        }else {
            khaoSat.ngaySinhNhaTuongHoc.next('div').remove();
        }

        if(khaoSat.fullNameNhanTuongHoc.val()=='')
        {
            errorNameNhanTuongHoc = false;
            khaoSat.fullNameNhanTuongHoc.next('div').remove();
            khaoSat.fullNameNhanTuongHoc.after('<div class="text-danger">Trường này không được để trống</div>')
        }else {
            khaoSat.fullNameNhanTuongHoc.next('div').remove();
        }
        if(errorYearNhanTuongHoc== false ||errorNameNhanTuongHoc ==false){
            return;
        }

        khaoSat.dataInsertNhantuongHoc = {
            'full_name_nhan_tuong_hoc': khaoSat.fullNameNhanTuongHoc.val(),
            'gioi_tinh_nhan_tuong_hoc': khaoSat.gioiTinhNhanTuongHoc.filter(":checked").val(),
            'ngay_sinh_nhan_tuong_hoc': khaoSat.ngaySinhNhaTuongHoc.val(),
            'khuon_mat_nhan_tuong_hoc': khaoSat.khuonMatNhanTuongHoc.filter(":checked").val(),
        }

        $('#exampleModal6').hide();
        $('#exampleModal2').modal('show');
            // $('#exampleModal1').modal('show');
    });
    $('body').on('hidden.bs.modal', '.modal', function () {
        location.reload();
    });

    // form modal thong tin de gui ket qua cho khach hang
    $("#ketqua1").on("click", function () {

        let errorFullName = true;
        let errorNamSinh = true;
        let errorPhoneContact = true;
        let errorEmailContact = true;
        let errorNganhDangLamContact = true;
        let errorViTriSaleContact = true;

        if(khaoSat.fullName.val()=='')
        {
            errorFullName = false;
            khaoSat.fullName.next('div').remove();
            khaoSat.fullName.after('<div class="text-danger">Trường này không được để trống</div>')
        }else {
            khaoSat.fullName.next('div').remove();
        }

        if(khaoSat.date_of_birth_contact.val()=='')
        {
            errorNamSinh =false;
            khaoSat.date_of_birth_contact.next('div').remove();
            khaoSat.date_of_birth_contact.after('<div class="text-danger">Trường này không được để trống</div>')
        }else if(checkRequiredNumber(khaoSat.date_of_birth_contact)){
            errorNamSinh =false;
            khaoSat.date_of_birth_contact.next('div').remove();
            khaoSat.date_of_birth_contact.after('<div class="text-danger">Không đúng định dạng số </div>')
        }else if( checkNumberYear(khaoSat.date_of_birth_contact)) {
            errorNamSinh =false;
            khaoSat.date_of_birth_contact.next('div').remove();
            khaoSat.date_of_birth_contact.after('<div class="text-danger">Không đúng định dạng năm sinh </div>')
        }else {
            khaoSat.date_of_birth_contact.next('div').remove();
        }

        if(khaoSat.phone_contact.val()=='')
        {
            errorPhoneContact =false;
            khaoSat.phone_contact.next('div').remove();
            khaoSat.phone_contact.after('<div class="text-danger">Trường này không được để trống</div>')
        }else if(checkRequiredNumber(khaoSat.phone_contact)){
            errorPhoneContact =false;
            khaoSat.phone_contact.next('div').remove();
            khaoSat.phone_contact.after('<div class="text-danger">Không đúng định dạng số </div>')
        }
        else if( checkRequiredPhoneNumber(khaoSat.phone_contact)) {
            errorPhoneContact =false;
            khaoSat.phone_contact.next('div').remove();
            khaoSat.phone_contact.after('<div class="text-danger">Không đúng định dạng số điện thoại </div>')
        }else {
            khaoSat.phone_contact.next('div').remove();
        }

        if(khaoSat.email_contact.val()=='')
        {
            errorEmailContact =false;
            khaoSat.email_contact.next('div').remove();
            khaoSat.email_contact.after('<div class="text-danger">Trường này không được để trống</div>')
        } else if( checkRequiredEmail(khaoSat.email_contact)) {
            errorEmailContact =false;
            khaoSat.email_contact.next('div').remove();
            khaoSat.email_contact.after('<div class="text-danger">Không đúng định dạng số Email </div>')
        }else {
            khaoSat.email_contact.next('div').remove();
        }

        if(khaoSat.nganh_dang_lam.val()=='')
        {
            errorNganhDangLamContact = false;
            khaoSat.nganh_dang_lam.next('div').remove();
            khaoSat.nganh_dang_lam.after('<div class="text-danger">Trường này không được để trống</div>')
        }else {
            khaoSat.nganh_dang_lam.next('div').remove();
        }

        if(khaoSat.vi_tri_sale.val()=='')
        {
            errorViTriSaleContact = false;
            khaoSat.vi_tri_sale.next('div').remove();
            khaoSat.vi_tri_sale.after('<div class="text-danger">Trường này không được để trống</div>')
        }else {
            khaoSat.vi_tri_sale.next('div').remove();
        }

        khaoSat.dataContactInsert = {
            'fullNameContact': khaoSat.fullName.val(),
            'genderContact': khaoSat.genderContact.filter(":checked").val(),
            'date_of_birth_contact': khaoSat.date_of_birth_contact.val(),
            'phone_contact': khaoSat.phone_contact.val(),
            'nganh_dang_lam': khaoSat.nganh_dang_lam.val(),
            'vi_tri_sale': khaoSat.vi_tri_sale.val(),
        }
        if (errorFullName == false || errorNamSinh == false || errorPhoneContact == false || errorEmailContact == false || errorNganhDangLamContact == false || errorViTriSaleContact == false) {
            return;
        } else {
            if (khaoSat.dataInsert !== undefined) {
                let rawData = {
                    'fullNameContact': khaoSat.fullName.val(),
                    'genderContact': khaoSat.genderContact.filter(":checked").val(),
                    'date_of_birth_contact': khaoSat.date_of_birth_contact.val(),
                    'phone_contact': khaoSat.phone_contact.val(),
                    'email_contact': khaoSat.email_contact.val(),
                    'nganh_dang_lam': khaoSat.nganh_dang_lam.val(),
                    'vi_tri_sale': khaoSat.vi_tri_sale.val(),
                    'type': 1,
                    'full_name_kh': khaoSat.fullNameThanThai.val(),
                    'giong_noi_kh': khaoSat.giongNoiThanThai.filter(":checked").val(),
                    'khuon_mat_kh': khaoSat.khuonMatThanThai.filter(":checked").val(),
                    'khi_chat_kh': khaoSat.khiChatThanThai.filter(":checked").val(),
                }
                let khaoSatThanThai = $.post('/them-tam-ly', rawData);
                // location.reload();

                // $('#exampleModal1').hide();
                // // $('#exampleModal2').modal('show');
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else if (khaoSat.dataInsertNhanKhauHoc !== undefined) {
                let rawData = {
                    'fullNameContact': khaoSat.fullName.val(),
                    'genderContact': khaoSat.genderContact.filter(":checked").val(),
                    'date_of_birth_contact': khaoSat.date_of_birth_contact.val(),
                    'phone_contact': khaoSat.phone_contact.val(),
                    'email_contact': khaoSat.email_contact.val(),
                    'nganh_dang_lam': khaoSat.nganh_dang_lam.val(),
                    'vi_tri_sale': khaoSat.vi_tri_sale.val(),
                    'type': 2,
                    'full_name_kh': khaoSat.fullNameNhanKhauHoc.val(),
                    'nam_sinh_kh': khaoSat.ngaySinhNhanKhauHoc.val(),
                    'linh_vuc_kh': khaoSat.LinhVucNhanKhauHoc.val(),
                }
                let khaoSatThanThai = $.post('/them-tam-ly', rawData);
                console.log(rawData);
                // $('#exampleModal1').hide();
                // $('#exampleModal2').modal('show');
                // location.reload();

                setTimeout(function () {
                    location.reload();
                }, 1000);
            }else if(khaoSat.dataInsertNhantuongHoc !== undefined){
                let rawData = {
                    'fullNameContact': khaoSat.fullName.val(),
                    'genderContact': khaoSat.genderContact.filter(":checked").val(),
                    'date_of_birth_contact': khaoSat.date_of_birth_contact.val(),
                    'phone_contact': khaoSat.phone_contact.val(),
                    'email_contact': khaoSat.email_contact.val(),
                    'nganh_dang_lam': khaoSat.nganh_dang_lam.val(),
                    'vi_tri_sale': khaoSat.vi_tri_sale.val(),
                    'type': 3,
                    'full_name_kh' : khaoSat.fullNameNhanTuongHoc.val(),
                    'gioi_tinh_kh' : khaoSat.gioiTinhNhanTuongHoc.filter(":checked").val(),
                    'nam_sinh_kh' : khaoSat.ngaySinhNhaTuongHoc.val(),
                    'khuon_mat_kh' : khaoSat.khuonMatNhanTuongHoc.filter(":checked").val(),
                }
                let khaoSatThanThai = $.post('/them-tam-ly', rawData);
                // $('#exampleModal1').hide();
                // $('#exampleModal2').modal('show');
                // location.reload();

                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        }
    });

    $("#xoa").on("click", function () {
        location.reload();
    });

    function checkRequired(selector) {
        if (selector.val() == '') {
            error = true;
            selector.next('div').remove();
            selector.after('<div class="text-danger">Trường này không được để trống</div>')
            return true;
        } else {
            selector.next('div').remove();
            return false;
        }
    }

    function checkRequiredDayMonth(selector, electorError) {
        if (selector.val() == '') {
            console.log(1111);
            error = true;
            // $('#append').remove();
            $('#append').html('Trường này không được để trống');
            return true;
        } else {
            console.log(2222);
            $('#append').remove();
            return false;
        }
    }

    function checkRequiredEmail(selector) {
        const regex = /^(([^<>()\[\]\\\\.,;:\s@"]+(\.[^<>()\[\]\\\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/gm;
        if (!regex.exec(selector.val())) {
            error = true;
            selector.next('div').remove();
            selector.after('<div class="text-danger">Không đúng định dạng email</div>')
            return true;
        } else {
            selector.next('div').remove();
            return false;
        }
    }

    function checkRequiredPhoneNumber(selector) {
        const regex = /(\+84|09|03|08|07|05)+([0-9]{8})\b/gm;;
        if (!regex.exec(selector.val())) {
            error = true;
            selector.next('div').remove();
            selector.after('<div class="text-danger">Không đúng định dạng số điện thoại</div>')
            return true;
        } else {
            selector.next('div').remove();
            return false;
        }
    }


    function checkRequiredNumber(selector) {
        const regex = /^[0-9]/gm;
        if (!regex.exec(selector.val())) {
            error = true;
            selector.next('div').remove();
            selector.after('<div class="text-danger">Không đúng định dạng số </div>')
            return true;
        } else {
            selector.next('div').remove();
            return false;
        }
    }

    function checkNumberYear(selector) {
        const regex = /^(19\d\d|20\d\d)$/gm;
        if (!regex.exec(selector.val())) {
            error = true;
            selector.next('div').remove();
            selector.after('<div class="text-danger">Không đúng định dạng năm sinh</small></div>')
            return true;
        } else {
            selector.next('div').remove();
            return false;
        }
    }

})(window.jQuery);
