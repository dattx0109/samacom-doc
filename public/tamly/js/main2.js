
$("#btn-thanthai").on("click", function () {
    $('button').removeClass("thanthai")
    $("#btn-thanthai").addClass("thanthai")
});
$("#btn-nhankhau").on("click", function () {
    $('button').removeClass("thanthai")
    $("#btn-nhankhau").addClass("thanthai")
});
$("#btn-tuonghoc").on("click", function () {
    $('button').removeClass("thanthai")
    $("#btn-tuonghoc").addClass("thanthai")
});
$('body').on('hidden.bs.modal', '.modal', function () {
    location.reload();
});



let error = false;

$("#thanthai").on("click", function(){

    $("#btn-thanthai").addClass("thanthai");
    var name = $("input[name='name']").val();
    var nameError = $("input[name='name']")
    checkRequired(name,nameError);
    var giongnoi = $("input[name='giongnoi']").filter(":checked").val();
    var khuonmat = $("input[name='khuonmat']").filter(":checked").val();
    if ($('.noi1').is(':checked') || $('.noi2').is(':checked') ) {
        $('.append3').remove();
    }else {
        $('.append3').html('Trường này không được để trống')
    }
    if ($('.mat1').is(':checked') || $('.mat2').is(':checked') ) {
        $('.append4').remove();
    }else {
        $('.append4').html('Trường này không được để trống')
    }
    if ($('.gan1').is(':checked') || $('.gan2').is(':checked') ) {
        $('.append5').remove();
    }else {
        $('.append5').html('Trường này không được để trống')
    }
    var khichat = $("input[name='khichat']").filter(":checked").val();
    var dienthoai = $("input[name='phone']").val();
    var dienthoaiError = $("input[name='phone']");
    var checkPhoneThanThai = checkRequired(dienthoai, dienthoaiError);
    if (!checkPhoneThanThai) {
      var checkNumberPhoneThanThai =  checkRequiredPhoneNumber(dienthoai,dienthoaiError);
    }
    var email = $("input[name='email']").val();
    var emailError = $("input[name='email']");
    checkRequired(email,emailError);
    if(!checkRequired(email,emailError)){
        var checkEmailThanThai = checkRequiredEmail(email, emailError);
    }

if ( checkRequired(name,nameError) == false && checkNumberPhoneThanThai == false && checkEmailThanThai == false){
    $.ajax({
        url: "/them-cv4",
        type: 'POST',
        data: {
            type: 1,
            ten: name,
            giong_noi: giongnoi,
            khuon_mat: khuonmat,
            khi_chat: khichat,
            so_dien_thoai: dienthoai,
            email: email,

        },
        success: function (data) {
            console.log(data)
        }
    });
    $('#exampleModal').hide();
    $('#exampleModal5').modal('show');
        setTimeout(function(){
        location.reload();
    }, 10000);
}

    function checkRequired(selector,selector1) {
        if (selector == '') {
            selector1.next('div').remove();
            error = true;
            selector1.after('<div class="text-danger">Trường này không được để trống</div>')
            return true;
        }
        else {
            selector1.next('div').remove();
            return false;
        }
    }

    function checkRequiredPhoneNumber(selector, selector1) {
        const regex = /(\+84|09|03|08|07|05)+([0-9]{8})\b/gm;
        if (!regex.exec(selector)) {
            error = true;
            selector1.next('div').remove();
            selector1.after('<div class="text-danger">Không đúng định dạng số điện thoại</div>')
            return true;
        } else {
            selector1.next('div').remove();
            return false;
        }
    }

    function checkRequiredEmail(selector, selector1) {
        const regex = /^(([^<>()\[\]\\\\.,;:\s@"]+(\.[^<>()\[\]\\\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/gm;
        if (!regex.exec(selector)) {
            error = true;
            selector1.next('div').remove();
            selector1.after('<div class="text-danger">Không đúng định dạng email</div>')
            return true;
        } else {
            selector1.next('div').remove();
            return false;
        }
    }


});
$("#nhankhauhoc").on("click", function(){

    $("#btn-nhankhau").addClass("thanthai");
    var name = $("input[name='namenha']").val();
    var nameError = $("input[name='namenha']")
    checkRequired(name,nameError);
    var namsinh = $("input[name='namsinhnhan']").val();
    var namsinhError = $("input[name='namsinhnhan']");
    checkRequiredNamsinh(namsinh);
    var phone = $("input[name='phonenhan']").val();
    var phoneError = $("input[name='phonenhan']");
    checkRequired(phone,phoneError);
    if(!checkRequired(phone,phoneError)){
        checkRequiredPhoneNumber(phone, phoneError)
    }

    var email = $("input[name='emailnhan']").val();
    var emailError = $("input[name='emailnhan']");
    checkRequired(email,emailError);
    if(!checkRequired(email,emailError)){
        var checkEmailNhanKhauHoc = checkRequiredEmail(email,emailError);
    }
    if ( checkRequired(name,nameError) == false && checkRequired(phone,phoneError) == false &&    checkEmailNhanKhauHoc == false && checkRequiredNamsinh(namsinh) == false){
        $.ajax({
            url: "/them-cv4",
            type: 'POST',
            data: {
                type: 2,
                ten: name,
                nam_sinh:namsinh,
                so_dien_thoai: phone,
                email: email,

            },
            success: function (data) {
                console.log(data)
            }
        });
        $('#exampleModal1').hide();
        $('#exampleModal5').modal('show');
        setTimeout(function(){
            location.reload();
        }, 10000);
    }

    function checkRequired(selector3,selector2) {
        if (selector3 == '') {
            selector2.next('div').remove();
            error = true;
            selector2.after('<div class="text-danger">Trường này không được để trống</div>')
            return true;
        }
        else {
            selector2.next('div').remove();
            return false;
        }
    }
    function checkRequiredNamsinh(selector3) {
        if (selector3 == '') {
            $('.inputphone').html('Trường này không được để trống')
            console.log(112222334455);
            return true;
        }
        else {
            console.log(1122223344556666);
            $('.inputphone').remove();
            return false;
        }
    }

    function checkRequiredPhoneNumber(selector, selector1) {
        const regex = /(\+84|09|03|08|07|05)+([0-9]{8})\b/gm;
        if (!regex.exec(selector)) {
            error = true;
            selector1.next('div').remove();
            selector1.after('<div class="text-danger">Không đúng định dạng số điện thoại</div>')
            return true;
        } else {
            selector1.next('div').remove();
            return false;
        }
    }

    function checkRequiredEmail(selector, selector1) {
        const regex = /^(([^<>()\[\]\\\\.,;:\s@"]+(\.[^<>()\[\]\\\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/gm;
        if (!regex.exec(selector)) {
            error = true;
            selector1.next('div').remove();
            selector1.after('<div class="text-danger">Không đúng định dạng email</div>')
            return true;
        } else {
            selector1.next('div').remove();
            return false;
        }
    }

});
$("#nhantuong").on("click", function(){

    $("#btn-tuonghoc").addClass("thanthai");
    var name = $("input[name='namehoc']").val();
    var nameError = $("input[name='namehoc']")
    checkRequired(name,nameError);
    var goitinh = $("input[name='gioitinh']").filter(":checked").val();
    var namsinhhoc = $("input[name='namsinhhoc']").val();
    var namsinhhocError = $("input[name='namsinhhoc']");

    checkRequired(namsinhhoc,namsinhhocError);
    if(!checkRequired(namsinhhoc,namsinhhocError)){
        checkNumberYear(namsinhhoc, namsinhhocError)
    }
    if ($('.nam').is(':checked') || $('.nu').is(':checked') ) {
        $('.append').remove();
    }else {
        $('.append').html('Trường này không được để trống')

    }
    if ($('.khuon1').is(':checked') || $('.khuon2').is(':checked') ) {
        $('.append1').remove();

    }else {
        $('.append1').html('Trường này không được để trống')
    }
    var khuonmathoc = $("input[name='khuonmathoc']").filter(":checked").val();
    var phone = $("input[name='phonehoc']").val();
    var phoneError = $("input[name='phonehoc']");
    checkRequired(phone,phoneError);
    if(!checkRequired(phone,phoneError)){
        checkRequiredPhoneNumber(phone,phoneError)
    }
    var email = $("input[name='emailhoc']").val();
    var emailError = $("input[name='emailhoc']");
    checkRequired(email,emailError);
    if(!checkRequired(email,emailError)){
        var checkEmailNhanTuongHoc = checkRequiredEmail(email, emailError)
    }
    // checkRequiredEmail(selector, selector1)
    if ( checkRequired(name,nameError) == false && checkRequiredPhoneNumber(phone,phoneError) == false &&   checkEmailNhanTuongHoc == false && checkNumberYear(namsinhhoc, namsinhhocError) == false){
        $.ajax({
            url: "/them-cv4",
            type: 'POST',
            data: {
                type: 3,

                ten: name,
                nam_sinh:namsinhhoc,
                gioi_tinh:goitinh,
                khuon_mat:khuonmathoc,
                so_dien_thoai: phone,
                email: email,

            },
            success: function (data) {
                console.log(data)
            }
        });
        $('#exampleModal2').hide();
        $('#exampleModal5').modal('show');
        setTimeout(function(){
            location.reload();
        }, 10000);
    }

    function checkRequired(selector3,selector2) {
        if (selector3 == '') {
            selector2.next('div').remove();
            error = true;
            selector2.after('<div class="text-danger">Trường này không được để trống</div>')
            return true;
        }
        else {
            selector2.next('div').remove();
            return false;
        }
    }

    function checkRequiredPhoneNumber(selector, selector1) {
        const regex = /(\+84|09|03|08|07|05)+([0-9]{8})\b/gm;
        if (!regex.exec(selector)) {
            error = true;
            selector1.next('div').remove();
            selector1.after('<div class="text-danger">Không đúng định dạng số điện thoại</div>')
            return true;
        } else {
            selector1.next('div').remove();
            return false;
        }
    }

    function checkRequiredEmail(selector, selector1) {
        const regex = /^(([^<>()\[\]\\\\.,;:\s@"]+(\.[^<>()\[\]\\\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/gm;
        if (!regex.exec(selector)) {
            error = true;
            selector1.next('div').remove();
            selector1.after('<div class="text-danger">Không đúng định dạng email</div>')
            return true;
        } else {
            selector1.next('div').remove();
            return false;
        }
    }

    function checkNumberYear(selector, selector1) {
        const regex = /^(19\d\d|20\d\d)$/gm;
        if (!regex.exec(selector)) {
            error = true;
            selector1.next('div').remove();
            selector1.after('<div class="text-danger">Không đúng định dạng năm sinh</div>')
            return true;
        } else {
            selector1.next('div').remove();
            return false;
        }
    }

});
