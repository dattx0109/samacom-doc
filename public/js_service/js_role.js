(function ($) {
   $(function () {
       const $roleName = $('#role_name');
       const $notificaitonError = $('.notificaiton');
       const $btnSubmit = $('#btn_new_role');
       $btnSubmit.on('click',function () {
           let roleName = $roleName.val();
           let rawdataPost = {
               'roleName' : roleName
           };

           let addNewRole = $.post('/role', rawdataPost);

           addNewRole.then(function (data) {
                console.log(data);
               if(data.code !== 3){
                   $notificaitonError.html(data.message);
               }

               if (data.code === 3) {
                   setTimeout(function() {
                       toastr.options = {
                           closeButton: true,
                           progressBar: true,
                           showMethod: 'slideDown',
                           timeOut: 3000
                       };
                       toastr.success('Thêm mới vai trò thành công');
                   }, 1000);

                   setTimeout(function() {
                       window.location.href = '/role/';
                   }, 1500);
               }
               // $(this).html('');
           });
       });
   });
})(window.jQuery);
