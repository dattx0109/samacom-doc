$(document).ready(function () {
    console.log(11111111);
    const name = $('#name');
    const email = $('#email');
    const password = $('#password');
    const btnSubmit = $('#btn-submit');

    btnSubmit.on('click',function () {
        let data = {
            name: name.val(),
            email: email.val(),
            password: password.val()
        }
        let url = '/company/store-test';
        let addAccount = $.post(url, data);
        addAccount.done(function (data) {
            console.log(data);
        })
    })
})
