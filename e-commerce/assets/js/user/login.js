$("#loginForm").validate({
    rules: {
        password: {required: true},
        email: {required: true},
    },
    messages: {
        email: {required: "Email is required."},
        password: {required: "Password is required."},
    },
});