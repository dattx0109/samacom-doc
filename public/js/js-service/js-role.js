(function ($) {

    const $linkListUser = $('.list-user');
    var buildHtmlListUser = function(data){
        var element = '';
        if(data.length === 0){
            $('.listUser').html('Không có thành viên nào !');
            return;
        }
        data.forEach(function (item) {
            element = element +'<li class="list-group-item"><span class="badge badge-info">'+ item.email+'</span>'+ item.name +'</li>';
        });
        $('.listUser').html(element);
    };
    $linkListUser.on('click', function () {
        let roleId = $(this).attr('data-id');
        $('#listUser').modal('show');
        let gettingListUserOfRole = $.get('/api/role/user-of-role?role_id='+roleId);
        gettingListUserOfRole.then(function (data) {
            buildHtmlListUser(data.data);
            console.log(data);
        })


    });
})(window.jQuery);
