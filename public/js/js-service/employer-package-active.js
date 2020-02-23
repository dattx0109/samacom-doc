(function ($, window, document) {

    $(function () {
        const type = $('select[name="status"]');
        type.on('change', function (){
            let approve = $.post('/active-package-for-employer/'+$(this).data('id'), {'status':$(this).val()});
            approve.done(function(data){
                setTimeout(function() {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.success( 'Xử lý yêu cầu thành công ', '');

                }, 1300);
                setTimeout(function() {
                    location.reload();
                }, 5300);
            });
            approve.fail(function(data){
                setTimeout(function() {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.error('Xử lý yêu cầu thành công', '');

                }, 1300);
            });
        });

    });

    // The rest of the code goes here!

}(window.jQuery, window, document));
