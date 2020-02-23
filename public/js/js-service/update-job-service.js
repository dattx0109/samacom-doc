(function ($) {
    let description;
    let requirements;
    let benefit;

    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            description = editor;
        })
        .catch(err => {
        });
    ClassicEditor
        .create(document.querySelector('#requirements'))
        .then(editor => {
            requirements = editor;
        })
        .catch(err => {
        });
    ClassicEditor
        .create(document.querySelector('#benefit'))
        .then(editor => {
            benefit = editor;
        })
        .catch(err => {
        });

    let Job = (function ($, window, document) {
        let dataRequest = {};
        dataRequest.company_id = $('select[name="company_id"]');
        dataRequest.title = $('input[name="title"]');
        dataRequest.level_id = $('select[name="level_id"]');
        dataRequest.job_type = $('select[name="job_type"]');
        dataRequest.income_min = $('input[name="income_min"]');
        dataRequest.income_max = $('input[name="income_max"]');
        dataRequest.base_salary_min = $('input[name="base_salary_min"]');
        dataRequest.base_salary_max = $('input[name="base_salary_max"]');
        dataRequest.province_id = $('select[name="province_id"]');
        dataRequest.district_id = $('select[name="district_id"]');
        dataRequest.workplace_full_text = $('input[name="workplace_full_text"]');
        dataRequest.tag = $('select[name="tag"]');
        dataRequest.field_work_id = $('select[name="field_work_id"]');
        dataRequest.gender = $('select[name="gender"]');
        dataRequest.description = $('.description');
        dataRequest.requirements = $('.requirements');
        dataRequest.benefit = $('.benefit');
        dataRequest.character = $('select[name="character"]');
        dataRequest.skills = $('select[name="skills"]');
        dataRequest.degree = $('select[name="degree"]');
        dataRequest.experience = $('select[name="experience"]');
        dataRequest.appearance = $('input[name="appearance"]');
        dataRequest.voice = $('input[name="voice"]');
        dataRequest.locationHref = $(location).attr('href');
        dataRequest.btnStore = $('.btn-store');
        dataRequest.job_expire = $('input[name="job_expire"]');
        dataRequest.type = $('input[name="type"]');
        dataRequest.employer_id = $('select[name="employer_id"]');
        dataRequest.btnHiddenJob = $('.btn-hidden-job');
        dataRequest.btnShowJob = $('.btn-show-job');
        dataRequest.btnPublicJob = $('.btn-public-job');

        dataRequest.error_company_id = $('div.error_company_id');
        dataRequest.error_title = $('div.error_title');
        dataRequest.error_income_min = $('div.error_income_min');
        dataRequest.error_income_max = $('div.error_income_max');
        dataRequest.error_base_salary_min = $('div.error_base_salary_min');
        dataRequest.error_base_salary_max = $('div.error_base_salary_max');
        dataRequest.error_province = $('div.error_province');
        dataRequest.error_gender = $('div.error_gender');
        dataRequest.error_description = $('div.error_description');
        dataRequest.error_requirements = $('div.error_requirements');
        dataRequest.error_benefit = $('div.error_benefit');
        dataRequest.error_type_of_employment = $('div.error_type_of_employment');
        dataRequest.error_field_work_sale = $('div.error_field_work_sale');
        dataRequest.error_level = $('div.error_level');
        dataRequest.error_job_expire = $('div.error_job_expire');
        dataRequest.error_type = $('div.error_type');
        dataRequest.error_employer_id = $('div.error_employer_id');
        dataRequest.error_tag = $('div.error_tag');
        dataRequest.replaceNumber = function (number) {
            let res = number.split(",").join("");
            res = res.split(".").join("");
            return res;
        };
        dataRequest.salary_base_type = $('input[name="salary_base_type"]');
        dataRequest.base_salary = $('div.base_salary');
        dataRequest.income_type = $('input[name="income_type"]');
        dataRequest.income = $('div.income');
        return dataRequest;

    }(window.jQuery, window, document));
    $('.chosen-select').chosen({width: "100%"});
    Job.income_min.simpleMoneyFormat();
    Job.income_max.simpleMoneyFormat();
    Job.base_salary_max.simpleMoneyFormat();
    Job.base_salary_min.simpleMoneyFormat();
    // setupSummernote( Job.description);
    // setupSummernote( Job.requirements);
    // setupSummernote( Job.benefit);
    $('.input-group.date').datepicker({
        todayBtn: "linked",
        format: 'dd-mm-yyyy',
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
    Job.btnStore.on('click', function () {
        Job.btnStore.prop("disabled", true);
        let parts = Job.locationHref.split("/");
        let last_part = parts[parts.length - 1];
        let jobUpdate = {
            'job_id': last_part,
            'company_id': Job.company_id.val(),
            'title': Job.title.val(),
            'job_type': Job.job_type.val(),
            'level_id': Job.level_id.val(),
            'income_min':Job.replaceNumber(Job.income_min.val()),
            'income_max': Job.replaceNumber(Job.income_max.val()),
            'base_salary_min': Job.replaceNumber(Job.base_salary_min.val()),
            'base_salary_max': Job.replaceNumber(Job.base_salary_max.val()),
            'province_id': Job.province_id.val(),
            'district_id': Job.district_id.val(),
            'workplace_full_text': Job.workplace_full_text.val(),
            'tag': Job.tag.val(),
            'field_work_id': Job.field_work_id.val(),
            'gender': Job.gender.val(),
            'description': description.getData(),
            'benefit': benefit.getData(),
            'requirements': requirements.getData(),
            'character': Job.character.val(),
            'skills': Job.skills.val(),
            'degree': Job.degree.val(),
            'experience': Job.experience.val(),
            'appearance': Job.appearance.val(),
            'voice': Job.voice.val(),
            'job_expire': Job.job_expire.val(),
            'type':Job.type.filter(':checked').val(),
            'employer_id':Job.employer_id.val(),
        };
        jobUpdate.salary_base_type = Job.salary_base_type.is(":checked")?1:2;
        jobUpdate.income_type = Job.income_type.is(":checked")?1:2;

        let updateJob = $.post('/job/update/' + last_part, jobUpdate);
        updateJob.done(function () {
            Job.btnStore.removeAttr("disabled");
            $('.error-create-job').html('');
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('', 'Update Job thành công');
            }, 1300);
            setTimeout(function () {
            location.href = '/danh-sach-cong-viec';
            }, 3000);
        });
        updateJob.fail(function (data) {
            Job.btnStore.removeAttr("disabled");
            $(window).scrollTop(0);
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 1000
                };
                toastr.error('', 'Cập nhật job thất ');

            }, 3000);
            let errors = data.responseJSON.error;
            $('.error-create-job').html('');

            if (typeof errors.company_id != 'undefined') {
                Job.error_company_id.append('<span class="help-block m-b-none alert alert-danger">' + errors.company_id[0] + '</span>');
            }
            if (typeof errors.title != 'undefined') {
                Job.error_title.append('<span class="help-block m-b-none alert alert-danger">' + errors.title[0] + '</span>');
            }
            if (typeof errors.job_type != 'undefined') {
                Job.error_type_of_employment.append('<span class="help-block m-b-none alert alert-danger">' + errors.job_type[0] + '</span>');
            }
            if (typeof errors.income_min !== 'undefined') {
                Job.error_income_min.append('<span class="help-block m-b-none alert alert-danger">' + errors.income_min[0] + '</span>');
            }
            if (typeof errors.income_max != 'undefined') {
                Job.error_income_max.append('<span class="help-block m-b-none alert alert-danger">' + errors.income_max[0] + '</span>');
            }
            if (typeof errors.base_salary_min != 'undefined') {
                Job.error_base_salary_min.append('<span class="help-block m-b-none alert alert-danger">' + errors.base_salary_min[0] + '</span>');
            }
            if (typeof errors.base_salary_max !== 'undefined') {
                Job.error_base_salary_max.append('<span class="help-block m-b-none alert alert-danger">' + errors.base_salary_max[0] + '</span>');
            }
            if (typeof errors.province_id != 'undefined') {
                Job.error_province.append('<span class="help-block m-b-none alert alert-danger">' + errors.province_id[0] + '</span>');
            }
            if (typeof errors.gender != 'undefined') {
                Job.error_gender.append('<span class="help-block m-b-none alert alert-danger">' + errors.gender[0] + '</span>');
            }
            if(typeof errors.description != 'undefined'){
                Job.error_description.append('<span class="help-block m-b-none alert alert-danger">'+errors.description[0]+'</span>');
            }
            if(typeof errors.requirements != 'undefined'){
                Job.error_requirements.append('<span class="help-block m-b-none alert alert-danger">'+errors.requirements[0]+'</span>');
            }
            if(typeof errors.benefit != 'undefined'){
                Job.error_benefit.append('<span class="help-block m-b-none alert alert-danger">'+errors.benefit[0]+'</span>');
            }
            if (typeof errors.field_work_id != 'undefined') {
                Job.error_field_work_sale.append('<span class="help-block m-b-none alert alert-danger">' + errors.field_work_id[0] + '</span>');
            }
            if (typeof errors.level_id != 'undefined') {
                Job.error_level.append('<span class="help-block m-b-none alert alert-danger">' + errors.level_id[0] + '</span>');
            }
            if(typeof errors.job_expire != 'undefined'){
                Job.error_job_expire.append('<span class="help-block m-b-none alert alert-danger">'+errors.job_expire[0]+'</span>');
            }
            if(typeof errors.employer_id != 'undefined'){
                Job.error_employer_id.append('<span class="help-block m-b-none alert alert-danger">'+errors.employer_id[0]+'</span>');
            }
            if(typeof errors.type != 'undefined'){
                Job.error_job_type.append('<span class="help-block m-b-none alert alert-danger">'+errors.type[0]+'</span>');
            }
            if(typeof errors.tag != 'undefined'){

                Job.error_tag.append('<span class="help-block m-b-none alert alert-danger">'+errors.tag[0]+'</span>');
            }
        });
    });
    Job.province_id.on('change', function () {
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
    Job.type.on('change',function(){
        let type =  $(this).filter(':checked').val();
        if(type==2)
        {
            $('.select-employer').show();
        }
        if(type==1)
        {
            $('.select-employer').hide();
        }

    });
    Job.salary_base_type.on('change', function () {
        if (!$(this).is(":checked")) {

            Job.base_salary.removeClass('hidden');
            Job.base_salary_min.val('');
            Job.base_salary_max.val('');
        }
        if ($(this).is(":checked")) {
            Job.base_salary.addClass('hidden');
        }
    });
    Job.income_type.on('change', function () {
        if (!$(this).is(":checked")) {

            Job.income.removeClass('hidden');
            Job.income_min.val('');
            Job.income_max.val('');
        }
        if ($(this).is(":checked")) {
            Job.income.addClass('hidden');
        }
    });
})(window.jQuery);
