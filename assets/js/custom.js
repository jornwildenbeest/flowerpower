function register() {
    // check if the repeated password matches first password.
    $("#firstpassword, #secondpassword").keyup(function() {
        if ($('#firstpassword').val() !== $('#secondpassword').val()){
            $('.register_errors').html("<li  style='color: red;'>passwords don't match</li>");
        } else {
            $('.register_errors li').remove();
        }
    });
}

$(document).ready(function () {
    register();
});