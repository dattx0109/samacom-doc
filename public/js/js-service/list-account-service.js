(function ($) {
    let Account =(function ($, window, document) {
        let dataRequest = {};
        dataRequest.account_id = null;
        dataRequest.btnModalHideAccount = $('.btn-modal-hide');
        dataRequest.btnModalShowAccount = $('.btn-modal-show');
        dataRequest.btnHideAccount = $('.btn-hide-account');
        dataRequest.btnShowAccount = $('.btn-show-account');
        return dataRequest;
    }(window.jQuery, window, document));
    $('.chosen-select').chosen({width: "100%"});
    // Check all/uncheck all checkboxes when click on select all
    $('.checkbox-check-all').click(function () {
        var checkedStatus = this.checked;
        $('.checkbox-table tr').find('td:first :checkbox').each(function () {
            $(this).prop('checked', checkedStatus);
        });
    });
    $('select[name="province_id"]').on('change', function () {
        let district = $.get('/workplace/list-district-by-province?province_id=' + $(this).val());
        let districtHtml = '<option value="">Chọn quận huyện</option>';
        district.done(function (data) {
            let countDistrict = data.length;
            for (let i = 0; i < countDistrict; i++) {
                districtHtml = districtHtml + '<option value="' + data[i].id + '">' + data[i].name + '</option>';
            }
            $('#district_id').html(districtHtml);
            $(".chosen-select").trigger("chosen:updated");
        });
        district.fail(function (data) {
            $('#district_id').html(districtHtml);
            $(".chosen-select").trigger("chosen:updated");
        });
    });

    $('#reset_fillter').click(function () {
        $('#gender').prop('selectedIndex', 0);
        $('#is_married').prop('selectedIndex', 0);
        $('#job_search_status').prop('selectedIndex', 0);
        $('#province_id').prop('selectedIndex', 0);
        $('#district_id').prop('selectedIndex', 0);
        $('#name').val('');
        $(".chosen-select").val('').trigger("chosen:updated");

    });
    Account.btnModalHideAccount.on('click', function(){
        Account.account_id = $(this).data('id');

    });
    Account.btnModalShowAccount.on('click', function(){
        Account.account_id = $(this).data('id');

    });
    Account.btnHideAccount.on('click',function(){
        $(this).attr("disabled", true);
        let hideAccount = $.post('account/hide-account-to-employer/' +Account.account_id);
        hideAccount.done(function(){

            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 1000
                };
                toastr.success('', 'Ẩn cv thành công');
            }, 1300);
            setTimeout(function () {
                location.reload();
            }, 3000);
        });
        hideAccount.fail(function(){
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 1000
                };
                toastr.error('', 'Ẩn cv thất bại');
            }, 1300);
            setTimeout(function () {
                location.reload();
            }, 3000);
        });
    });
    Account.btnShowAccount.on('click',function(){
        $(this).attr("disabled", true);
        let showAccount = $.post('account/show-account-to-employer/' +Account.account_id);
        showAccount.done(function(){

            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 1000
                };
                toastr.success('', 'Hiện cv thành công');
            }, 1300);
            setTimeout(function () {
                location.reload();
            }, 3000);
        });
        showAccount.fail(function(){
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 1000
                };
                toastr.error('', 'Hiện cv thất bại');
            }, 1300);
            setTimeout(function () {
                location.reload();
            }, 3000);
        });
    });

})(window.jQuery);
