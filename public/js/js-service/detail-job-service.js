(function ($) {
    console.log(1);
    let Job = (function ($, window, document) {
        let dataRequest = {};
        dataRequest.btnHiddenJob = $('.btn-hidden-job');
        dataRequest.btnShowJob = $('.btn-show-job');
        dataRequest.btnPublicJob = $('.btn-public-job');
        dataRequest.locationHref = $(location).attr('href');
        return dataRequest;

    }(window.jQuery, window, document));
    Job.btnHiddenJob.on('click',function(){
        $(this).attr("disabled", true);
        let parts = Job.locationHref.split("/");
        let last_part = parts[parts.length - 1];
        let datChange = {'is_show': 2};
        $(this).attr("disabled", true);
        let hiddenJob = $.post('/job/change-show/' + last_part, datChange);
        hiddenJob.done(function(){
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('', 'Ẩn Job thành công');
            }, 1300);
            setTimeout(function () {
                // location.reload();
            }, 5000);
        });
        hiddenJob.fail(function(){
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.error('', 'Ẩn Job thất bại');
            }, 1300);
            setTimeout(function () {
                // location.reload();
            }, 5000);
        });
    });

    Job.btnShowJob.on('click',function(){
        $(this).attr("disabled", true);
        let parts = Job.locationHref.split("/");
        let last_part = parts[parts.length - 1];
        let datChange = {'is_show': 1};
        $(this).attr("disabled", true);
        let showJob = $.post('/job/change-show/' + last_part, datChange);
        showJob.done(function(){

            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 1000
                };
                toastr.success('', 'Hiện Job thành công');
            }, 1300);
            setTimeout(function () {
                 location.reload();
            }, 3000);
        });
        showJob.fail(function(){
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 1000
                };
                toastr.error('', 'Hiện Job thất bại');
            }, 1300);
            setTimeout(function () {
                 location.reload();
            }, 3000);
        });
    });
    Job.btnPublicJob.on('click',function(){
        $(this).attr("disabled", true);
        let parts = Job.locationHref.split("/");
        let last_part = parts[parts.length - 1];
        $(this).attr("disabled", true);
        let publicJob = $.post('/job/public/' + last_part);
        publicJob.done(function(){
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 1000
                };
                toastr.success('', 'Public job thành công');
            }, 1300);
            setTimeout(function () {
                 location.reload();
            }, 3000);
        });
        publicJob.fail(function(){
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 1000
                };
                toastr.error('', 'public job thất bại');
            }, 1300);
            setTimeout(function () {
                 location.reload();
            }, 3000);
        });
    });
    $('.chosen-select').chosen({width: "100%"});
    $( "td:contains('Không có dữ liệu')" ).addClass('null-info-block');
    $('.btn-store').on('click', function (){
        $('#create-job').submit();
    })
})(window.jQuery);
