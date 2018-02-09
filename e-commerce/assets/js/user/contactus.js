$(document).ready(function () {
    jQuery.validator.addMethod("phoneno", function (phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
    }, "<br />Please specify a valid phone number");
    $("#contactForm").validate({
        submitHandler: function (form) {
            contactInfo('contactForm');
            return false; //submit it the form
        },
        rules: {name: {required: true},
            email: {required: true, email: true},
            phone: {required: true, number: true, phoneno: true},
            subject: {required: true},
            message: {required: true}
        },
        messages: {name: {required: "Name is required"},
            email: {required: "Email is required"},
            phone: {required: "Mobile No. is required"},
            subject: {required: "Subject is required"},
            message: {required: "Message is required"}
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var type = $(element).attr("name");
            var id = $(element).attr("id");
            error.insertAfter(element.parent()).wrap('<div/>');
            element.parent().css('margin-bottom', '0px');
        },
    });

    function contactInfo(id)
    {
        var base_url = $("#txtbaseurl").val();
        var form = $('#' + id);
        $.ajax({
            type: "POST",
            url: base_url + 'ContactUs/saveContactInfo',
            data: form.serialize(), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            success: function (response) {
//                alert(response);
                window.location.href = base_url + "contact-us";
            }
        });
    }

    $("#complaintForm").validate({
        submitHandler: function (form) {
            complaintInfo('complaintForm');
            return false; //submit it the form
        },
        rules: {name: {required: true},
            email: {required: true, email: true},
            phone: {required: true, number: true, phoneno: true},
            reason: {required: true},
            message: {required: true},
            order_id: {required: true},
            coupon_code: {required: true}
        },
        messages: {name: {required: "Name is required"},
            email: {required: "Email is required"},
            phone: {required: "Mobile No. is required"},
            reason: {required: "Reason is required"},
            message: {required: "Message is required"},
            order_id: {required: "Order Id is required"},
            coupon_code: {required: "Coupon Code is required"}
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var type = $(element).attr("name");
            var id = $(element).attr("id");
            if (type == 'reason')
            {
                error.insertAfter(element.parent()).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
            } else
            {
                error.insertAfter(element.parent()).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
            }

        },
    });

    function complaintInfo(id)
    {
        var base_url = $("#txtbaseurl").val();
        var form = $('#' + id);
        $.ajax({
            type: "POST",
            url: base_url + 'ContactUs/saveComplaintInfo',
            data: form.serialize(), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            success: function (response) {
//                alert(response);
                window.location.href = base_url + "contact-us";
            }
        });
    }

// for change and select reason
    $("#reason").select2({
        dropdownCssClass: 'bigdrop'
    });

    $(document).on('change', '#reason', function (e) {
        //alert();
        var id = $(this).val();
        if (id == 'Order') {
            $("#order").show();
            $("#coupon").hide();
        }
        if (id == 'Coupons') {
            $("#coupon").show();
            $("#order").hide();
        }
        if (id == 'Account' || id == 'Website') {
            $("#coupon").hide();
            $("#order").hide();
        }
    });
});