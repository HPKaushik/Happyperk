$(document).ready(function () {
    $('#forgotpassopen').click(function () {
        $('#loginopen').hide();
        $('#forgotpassword').show();
    });
    $('#openlogins').click(function () {
        $('#forgotpassword').hide();
        $('#loginopen').show();
    });
    $("#forgotPasswordForm").validate({
        rules: {
            email: {required: true, email: true}
        },
        messages: {
            email: {required: "Email id is required"}
        }
    });

    $("#chnagePasswordForms").validate({
        rules: {
            npassword: {required: true},
            cpassword: {required: true, equalTo: "#npassword"}
        },
        messages: {
            npassword: {required: "New Password is required"},
            cpassword: {required: "Enter Confirm Password Same as New Password"}
        }
    });
});