$(function(){
    let $show_password = $('#show-password');
    let $password_input = $('#password');

    $show_password.click(function(){
        $(this).is(':checked') ? $password_input.attr('type', 'text') : $password_input.attr('type', 'password');
    });
});