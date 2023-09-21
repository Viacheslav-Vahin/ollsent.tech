jQuery(document).ready(function($) {
    $('#formsubm').click(function(e) {
        e.preventDefault();
        var data = {
            action: 'submit_step',
            email: $('#email').val(),
            checkboxRules: $('input[name=checkboxRules]').is(':checked'),
            checkboxSubscribe: $('input[name=checkboxSubscribe]').is(':checked'),
            lastName: $('input[name=lastName]').val(),
            name: $('input[name=name]').val(),
            password: $('input[name=password]').val(),
            confirmPassword: $('input[name=confirmPassword]').val(),
            security: MyAjax2.security
        };
        $.post(MyAjax2.ajaxurl, data, function(response) {

            $('.mainfaq').css('display','block');
        });
    });
});
