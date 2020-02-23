(function($){
    let Job = (function ($, window, document) {
        let dataRequest = {};
        dataRequest.jobId = null;
        dataRequest.btnHiddenJob = $('.btn-hidden-job');
        dataRequest.btnShowJob = $('.btn-show-job');
        dataRequest.btnPublicJob = $('.btn-public-job');
        dataRequest.btnModalPublicJob = $('.btn-modal-public');
        dataRequest.btnModalHideJob = $('.btn-modal-hide');
        dataRequest.btnModalShowJob = $('.btn-modal-show');
        return dataRequest;
    }(window.jQuery, window, document));

    $('.checkbox-check-all').click(function () {
        var checkedStatus = this.checked;
        $('.checkbox-table tr').find('td:first :checkbox').each(function () {
            $(this).prop('checked', checkedStatus);
        });
    });

    $('#reset_fillter').click(function(){
        $('#salary').prop('selectedIndex',0);
        $('#sale').prop('selectedIndex',0);
        $('#orderByJob').prop('selectedIndex',0);
        $('#orderBySale').prop('selectedIndex',0);
        $('#orderByPost').prop('selectedIndex',0);
        $('#title').val("");
    });
    Job.btnModalPublicJob.on('click',function(){
        Job.id = $(this).data('id');
    });
    Job.btnModalHideJob.on('click',function(){
        Job.id = $(this).data('id');
    });
    Job.btnModalShowJob.on('click',function(){
        Job.id = $(this).data('id');
    });
    Job.btnHiddenJob.on('click',function(){
        $(this).attr("disabled", true);
        let datChange = {'is_show': 2};
        $(this).attr("disabled", true);
        let hiddenJob = $.post('/job/change-show/' + Job.id, datChange);
        hiddenJob.done(function(){
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 1000
                };
                toastr.success('', 'Ẩn Job thành công');
            }, 1300);
            setTimeout(function () {
                location.reload();
            }, 3000);
        });
        hiddenJob.fail(function(){
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 1000
                };
                toastr.error('', 'Ẩn Job thất bại');
            }, 1300);
            setTimeout(function () {
                location.reload();
            }, 3000);
        });
    });

    Job.btnShowJob.on('click',function(){
        $(this).attr("disabled", true);
        let datChange = {'is_show': 1};
        $(this).attr("disabled", true);
        let showJob = $.post('/job/change-show/' + Job.id, datChange);
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
        $(this).attr("disabled", true);
        let publicJob = $.post('/job/public/' + Job.id);
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
    })
})(window.jQuery);
