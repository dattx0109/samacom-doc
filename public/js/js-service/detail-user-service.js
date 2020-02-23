(function ($) {
const name = $("[name*='name']");
const phone = $("[name*='phone']");
const email = $("[name*='email']");
const role = $("[name*='role']");
const btnUpdate =$('.btn-update');
const btnUpdateUser =$('.btn-delete');
const btnResetPasswordUser =$('.btn-reset-password');
const locationHref  = $(location).attr('href');
const alertError = $('.alert-form');
const alertSuccess = $('#alert-update-success');
const btnDelete = $('.btn-delete-user');
const btnResetPassword = $('.btn-reset-user');
const PermissionUpdate ='user_sys_detail_update';
const PermissionDelete ='user_sys_detail_delete';
const PermissionUResetPassword ='user_reset_pass';

    $('.tagsinput').tagsinput({
        tagClass: 'label label-primary'
    });
    $('.chosen-select').chosen({width: "100%"});
    checkPermission(PermissionUpdate);
    checkPermission(PermissionDelete);
    checkPermission(PermissionUResetPassword);
    btnUpdate.on('click', function () {
        let parts = locationHref.split("/");
        let last_part = parts[parts.length - 1];
        let updateUser = $.ajax({
            url: '/user/update/'+last_part,
            method: 'post',
            data: {
                name: name.val(),
                phone: phone.val(),
                email: email.val(),
                role: role.val(),
            },
            beforeSend: function() {

            }
        });
        updateUser.done(function (data) {
            alertError.hide();
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 3000
                };
                toastr.success('update thành công');
            }, 1000);
        });

        updateUser.fail(function (data) {
            var error =  data.responseJSON.errors;
            btnUpdate.prop('disabled', false);
            if (error.name !== undefined) {
                $('.alert-name').show();
                $('.alert-name').css('display','block');
                $('.alert-name').html(error.name);
            }
            if (error.email !== undefined) {
                $('.alert-email').show();
                $('.alert-email').css('display','block');
                $('.alert-email').html(error.email);
            }
            if (error.phone !== undefined) {
                $('.alert-phone').show();
                $('.alert-phone').css('display','block');
                $('.alert-phone').html(error.phone);
            }
        });
    })
    btnDelete.on('click', function () {

        let parts = locationHref.split("/");
        let last_part = parts[parts.length - 1];
        let deleteUser = $.ajax({
            url: '/user/delete/'+last_part,
            method: 'post',
            data: {
            },
            beforeSend: function() {

            }
        });
        deleteUser.done(function (data) {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 3000
                };
                toastr.success('xóa tài khoản thành công');
            }, 1000);
        });

        deleteUser.fail(function (data) {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 3000
                };
                toastr.error('xóa tài khoản thất bại ');
            }, 1000);
        });
    })
    btnResetPassword.on('click', function () {

        let parts = locationHref.split("/");
        let last_part = parts[parts.length - 1];
        let resetPassword = $.ajax({
            url: '/user/change-password/'+last_part,
            method: 'post',
            data: {
            },
            beforeSend: function() {

            }
        });
        resetPassword.done(function (data) {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 3000
                };
                toastr.success('đặt lại mật khẩu thành công');
            }, 1000);

        });

        resetPassword.fail(function (data) {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 3000
                };
                toastr.error('đặt lại mật khẩu thất bại ');
            }, 1000);
        });
    })
    function checkPermission(permission){
        let checkPermission = $.ajax({
            url: '/role-check-permissions',
            method: 'post',
            data: {
                permission: permission,
            },
            beforeSend: function() {

            }
        });
        checkPermission.done(function (data) {
            if(permission ===PermissionDelete){
                btnUpdateUser.show();
           }
           if(permission ===PermissionUpdate){

               btnUpdate.show();
           }
           if(permission ===PermissionUResetPassword){
               btnResetPasswordUser.show();
           }
        });

        checkPermission.fail(function (data) {
            if(permission ===PermissionDelete){
                btnDelete.hide();
            }
            if(permission ===PermissionUpdate){
                btnResetPassword.hide();
            }
            if(permission ===PermissionUResetPassword){
                btnResetPassword.hide();
            }
        });
    }
})(window.jQuery);

