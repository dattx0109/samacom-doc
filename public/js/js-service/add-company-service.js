(function ($) {
    const workplace = $('select[name="workplace"]');
        let about_us;
        let other;
        let core_value;
        let vision;
        let mission;
        const error_name_company = $('div.error_name_company');
        const error_logo = $('div.error_logo');
        const error_address = $('div.error_address');
        const error_workplace = $('div.error_workplace');
        const error_email = $('div.error_email');
        const error_sale_size = $('div.error_sale_size');
        const error_company_size = $('div.error_company_size');
        const error_hotline = $('div.error_hotline');
        const error_website = $('div.error_website');
        const error_about_us = $('div.error_about_us');

    ClassicEditor
        .create(document.querySelector('#about_us'))
        .then(editor => {
            about_us = editor;
        })
        .catch(err => {
        });
    ClassicEditor
        .create(document.querySelector('#other'))
        .then(editor => {
            other = editor;
        })
        .catch(err => {
        });
    ClassicEditor
        .create(document.querySelector('#core_value'))
        .then(editor => {
            core_value = editor;
        })
        .catch(err => {
        });
    ClassicEditor
        .create(document.querySelector('#vision'))
        .then(editor => {
            vision = editor;
        })
        .catch(err => {
        });
    ClassicEditor
        .create(document.querySelector('#mission'))
        .then(editor => {
            mission = editor;
        })
        .catch(err => {
        });
    $('.chosen-select').chosen({width: "100%"});
    workplace.on('change', function () {
        let district = $.get('/workplace/list-district-by-province?province_id=' + $(this).val());
        let districtHtml = '<option value="">Chọn quận huyện</option>';
        district.done(function (data) {
            let countDistrict = data.length;
            for (let i = 0; i < countDistrict; i++) {
                districtHtml = districtHtml + '<option value="' + data[i].id + '">' + data[i].name + '</option>';
            }
            $('#district').html(districtHtml);
            $(".chosen-select").trigger("chosen:updated");
        });
        district.fail(function (data) {
            $('#district').html(districtHtml);
            $(".chosen-select").trigger("chosen:updated");
        });
    });
    $('#create_company').on('click',function () {
       $('#create_company').prop("disabled", true);
        let formData = new FormData(document.getElementById("upload_form"));
        formData.set('other', other.getData());
        formData.set('about_us', about_us.getData());
        formData.set('core_value', core_value.getData());
        formData.set('vision', vision.getData());
        formData.set('mission', mission.getData());
        $.ajax({
            url: '/company/store',
            data: formData,
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
                setTimeout(function () {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                      showMethod: 'slideDown',
                        timeOut: 1000
                    };
                    toastr.success('', 'Tạo công ty thành công');
                }, 500);
                setTimeout(function () {
                    window.location.href = '/company';
                }, 1500);
            },
            error: function (data) {
                $('#create_company').removeAttr("disabled");
                $(window).scrollTop(0);
                setTimeout(function () {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 1000
                    };
                    toastr.error('', 'Tạo công ty thất bại ');
                }, 500);
                let errors = data.responseJSON.errors;
                $('.error_create').html('');

                if (typeof errors.name_company != 'undefined') {
                    error_name_company.append('<span class="help-block m-b-none alert alert-danger">'+errors.name_company[0]+'</span>');
                }
                if (typeof errors.logo != 'undefined') {
                    error_logo.append('<span class="help-block m-b-none alert alert-danger">'+errors.logo[0]+'</span>');
                }
                if (typeof errors.address != 'undefined') {
                    error_address.append('<span class="help-block m-b-none alert alert-danger">'+errors.address[0]+'</span>');
                }
                if (typeof errors.workplace != 'undefined') {
                    error_workplace.append('<span class="help-block m-b-none alert alert-danger">'+errors.workplace[0]+'</span>');
                }
                if (typeof errors.email != 'undefined') {
                    error_email.append('<span class="help-block m-b-none alert alert-danger">'+errors.email[0]+'</span>');
                }
                if (typeof errors.sale_size != 'undefined') {
                    error_sale_size.append('<span class="help-block m-b-none alert alert-danger">'+errors.sale_size[0]+'</span>');
                }
                if (typeof errors.company_size != 'undefined') {
                    error_company_size.append('<span class="help-block m-b-none alert alert-danger">'+errors.company_size[0]+'</span>');
                }
                if (typeof errors.hotline != 'undefined') {
                    error_hotline.append('<span class="help-block m-b-none alert alert-danger">'+errors.hotline[0]+'</span>');
                }
                if (typeof errors.website != 'undefined') {
                    error_website.append('<span class="help-block m-b-none alert alert-danger">'+errors.website[0]+'</span>');
                }
                if (typeof errors.about_us != 'undefined') {
                    error_about_us.append('<span class="help-block m-b-none alert alert-danger">'+errors.about_us[0]+'</span>');
                }
            }
        })

    });
})(window.jQuery);


