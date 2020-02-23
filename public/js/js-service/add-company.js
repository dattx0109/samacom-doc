$(function () {
    const about_us = $('#about_us');
    const mission = $('#mission');
    const vision = $('#vision');
    const core_value = $('#core_value');
    const other = $('#other');
    const bntSave = $('#create_company');
    bntSave.on('click',function () {
       let dataPost = {
           about_us: about_us.val(),
           mission: mission.val(),
           vision: vision.val(),
           core_value: core_value.val(),
           other: other.val(),
       };
        let addCompany = $.post('/company/add', dataPost);
        addCompany.done(function () {
       });
    });
}(window.jQuery));
