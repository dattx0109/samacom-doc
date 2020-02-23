(function ($) {
    const $linkOpenModal = $('.modal-job');
    $linkOpenModal.on('click', function () {
        console.log('11');
        var name = $(this).attr("data-name");
        var phone = $(this).attr("data-phone");

        let referralId = $(this).attr("data-id");
        let gettingAllJob = $.get('/api/report/report-referral?referralId='+referralId);

        gettingAllJob.then(function (data) {
            $('#modal-name').html(name);
            $('#modal-phone').html(phone);
            let buildDataModal = '';
            data.forEach(function (item) {
                buildDataModal += '<tr><td>'+ item.id +'</td><td>'+ item.title +'</td><td>'+ item.count_apply +'</td><td>-</td></tr>'
            });
            $('#body-job').html(buildDataModal);
        });
        $('#modalJobForm').modal('show');
    });
    console.log('aaa');
})(window.jQuery);
