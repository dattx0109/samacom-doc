(function ($, window, document) {
    const employer = $('select[name="employer"]');
    const package_type = $('input[name="package_type"]');
    const package = $('select[name="package"]');
    const count_view = $('input[name="count_view"]');
    const count_day_view = $('input[name="count_day_view"]');
    const count_employment_post = $('input[name="count_employment_post"]');
    const count_day_employment_post = $('input[name="count_day_employment_post"]');
    const count = $('input[name="count"]');
    const btn_store_product = $('#btn-store-product');

    const info_customer_product = $('.info-customer-product');
    const select_package = $('.select-package');
    //error
    const error_add_buy_product = $('.error-add-buy-product');
    const error_employer = $('.error_employer');
    const error_package_type = $('.error_package_type');
    const error_package = $('.error_package');
    const error_count = $('.error_count');
    const error_count_view = $('.error_count_view');
    const error_count_day_view = $('.error_count_day_view');
    const error_count_employment_post = $('.error_count_employment_post');
    const error_count_day_employment_post = $('.error_count_day_employment_post');


    $(function () {
        $('.chosen-select').chosen({width: "100%"});
        package.on('change', function () {
            if ($(this).val() == '') {
                return;
            }
            let district = $.get('/package/' + $(this).val());

            district.done(function (data) {
                if (Object.getOwnPropertyNames(data).length > 0) {
                }
            });
            district.fail(function (data) {

            });
        });
        package_type.on('change', function () {

            if ($(this).val() == 1) {
                select_package.show();
                info_customer_product.hide();
            }
            if ($(this).val() == 2) {
                select_package.hide();
                info_customer_product.show();
                $('.info-customer-product input').val('');
            }

        });
        btn_store_product.on('click', function () {
            btn_store_product.prop('disabled', true);
            let productInfo = {
                'employer_id': employer.val(),
                'package': package.val(),
                'package_type': package_type.filter(":checked").val(),
                'count_view': count_view.val(),
                'count_day_view': count_day_view.val(),
                'count_employment_post': count_employment_post.val(),
                'count_day_employment_post': count_day_employment_post.val(),
                'count': count.val(),
            };
            let buyProduct = $.post('/buy-product-by-admin', productInfo);
            buyProduct.then(function (data) {

                setTimeout(function () {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 1500
                    };
                    toastr.success('Thêm mới thành công');
                }, 500);
                setTimeout(function () {
                    location.reload();
                }, 1000);
            });
            buyProduct.fail(function (data) {
                btn_store_product.prop('disabled', false);
                let errors = data.responseJSON.errors;
                error_add_buy_product.html('');
                if (typeof errors.employer_id != 'undefined') {
                    error_employer.append('<span class="help-block m-b-none alert alert-danger">' + errors.employer_id[0] + '</span>');
                }
                if (typeof errors.package != 'undefined') {
                    error_package.append('<span class="help-block m-b-none alert alert-danger">' + errors.package[0] + '</span>');
                }
                if (typeof errors.package_type != 'undefined') {
                    error_package_type.append('<span class="help-block m-b-none alert alert-danger">' + error.package_type[0] + '</span>');
                }
                if (typeof errors.count != 'undefined') {
                    error_count.append('<span class="help-block m-b-none alert alert-danger">' + errors.count[0] + '</span>');
                }
                if (typeof errors.count_day_view != 'undefined') {
                    error_count_day_view.append('<span class="help-block m-b-none alert alert-danger">' + errors.count_day_view[0] + '</span>');
                }
                if (typeof errors.count_employment_post != 'undefined') {
                    error_count_employment_post.append('<span class="help-block m-b-none alert alert-danger">' + errors.count_employment_post[0] + '</span>');
                }
                if (typeof errors.count_day_employment_post != 'undefined') {
                    error_count_day_employment_post.append('<span class="help-block m-b-none alert alert-danger">' + errors.count_day_employment_post[0] + '</span>');
                }
            })
        });

    });

}(window.jQuery, window, document));
